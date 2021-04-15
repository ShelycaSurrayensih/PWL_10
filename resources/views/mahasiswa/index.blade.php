@extends('mahasiswa.layout')
@section('content')
        <div class="row">
            <div class="col-lg-12 margin-tb">
                <div class="pull-left mt-2">
                    <h2>JURUSAN TEKNOLOGI INFORMASI-POLITEKNIK NEGERI MALANG</h2>
                </div>
                <div class="float-right my-2">
                    <a class="btn btn-success" href="{{ route('mahasiswa.create') }}"> Input Mahasiswa</a>
                </div>
            </div>
        </div>

        @if ($message = Session::get('success'))
            <div class="alert alert-success">
                <p>{{ $message }}</p>
            </div>
        @endif
        <form method="post" action="{{url('cari')}}" id="myForm">
            @csrf
                <div class="form-group">
                <label for="nama">Cari</label>
                <input type="text"name="nama"class="form-control"id="nama"aria-describedby="nama"  placeholder="Cari bedasarkan nama">
                </div>
                <button type="submit" class="btn btn-success mt-3">
            cari
            </button>
            </form>
        <table class="table table-bordered">
        <tr>
            <th>Nim</th>
            <th>Nama</th>
            <th>Foto</th>
            <th>Tanggal_Lahir</th>
            <th width="100px">Kelas</th>
            <th>Jurusan</th>
            <th>No_Handphone</th>
            <th>Email</th>
            <th width="400px">Action</th>
        </tr>
        @foreach ($mahasiswas as $Mahasiswa)
        <tr>
            <td>{{ $Mahasiswa->nim }}</td>
            <td>{{ $Mahasiswa->nama }}</td>
            <td>
                @php
                $pathImage = '';
                $mahasiswa->foto ? ($pathImage = 'storage/' . $mahasiswa->foto) : ($pathImage = 'img/empty.jpg');
            @endphp
            <img src="{{ asset('' . $pathImage . '') }}" width="100" alt="">
            </td>
            <td>{{ $Mahasiswa->tanggal_lahir }}</td>
            <td>{{ $Mahasiswa->kelas->nama_kelas }}</td>
            <td>{{ $Mahasiswa->jurusan }}</td>
            <td>{{ $Mahasiswa->no_handphone }}</td>
            <td>{{ $Mahasiswa->email }}</td>
            <td>
            <form action="{{ route('mahasiswa.destroy',$Mahasiswa->nim) }}" method="POST">
                <a class="btn btn-info" href="{{ route('mahasiswa.show',$Mahasiswa->nim) }}">Show</a>
                <a class="btn btn-primary" href="{{ route('mahasiswa.edit',$Mahasiswa->nim) }}">Edit</a>
                    @csrf
                    @method('DELETE')
                <button type="submit" class="btn btn-danger">Delete</button>
                <a class="btn btn-warning" href="{{ route('mahasiswa.nilai',$Mahasiswa->nim) }}">Nilai</a>
            </form>
            </td>
        </tr>
        @endforeach
    </table>

    </table>

    <div class="d-flex justify-content-center">
        {{$mahasiswas->links()}}
    </div>

@endsection
