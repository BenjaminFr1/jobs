

$('.datepicker_start_date').each(function () {
    $(this).datepicker({
        format: 'dd/mm/yyyy',
        uiLibrary: 'bootstrap4'
    })});


$('.datepicker_due_date').each(function () {
    $(this).datepicker({
        format: 'dd/mm/yyyy',
        uiLibrary: 'bootstrap4'
    })});


$(document).ready(function () {
    // Setup - add a text input to each footer cell
    $('#myTable thead th').each(function (i) {
        var title = $('#myTable thead th').eq($(this).index()).text();
        if (i == 8 | i == 9) {
        } else {
            $(this).html('<input type="text" class="form-control" placeholder="' + title + '" data-index="' + i + '" />');
        }
    });

    // DataTable
    var table = $('#myTable').DataTable({
        "pageLength": 40,
        "lengthChange": false,
        "ordering": false,
        "columnDefs": [
            { "targets": [0,1], "searchable": true }
        ],
    });

    // Filter event handler
    $(table.table().container()).on('keyup', 'thead input',function () {
        table
            .column($(this).data('index'))
            .search(this.value)
            .draw();
    });
});


$(document).ready(function () {
    $("body").mouseover(function () {
        $("li").click(function () {
            show_ready_to_invoice();
            show_hidden_column();
        });
    });
});


$(document).ready(function () {
    $("body").mouseover(function () {
        show_hidden_column();
    });
});


$(document).ready(function () {
    $('.hide_td:nth-child(1),.hide_th:nth-child(1)').hide();
    $('.hide_td:nth-child(5),.hide_th:nth-child(5)').hide();
    $('.hide_td:nth-child(6),.hide_th:nth-child(6)').hide();
});


function show_hidden_column()
{
    var i = document.getElementById("hide_job_number").value;
    if (!document.getElementById("hide_job_number").checked) {
        $('.hide_td:nth-child(' + i + '),.hide_th:nth-child(' + i + ')').hide();
    } else {
        $('.hide_td:nth-child(' + i + '),.hide_th:nth-child(' + i + ')').show();
    }

    var i = document.getElementById("hide_client").value;
    if (!document.getElementById("hide_client").checked) {
        $('.hide_td:nth-child(' + i + '),.hide_th:nth-child(' + i + ')').hide();
    } else {
        $('.hide_td:nth-child(' + i + '),.hide_th:nth-child(' + i + ')').show();
    }

    var i = document.getElementById("hide_job_name").value;
    if (!document.getElementById("hide_job_name").checked) {
        $('.hide_td:nth-child(' + i + '),.hide_th:nth-child(' + i + ')').hide();
    } else {
        $('.hide_td:nth-child(' + i + '),.hide_th:nth-child(' + i + ')').show();
    }

    var i = document.getElementById("hide_state").value;
    if (!document.getElementById("hide_state").checked) {
        $('.hide_td:nth-child(' + i + '),.hide_th:nth-child(' + i + ')').hide();
    } else {
        $('.hide_td:nth-child(' + i + '),.hide_th:nth-child(' + i + ')').show();
    }

    var i = document.getElementById("hide_start_date").value;
    if (!document.getElementById("hide_start_date").checked) {
        $('.hide_td:nth-child(' + i + '),.hide_th:nth-child(' + i + ')').hide();
    } else {
        $('.hide_td:nth-child(' + i + '),.hide_th:nth-child(' + i + ')').show();
    }

    var i = document.getElementById("hide_due_date").value;
    if (!document.getElementById("hide_due_date").checked) {
        $('.hide_td:nth-child(' + i + '),.hide_th:nth-child(' + i + ')').hide();
    } else {
        $('.hide_td:nth-child(' + i + '),.hide_th:nth-child(' + i + ')').show();
    }

    var i = document.getElementById("hide_account_manager").value;
    if (!document.getElementById("hide_account_manager").checked) {
        $('.hide_td:nth-child(' + i + '),.hide_th:nth-child(' + i + ')').hide();
    } else {
        $('.hide_td:nth-child(' + i + '),.hide_th:nth-child(' + i + ')').show();
    }

    var i = document.getElementById("hide_developer").value;
    if (!document.getElementById("hide_developer").checked) {
        $('.hide_td:nth-child(' + i + '),.hide_th:nth-child(' + i + ')').hide();
    } else {
        $('.hide_td:nth-child(' + i + '),.hide_th:nth-child(' + i + ')').show();
    }
}


function edit(i)
{
    if (document.getElementById("job_name" + i).disabled == true) {
        document.getElementById("job_name" + i).disabled = false;
        document.getElementById("state" + i).disabled = false;
        document.getElementById("datepicker_start_date" + i).disabled = false;
        document.getElementById("datepicker_due_date" + i).disabled = false;
        document.getElementById("account_manager" + i).disabled = false;
        document.getElementById("developer" + i).disabled = false;
        add_select_option(i);
        able_save_data(i);
    } else {
        document.getElementById("job_name" + i).disabled = true;
        document.getElementById("state" + i).disabled = true;
        document.getElementById("datepicker_start_date" + i).disabled = true;
        document.getElementById("datepicker_due_date" + i).disabled = true;
        document.getElementById("account_manager" + i).disabled = true;
        document.getElementById("developer" + i).disabled = true;
        remove_select_option(i);
        able_save_data(i);
    }
}


function able_save_data(i)
{
    if ( document.getElementById("job_name" + i).value !== "" & document.getElementById("state" + i).value !== ""
        & document.getElementById("datepicker_start_date" + i).value !== "" & document.getElementById("datepicker_due_date" + i).value !== ""
        & document.getElementById("account_manager" + i).value !== "" & document.getElementById("developer" + i).value !== "") {
        document.getElementById("checkbox" + i).disabled = false;
    } else {
        document.getElementById("checkbox" + i).disabled = true;
    }
}


function add_select_option(i)
{
    var select_state_value = document.getElementById("state" + i).value;
    if (select_state_value != "Planned") {
        var option = document.createElement("option");
        option.text = "Planned";
        document.getElementById("state" + i).add(option);
    }
    if (select_state_value != "In Progress") {
        var option = document.createElement("option");
        option.text = "In Progress";
        document.getElementById("state" + i).add(option);
    }
    if (select_state_value != "On Hold") {
        var option = document.createElement("option");
        option.text = "On Hold";
        document.getElementById("state" + i).add(option);
    }
    if (select_state_value != "Completed") {
        var option = document.createElement("option");
        option.text = "Completed";
        document.getElementById("state" + i).add(option);
    }
    if (select_state_value != "Cancelled") {
        var option = document.createElement("option");
        option.text = "Cancelled";
        document.getElementById("state" + i).add(option);
    }

    for (var count = 0; count < document.getElementById("size_staff").value; count++) {
        var staff_value = document.getElementById("staff_id" + count).value;
        if (document.getElementById("account_manager" + i).value != staff_value) {
            var option = document.createElement("option");
            option.text = staff_value;
            document.getElementById("account_manager" + i).add(option);
        }
        if (document.getElementById("developer" + i).value != staff_value) {
            var option = document.createElement("option");
            option.text = staff_value;
            document.getElementById("developer" + i).add(option);
        }
    }
}


function remove_select_option(i)
{
    document.getElementById("state" + i).remove(1);
    document.getElementById("state" + i).remove(1);
    document.getElementById("state" + i).remove(1);
    document.getElementById("state" + i).remove(1);
    for (var count = 0; count <= document.getElementById("size_staff").value; count++) {
        document.getElementById("account_manager" + i).remove(1);
        document.getElementById("developer" + i).remove(1);
    }
}


function ready_to_invoice(i)
{
    if (document.getElementById("checkbox" + i).checked) {
        if (confirm("Are you sure you're ready to invoice ?")) {
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            $.ajax({
                type: 'post',
                url: '/wip/public/',
                data: {
                    'job_number' : document.getElementById('job_number' + i).innerHTML,
                    'client_name' : document.getElementById('client_name' + i).innerHTML,
                    'job_name' : document.getElementById('job_name' + i).value,
                    'state' : document.getElementById('state' + i).value,
                    'start_date' : document.getElementById('datepicker_start_date' + i).value,
                    'due_date' : document.getElementById('datepicker_due_date' + i).value,
                    'manager_name' : document.getElementById('account_manager' + i).value,
                    'developer_name' : document.getElementById('developer' + i).value,
                    'invoice' : 1,
                },
                success: function (data) {
                    if (document.getElementById("select_show_invoice").value == "No") {
                        document.getElementById(i).hidden = true;
                        document.getElementById("show" + i).hidden = true;
                    }
                    $.notify.defaults({ position: "right-bottom" });
                    $.notify("Job : " + data.job_name + " (" + data.job_number  + ") for " + data.client_name + " invoice", "success");
                },
                error: function (data) {
                    $.notify.defaults({ position: "right-bottom" });
                    $.notify("ERROR -> Job : " + data.job_name + " (" + data.job_number  + ") for " + data.client_name + " invoice", "error");
                }
            })
        }
    } else {
        if (confirm("You want to cancel this invoice ?")) {
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            $.ajax({
                type: 'post',
                url: '/wip/public/',
                data: {
                    'job_number' : document.getElementById('job_number' + i).innerHTML,
                    'client_name' : document.getElementById('client_name' + i).innerHTML,
                    'job_name' : document.getElementById('job_name' + i).value,
                    'state' : document.getElementById('state' + i).value,
                    'start_date' : document.getElementById('datepicker_start_date' + i).value,
                    'due_date' : document.getElementById('datepicker_due_date' + i).value,
                    'manager_name' : document.getElementById('account_manager' + i).value,
                    'developer_name' : document.getElementById('developer' + i).value,
                    'invoice' : 0,
                },
                success: function (data) {
                    if (document.getElementById("select_show_invoice").value == "No") {
                        document.getElementById(i).hidden = true;
                        document.getElementById("show" + i).hidden = true;
                    }
                    $.notify.defaults({ position: "right-bottom" });
                    $.notify("Job : " + data.job_name + " (" + data.job_number  + ") for " + data.client_name + " invoice canceled", "success");
                },
                error: function (data) {
                    $.notify.defaults({ position: "right-bottom" });
                    $.notify("ERROR -> Job : " + data.job_name + " (" + data.job_number  + ") for " + data.client_name + " invoice canceled", "error");
                }
            })
        }
    }
}


function save_data(i)
{
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
    $.ajax({
        type: 'post',
        url: '/wip/public/add',
        data: {
            'job_number': document.getElementById('job_number' + i).innerHTML,
            'client_name': document.getElementById('client_name' + i).innerHTML,
            'job_name': document.getElementById('job_name' + i).value,
            'state': document.getElementById('state' + i).value,
            'start_date': document.getElementById('datepicker_start_date' + i).value,
            'due_date': document.getElementById('datepicker_due_date' + i).value,
            'manager_name': document.getElementById('account_manager' + i).value,
            'developer_name': document.getElementById('developer' + i).value
        },
        success: function (data) {
            $.notify.defaults({ position: "right-bottom" });
            $.notify("Job : " + data.job_name + " (" + data.job_number + ") for " + data.client_name + " have been save in the database", "success");
        },
        error: function (data) {
            $.notify.defaults({ position: "right-bottom" });
            $.notify("ERROR -> Job : " + data.job_name + " (" + data.job_number + ") for " + data.client_name + " have been save in the database", "error");
        }
    })
}


function show_description(i)
{
    if (document.getElementById("show" + i).hidden === true) {
        document.getElementById("show" + i).hidden = false;
        document.getElementById("job_number" + i).style.color = "grey";
        var table_length = document.getElementById("tableAction" + i).rows.length;
        if (table_length == 1) {
            get_action(i);
        }
    } else {
        document.getElementById("show" + i).hidden = true;
        document.getElementById("job_number" + i).style.color = "black";
    }
}


function unlock_save_new(i)
{
    if (document.getElementById("text_area" + i).value !== "") {
        document.getElementById("btn_new" + i).disabled = false;
    } else {
        document.getElementById("btn_new" + i).disabled = true;
    }
}


function unlock_save_action(i, c)
{
    if (document.getElementById("text_area" + i + "_" + c).value !== "") {
        document.getElementById("btn_new" + i + "_" + c).disabled = false;
    } else {
        document.getElementById("btn_new" + i + "_" + c).disabled = true;
    }
}


function hide_column(id)
{
    var i = document.getElementById(id).value;
    if (document.getElementById(id).checked == true) {
        document.getElementById(id).checked = false;
        document.getElementById(id + "_color").style.color = "grey";
        $('.hide_td:nth-child(' + i + '),.hide_th:nth-child(' + i + ')').hide();
    } else {
        document.getElementById(id).checked = true;
        document.getElementById(id + "_color").style.color = "black";
        $('.hide_td:nth-child(' + i + '),.hide_th:nth-child(' + i + ')').show();
    }
}


function get_action(id)
{
    $.ajax({
        type: "get",
        url: '/wip/public/listAction',
        data: {
            'job_number' : document.getElementById('job_number' + id).innerHTML,
        },
        success: function (data) {
            for (var i = 0; i < data.length; i++) {
                var table = document.getElementById("tableAction" + id);
                var row = table.insertRow(1);
                row.id = "row_" + id + "_" + i;
                var cell1 = row.insertCell(0);
                var cell2 = row.insertCell(1);
                if (data[i].is_complete == "0") {
                    cell1.innerHTML = "<input disabled id='action_input_" + id + "_" + i + "' class='form-control' value='" + data[i].action + "'><input hidden id='action_id_" + id + "_" + i + "'  value='" + data[i].note_id + "'>";
                    cell2.innerHTML = "<input id='action_checkbox_" + id + "_" + i + "' type='checkbox' onclick='save_complete_action(" + id + "," + i + ")'>";
                } else {
                    row.hidden = true;
                    cell1.innerHTML = "<input disabled id='action_input_" + id + "_" + i + "' class='form-control' value='" + data[i].action + "'><input hidden id='action_id_" + id + "_" + i + "'  value='" + data[i].note_id + "'>";
                    cell2.innerHTML = "<input id='action_checkbox_" + id + "_" + i + "' type='checkbox' onclick='save_complete_action(" + id + "," + i + ")' checked>";
                }
            }
        },
    })
}


function save_new_action(i)
{
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
    $.ajax({
        type: 'post',
        url: '/wip/public/addaction',
        data: {
            'job_number': document.getElementById('job_number' + i).innerHTML,
            'next_action': document.getElementById('text_area' + i).value,
        },
        success: function (data) {
            console.log(data);
            document.getElementById('text_area' + i).value = "";
            var table_length = console.log(document.getElementById("tableAction" + i).rows.length);
            for (var x = 1; x < table_length; x++) {
                document.getElementById("myTable").deleteRow(1);
            }
            get_action(i);
            $.notify.defaults({ position: "right-bottom" });
            $.notify("Action added", "success");
        },
        error: function (data) {
            console.log(data);
            $.notify.defaults({ position: "right-bottom" });
            $.notify("ERROR -> Action added", "error");
        }
    })
}


function save_complete_action(id, i)
{
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
    $.ajax({
        type: 'post',
        url: '/wip/public/updateComplete',
        data: {
            'note_id': document.getElementById("action_id_" + id + "_" + i).value,
            'checked': document.getElementById("action_checkbox_" + id + "_" + i).checked,
        },
        success: function (data) {
            if (document.getElementById("action_checkbox_" + id + "_" + i).checked == true) {
                if (document.getElementById("select_show_action_" + id).value == "No") {
                    document.getElementById("row_" + id + "_" + i).hidden = true;
                }
                $.notify.defaults({ position: "right-bottom" });
                $.notify("Action completed", "success");
            } else {
                $.notify.defaults({ position: "right-bottom" });
                $.notify("Action uncompleted", "success");
            }
        },
        error: function (data) {
            console.log(data);
            $.notify.defaults({ position: "right-bottom" });
            $.notify("ERROR -> Action completed/uncompleted", "error");
        }
    })
}


function show_completed_action(id)
{
    $.ajax({
        type: "get",
        url: '/wip/public/listAction',
        data: {
            'job_number' : document.getElementById('job_number' + id).innerHTML,
        },
        success: function (data) {
            if (document.getElementById("select_show_action_" + id).value == "Yes") {
                for (var i = 0; i < data.length; i++) {
                    if (data[i].is_complete == 1) {
                        document.getElementById("row_" + id + "_" + i).hidden = false;
                    }
                }
            } else {
                for (var i = 0; i < data.length; i++) {
                    if (data[i].is_complete == 1) {
                        document.getElementById("row_" + id + "_" + i).hidden = true;
                    }
                }
            }
        },
    })
}


function show_ready_to_invoice()
{
    var id = parseInt(document.getElementById("myTable").rows[1].id);
    if (document.getElementById("select_show_invoice").value == "Yes") {
        for (var i = 0; i < (document.getElementById("myTable").rows.length - 3) / 2; i++) {
            var current_id = id + i;
            if (document.getElementById("checkbox" + current_id).checked) {
                document.getElementById(current_id).hidden = false;
            }
        }
    } else {
        for (var i = 0; i < (document.getElementById("myTable").rows.length - 3) / 2; i++) {
            var current_id = id + i;
            if (document.getElementById("checkbox" + current_id).checked) {
                document.getElementById(current_id).hidden = true;
            }
        }
    }
}
