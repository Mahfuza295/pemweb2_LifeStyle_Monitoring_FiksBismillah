<form method="POST" action="{{ route('admin.artikel.update', $artikel->id) }}">
    @csrf
    @method('PUT')

    <input type="text" name="judul" value="{{ $artikel->judul }}">
    <input type="text" name="link" value="{{ $artikel->link }}">

    <button type="submit">Update</button>
</form>