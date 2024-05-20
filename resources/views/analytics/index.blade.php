@extends('layouts.app')
@section('content')
    <div class="bg-white shadow rounded p-6">
        <h2 class="text-xl font-bold mb-4">Analytics Dashboard</h2>
        <!-- Your analytics content goes here -->

        <ul>
            <li><a href="{{ route('repairs') }}" class="text-blue-500">Get Repairs</a></li>
            <li><a href="{{ route('sales') }}" class="text-blue-500">Get Sales</a></li>
        </ul>

    </div>
@endsection
