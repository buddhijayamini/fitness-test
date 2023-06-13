$(document).ready(function() {
    var CSRF_TOKEN = $('meta[name="csrf-token"]').attr("content");

    $('#odTbl').DataTable({
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
                data: 'code',
                name: 'code',
                visible: true
            },
            {
                data: 'customer_name',
                name: 'customer_name',
                visible: true
            },
            {
                data: 'mobile',
                name: 'mobile',
                visible: true
            },
            {
                data: 'address',
                name: 'address',
                visible: true
            },
            {
                data: 'total',
                name: 'total',
                visible: true
            },
            {
                data: 'view',
                name: 'view',
                visible: true
            }
        ],
    });

    $(document).on('click', '.viewData', function() {

        var id = $(this).val();
        $('#ordId').html('ORD00' + id);
        $('#lstTbl').DataTable({
            processing: true,
            serverSide: true,
            stateSave: true,
            bDestroy: true,
            scrollX: true,
            ajax: {
                url: "order-list/" + id,
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
                    data: 'dish',
                    name: 'dish',
                    visible: true
                },
                {
                    data: 'qty',
                    name: 'qty',
                    visible: true
                },
                {
                    data: 'price',
                    name: 'price',
                    visible: true
                },
            ],
        });
    });

    var table =  $('#ordTbl').DataTable({
        "pageLength": 100,
        "bInfo": false,
        "bFilter": false,
        "bPaginate": false,
        columnDefs: [{
                targets: "_all",
                createdCell: function(td, cellData, rowData, row, col) {
                    $(td).css('text-align', 'center')
                }
            }],
    });

     //dish by type
    $("#type").change(function() {
        var type = $(this).val();

        $.ajax({
            type: "GET",
            url: "dish-by-type/" + type,
            success: function(json) {
                if (json.status == 200) {
                    $("#dishName").empty();
                    $.each(json.data, function(key, val) {
                        $("#dishName").append(
                            '<option value="' + val.name + '">' + val.name +
                            '</option>'
                        );
                        $("#price").val(val.price);
                    });
                } else {
                    $("#dishName").empty();
                }
            },
        });

    });

    //dish by name
    $("#dishName").change(function() {
        var name = $(this).val();

        $.ajax({
            type: "GET",
            url: "dish-by-name/" + name,
            success: function(json) {
                if (json.status == 200) {
                    $("#price").val(json.data.price);
                } else {
                    $("#price").val('');
                }
            },
        });

    });

    //add to table
    $("#addTbl").click(function(e) {

        var tot = $('#qty').val()*$('#price').val();

        var delBtn = '<button type="button" class="btn btn-danger delBtn"><i class="fa fa-trash"></i></button>';
        var data = [
            $('#type').val(),
            $('#dishName').val(),
            $('#qty').val(),
            tot,
            delBtn
        ];

        var tbl = $('#ordTbl').dataTable();
        tbl.fnAddData(data);
        $("#addTblFrm").trigger("reset");
    });

    //delete row
    $(document).on('click', '.delBtn', function () {
        var removingRow = $(this).closest('tr');
        table.row(removingRow).remove().draw();
    });

    // save btn
    $("#btnSave").click(function(e) {
        e.preventDefault();

        var name = $("#name").val();
        var mobile = $("#mobile").val();
        var address = $("#address").val();
       var tblData = table.rows().data().toArray();

        $.ajax({
            type: "POST",
            url: "/order-save",
            headers: {
                "Content-Type": "application/x-www-form-urlencoded",
            },
            data: {
                _token: CSRF_TOKEN,
                mobile: mobile,
                name: name,
                address: address,
                tblData: tblData,
            },
            success: function(json) {
                if (json.status == 500) {
                    Swal.fire("Error", json.message, "error");
                    $("#addOrdFrm").trigger("reset");
                    table .clear().draw();

                } else if (json.status == 200) {
                    Swal.fire("Succuss", json.message, "success");
                    $("#addOrdFrm").trigger("reset");
                    table .clear().draw();

                }
            },
            error: function(xhr) {
                Swal.fire(
                    "Error",
                    "Error",
                    "error"
                );
                $("#addOrdFrm").trigger("reset");
                table .clear().draw();
            },
        });

    });


});
