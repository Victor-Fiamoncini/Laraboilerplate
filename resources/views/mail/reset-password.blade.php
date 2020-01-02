User: {{ $user->name }}
<br>
Token: {{ $token }}
<br>
<a href="{{ route('password.form', $token) }}">
    Access here to reset your password
</a>
