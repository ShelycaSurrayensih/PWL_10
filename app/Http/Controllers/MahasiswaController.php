<?php

namespace App\Http\Controllers;

use App\Models\Mahasiswa;
use App\Models\Kelas;
use App\Models\MataKuliah;
use App\Models\Mahasiswa_MataKuliah;
use Illuminate\Http\Request;

class MahasiswaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        if($request->has('search')){ // Pemilihan jika ingin melakukan pencarian nama
            $mahasiswas = Mahasiswa::where('nama', 'like', "%".$request->search."%")
            ->with('kelas')->paginate(3); //yang semula Mahasiswa::all, diubah menjadi with() yang menyatakan relasi
        } else { // Pemilihan jika tidak melakukan pencarian nama
            //fungsi eloquent menampilkan data menggunakan pagination
            $mahasiswas = Mahasiswa::with('kelas')->paginate(3); // Pagination menampilkan 3 data
        }
        return view('mahasiswa.index', compact('mahasiswas'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $kelas = Kelas::all();
        return view('mahasiswa.create',['kelas'=>$kelas]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //melakukan validasi data
        $request->validate([
            'nim' => 'required',
            'nama' => 'required',
            'tanggal_lahir' => 'required',
            'kelas' => 'required',
            'jurusan' => 'required',
            'no_handphone' => 'required',
            'email' => 'required',
            ]);

            $kelas = Kelas::find($request->get('kelas'));

            $Mahasiswa = new Mahasiswa;
            $Mahasiswa->Nim = $request->get('nim');
            $Mahasiswa->Nama = $request->get('nama');
            $Mahasiswa->Tanggal_Lahir = $request->get('tanggal_lahir');
            $Mahasiswa->Jurusan = $request->get('jurusan');
            $Mahasiswa->No_Handphone = $request->get('no_handphone');
            $Mahasiswa->Email = $request->get('email');

            //fungsi eloquent untuk menambah data dengan relasi belongsTo
            $Mahasiswa->kelas()->associate($kelas);
            $Mahasiswa->save();

            //jika data berhasil ditambahkan, akan kembali ke halaman utama
            return redirect()->route('mahasiswa.index')
                ->with('success', 'Mahasiswa Berhasil Ditambahkan');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($Nim)
    {
        //menampilkan detail data dengan menemukan/berdasarkan Nim Mahasiswa
        //code sebelum dibuat relasi --> $Mahasiswa = Mahasiswa::find($Nim);
        $Mahasiswa = Mahasiswa::with('kelas')->where('Nim', $Nim)->first();
        return view('mahasiswa.detail', compact('Mahasiswa'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($Nim)
    {
        //menampilkan detail data dengan menemukan berdasarkan Nim Mahasiswa untuk diedit
        $Mahasiswa = Mahasiswa::with('kelas')->where('nim', $Nim)->first();
        $kelas = Kelas::all(); //mendapatkan data dari tabel kelas
        return view('mahasiswa.edit', compact('Mahasiswa','kelas'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $nim)
    {
        //melakukan validasi data
        $request->validate([
            'nim' => 'required',
            'nama' => 'required',
            'tanggal_lahir' => 'required',
            'kelas' => 'required',
            'jurusan' => 'required',
            'no_handphone' => 'required',
            'email' => 'required',
        ]);

        $Mahasiswa = Mahasiswa::with('kelas')->where('nim', $nim)->first();
        $Mahasiswa->Nim = $request->get('nim');
        $Mahasiswa->Nama = $request->get('nama');
        $Mahasiswa->Tanggal_Lahir = $request->get('tanggal_lahir');
        $Mahasiswa->Jurusan = $request->get('jurusan');
        $Mahasiswa->No_Handphone = $request->get('no_handphone');
        $Mahasiswa->Email = $request->get('email');

        $kelas = Kelas::find($request->get('kelas'));

        //fungsi eloquent untuk mengupdate data dengan relasi belongsTo
        $Mahasiswa->kelas()->associate($kelas);
        $Mahasiswa->save();

        //jika data berhasil diupdate, akan kembali ke halaman utama
            return redirect()->route('mahasiswa.index')
                ->with('success', 'Mahasiswa Berhasil Diupdate');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($nim)
    {
        //fungsi eloquent untuk menghapus data
        Mahasiswa::find($nim)->delete();
        return redirect()->route('mahasiswa.index')
            -> with('success', 'Mahasiswa Berhasil Dihapus');
    }
    public function nilai($nim)
    {
        $Mahasiswa = Mahasiswa::with('kelas', 'matakuliah')->find($nim);
        return view('mahasiswa.nilai', compact('Mahasiswa'));
    }
    public function cari(Request $request)
	{
		$Mahasiswa=Mahasiswa::where('nama',$request->nama)->first();
        return view('mahasiswa.cari',compact('Mahasiswa'));

	}
}
