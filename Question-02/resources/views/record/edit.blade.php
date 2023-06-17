@extends('auth.layouts')

@section('content')
    <style>
        .swal-wide {
            width: 50px !important;
            height: 20px !important;
        }
    </style>
    <div>
        <form id="editRcdFrm" method="Post" action="">
            @csrf
            <div class="container p-2">
                <div class="row justify-content-center">
                    <div class="col-md-12">
                        <div class="card">
                            <div class="card-header">{{ __('View Patient') }}</div>

                            <div class="card-body">
                                @if (session('status'))
                                    <div class="alert alert-success" role="alert">
                                        {{ session('status') }}
                                    </div>
                                @endif

                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="row mb-3">
                                            <label for="name"
                                                class="col-md-4 col-form-label text-md-end">{{ __('Name') }}</label>

                                            <div class="col-md-6">
                                                <input type="hidden" id="idPatient" value="{{ $data->id }}">
                                                <input id="name" type="text" value="{{ $data->name }}"
                                                    class="form-control" name="name" readonly>
                                            </div>
                                        </div>

                                        <div class="row mb-3">
                                            <label for="mobile"
                                                class="col-md-4 col-form-label text-md-end">{{ __('Mobile') }}</label>

                                            <div class="col-md-6">
                                                <input id="mobile" type="number" value="{{ $data->mobile }}"
                                                    class="form-control" name="mobile" readonly>
                                            </div>
                                        </div>

                                        <div class="row mb-3">
                                            <label for="date"
                                                class="col-md-4 col-form-label text-md-end">{{ __('Birthday') }}</label>

                                            <div class="col-md-6">
                                                <input id="birthday" type="date" value="{{ $data->birthday }}"
                                                    class="form-control" name="birthday" readonly>
                                            </div>
                                        </div>
                                        <div class="row mb-3">
                                            <label for="nic"
                                                class="col-md-4 col-form-label text-md-end">{{ __('NIC') }}</label>

                                            <div class="col-md-6">
                                                <input id="nic" type="text" value="{{ $data->nic }}"
                                                    class="form-control" name="nic" readonly>
                                            </div>
                                        </div>
                                        <div class="row mb-3">
                                            <label for="photo"
                                                class="col-md-4 col-form-label text-md-end">{{ __('Photo') }}</label>
                                            <div class="col-md-6">
                                                <img id="photo" src="{{ asset('photo/' . $data->photo) }}"
                                                    width="100%" height="100%" name="photo">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-6 table-responsive">
                                        <table class="table table-striped table-bordered table-scroll" width="100%" cellspacing="0">
                                            {{-- style="height: 250px; overflow-y: auto;display:block !important" --}}
                                            <thead>
                                                <tr>
                                                    <th class="text-center">#</th>
                                                    <th class="text-center">Record</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @foreach ($records as $key => $dt)
                                                    <tr>
                                                        <td class="text-center">{{ $key + 1 }}</td>
                                                        <td class="text-left">{{ $dt->note }}</td>
                                                    </tr>
                                                @endforeach
                                            </tbody>
                                        </table>
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
                                    <label for="recordEdit"
                                        class="col-md-4 col-form-label text-md-end">{{ __('Record') }}</label>

                                    <div class="col-md-6">
                                        <textarea id="recordEdit" cols="4" rows="4" class="form-control @error('recordEdit') is-invalid @enderror"
                                            name="recordEdit" required autocomplete="recordEdit" autofocus> </textarea>

                                        @error('recordEdit')
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
                                    <label for="descriptionEdit"
                                        class="col-md-4 col-form-label text-md-end">{{ __('Description') }}</label>

                                    <div class="col-md-6">
                                        <textarea id="descriptionEdit" cols="4" rows="4" class="form-control @error('descriptionEdit') is-invalid @enderror"
                                            name="descriptionEdit" required autocomplete="descriptionEdit" autofocus> </textarea>

                                        @error('descriptionEdit')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="row mb-3">
                                    <label for="Edit"
                                        class="col-md-4 col-form-label text-md-end">{{ __('Amount') }}</label>

                                    <div class="col-md-6">
                                        <input id="amountEdit" type="number"
                                            class="form-control @error('amountEdit') is-invalid @enderror" name="Edit"
                                            pattern='[0-9]+(\\.[0-9][0-9]?)?' required autocomplete="Edit" autofocus>

                                        @error('Edit')
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

            <button type="button" id="btnEdit" class="btn btn-primary" style="float: right">Add Record</button>
        </form>
    </div>

    <script src="{{ url('js/record.js') }}"></script>
@endsection
