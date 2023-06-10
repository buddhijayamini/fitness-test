@extends('auth.layouts')

@section('content')
    <div class="container p-2">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">{{ __('Dishes') }}</div>

                    <div class="card-body">
                        @if (session('status'))
                            <div class="alert alert-success" role="alert">
                                {{ session('status') }}
                            </div>
                        @endif

                        <div class="row">
                            <div class="col-md-12">
                                <table id="dishTbl" class="table  display" style="width:100%">
                                    <thead>
                                        <tr>
                                            <th class="text-center">#</th>
                                            <th class="text-center">Type</th>
                                            <th class="text-center">Name</th>
                                            <th class="text-center">Price</th>
                                        </tr>
                                    </thead>
                                    <tbody>

                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script type="text/javascript">
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
            });
        </script>

@endsection

