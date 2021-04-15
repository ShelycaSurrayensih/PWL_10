@extends('mahasiswa.layout')

@section('content')

<div class="container mt-5">

    <div class="row justify-content-center align-items-center">
        <div class="card" style="width: 24rem;">
            <div class="card-header">
                Edit Mahasiswa
            </div>
        <div class="card-body">
            @if ($errors->any())
                <div class="alert alert-danger">
                <strong>Whoops!</strong> There were some problems with your input.<br><br>
                <ul>
                    @foreach ($errors->all() as $error)
                       <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
            @endif
            <form action="/mahasiswa/{{$Mahasiswa->nim}}" method="post"
                enctype="multipart/form-data">
                @csrf
                @method('PUT')
            <div class="form-group">
                <label for="nim">Nim</label>
                <input type="text" name="nim" class="form-control" id="nim" value="{{ $Mahasiswa->nim }}" aria-describedby="nim" >
            </div>
            <div class="form-group">
                <label for="nama">Nama</label>
                <input type="text" name="nama" class="form-control" id="nama" value="{{ $Mahasiswa->nama }}" aria-describedby="nama" >
            </div>
            @php
            $pathImage = '';
            $Mahasiswa->foto ? ($pathImage = 'storage/' . $Mahasiswa->foto) : ($pathImage = 'img/empty.jpg');
            @endphp
            <div class="d-flex align-items-start mb-3">
            <img src="{{ asset('' . $pathImage . '') }}" alt="" width="100" class="img-responsive">
            <div class="form-group ml-3 ">
                <label for="foto">Foto</label>
                <input type="file" class="form-control-file" id="foto" name="foto">
            </div>
        </div>
            <div class="form-group">
                <label for="tanggal_lahir">Tanggal Lahir</label>
                <input type="date" name="tanggal_lahir" class="form-control" id="tanggal_lahir" value="{{ $Mahasiswa->tanggal_lahir }}" aria-describedby="tanggal_lahir" >
            </div>
            <div class="form-group">
                <label for="kelas">Kelas</label>
                <select type="kelas" name="kelas" class="form-control" id="kelas">
                    @foreach($kelas as $kls)
                        <option value="{{ $kls->id }}"
                            {{ $Mahasiswa->kelas_id == $kls->id ? 'selected' : '' }}>
                            {{ $kls->nama_kelas }}</option>
                    @endforeach
                </select>
            </div>
            <div class="form-group">
                <label for="jurusan">Jurusan</label>
                <input type="jurusan" name="jurusan" class="form-control" id="jurusan" value="{{ $Mahasiswa->jurusan }}" aria-describedby="jurusan" >
            </div>
            <div class="form-group">
                <label for="no_handphone">No Handphone</label>
                <input type="no_handphone" name="no_handphone" class="form-control" id="no_handphone" value="{{ $Mahasiswa->no_handphone }}" aria-describedby="no_handphone" >
            </div>
            <div class="form-group">
                <label for="email">Email</label>
                <input type="email" name="email" class="form-control" id="email" value="{{ $Mahasiswa->email }}" aria-describedby="email" >
            </div>
            <button type="submit" class="btn btn-primary">Submit</button>
            </form>
            </div>
        </div>
    </div>
</div>
@endsection
