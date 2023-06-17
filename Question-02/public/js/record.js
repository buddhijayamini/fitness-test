$(document).ready(function () {
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
            createdCell: function (td, cellData, rowData, row, col) {
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


    $(document).on('click', '.viewData', function () {

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
                createdCell: function (td, cellData, rowData, row, col) {
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


    // save btn
    $("#btnSave").click(function (e) {
        e.preventDefault();

        var name = $("#name").val();
        var mobile = $("#mobile").val();
        var birthday = $("#birthday").val();
        var nic = $("#nic").val();
        var photo = $('#photo')[0].files[0];
        var record = $("#record").val();
        var description = $("#description").val();
        var amount = $("#amount").val();

        var myformData = new FormData();
        myformData.append('name', name);
        myformData.append('mobile', mobile);
        myformData.append('birthday', birthday);
        myformData.append('nic', nic);
        myformData.append('photo', photo);
        myformData.append('record', record);
        myformData.append('description', description);
        myformData.append('amount', amount);

        $.ajax({
            type: "POST",
            url: "/record-save",
            headers: {
                "X-CSRF-Token": $('meta[name="csrf-token"]').attr(
                    "content"
                ),
            },
            enctype: "multipart/form-data",
            dataType: "json",
            contentType: false,
            processData: false,
            data: myformData,
            success: function (json) {
                if (json.status == 500) {
                    Swal.fire("Error", json.message, "error");
                    $("#addRcdFrm").trigger("reset");

                } else if (json.status == 200) {
                    Swal.fire("Succuss", json.message, "success");
                    $("#addRcdFrm").trigger("reset");

                }
            },
            error: function (xhr) {
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
