@component('mail::message')
    # Welcome, {{ $name }}!
    <div style="text-align: center;justify-content:center;width:100%;">
        <img src="https://importguadalajara.com/assets/images/logo.jpg" alt="Company Logo" style="width: 50px; height: auto;">
    </div>

    Your account has been created successfully.

    Here are your login details:

    - **Email**: {{ $email }}
    - **Password**: {{ $password }}
    @if ($type == 1)
        @component('mail::button', ['url' => route('roow')])
            Login Now
        @endcomponent
    @endif

    Thanks,<br>
    {{ config('app.name') }}
@endcomponent
