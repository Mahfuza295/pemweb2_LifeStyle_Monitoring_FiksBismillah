<form method="POST" action="/register">
    @csrf

    <input type="text" name="name" placeholder="Nama">

    <input type="email" name="email" placeholder="Email">

    <input type="password" name="password" placeholder="Password">

    <input type="password" name="password_confirmation" placeholder="Konfirmasi Password">

    <button type="submit">
        Register
    </button>
</form>

<a href="/login">
    Login
</a>
