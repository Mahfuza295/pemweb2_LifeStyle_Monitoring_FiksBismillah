<form action="/artikel" method="POST" enctype="multipart/form-data">
    @csrf

    <input type="text" name="judul" placeholder="Judul">

    <textarea name="isi" placeholder="Isi"></textarea>

    <input type="file" name="gambar">

    <button type="submit">Simpan</button>
</form>