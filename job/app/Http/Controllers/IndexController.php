<?php

namespace App\Http\Controllers;

use App\Job;
use App\JobTodoItems;
use Illuminate\Http\Request;

class IndexController extends Controller
{
    public function index()
    {
        $job = new Job();
        //$job->getTaskList();
        return view(
            'welcome',
            array (
                'data' => $job->getJobList(),
                'StaffList' => $job->getStaffList(),
                'check' => $job->getCheck(),
            )
        );
    }

    public function invoiceJob(Request $request)
    {
        $job = new Job();
        return $job->invoiceJob($request);
    }

    public function addJob(Request $request)
    {
        $job = new Job();
        return $job->addJob($request);
    }

    public function addAction(Request $request)
    {
        $job = new JobTodoItems();
        return $job->addAction($request);
    }

    public function listAction(Request $request)
    {
        $job = new JobTodoItems();
        $job->addActionFromAPI($request);
        return $job->listActionDB($request);
    }

    public function updateComplete(Request $request)
    {
        $job = new JobTodoItems();
        return $job->updateComplete($request);
    }

    public function modifyTask(Request $request)
    {
        $job = new JobTodoItems();
        return $job->modifyTask($request);
    }
}
