<?php

namespace App\Imports;

use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\ToCollection;

class UsersImport implements ToCollection
{
  
    public function collection(Collection $rows)
    {
        return dd($rows[0][0]);
    }
}
