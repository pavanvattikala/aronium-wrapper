@extends('layouts.app')
@section('content')
    <div class="bg-white shadow rounded p-6">
        <h2 class="text-xl font-bold mb-4">Analytics Dashboard</h2>

        <div class="space-y-6">
            <div>
                <h3 class="text-lg font-semibold mb-2">Repairs</h3>
                <ul class="list-disc list-inside space-y-1 pl-4">
                    <li><a href="{{ route('repairs') }}" class="text-blue-500 hover:underline">Get Repairs By Date</a></li>
                    <li><a href="{{ route('repairs.documents') }}" class="text-blue-500 hover:underline">Get Repairs By
                            Document</a>
                    </li>
                </ul>
            </div>
            <div>
                <h3 class="text-lg font-semibold mb-2">Sales</h3>
                <ul class="list-disc list-inside space-y-1 pl-4">
                    <li><a href="{{ route('sales') }}" class="text-blue-500 hover:underline">Get Sales By Date</a></li>
                    <li><a href="{{ route('sales.documents') }}" class="text-blue-500 hover:underline">Get Sales By
                            Document</a></li>
                </ul>
            </div>
        </div>

    </div>
@endsection
