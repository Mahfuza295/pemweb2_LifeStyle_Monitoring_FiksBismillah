<form method="POST" action="{{ route('admin.artikel.store') }}">
    @csrf

    <input type="text" name="judul" placeholder="Judul">
    <input type="text" name="link" placeholder="Link">

    <button type="submit">Simpan</button>
</form>