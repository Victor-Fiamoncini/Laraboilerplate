Hello {{ $user->name }}
<br>
<a href="{{ route('password.reset.form', $token) }}" title="Reset Password" rel="noopener noreferrer">
    Access here to reset your password
</a>
