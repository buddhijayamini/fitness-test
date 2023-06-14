$(document).ready(function() {
    $('#patientTbl').DataTable({
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
                data: 'birthday',
                name: 'birthday',
                visible: true
            },
            {
                data: 'nic',
                name: 'nic',
                visible: true
            }
        ],
    });
});
