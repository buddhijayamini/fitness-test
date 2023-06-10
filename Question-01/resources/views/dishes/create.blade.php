@extends('auth.layouts')

@section('content')
    <style>
        .swal-wide {
            width: 50px !important;
            height: 20px !important;
        }
    </style>
    <div class="container p-2">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">{{ __('Create Dish') }}</div>

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
                                                class="form-control @error('name') is-invalid @enderror" name="name"
                                                required autocomplete="name" autofocus>

                                            @error('name')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                    </div>

                                    <div class="row mb-3">
                                        <label for="name"
                                            class="col-md-4 col-form-label text-md-end">{{ __('Type') }}</label>

                                        <div class="col-md-6">
                                            <select class="form-select" id="type" name="type">
                                                <option>Select</option>
                                                <option value="Main Dishes">Main Dishes</option>
                                                <option value="Side Dishes">Side Dishes</option>
                                                <option value="Dessert">Dessert</option>
                                            </select>

                                            @error('type')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                    </div>

                                    <div class="row mb-3">
                                        <label for="price"
                                            class="col-md-4 col-form-label text-md-end">{{ __('Price') }}</label>

                                        <div class="col-md-6">
                                            <input id="price" type="number"
                                                class="form-control @error('price') is-invalid @enderror" name="price"
                                                required autocomplete="price" autofocus>

                                            @error('price')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                    </div>

                                    <div class="row mb-0">
                                        <div class="col-md-6 offset-md-4">
                                            <button type="submit" class="btn btn-primary" id="saveBtn">
                                                {{ __('Add') }}
                                            </button>
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

    <script type="text/javascript">
        $(document).ready(function() {

            // save btn
            $("#saveBtn").click(function(e) {
                e.preventDefault();
                var CSRF_TOKEN = $('meta[name="csrf-token"]').attr("content");
                var name = $("#name").val();
                var type = $("#type").val();
                var price = $("#price").val();

                $.ajax({
                    type: "POST",
                    url: "/dish-save",
                    headers: {
                    "Content-Type": "application/x-www-form-urlencoded",
                    },
                    data: {
                        _token: CSRF_TOKEN,
                        type: type,
                        name: name,
                        price: price,
                    },
                    success: function(json) {
                        if (json.status == 500) {
                            Swal.fire("Error", json.message, "error");
                            $("#addFrm").trigger("reset");
                        } else if (json.status == 200) {
                            Swal.fire("Succuss", json.message, "success");
                            $("#addFrm").trigger("reset");
                        }
                    },
                    error: function(xhr) {
                        // $.LoadingOverlay("hide");
                        Swal.fire(
                            "Error",
                            JSON.parse(xhr.responseText).message,
                            "error"
                        );
                        $("#addFrm").trigger("reset");
                    },
                });

            });

        });
    </script>
@endsection
