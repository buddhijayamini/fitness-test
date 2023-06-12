@extends('auth.layouts')

@section('content')
    <div class="container p-2">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">{{ __('Daily Sale Avenue') }}</div>

                    <div class="card-body">
                        @if (session('status'))
                            <div class="alert alert-success" role="alert">
                                {{ session('status') }}
                            </div>
                        @endif
                        <div class="container pb-4 py-2">
                            <div class="row">
                                <div class="col-6 ">
                                    <div class="col-4 px-0 pt-1"></div>
                                    <div class="col-8">
                                        <div class="btn-group">
                                            <input type="date" class="form-control" id="create_date" onchange="handler(event);" value="<?php echo date('Y-m-d'); ?>" >
                                          </div>
                                    </div>
                                </div>
                                <div class="col-3"></div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <table id="dailyTbl" class="table  display" style="width:100%">
                                    <thead>
                                        <tr>
                                            <th class="text-center">#</th>
                                            <th class="text-center">Code</th>
                                            <th class="text-center">Customer</th>
                                            <th class="text-center">Mobile</th>
                                            <th class="text-center">Address</th>
                                            <th class="text-center">Total</th>
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

    <script  src="{{ url('js/daily_sale.js') }}"></script>

@endsection

