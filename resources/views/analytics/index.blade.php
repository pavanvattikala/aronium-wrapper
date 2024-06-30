@extends('layouts.app', ['title' => 'Analytics Dashboard'])
@section('content')
    <div class="bg-white shadow rounded p-6">
        <h2 class="text-xl font-bold mb-4">Analytics Dashboard</h2>

        <div class="space-y-6">
            <div>
                <h3 class="text-lg font-semibold mb-2">Analytics</h3>
                <ul class="list-disc list-inside space-y-1 pl-4">
                    <li><a href="{{ route('analytics.by_date') }}?type=repairs" class="text-blue-500 hover:underline">Get
                            Repairs By
                            Date</a></li>
                    <li><a href="{{ route('analytics.by_date') }}?type=sales" class="text-blue-500 hover:underline">Get Sales
                            By Date</a>
                    </li>
                </ul>
            </div>

        </div>

    </div>
@endsection
