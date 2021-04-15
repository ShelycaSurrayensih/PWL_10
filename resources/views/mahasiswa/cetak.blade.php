<style>
    table {
border: 1px solid rgb(0, 0, 0);
border-collapse: collapse;
margin: 0;
padding: 0;
width: 100%;
table-layout: fixed;
}
table caption {
font-size: 1.5em;
margin: .5em 0 .75em;
}
table tr {
background-color: #fdfdfd;
border: 3px solid rgb(0, 0, 0);
padding: .35em;
}
table th,
table td {
padding: .625em;
text-align: center;
}
table th {
font-size: .85em;
letter-spacing: .1em;
text-transform: uppercase;
}
</style>
<div class="row">
    <div class="col-12 text-center">
        <center><h3><strong>Politeknik Negeri MALANG</strong></h3><br /><h3><strong>KARTU HASIL STUDI (KHS)</strong></h3></center>
    </div>
    <div class="col-12 my-4">
        <p class="m-0"><strong>Nama:</strong> {{ $Mahasiswa->nama }}</p>
        <p class="m-0"><strong>NIM:</strong> {{ $Mahasiswa->nim }}</p>
        <p class="m-0"><strong>Kelas:</strong> {{ $Mahasiswa->kelas->nama_kelas }}</p>
    </div>
    <div class="col-12">
        <table class="table table-bordered">
            <tr>
                <th>Mata Kuliah</th>
                <th>SKS</th>
                <th>Semester</th>
                <th>Nilai</th>
            </tr>
            @foreach ($Mahasiswa->matakuliah as $matakuliah)
                <tr>
                    <td>{{ $matakuliah->nama_matkul }}</td>
                    <td>{{ $matakuliah->sks }}</td>
                    <td>{{ $matakuliah->semester }}</td>
                    <td>{{ $matakuliah->pivot->nilai }}</td>
                </tr>
            @endforeach
        </table>
    </div>
</div>
