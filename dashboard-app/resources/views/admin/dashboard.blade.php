@extends('layouts.app')
<!DOCTYPE html>
<html>

<head>
    <title>Dashboard Admin</title>
</head>

<body>

    <h1>Dashboard Admin</h1>
    <p>Selamat datang Admin</p>

    <hr>

    <h3>Menu Admin</h3>

    <ul>
        <li>
            <a href="{{ route('admin.artikel.index') }}">
                Kelola Artikel
            </a>
        </li>
    </ul>

</body>

</html>