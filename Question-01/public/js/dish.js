$(document).ready(function() {
    $('#dishTbl').DataTable({
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
                data: 'type',
                name: 'type',
                visible: true
            },
            {
                data: 'name',
                name: 'name',
                visible: true
            },
            {
                data: 'price',
                name: 'price',
                visible: true
            }
        ],
    });

      // save btn
      $("#saveBtn").click(function(e) {
        e.preventDefault();
        var CSRF_TOKEN = $('meta[name="csrf-token"]').attr("content");
        var name = $("#name").val();
        var type = $("#type").val();
        var price = $("#price").val();

        $.ajax({
            type: "POST",
            url: "/dish-save",
            headers: {
            "Content-Type": "application/x-www-form-urlencoded",
            },
            data: {
                _token: CSRF_TOKEN,
                type: type,
                name: name,
                price: price,
            },
            success: function(json) {
                if (json.status == 500) {
                    Swal.fire("Error", json.message, "error");
                    $("#addFrm").trigger("reset");
                } else if (json.status == 200) {
                    Swal.fire("Succuss", json.message, "success");
                    $("#addFrm").trigger("reset");
                }
            },
            error: function(xhr) {
                // $.LoadingOverlay("hide");
                Swal.fire(
                    "Error",
                    JSON.parse(xhr.responseText).message,
                    "error"
                );
                $("#addFrm").trigger("reset");
            },
        });

    });
});
