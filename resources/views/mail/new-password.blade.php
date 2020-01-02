Hello {{ $user->name }}
<br>
Your new password: {{ $password }}
<br>
<a href="{{ route('login') }}" title="Login" rel="noopener noreferrer">Access your account now!</a>
