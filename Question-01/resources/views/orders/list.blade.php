@extends('auth.layouts')

@section('content')
    <div class="container p-2">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">{{ __('Order') }}</div>

                    <div class="card-body">
                        @if (session('status'))
                            <div class="alert alert-success" role="alert">
                                {{ session('status') }}
                            </div>
                        @endif

                        <div class="row">
                            <div class="col-md-12">
                                <table id="odTbl" class="table  display" style="width:100%">
                                    <thead>
                                        <tr>
                                            <th class="text-center">#</th>
                                            <th class="text-center">Code</th>
                                            <th class="text-center">Customer</th>
                                            <th class="text-center">Mobile</th>
                                            <th class="text-center">Address</th>
                                            <th class="text-center">Total</th>
                                            <th class="text-center">Action</th>
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

    <!-- Modal -->
    <div class="modal fade" id="viewMdl" tabindex="-1" role="dialog" aria-labelledby="viewModalLabel"
        aria-hidden="true">
        <div class="modal-dialog modal-dialog-scrollable modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="viewModalLabel">View Order</h5>
                </div>
                <div class="modal-body">
                    <div class="row mt-2">
                        <input type="hidden" id="idOrd" />
                        <div class="col-md-12">
                            <table id="lstTbl" class="table  display" style="width:100%">
                                <thead>
                                    <tr>
                                        <th class="text-center">#</th>
                                        <th class="text-center">Dish</th>
                                        <th class="text-center">QTY</th>
                                        <th class="text-center">Price</th>
                                    </tr>
                                </thead>
                                <tbody>

                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-warning" data-bs-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>

    <script type="text/javascript">
            $(document).ready(function() {

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

                $(document).on('click', '.viewData', function () {

                 var id = $(this).val();
                $('#lstTbl').DataTable({
                    processing: true,
                    serverSide: true,
                    stateSave: true,
                    bDestroy: true,
                    scrollX: true,
                    ajax: {
                        url: location.url
                    },
                    data:{
                        id: id
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

            });
        </script>

@endsection

