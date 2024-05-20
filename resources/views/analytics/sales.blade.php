@extends('layouts.app')
@section('content')
    <div class="container mx-auto">
        <h1 class="text-2xl font-bold mb-4">Get Sales</h1>
        <div>
            <form action="{{ route('sales') }}" method="POST">
                @csrf
                <div class="flex mb-4">
                    <div class="mr-4">
                        <label class="block text-gray-700 font-bold mb-2" for="startDate">Start Date:</label>
                        <input type="date" id="startDate" name="startDate"
                            class="shadow appearance-none border rounded w-48 py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"
                            value="{{ old('startDate') }}">
                    </div>
                    <div>
                        <label class="block text-gray-700 font-bold mb-2" for="endDate">End Date:</label>
                        <input type="date" id="endDate" name="endDate"
                            class="shadow appearance-none border rounded w-48 py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"
                            value="{{ old('endDate') }}">
                    </div>
                </div>
                <button type="submit"
                    class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline">Fetch
                    sales</button>
            </form>
        </div>
        <div class="mt-6">
            <table id="salesTable" class="table-auto w-full">
                <thead>
                    <tr>
                        <th>Date</th>
                        <th>Total Sum</th>
                    </tr>
                </thead>
                @if ($sales != null)
                    <tbody class="text-center ">

                        @php
                            $grandSum = 0;
                        @endphp
                        @foreach ($sales as $sale)
                            <tr>
                                <td>{{ $sale->Date }}</td>
                                <td>{{ round($sale->TotalSum, 2) }}</td>
                                @php
                                    $grandSum += $sale->TotalSum;
                                @endphp
                            </tr>
                        @endforeach

                    </tbody>
                    <tfoot>
                        <tr>
                            <td><strong>Grand Total</strong></td>
                            <td><strong>{{ round($grandSum, 2) }}</strong></td>
                        </tr>
                    </tfoot>
                @endif
            </table>
        </div>
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
