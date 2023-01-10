<?php

namespace App\Exports;

use App\Models\Client;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class ClientsExport implements FromCollection, WithHeadings
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        return Client::get(['user_id', 'nombre', 'fecha', 'monto', 'depositado', 'credito', 'estatus', 'pago']);
    }

    public function headings(): array
    {
        return ["user_id", "nombre", "fecha", "pactado", "aplicado", "credito", "estatus", "deposito"];
    }
}
