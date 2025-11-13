@extends('layouts.master')
@section('title')
    Register Seller
@endsection

@section('content')
    <div class="container">
        <h1>Register Seller</h1>

        @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        @if (session('error'))
            <div class="alert alert-danger">
                {{ session('error') }}
            </div>
        @endif

        <form action="{{ route('sellers.store') }}" method="POST">
            @csrf
            <div class="mb-3">
                <label for="name" class="form-label">Seller Name</label>
                <input type="text" class="form-control" id="name" name="name" value="{{ old('name') }}" required>
            </div>

            <div class="mb-3">
                <label for="phone" class="form-label">Phone</label>
                <input type="text" class="form-control" id="phone" name="phone" value="{{ old('phone') }}">
            </div>

            <div class="mb-3">
                <label for="address" class="form-label">Address</label>
                <input type="text" class="form-control" id="address" name="address" value="{{ old('address') }}">
            </div>

            <div class="mb-3">
                <label for="email" class="form-label">Email</label>
                <input type="email" class="form-control" id="email" name="email" value="{{ old('email') }}"
                    required>
            </div>
            {{-- 
            <div class="mb-3">
                <label for="password" class="form-label">Password</label>
                <input type="password" class="form-control" id="password" name="password" required>
            </div> --}}

            <div class="mb-3">
                <div><label class="form-label" for="password">Contraseña</label><span
                        class="float-end btn m-0 p-0 btn-outline-info" id="btnGeneratePassword">Generar contraseña</span>
                </div>
                <div class="input-group">
                    <input type="password" class="form-control @error('password') is-invalid @enderror" id="password"
                        name="password" placeholder="Ingrese password" autofocus>
                    <span class="input-group-text">
                        <i class="fa fa-eye show_hide_pwd" style="cursor: pointer"></i>
                    </span>
                </div>

                @error('password')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>

            <button type="submit" class="btn btn-primary">Save</button>
        </form>
    </div>
@endsection

@section('script')
    <script src="{{ URL::asset('assets/js/app.js') }}"></script>
    <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>

    <script type="text/javascript">
        $(document).ready(function() {
            $('#btnGeneratePassword').on('click', function(e) {
                let randomstring = Math.random().toString(36).slice(-10);
                $('#password').val(randomstring);
            });


            $('.show_hide_pwd').on('click', function(e) {
                const togglePassword = $(this);
                const password = $(this).parent().parent().find('input');
                const type = password.attr("type") === "password" ? "text" : "password";
                password.attr("type", type);
                this.classList.toggle('fa-eye');
                this.classList.toggle('fa-eye-slash');
            });

        });
    </script>
@endsection
