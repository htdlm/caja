@extends('layout.app')

@section('title')
Mi cuenta
@endsection

@section('content')
    @component('components.breadcrumb')
        @slot('breadcrumb_title')
            <h3>¡Bienvenido, {{ Auth::user()->name }}!</h3>
        @endslot
    @endcomponent
    <div class="container-fluid">
        <div class="row">
            @if (Auth::user()->hasRole('admin'))
            <div>
                Sin datos aquí
            </div>
            @else
            <div class="col-sm-6 col-xl-4 col-lg-6">
                <div class="card o-hidden border-0">
                    <div class="bg-primary b-r-4 card-body">
                        <div class="media static-top-widget">
                            <div class="align-self-center text-center">
                                <i data-feather="check"></i>
                            </div>
                            <div class="media-body">
                                <span class="m-0">Pagos realizados</span>
                                <h4 class="mb-0 counter">
                                    {{ $done }}
                                </h4>
                                <i class="icon-bg" data-feather="check"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-sm-6 col-xl-4 col-lg-6">
                <div class="card o-hidden border-0">
                    <div class="bg-secondary b-r-4 card-body">
                        <div class="media static-top-widget">
                            <div class="align-self-center text-center">
                                <i data-feather="clock"></i>
                            </div>
                            <div class="media-body">
                                <span class="m-0">Pagos pendientes</span>
                                <h4 class="mb-0 counter">
                                    {{ $pendient }}
                                </h4>
                                <i class="icon-bg" data-feather="clock"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-sm-6 col-xl-4 col-lg-6">
                <div class="card o-hidden border-0">
                    <div class="bg-primary b-r-4 card-body">
                        <div class="media static-top-widget">
                            <div class="align-self-center text-center">
                                <i data-feather="dollar-sign"></i>
                            </div>
                            <div class="media-body">
                                <span class="m-0">Credito disponible</span>
                                <h4 class="mb-0 counter">
                                    ${{ number_format($credit, 2) }}
                                </h4>
                                <i class="icon-bg" data-feather="dollar-sign"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-sm-6 col-xl-4 col-lg-6">
                <div class="card o-hidden border-0">
                    <div class="card-body">
                        <canvas id="grafica"></canvas>
                    </div>
                </div>
            </div>

            <div class="col-sm-6 col-xl-8 col-lg-6">
                <div class="card overflow-auto" style="max-height: 487px">
                    <div class="card-body">
                        <div class="table-responsive text-center">
                            <table class="table table-bordernone">
                                <thead>
                                    <tr>
                                        <th scope="col">Fecha</th>
                                        <th scope="col">Estatus</th>
                                        <th scope="col">Déposito</th>
                                        <th scope="col">Pactado</th>
                                        <th scope="col">Crédito</th>
                                        <th scope="col">Aplicado</th>
                                    </tr>
                                </thead>
                                <tbody>
                                @foreach ($client as $mov)
                                    <tr>
                                        <td>
                                            {{ $mov->fecha->toDateString() }}
                                        </td>
                                        <td class="d-flex justify-content-center">
                                            @if ($mov->estatus == 0)
                                            <i data-feather="clock" class="text-warning"></i>
                                            <span class="ms-1">Pendiente</span>
                                            @elseif ($mov->estatus == 1)
                                            <i data-feather="check" class="text-success"></i>
                                            <span class="ms-1">Pagado</span>
                                            @elseif ($mov->estatus == 2)
                                            <i data-feather="star" class="text-primary"></i>
                                            <span class="ms-1">Extra</span>
                                            @elseif ($mov->estatus == 3)
                                            <i data-feather="dollar-sign" class="text-info"></i>
                                            <span class="ms-1">Bono</span>
                                            @elseif ($mov->estatus == 4)
                                            <i data-feather="bookmark" class="text-danger"></i>
                                            <span class="ms-1">Credito</span>
                                            @elseif ($mov->estatus == 5)
                                            <i data-feather="gift" class="text-muted"></i>
                                            <span class="ms-1">Cumpleaños</span>
                                            @elseif ($mov->estatus == 6)
                                            <i data-feather="dollar-sign" class="text-secondary"></i>
                                            <span class="ms-1">Deposito</span>
                                            @endif
                                        </td>
                                        <td>
                                            ${{ number_format($mov->pago, 2) }}
                                        </td>
                                        <td>
                                            ${{ number_format($mov->monto, 2) }}
                                        </td>
                                        <td>
                                            ${{ number_format($mov->credito, 2) }}
                                        </td>
                                        <td>
                                            ${{ number_format($mov->depositado, 2) }}
                                        </td>
                                    </tr>
                                @endforeach
                                <tr>
                                    <td colspan="2">
                                        Subtotal
                                    </td>
                                    <td>
                                        ${{ number_format($pagos, 2) }}
                                    </td>
                                    <td>

                                    </td>
                                    <td>

                                    </td>
                                    <td>
                                        ${{ number_format($total, 2) }}
                                    </td>
                                </tr>
                                    <tr>
                                        <td colspan="2">
                                            Ganancia del 7% del total
                                        </td>
                                        <td>
                                            @php
                                                $ganancia_pagos = $pagos * 0.07;
                                            @endphp
                                            ${{ number_format($ganancia_pagos, 2) }}
                                        </td>
                                        <td>

                                        </td>
                                        <td>

                                        </td>
                                        <td>
                                            @php
                                                $ganancia = $total * 0.07;
                                            @endphp
                                            ${{ number_format($ganancia, 2) }}
                                        </td>
                                    </tr>
                                    <tr>
                                        <td colspan="2">
                                            Total
                                        </td>
                                        <td>
                                            ${{ number_format($pagos + $ganancia_pagos, 2) }}
                                        </td>
                                        <td>

                                        </td>
                                        <td>

                                        </td>
                                        <td>
                                            ${{ number_format($total + $ganancia, 2) }}
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                            <br>
                            <span><b>Nota:</b> Usted recibirá estos montos siempre y cuando cumpla con la meta de ahorro que se propuso.</span>
                        </div>
                    </div>
                </div>
            </div>
            @endif
        </div>
    </div>
@endsection

@section('script')
<script src="https://cdn.jsdelivr.net/npm/chart.js@3.6.1/dist/chart.min.js"></script>
@if (Auth::user()->hasRole('admin'))
@else
<script>
    const ctx = document.getElementById('grafica').getContext('2d');
    const myChart = new Chart(ctx, {
        type: 'pie',
        data: {
            labels: ['Pendiente', 'Ahorrado', 'Extra'],
            datasets: [{
                data: [{{ $mount }}, {{ $save }}, {{ $extra }}],
                backgroundColor: [
                    'rgb(255, 99, 132)',
                    'rgb(75, 192, 192)',
                    'rgb(13, 110, 253)'
                ],
                borderColor: [
                    'rgb(255, 99, 132)',
                    'rgb(75, 192, 192)',
                    'rgb(13, 110, 253)'
                ],
                borderWidth: 1
            }]
        },
        options: {
            responsive: true,
            plugins: {
                legend: {
                    position: 'top',
                },
            }
        },
    });
</script>
@endif
@endsection

