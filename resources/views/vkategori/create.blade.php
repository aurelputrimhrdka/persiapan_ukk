@extends('view_barang.layout')

@section('content')  
    

<div class="row m-4">
    <div class="col-lg-12 margin-tb">
        <div class="row justify-content-center">
            <h5>Tambahkan Kategori</h5>
        </div>
        
    </div>
   
    @if ($errors->any())
    <div class="row m-4">
        <div class="alert alert-danger">
            <strong>Whoops!</strong> There were some problems with your input.<br><br>
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    </div>
    @endif

    <hr/>
    <div class="container">
        <div class="row justify-content-center">
    <div class="card">
    <div class="card-body">
    <div class="col-xs-12 col-sm-12 col-md-12 text-center">
            <a class="btn btn-primary" href="{{ route('kategori.index') }}"> Back</a>
        </div>
    <form action="{{ route('kategori.store') }}" method="POST" enctype="multipart/form-data">
        @csrf
  
        <div class="row">

            <div class="col-xs-12 col-sm-12 col-md-12">
                <div class="form-group">
                    <strong>Kategori</strong>
                    <input type="text" name="kategori" class="form-control" placeholder="Kategori">
                </div>
            </div>

            <div class="col-xs-12 col-sm-12 col-md-12">
                <div class="form-group">
                    <strong>Jenis</strong>
                    <select class="form-control" name="jenis" aria-label="Default select example">
                        <option value="M">M</option>
                        <option value="A">A</option>
                        <option value="BHP">BHP</option>
                        <option value="BTHP">BTHP</option>
                    </select>
                </div>
            </div>

            <div class="col-xs-12 col-sm-12 col-md-12 text-center">
                <button type="submit" class="btn btn-primary">Submit</button>
                
            </div>
            

        </div>
        </div>
        </div>
        </div>
        </div>

    </form>
</div>
   
@endsection
