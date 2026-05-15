@extends('layouts.app')
@section('title', 'Dashboard')
@section('content')

<div class="grid grid-cols-3 gap-4">

    <div class="bg-white p-4 rounded shadow">
        <h2 class="text-gray-500">Total Shipment</h2>
        <p class="text-2xl font-bold">0</p>
    </div>

    <div class="bg-white p-4 rounded shadow">
        <h2 class="text-gray-500">In Transit</h2>
        <p class="text-2xl font-bold text-yellow-500">0</p>
    </div>

    <div class="bg-white p-4 rounded shadow">
        <h2 class="text-gray-500">Delivered</h2>
        <p class="text-2xl font-bold text-green-500">0</p>
    </div>

</div>

@endsection