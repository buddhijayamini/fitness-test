$(document).ready(function() {
    $('#recordTbl').DataTable({
        processing: true,
        serverSide: true,
        stateSave: true,
        bDestroy: true,
        scrollX: true,
        ajax: {
            url: location.url
        },
        columnDefs: [{
            targets: "_all",
            createdCell: function(td, cellData, rowData, row, col) {
                $(td).css('text-align', 'center')
            }
        }],
        columns: [{
                data: 'DT_RowIndex',
                name: 'id',
                searchable: false
            },
            {
                data: 'name',
                name: 'name',
                visible: true
            },
            {
                data: 'mobile',
                name: 'mobile',
                visible: true
            },
            {
                data: 'view',
                name: 'view',
                visible: true
            },
        ],
    });


    $(document).on('click', '.viewData', function() {

        var id = $(this).val();
        $('#patientId').html(id);
        $('#listTbl').DataTable({
            processing: true,
            serverSide: true,
            stateSave: true,
            bDestroy: true,
            scrollX: true,
            ajax: {
                url: "record-list/" + id,
            },
            columnDefs: [{
                targets: "_all",
                createdCell: function(td, cellData, rowData, row, col) {
                    $(td).css('text-align', 'center')
                }
            }],
            columns: [{
                    data: 'DT_RowIndex',
                    name: 'id',
                    searchable: false
                },
                {
                    data: 'note',
                    name: 'note',
                    visible: true
                },
                {
                    data: 'created_at',
                    name: 'created_at',
                    visible: true
                },
            ],
        });
    });

//-------------------------------------------create section -------------------------------------------------//

var CSRF_TOKEN = $('meta[name="csrf-token"]').attr("content");

// save btn
$("#btnSave").click(function(e) {
    e.preventDefault();

    var name = $("#name").val();
    var mobile = $("#mobile").val();
    var birthday = $("#birthday").val();
    var nic = $("#nic").val();
    var photo = $("#photo").val();
    var record = $("#record").val();
    var description = $("#description").val();
    var amount = $("#amount").val();


    $.ajax({
        type: "POST",
        url: "/record-save",
        headers: {
            "Content-Type": "application/x-www-form-urlencoded",
        },
        data: {
            _token: CSRF_TOKEN,
            mobile: mobile,
            name: name,
            birthday: birthday,
            nic: nic,
            photo: photo,
            record: record,
            description: description,
            amount: amount,
        },
        success: function(json) {
            if (json.status == 500) {
                Swal.fire("Error", json.message, "error");
                $("#addRcdFrm").trigger("reset");

            } else if (json.status == 200) {
                Swal.fire("Succuss", json.message, "success");
                $("#addRcdFrm").trigger("reset");

            }
        },
        error: function(xhr) {
            Swal.fire(
                "Error",
                "Error",
                "error"
            );
            $("#addRcdFrm").trigger("reset");
        },
    });

});

});
