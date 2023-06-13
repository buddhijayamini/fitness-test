$(document).ready(function() {

    sideTblLoad();

});


function sideTblLoad(){

    $('#sideTbl').DataTable({
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
            url: 'famous-side-dish'
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
            }
        ],
    });
}
