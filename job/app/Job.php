<?php

namespace App;

use App\Mail\InvoiceSend;
use GuzzleHttp\Client;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;
use Response;

class Job extends Model
{
    protected $fillable = [
        'job_number', 'client_name', 'job_name','state',
        'start_date','due_date','manager_name','developer_name','completed_date'
    ];
    public $timestamps = false;

    public function getJobList()
    {
        $client = new Client();

        $res = $client->request(
            'GET',
            'https://api.workflowmax.com/job.api/current?apiKey=' . env('API_KEY')
            . '&accountKey=' . env('ACCOUNT_KEY')
        );

        return simplexml_load_string($res->getBody());
    }

    public function getStaffList()
    {
        $client = new Client();

        $res = $client->request(
            'GET',
            'https://api.workflowmax.com/staff.api/list?apiKey=' . env('API_KEY')
            . '&accountKey=' . env('ACCOUNT_KEY')
        );
        return simplexml_load_string($res->getBody());
    }

    public function getTaskList()
    {
        $client = new Client();

        $res = $client->request(
            'GET',
            'https://api.workflowmax.com/job.api/tasks?apiKey=' . env('API_KEY')
            . '&accountKey=' . env('ACCOUNT_KEY')
        );
        $res = simplexml_load_string($res->getBody());

        foreach ($res->Jobs[0] as $action) {
            foreach ($action->Tasks[0] as $task) {
                $req = JobTodoItems::where('job_number_fk', '=', $action->ID)
                    ->where('action', '=', $task->Name)
                    ->first();
                if (!$req) {
                    $job_item = new JobTodoItems();

                    $job_item->job_number_fk = $action->ID;
                    $job_item->action = $task->Name;
                    $job_item->created = date("Y-m-d H:i:s");
                    if ($task->Completed == "true") {
                        $job_item->is_complete = 1;
                        $job_item->completed_date = date("Y-m-d H:i:s");
                    } else {
                        $job_item->is_complete = 0;
                    }

                    $job_item->save();
                }
            }
        }
    }

    public function getCheck()
    {
        return DB::table('jobs')
            ->get();
    }

    public function getAction()
    {
        return DB::table('job_todo_items')
            ->get();
    }

    public function invoiceJob($request)
    {
        $job_exist = Job::where('job_number', $request->input('job_number'))->first();
        if (!$job_exist) {
            $job = new Job();
        } else {
            $job = Job::find($job_exist->id);
        }

        $job->job_number = $request->input('job_number');
        $job->client_name = $request->input('client_name');
        $job->job_name = $request->input('job_name');
        $job->state = $request->input('state');
        $start_date = explode("/", $request->input('start_date'));
        $job->start_date = $start_date[2] . "/" . $start_date[1] . "/" . $start_date[0];
        $due_date = explode("/", $request->input('due_date'));
        $job->due_date = $due_date[2] . "/" . $due_date[1] . "/" . $due_date[0];
        $job->manager_name = $request->input('manager_name');
        $job->developer_name = $request->input('developer_name');
        if ($request->input('invoice') == 1) {
            $job->completed_date = date("Y-m-d H:i:s");

            Mail::to("troy@increaseo.com")
                ->send(new InvoiceSend(
                    $job->job_number,
                    $job->job_name,
                    $job->manager_name,
                    $job->developer_name,
                    date("d/m/Y"),
                    "https://my.workflowmax.com/job/jobview.aspx?id=" . $job->job_number,
                    $job->client_name
                ));
        } else {
            $job->completed_date = null;
        }

        $job->save();

        return response()->json($job);
    }

    public function addJob($request)
    {
        $job_exist = Job::where('job_number', $request->input('job_number'))->first();
        if (!$job_exist) {
            $job = new Job();
        } else {
            $job = Job::find($job_exist->id);
        }

        $job->job_number = $request->input('job_number');
        $job->client_name = $request->input('client_name');
        $job->job_name = $request->input('job_name');
        $job->state = $request->input('state');
        $start_date = explode("/", $request->input('start_date'));
        $job->start_date = $start_date[2] . "/" . $start_date[1] . "/" . $start_date[0];
        $due_date = explode("/", $request->input('due_date'));
        $job->due_date = $due_date[2] . "/" . $due_date[1] . "/" . $due_date[0];
        $job->manager_name = $request->input('manager_name');
        $job->developer_name = $request->input('developer_name');

        $job->save();

        return response()->json($job);
    }
}