@extends('auth.layouts')

@section('content')
    <style>
        .swal-wide {
            width: 50px !important;
            height: 20px !important;
        }
    </style>
    <div>
        <form id="addRcdFrm" method="" action="" enctype="multipart/form-data">
            <div class="container p-2">
                <div class="row justify-content-center">
                    <div class="col-md-12">
                        <div class="card">
                            <div class="card-header">{{ __('Create Patient') }}</div>

                            <div class="card-body">
                                @if (session('status'))
                                    <div class="alert alert-success" role="alert">
                                        {{ session('status') }}
                                    </div>
                                @endif

                                <div class="row">
                                    <div class="col-md-12">
                                        <form id="addFrm" method="" action="">

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
                                                <label for="date"
                                                    class="col-md-4 col-form-label text-md-end">{{ __('Birthday') }}</label>

                                                <div class="col-md-6">
                                                    <input id="birthday" type="date"
                                                        class="form-control @error('birthday') is-invalid @enderror"
                                                        name="birthday" required autocomplete="birthday" autofocus>

                                                    @error('birthday')
                                                        <span class="invalid-feedback" role="alert">
                                                            <strong>{{ $message }}</strong>
                                                        </span>
                                                    @enderror
                                                </div>
                                            </div>
                                            <div class="row mb-3">
                                                <label for="nic"
                                                    class="col-md-4 col-form-label text-md-end">{{ __('NIC') }}</label>

                                                <div class="col-md-6">
                                                    <input id="nic" type="text"
                                                        class="form-control @error('nic') is-invalid @enderror"
                                                        name="nic" required autocomplete="nic" autofocus>

                                                    @error('nic')
                                                        <span class="invalid-feedback" role="alert">
                                                            <strong>{{ $message }}</strong>
                                                        </span>
                                                    @enderror
                                                </div>
                                            </div>
                                            <div class="row mb-3">
                                                <label for="photo"
                                                    class="col-md-4 col-form-label text-md-end">{{ __('Photo') }}</label>

                                                <div class="col-md-6">
                                                    <input id="photo" type="file"
                                                        class="form-control @error('photo') is-invalid @enderror"
                                                        name="photo" required autocomplete="photo" autofocus>

                                                    @error('photo')
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
                            <div class="card-header">{{ __('Create Record') }}</div>

                            <div class="card-body">
                                @if (session('status'))
                                    <div class="alert alert-success" role="alert">
                                        {{ session('status') }}
                                    </div>
                                @endif

                                <div class="row mb-3">
                                    <label for="record"
                                        class="col-md-4 col-form-label text-md-end">{{ __('Record') }}</label>

                                    <div class="col-md-6">
                                        <textarea id="record" cols="4" rows="4" class="form-control @error('record') is-invalid @enderror"
                                            name="record" required autocomplete="record" autofocus> </textarea>

                                        @error('record')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
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
                            <div class="card-header">{{ __('Create Bill') }}</div>

                            <div class="card-body">
                                @if (session('status'))
                                    <div class="alert alert-success" role="alert">
                                        {{ session('status') }}
                                    </div>
                                @endif

                                <div class="row mb-3">
                                    <label for="description"
                                        class="col-md-4 col-form-label text-md-end">{{ __('Description') }}</label>

                                    <div class="col-md-6">
                                        <textarea id="description" cols="4" rows="4" class="form-control @error('record') is-invalid @enderror"
                                            name="description" required autocomplete="description" autofocus> </textarea>

                                        @error('description')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="row mb-3">
                                    <label for="amount"
                                        class="col-md-4 col-form-label text-md-end">{{ __('Amount') }}</label>

                                    <div class="col-md-6">
                                        <input id="amount" type="text"
                                            class="form-control @error('amount') is-invalid @enderror" name="amount"
                                            required autocomplete="amount" autofocus>

                                        @error('amount')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <button type="button" id="btnSave" class="btn btn-primary" style="float: right">Add Bill</button>
        </form>
    </div>

    <script src="{{ url('js/record.js') }}"></script>
@endsection
