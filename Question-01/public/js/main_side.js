$(document).ready(function() {

    sideMainTblLoad();

});


function sideMainTblLoad(){

    $('#mainSideTbl').DataTable({
        processing: true,
        serverSide: true,
      //  stateSave: true,
        bDestroy: true,
        scrollX: true,
        dom: 'Bfrtip',
        order: [[1, 'desc']],
        buttons: [
             'csv', 'print'
        ],
        ajax: {
            url: 'famous-main-side-dish'
        },
        columnDefs: [
            {
            targets: "_all",
            createdCell: function(td, cellData, rowData, row, col) {
                $(td).css('text-align', 'center')
            }
        },
        {
            targets: 1 ,
            visible: false
        }
    ],
        rowGroup: {
            dataSrc: 'code'
        },
        columns: [{
                data: 'DT_RowIndex',
                name: 'id',
                searchable: false
            },
            {
                data: 'code',
                name: 'code',
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
