@extends('layouts.admin')

@section('title', 'Dashboard')

@section('content')
    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">
        <div class="bg-white p-6 rounded-lg shadow hover:shadow-lg transition">
            <h2 class="text-lg font-semibold text-gray-700 mb-2">Total Produk</h2>
            <p class="text-4xl font-bold text-green-600">10</p>
        </div>
        <div class="bg-white p-6 rounded-lg shadow hover:shadow-lg transition">
            <h2 class="text-lg font-semibold text-gray-700 mb-2">Total Pesanan</h2>
            <p class="text-4xl font-bold text-green-600">27</p>
        </div>
        <div class="bg-white p-6 rounded-lg shadow hover:shadow-lg transition">
            <h2 class="text-lg font-semibold text-gray-700 mb-2">Total User</h2>
            <p class="text-4xl font-bold text-green-600">3</p>
        </div>
    </div>
@endsection
