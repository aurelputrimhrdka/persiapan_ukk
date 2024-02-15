<!-- {{ dd($rsetKategori) }}

foreach ($rsetKategori as $rowkategori) {
    {{ $rowkategori->id }}
}

$rowkategori : {"id":1,"deskripsi":"Pendingin Ruangan","kategori":"M","created_at":"2023-10-23 00:35:02","updated_at":"2023-10-23 00:35:02"} -->

@foreach ($rsetKategori as $rowkategori) 
    {{ $rowkategori->deskripsi }}
    <br>
@endforeach