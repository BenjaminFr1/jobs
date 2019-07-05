<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class InvoiceSend extends Mailable
{
    use Queueable, SerializesModels;
    public $job_number;
    public $job_name;
    public $manager_name;
    public $developer_name;
    public $completed_date;
    public $link;
    public $client;
    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($job_number, $job_name, $manager_name, $developer_name, $completed_date, $link, $client)
    {
        $this->job_number = $job_number;
        $this->job_name = $job_name;
        $this->manager_name = $manager_name;
        $this->developer_name = $developer_name;
        $this->completed_date = $completed_date;
        $this->link = $link;
        $this->client = $client;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        $job = array('job_number' => $this->job_number,
            'job_name' => $this->job_name,
            'manager_name' => $this->manager_name,
            'developer_name' => $this->developer_name,
            'completed_date' => $this->completed_date,
            'link' => $this->link,
        );
        return $this->subject('Ready to Invoice: ' . $this->job_number .' - '. $this->job_name .' - '. $this->client)->view('mailInvoice', compact('job'));
    }
}
