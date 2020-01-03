Hello {{ $user->name }}
<br>
Password: {{ $password }}
<a href="{{ route('login') }}" title="Login" rel="noopener noreferrer">
    Access here and login for free!
</a>
