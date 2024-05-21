@extends('layouts.app')
@section('content')
    <div class="container mx-auto">
        <h1 class="text-2xl font-bold mb-4">Get Repairs</h1>
        <!-- Date input component -->
        <x-utils.dateInput action="{{ route('repairs') }}" />
        <div class="mt-6">
            <table id="repairsTable" class="table-auto w-full text-center">
                <thead>
                    @if ($repairs != null)
                        <tr>
                            <th colspan="2" id="table-heading">Repairs From {{ date('d-m-Y', strtotime($startDate)) }} To
                                {{ date('d-m-Y', strtotime($endDate)) }}</th>
                        </tr>
                    @endif
                    <tr>
                        <th>Date</th>
                        <th>Total Sum</th>
                    </tr>
                </thead>
                @php
                    $data = [
                        'labels' => [],
                        'data' => [],
                    ];
                @endphp
                @if ($repairs != null)
                    <tbody>

                        @php
                            $grandSum = 0;

                            $data['labels'] = array_column($repairs->toArray(), 'Date');
                            $data['data'] = array_column($repairs->toArray(), 'TotalSum');
                        @endphp
                        @foreach ($repairs as $repair)
                            <tr>
                                <td>{{ date('d-m-Y', strtotime($repair->Date)) }}</td>
                                <td>{{ formatIndianCurrency(round($repair->TotalSum, 0)) }}</td>
                                @php
                                    $grandSum += $repair->TotalSum;
                                @endphp
                            </tr>
                        @endforeach

                    </tbody>
                    <tfoot>
                        <tr>
                            <td><strong>Grand Total</strong></td>
                            <td><strong>{{ formatIndianCurrency(round($grandSum, 0)) }}</strong></td>
                        </tr>
                    </tfoot>
                @endif
            </table>
        </div>
        <!-- Display the line chart -->
        <x-graphs.lineChart :data="$data" />

    </div>
    <script></script>
@endsection
