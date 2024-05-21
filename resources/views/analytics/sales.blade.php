@extends('layouts.app')
@section('content')
    <div class="container mx-auto">
        <h1 class="text-2xl font-bold mb-4">Get Sales</h1>
        <!-- Date input component -->
        <x-utils.dateInput action="{{ route('sales') }}" />
        <div class="mt-6">
            <table id="salesTable" class="table-auto w-full">
                <thead>
                    @if ($sales != null)
                        <tr>
                            <th colspan="2" id="table-heading">Sales From {{ date('d-m-Y', strtotime($startDate)) }} To
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
                @if ($sales != null)
                    <tbody class="text-center ">

                        @php
                            $grandSum = 0;

                            $data['labels'] = array_column($sales->toArray(), 'Date');
                            $data['data'] = array_column($sales->toArray(), 'TotalSum');
                        @endphp
                        @foreach ($sales as $sale)
                            <tr>
                                <td>{{ date('d-m-Y', strtotime($sale->Date)) }}</td>

                                <td>{{ formatIndianCurrency(round($sale->TotalSum, 0)) }}</td>
                                @php
                                    $grandSum += $sale->TotalSum;
                                @endphp
                            </tr>
                        @endforeach

                    </tbody>
                    <tfoot class="text-center ">
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
    <script src="{{ asset('js/jquery.js') }}"></script>
    <script>
        $(document).ready(function() {
            // set the start date to this month start date
            let startDate = new Date();
            startDate.setDate(1);
            let month = startDate.getMonth() + 1;
            let day = startDate.getDate();
            let year = startDate.getFullYear();
            let formattedStartDate = year + '-' + (month < 10 ? '0' + month : month) + '-' + (day < 10 ? '0' + day :
                day);
            $('#startDate').val(formattedStartDate);

            // set the end date to current Date
            let endDate = new Date();
            month = endDate.getMonth() + 1;
            day = endDate.getDate();
            year = endDate.getFullYear();
            let formattedEndDate = year + '-' + (month < 10 ? '0' + month : month) + '-' + (day < 10 ? '0' + day :
                day);
            $('#endDate').val(formattedEndDate);
        });
    </script>
@endsection
