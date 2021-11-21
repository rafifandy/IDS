<?php

namespace App\Imports;

use App\Models\Customer;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\SkipsonError;
use Maatwebsite\Excel\Concerns\SkipsonFailure;
use Maatwebsite\Excel\Concerns\SkipsErrors;
use Maatwebsite\Excel\Concerns\SkipsFailures;
use Maatwebsite\Excel\Concerns\Importable;
use Maatwebsite\Excel\Validators\Failure;
use Maatwebsite\Excel\Concerns\WithValidation;
use validation;

class I_customer implements ToModel,WithValidation,SkipsonError,SkipsonFailure
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    use Importable, SkipsErrors,SkipsFailures;
    public function rules(): array
    {
        return [
            '0' => 'unique:tbl_customer,id_cust',
        ];
    }
    public function model(array $row)
    {
        return new Customer([
            'id_cust' => $row[0],
            'nama' => $row[1],
            'alamat' => $row[2],
            'kodepos' => $row[3],
        ]);
    }
    public function batchSize(): int
    {
        return 1000;
    }
    
    
}
