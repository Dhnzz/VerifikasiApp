<?php

namespace App\Imports;

use App\Models\mahasiswa;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\ToCollection;
use Maatwebsite\Excel\Concerns\ToModel;

class ImportMahasiswa implements ToCollection, ToModel
{
    private $current = 0;
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        $this->current++;
        if($this->current > 1){
            $mahasiswa = new mahasiswa;
            dd($mahasiswa);
        }
        
    }

    public function collection(Collection $collection)
    {
        
    }
}
