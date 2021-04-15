<?php

namespace Database\Seeders;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Seeder;

class UpdateMahasiswaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
         // Misal kita update data mahasiswa yang ada saat ini milik TI 2A
         DB::table('mahasiswa')->update(['kelas_id' => 1]);
    }
}
