@extends('auth.layouts')

@section('content')
    <style>
        .swal-wide {
            width: 50px !important;
            height: 20px !important;
        }
    </style>
    <div>
        <form id="addOrdFrm" method="" action="">
            <div class="container p-2">
                <div class="row justify-content-center">
                    <div class="col-md-12">
                        <div class="card">
                            <div class="card-header">{{ __('Create Customer') }}</div>

                            <div class="card-body">
                                @if (session('status'))
                                    <div class="alert alert-success" role="alert">
                                        {{ session('status') }}
                                    </div>
                                @endif

                                <div class="row">
                                    <div class="col-md-12">
                                        <form id="addCustFrm" method="" action="">

                                            <div class="row mb-3">
                                                <label for="name"
                                                    class="col-md-4 col-form-label text-md-end">{{ __('Name') }}</label>

                                                <div class="col-md-6">
                                                    <input id="name" type="text"
                                                        class="form-control @error('name') is-invalid @enderror"
                                                        name="name" required autocomplete="name" autofocus>

                                                    @error('name')
                                                        <span class="invalid-feedback" role="alert">
                                                            <strong>{{ $message }}</strong>
                                                        </span>
                                                    @enderror
                                                </div>
                                            </div>

                                            <div class="row mb-3">
                                                <label for="mobile"
                                                    class="col-md-4 col-form-label text-md-end">{{ __('Mobile') }}</label>

                                                <div class="col-md-6">
                                                    <input id="mobile" type="text"
                                                        class="form-control @error('mobile') is-invalid @enderror"
                                                        name="mobile" required autocomplete="mobile" autofocus>

                                                    @error('mobile')
                                                        <span class="invalid-feedback" role="alert">
                                                            <strong>{{ $message }}</strong>
                                                        </span>
                                                    @enderror
                                                </div>
                                            </div>

                                            <div class="row mb-3">
                                                <label for="address"
                                                    class="col-md-4 col-form-label text-md-end">{{ __('Address') }}</label>

                                                <div class="col-md-6">
                                                    <input id="address" type="text"
                                                        class="form-control @error('address') is-invalid @enderror"
                                                        name="address" required autocomplete="address" autofocus>

                                                    @error('address')
                                                        <span class="invalid-feedback" role="alert">
                                                            <strong>{{ $message }}</strong>
                                                        </span>
                                                    @enderror
                                                </div>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="container p-2">
                <div class="row justify-content-center">
                    <div class="col-md-12">
                        <div class="card ">
                            <div class="card-header">{{ __('Create Order') }}</div>

                            <div class="card-body">
                                @if (session('status'))
                                    <div class="alert alert-success" role="alert">
                                        {{ session('status') }}
                                    </div>
                                @endif

                                <div class="row">
                                    <div class="col-md-4">
                                        <form id="addTblFrm" method="" action="">
                                            <div class="row mb-3">
                                                <label for="type"
                                                    class="col-md-4 col-form-label text-md-end">{{ __('Type') }}</label>

                                                <div class="col-md-6">
                                                    <select class="form-select" id="type" name="type" required>
                                                        <option>Select</option>
                                                        <option value="Main Dishes">Main Dishes</option>
                                                        <option value="Side Dishes">Side Dishes</option>
                                                        <option value="Dessert">Dessert</option>
                                                    </select>
                                                </div>
                                            </div>

                                            <div class="row mb-3">
                                                <label for="mobile"
                                                    class="col-md-4 col-form-label text-md-end">{{ __('Dish Name') }}</label>

                                                <div class="col-md-6">
                                                    <select class="form-select" id="dishName" name="dishName" required>
                                                    </select>
                                                </div>
                                            </div>

                                            <div class="row mb-3">
                                                <label for="qty"
                                                    class="col-md-4 col-form-label text-md-end">{{ __('QTY') }}</label>

                                                <div class="col-md-6">
                                                    <input id="qty" type="number" class="form-control"
                                                        name="qty" required>
                                                </div>
                                            </div>

                                            <div class="row mb-3">
                                                <label for="price"
                                                    class="col-md-4 col-form-label text-md-end">{{ __('Price') }}</label>

                                                <div class="col-md-6">
                                                    <input id="price" type="text" class="form-control" readonly
                                                        name="price" required>
                                                </div>
                                            </div>

                                            <div class="col-md-8">
                                                <button type="button" id="addTbl" class="btn btn-primary"
                                                    style="float: right">Add</button>
                                            </div>
                                        </form>
                                    </div>
                                    <div class="vr" style="height: auto;"></div>
                                    <div class="col-md-7">
                                        <form id="addOrdFrm" method="" action="">
                                            <table id="ordTbl" class="table  display" style="width:100%">
                                                <thead>
                                                    <tr>
                                                        <th class="text-center">Type</th>
                                                        <th class="text-center">Name</th>
                                                        <th class="text-center">QTY</th>
                                                        <th class="text-center">Total Price</th>
                                                        <th class="text-center">Delete</th>
                                                    </tr>
                                                </thead>
                                                <tbody>

                                                </tbody>
                                            </table>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <button type="button" id="btnSave" class="btn btn-primary" style="float: right">Add Order</button>
        </form>
    </div>

    <script  src="{{ url('js/order.js') }}"></script>

@endsection
