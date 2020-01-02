Hello {{ $user->name }}
<br>
Your new password: {{ $password }}
<br>
<a href="{{ route('login') }}" title="Login">Access your account now!</a>
