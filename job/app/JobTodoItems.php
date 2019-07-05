<?php

namespace App;

use GuzzleHttp\Client;
use GuzzleHttp\Psr7\Request;
use GuzzleHttp\HandlerStack;
use GuzzleHttp\Middleware;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Queue\Events\JobExceptionOccurred;
use Illuminate\Support\Facades\DB;

class JobTodoItems extends Model
{
    public $timestamps = false;
    protected $fillable = [
        'job_number_fk', 'action', 'is_complete','created', 'modified','completed_date'
    ];

    public function addAction($request)
    {
        $container = [];
        $history = Middleware::history($container);
        $stack = HandlerStack::create();
        $stack->push($history);


        $client = new Client(['handler' => $stack]);

        $job_number = $request->input('job_number');
        $next_action = $request->input('next_action');
        $xml = '<?xml version="1.0" encoding="ISO-8859-1"?>
                <Note>
                    <Job>' . $job_number . '</Job>
                    <Title>Next Action</Title>
                    <Text>' . $next_action . '</Text>
                </Note>';

        $url = 'https://api.workflowmax.com/job.api/note?apiKey='
            . env('API_KEY') . '&accountKey=' . env('ACCOUNT_KEY');


        $request = new Request(
            'POST',
            $url,
            ['Content-Type' => 'text/xml; charset=UTF8'],
            $xml,
            ['debug' => true]
        );

        $client->send($request);

        $res = "";
        foreach ($container as $transaction) {
            $res = $res . "\n" . (string) $transaction['request']->getBody();
        }

        return $res;
    }

    public function addActionFromAPI($request)
    {
        $client = new Client();

        $res = $client->request(
            'GET',
            'https://api.workflowmax.com/job.api/get/' . $request->input('job_number') . '?apiKey='
            . env('API_KEY') . '&accountKey=' . env('ACCOUNT_KEY')
        );

        $res = simplexml_load_string($res->getBody());

        foreach ($res->Job->Notes[0] as $note) {
            $req = JobTodoItems::where('note_id', '=', $note->ID)
                ->first();

            if (!$req) {
                $job = new JobTodoItems();

                $job->job_number_fk = $request->input('job_number');
                $job->note_id = $note->ID;
                $job->action = $note->Text;
                $job->created = $note->Date;
                $job->is_complete = 0;

                $job->save();
            }
        }
    }

    public function listActionDB($request)
    {
        return DB::table('job_todo_items')
            ->where('job_number_fk', '=', $request->input('job_number'))
            ->orderBy('created', 'asc')
            ->get();
    }

    public function updateComplete($request)
    {
        $job = JobTodoItems::where('note_id', '=', $request->input('note_id'))->first();

        if ($request->input('checked') == "true") {
            $job->is_complete = 1;
            $job->completed_date = date("Y-m-d H:i:s");
        } else {
            $job->is_complete = 0;
            $job->completed_date = null;
        }

        $job->save();
    }

    public function modifyTask($request)
    {
        $job = JobTodoItems::where('note_id', '=', $request->input('note_id'))->first();

        $job->action = $request->input('note_action');
        $job->modified = date("Y-m-d H:i:s");

        $job->save();
    }
}
