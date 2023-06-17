$(document).ready(function() {
    $('#invoiceTbl').DataTable({
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
    });
});
