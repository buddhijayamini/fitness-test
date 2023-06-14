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




});
