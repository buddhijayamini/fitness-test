$(document).ready(function() {

    $("#create_date").change(function () {
        soTblLoad();
    });

    soTblLoad();

});


function soTblLoad(){
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
            url: 'daily-orders',
            data:{
                create_date: create_date,
            },
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
        ],
    });
}
