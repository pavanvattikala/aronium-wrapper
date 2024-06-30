@extends('layouts.app', ['title' => 'Get ' . Str::ucfirst($type) . ' By Date'])
@section('content')
    <style>
        tr {
            border-bottom: 1px solid #343030;
        }

        /* odd tr background color */
        tr:nth-child(odd) {
            background-color: #cbcbcbcd;
        }

        table {
            border-collapse: collapse;
            width: 60%;
        }
    </style>
    <div class="container mx-auto">
        <h1 class="text-2xl font-bold mb-4">Get {{ Str::ucfirst($type) }}</h1>
        <!-- Date input component -->
        <x-utils.dateInput action="{{ route('analytics.by_date') }}" type="{{ $type }}" />
        <div class="mt-6">
            <table id="analyticsTable" class="table-auto w-2/3">
                <thead>
                    @if ($analytics_data != null)
                        <tr>
                            <th colspan="2" id="table-heading"> {{ Str::ucfirst($type) }} Data From
                                {{ date('d-m-Y', strtotime($startDate)) }} To
                                {{ date('d-m-Y', strtotime($endDate)) }}</th>
                        </tr>
                    @endif
                    <tr>
                        <th>Date</th>
                        <th>Total Sum</th>
                    </tr>
                </thead>
                @php
                    $graph_data = [
                        'labels' => [],
                        'data' => [],
                    ];
                @endphp
                @if ($analytics_data != null)
                    <tbody class="text-center ">

                        @php
                            $grandSum = 0;

                            $graph_data['labels'] = array_column($analytics_data->toArray(), 'Date');
                            $graph_data['data'] = array_column($analytics_data->toArray(), 'TotalSum');
                        @endphp
                        @foreach ($analytics_data as $data)
                            <tr>
                                <td>{{ date('d-m-Y', strtotime($data->Date)) }}</td>

                                <td>{{ formatIndianCurrency(round($data->TotalSum, 0)) }}</td>
                                @php
                                    $grandSum += $data->TotalSum;
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

        <x-graphs.lineChart :data="$graph_data" />
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
