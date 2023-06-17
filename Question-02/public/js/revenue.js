$(document).ready(function () {

    $("#create_date").change(function () {
        revenueTblLoad();
    });

    revenueTblLoad();

});


function revenueTblLoad() {
    var create_date = $("#create_date").val();

    $('#dailyTbl').DataTable({
        processing: true,
        serverSide: true,
        stateSave: true,
        bDestroy: true,
        scrollX: true,
        dom: 'Bfrtip',
        buttons: [
            'csv', 'print'
        ],
        ajax: {
            url: 'daily-revenue',
            data: {
                create_date: create_date,
            },
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
            data: 'code',
            name: 'code',
            visible: true
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
            data: 'description',
            name: 'description',
            visible: true
        },
        {
            data: 'amount',
            name: 'amount',
            visible: true
        },
        {
            data: 'created_at',
            name: 'created_at',
            visible: true
        }
        ],
        "footerCallback": function (row, data, start, end, display) {
            var api = this.api(), data;
            var intVal = function (i) {
                return typeof i === 'string' ?
                    i.replace(/[\$,]/g, '') * 1 :
                    typeof i === 'number' ?
                        i : 0;
            };
            // Total over all pages
            total = api
                .column(5)
                .data()
                .reduce(function (a, b) {
                    return intVal(a) + intVal(b);
                }, 0);

            // Update footer
            $(api.column(4).footer()).html(total);
        }
    });


}
