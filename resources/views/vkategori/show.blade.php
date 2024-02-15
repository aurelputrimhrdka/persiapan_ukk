@extends('view_barang.layout')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
               <div class="card border-0 shadow rounded">
                    <div class="card-body">
                    <div class="card-header">Detail Kategori</div>
                        <table class="table">
                            <tr>
                                <td>Kategori</td>
                                <td>{{ $rsetKategori->kategori }}</td>
                            </tr>
                            <tr>
                                <td>Jenis</td>
                                <td>{{ $rsetKategori->jenis }}</td>
                            </tr>
                        </table>
                        <div class="row">
            <div class="col-md-12  text-center">
                <a href="{{ route('kategori.index') }}" class="btn btn-md btn-primary mb-3">Back</a>
            </div>
                    </div>
               </div>
            </div>
            
           
        </div>
        
        </div>
    </div>
@endsection
