<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Job</title>

    <!-- Fonts -->
    <link href="https://fonts.googleapis.com/css?family=Nunito:200,600" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.datatables.net/1.10.18/css/dataTables.bootstrap4.min.css">
    <script src="https://code.jquery.com/jquery-3.3.1.js"></script>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css"
          integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.1/css/all.css">
    <link rel="stylesheet"
          href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.0/jquery.min.js"></script>
    <script src = "https://ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>

    <script src="https://code.jquery.com/jquery-3.3.1.min.js"></script>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css"
          integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <script src="https://unpkg.com/gijgo@1.9.13/js/gijgo.min.js"
            type="text/javascript"></script>
    <link href="https://unpkg.com/gijgo@1.9.13/css/gijgo.min.css" rel="stylesheet" type="text/css" />
    <link href="http://dev3.increaseo.com.au/wip/public/css/master.css" rel="stylesheet">

</head>
<body>

<div class="row">
    <div class="col-1"></div>
    <div class="col-2">
        <br>
        <br>
        <br>
        <label >Show Invoice : </label>
        <select onchange="show_ready_to_invoice()" id="select_show_invoice" class="form-control">
            <option>No</option>
            <option>Yes</option>
        </select>
    </div>
    <div class="col-4"></div>
    <div class="col-5">
        <div class="card text-center" >

            <div class="card-header">
                Hide Column
            </div>

            <div class="card-body">

                <label class="onclick" id="hide_job_number_color" style="color: grey;" onclick="hide_column('hide_job_number')">
                    Job Number</label>
                <input hidden id="hide_job_number" type="checkbox" value="1">

                <strong>~</strong>

                <label class="onclick" id="hide_client_color" onclick="hide_column('hide_client')">Client</label>
                <input hidden id="hide_client" type="checkbox" checked value="2">

                <strong>~</strong>

                <label class="onclick" id="hide_job_name_color" onclick="hide_column('hide_job_name')">Job Name</label>
                <input hidden id="hide_job_name" type="checkbox" checked value="3">

                <strong>~</strong>

                <label class="onclick" id="hide_state_color" onclick="hide_column('hide_state')">State</label>
                <input hidden id="hide_state" type="checkbox" checked value="4">

                <br>

                <label class="onclick" id="hide_start_date_color" style="color: grey;" onclick="hide_column('hide_start_date')">
                    Start Date</label>
                <input hidden id="hide_start_date" type="checkbox" value="5">

                <strong>~</strong>

                <label class="onclick" id="hide_due_date_color" style="color: grey;" onclick="hide_column('hide_due_date')">Due Start</label>
                <input hidden id="hide_due_date" type="checkbox" value="6">

                <strong>~</strong>

                <label class="onclick" id="hide_account_manager_color" onclick="hide_column('hide_account_manager')">
                    Account Manager</label>
                <input hidden id="hide_account_manager" type="checkbox" checked value="7">

                <strong>~</strong>

                <label class="onclick" id="hide_developer_color" onclick="hide_column('hide_developer')">
                    Developer</label>
                <input hidden id="hide_developer" type="checkbox" checked value="8">

                </tr>
            </div>

        </div>
    </div>
</div>
<br>

<div id="success" class="text-center text-success">
</div>


<?php $id_staff=0 ?>
<input hidden id="size_staff" value="{{sizeof($StaffList->StaffList[0])}}">
@foreach($StaffList->StaffList[0] as $staff)
    <input hidden id="staff_id{{$id_staff}}" value="{{$staff->Name}}">
    <?php $id_staff++ ?>
@endforeach


<table class="table table-hover table-bordered table-striped table-light" id="myTable">

    <thead>
    <tr>
        <th scope="col" style="width: 100px;" class="text-center hide_th">Job Number</th>
        <th scope="col" class="text-center hide_th">Client</th>
        <th scope="col" class="text-center hide_th">Job Name</th>
        <th scope="col" class="text-center hide_th">State</th>
        <th scope="col" class="text-center hide_th">Start Date</th>
        <th scope="col" class="text-center hide_th">Due Date</th>
        <th scope="col" class="text-center hide_th">Account Manager</th>
        <th scope="col" class="text-center hide_th">Developer</th>
        <th scope="col" style="width: 100px;" class="text-center hide_th">Actions</th>
        <th scope="col" class="text-center hide_th">Ready To Invoice</th>
    </tr>
    </thead>

    <tbody id="pagination">

    <?php $i = 0 ?>

    @foreach($data->Jobs[0] as $job)

        <?php
        $bol_check = 0;
        $nb_job = 0 ;
        $job_place = 0;
        $data_exist = 0
        ?>

        @foreach($check as $job_check)
            @if($job_check->job_number == $job->ID )
                @if( $job_check->completed_date != null )
                    <?php
                    $bol_check = 1;
                    ?>
                @endif
                <?php
                $job_place = $nb_job;
                $data_exist = 1
                ?>
            @endif
            <?php $nb_job++ ?>
        @endforeach

        <tr id="{{$i}}" @if($bol_check == 1) hidden @endif>

            @if($data_exist == 1)


                <td class="text-center hide_td" >

                    <p id="job_number{{$i}}">
                        {{$check[$job_place]->job_number}}</p>

                </td>



                <td class="text-center hide_td">

                    <p id="client_name{{$i}}">{{$check[$job_place]->client_name}}</p>

                </td>



                <td class="text-center hide_td">

                    <div hidden>
                        {{$check[$job_place]->job_name}}
                    </div>
                    <input onchange="able_save_data('{{$i}}')" id="job_name{{$i}}" class="form-control"
                           disabled value="{{$check[$job_place]->job_name}}">

                </td>



                <td class="text-center hide_td">

                    <select onchange="able_save_data('{{$i}}')" id="state{{$i}}" class="form-control" disabled>
                        <option>{{$check[$job_place]->state}}</option>
                    </select>

                </td>



                <td class="text-center hide_td">

                    <div hidden>
                        {{date('d/m/Y',strtotime($check[$job_place]->start_date))}}
                    </div>
                    <input onchange="able_save_data('{{$i}}')" id="datepicker_start_date{{$i}}"
                           class="form-control datepicker_start_date" disabled
                           value="{{date('d/m/Y', strtotime($check[$job_place]->start_date))}}">

                </td>



                <td class="text-center hide_td">

                    <div hidden>
                        {{date('d/m/Y',strtotime($check[$job_place]->due_date))}}
                    </div>
                    <input onchange="able_save_data('{{$i}}')" id="datepicker_due_date{{$i}}"
                           class="form-control datepicker_due_date" disabled
                           value="{{date('d/m/Y', strtotime($check[$job_place]->due_date))}}">

                </td>



                <td class="text-center hide_td">

                    <select onchange="able_save_data('{{$i}}')" id="account_manager{{$i}}"
                            class="form-control" disabled>
                        <option>{{ $check[$job_place]->manager_name }}</option>
                    </select>

                </td>



                <td class="text-center hide_td">

                    <select onchange="able_save_data('{{$i}}')" id="developer{{$i}}"
                            class="form-control" disabled>
                        <option>{{ $check[$job_place]->developer_name }}</option>
                    </select>

                </td>



                <td class="text-center hide_td">

                    <i onclick="edit('{{$i}}')" class="fas fa-pencil-alt edit_save"></i>
                    <strong> ~ </strong>
                    <i onclick="show_description('{{$i}}')" class="far fa-eye edit_save"></i>
                    <strong> ~ </strong>
                    <i onclick="save_data('{{$i}}')" class="fas fa-save edit_save" ></i>

                </td>



                <td class="text-center hide_td">

                    <input @if($bol_check == 1) checked @endif onclick="ready_to_invoice('{{$i}}')" id="checkbox{{$i}}" type="checkbox" disabled>

                </td>


            @else


                <td class="text-center hide_td" >

                    <p id="job_number{{$i}}" >{{$job->ID}}</p>

                </td>



                <td class="text-center hide_td">

                    <p id="client_name{{$i}}">{{$job->Client->Name}}</p>

                </td>



                <td class="text-center hide_td">

                    <div hidden>
                        {{$job->Name}}
                    </div>
                    <input onchange="able_save_data('{{$i}}')" id="job_name{{$i}}" class="form-control" disabled
                           @if($job->Name !=null)
                           value="{{$job->Name}}"
                            @endif
                    >

                </td>



                <td class="text-center hide_td">

                    <select onchange="able_save_data('{{$i}}')" id="state{{$i}}" class="form-control" disabled>
                        <option>{{$job->State}}</option>
                    </select>

                </td>



                <td class="text-center hide_td">

                    <div hidden>
                        {{date('d/m/Y',strtotime($job->StartDate))}}
                    </div>
                    <input onchange="able_save_data('{{$i}}')"
                           id="datepicker_start_date{{$i}}"
                           class="form-control datepicker_start_date" disabled
                           @if($job->StartDate !=null)
                           value="{{date('d/m/Y',strtotime($job->StartDate))}}"
                            @endif
                    >

                </td>



                <td class="text-center hide_td">

                    <div hidden>
                        {{date('d/m/Y',strtotime($job->DueDate))}}
                    </div>
                    <input onchange="able_save_data('{{$i}}')" id="datepicker_due_date{{$i}}"
                           class="form-control datepicker_due_date" disabled
                           @if($job->DueDate !=null)
                           value="{{date('d/m/Y',strtotime($job->DueDate))}}"
                            @endif
                    >

                </td>



                <td class="text-center hide_td">

                    <select onchange="able_save_data('{{$i}}')"
                            id="account_manager{{$i}}" class="form-control" disabled>
                        @if($job->Manager->Name != null)
                            <option>{{$job->Manager->Name}}</option>
                        @else
                            <option></option>
                        @endif
                    </select>

                </td>



                <td class="text-center hide_td">

                    <select onchange="able_save_data('{{$i}}')"
                            id="developer{{$i}}" class="form-control" disabled>
                        <option></option>
                    </select>

                </td>



                <td class="text-center hide_td">

                    <i onclick="edit('{{$i}}')" class="fas fa-pencil-alt edit_save"></i>
                    <strong> ~ </strong>
                    <i onclick="show_description('{{$i}}')" class="far fa-eye edit_save"></i>
                    <strong> ~ </strong>
                    <i onclick="save_data('{{$i}}')" class="fas fa-save edit_save" ></i>

                </td>



                <td class="text-center hide_td">

                    <input onclick="ready_to_invoice('{{$i}}')" id="checkbox{{$i}}" type="checkbox" disabled>

                </td>


            @endif
        </tr>

        @if($data_exist == 1)

            <tr id="show{{$i}}"  class="text-center hidden_row{{$i}}" hidden>
                <td hidden>{{$check[$job_place]->job_number}}</td>
                <td hidden>{{$check[$job_place]->client_name}}</td>
                <td hidden>{{$check[$job_place]->job_name}}</td>
                <td hidden>{{$check[$job_place]->state}}</td>
                <td hidden>{{date('Y/m/d',strtotime($check[$job_place]->start_date))}}</td>
                <td hidden>{{date('Y/m/d',strtotime($check[$job_place]->due_date))}}</td>
                <td hidden>{{ $check[$job_place]->manager_name }}</td>
                <td hidden>{{ $check[$job_place]->developer_name }}</td>
                <td hidden></td>
                <td colspan="10">

                    <div id="action{{$i}}">


                        <div class="form-group">
                            <div class="row">
                                <div class="col-1"></div>
                                <div class="col-9">
                                    <label><strong>Next Action :</strong></label>
                                    <textarea class="form-control" id="text_area{{$i}}"></textarea>
                                </div>
                                <div class="col-1">
                                    <br>
                                    <br>
                                    <button class="btn btn-primary" onclick="save_new_action('{{$i}}')">Save</button>
                                </div>
                                <div class="col-1"></div>
                            </div>
                        </div>


                        <div class="row">
                            <div class="col-1"></div>
                            <div class="col-10">
                                <div style="border-top: solid 1px;"></div>
                            </div>
                            <div class="col-1"></div>
                        </div>

                        <br>

                        <div class="row">
                            <div class="col-1"></div>
                            <div class="col-2">
                                <label >Show Completed Action : </label>
                                <select id="select_show_action_{{$i}}" onchange="show_completed_action('{{$i}}')" class="form-control">
                                    <option>No</option>
                                    <option>Yes</option>
                                </select>
                            </div>
                            <div class="col-7"></div>
                        </div>

                        <br>

                        <div class="row">
                            <div class="col-1"></div>
                            <div class="col-10">
                                <table class="table table-hover" id="tableAction{{$i}}">
                                    <tbody>
                                    <tr>
                                        <th width="85%">Next Action</th>
                                        <th width="15%">Complete</th>
                                    </tr>
                                    </tbody>
                                </table>
                            </div>
                            <div class="col-1"></div>
                        </div>

                    </div>

                </td>

            </tr>

        @else

            <tr id="show{{$i}}" class="text-center hidden_row{{$i}}" hidden>

                <td hidden>{{$job->ID}}</td>
                <td hidden>{{$job->Client->Name}}</td>
                <td hidden>{{$job->Name}}</td>
                <td hidden>{{$job->State}}</td>
                <td hidden>{{date('Y/m/d',strtotime($job->StartDate))}}</td>
                <td hidden>{{date('Y/m/d',strtotime($job->DueDate))}}</td>
                <td hidden>{{$job->Manager->Name}}</td>
                <td hidden></td>
                <td hidden></td>
                <td colspan="10"class="text-center">


                    <div id="action{{$i}}">

                        <div class="action_success{{$i}}"></div>

                        <div class="form-group">
                            <div class="row">
                                <div class="col-1"></div>
                                <div class="col-9">
                                    <label><strong>Next Action :</strong></label>
                                    <textarea class="form-control" id="text_area{{$i}}"></textarea>
                                </div>
                                <div class="col-1">
                                    <br>
                                    <br>
                                    <button class="btn btn-primary" onclick="save_new_action('{{$i}}')">Save</button>
                                </div>
                                <div class="col-1"></div>
                            </div>
                        </div>


                        <div class="row">
                            <div class="col-1"></div>
                            <div class="col-10">
                                <div style="border-top: solid 1px;"></div>
                            </div>
                            <div class="col-1"></div>
                        </div>

                        <br>

                        <div class="row">
                            <div class="col-1"></div>
                            <div class="col-2">
                                <label >Show Completed Action : </label>
                                <select id="select_show_action_{{$i}}" onchange="show_completed_action('{{$i}}')" class="form-control">
                                    <option>No</option>
                                    <option>Yes</option>
                                </select>
                            </div>
                            <div class="col-7"></div>
                        </div>

                        <br>

                        <div class="row">
                            <div class="col-1"></div>
                            <div class="col-10">
                                <table class="table table-hover" id="tableAction{{$i}}">
                                    <tbody>
                                    <tr>
                                        <th width="85%">Next Action</th>
                                        <th width="15%">Complete</th>
                                    </tr>
                                    </tbody>
                                </table>
                            </div>
                            <div class="col-1"></div>
                        </div>

                    </div>


                </td>


            </tr>

        @endif

        <?php $i++ ?>

    @endforeach

    </tbody>

</table>


<script src="http://dev3.increaseo.com.au/wip/public/js/master.js"></script>

<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"
        integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo"
        crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"
        integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1"
        crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"
        integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM"
        crossorigin="anonymous"></script>
<script src="http://dev3.increaseo.com.au/wip/public/jquery/dist/jquery.min.js"></script>

<script src="https://cdn.datatables.net/1.10.18/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.10.18/js/dataTables.bootstrap4.min.js"></script>

<script src="http://dev3.increaseo.com.au/wip/public/js/notify.js"></script>
<script src="http://dev3.increaseo.com.au/wip/public/js/notify.min.js"></script>
</body>
</html>
