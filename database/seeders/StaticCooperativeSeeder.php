<?php

namespace Database\Seeders;

use App\Imports\StaticCooperativeImport;
use App\Models\StaticCooperative;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\File;
use Maatwebsite\Excel\Facades\Excel;

class StaticCooperativeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $json = File::get(public_path('cooperatives.json'));
        $cooperatives = json_decode($json, true);
        foreach ($cooperatives as $row)
        {
            StaticCooperative::create([
                'name'       => $row['KOPERASI'],
                'village'    => $row['DESA'],
                'districts'  => $row['KECAMATAN'],
                'active'     => $row['AKTIF'],
                'type'       => $row['JENIS KOPERASI'],
                'group'      => $row['KELOMPOK KOPERASI'],
            ]);
        }
    }
}
