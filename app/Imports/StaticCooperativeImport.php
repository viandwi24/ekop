<?php

namespace App\Imports;

use App\Models\StaticCooperative;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\ToCollection;

class StaticCooperativeImport implements ToCollection
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function collection(Collection $rows)
    {
        unset($rows[0]);
        foreach ($rows as $row)
        {
            // $row_arr = $row->toArray()[1];
            // $row_arr = $row->toArray()
            return var_dump(explode('\t', $row[0]));
            return new StaticCooperative([
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
