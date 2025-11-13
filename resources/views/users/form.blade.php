<div class="container">
    <h1>{{ isset($user) ? 'Edit User' : 'Register User' }}</h1>

    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ isset($user) ? route('users.update', $user->id) : route('users.store') }}" method="POST">
        @csrf
        @if (isset($user))
            @method('PUT')
        @endif

        <div class="mb-3">
            <label for="name" class="form-label">Name</label>
            <input type="text" class="form-control" id="name" name="name"
                value="{{ old('name', $user->name ?? '') }}" required>
        </div>

        <div class="mb-3">
            <label for="email" class="form-label">Email</label>
            <input type="email" class="form-control" id="email" name="email"
                value="{{ old('email', $user->email ?? '') }}" required>
        </div>

        <div class="mb-3">
            <div><label class="form-label" for="password">Password</label><span
                    class="float-end btn m-0 p-0 btn-outline-info" id="btnGeneratePassword">Generate password
                </span>
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

        <div class="mb-3">
            <label for="role" class="form-label">Role</label>
            <select class="form-control" id="role" name="role">
                <option value="">Select Role</option>
                @foreach ($roles as $role)
                    <option value="{{ $role->name }}"
                        {{ isset($user) && $user->hasRole($role->name) ? 'selected' : '' }}>
                        {{ $role->name }}
                    </option>
                @endforeach
            </select>
        </div>

        <button type="submit" class="btn btn-primary">Save</button>
    </form>
</div>

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
