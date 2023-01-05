<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use App\Models\{
    Client,
};

class DashboardController extends Controller
{

    public function index()
    {
        $data = null;
        if (Auth::user()->hasRole('admin'))
            $data = [
                'clients' => Client::all()
            ];
        else if (Auth::user()->hasRole('client'))
        {
            $client = Client::where('user_id', Auth::user()->id)->get();
            $credit = Client::where('user_id', Auth::user()->id)
                            ->where('estatus', 1)
                            ->latest('fecha')
                            ->first();
            $save = Client::where('user_id', Auth::user()->id)->whereIn('estatus', [1, 3])->sum('depositado');
            $pendient = Client::where('user_id', Auth::user()->id)->where('estatus', 0)->sum('monto');
            $pagos = Client::where('user_id', Auth::user()->id)->sum('pago');

            $data = [
                'client' => $client,
                'done' => Client::where('user_id', Auth::user()->id)->where('estatus', 1)->count(),
                'pendient' => Client::where('user_id', Auth::user()->id)->where('estatus', 0)->count(),
                'total' => $save + $pendient,
                'save' => $save,
                'pagos' => $pagos,
                'mount' => $pendient,
                'credit' => $credit != null ? $credit->credito : 0,
                'bonos' => Client::where('user_id', Auth::user()->id)->where('estatus', 2)->sum('depositado'),
            ];
        }

        return view('pages.dashboard.index', $data);
    }

}
