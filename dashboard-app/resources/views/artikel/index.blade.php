<!DOCTYPE html>
<html>

<div class="row">

    @foreach($artikels as $artikel)

        <div class="col-md-4 mb-4">

            <div class="card shadow h-100">

                <!-- gambar -->
                <img src="{{ $artikel['gambar'] }}" class="card-img-top" style="height: 200px; object-fit: cover;">

                <div class="card-body text-center">

                    <!-- judul -->
                    <h5 class="card-title">
                        {{ $artikel['judul'] }}
                    </h5>

                    <!-- tombol -->
                    <a href="{{ $artikel['link'] }}" target="_blank" class="btn btn-primary">

                        Baca Artikel

                    </a>

                </div>

            </div>

        </div>

    @endforeach

</div>

</div>

</body>

</html>