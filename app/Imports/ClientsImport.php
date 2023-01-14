<?php

namespace App\Imports;

use App\Models\Client;
use Carbon\Carbon;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;



class ClientsImport implements ToModel, WithHeadingRow
{
    /**
     * @param array $row
     *
     * @return \Illuminate\Database\Eloquent\Model|null
     */

    public function model(array $row)
    {
           return new Client([
            'user_id'     => $row['user_id'],
            'nombre'    => $row['nombre'],
            'fecha' =>  \PhpOffice\PhpSpreadsheet\Shared\Date::excelToDateTimeObject($row['fecha'])->format('Y/m/d'),
            'monto' => $row['pactado'],
            'depositado' => $row['aplicado'],
            'credito' => $row['credito'],
            'estatus' => $row['estatus'],
            'pago' => $row['deposito'],
        ]);
    }
}
