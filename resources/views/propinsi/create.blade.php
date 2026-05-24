@extends('layouts.app')
@section('title')
    <a href="{{ url('/propinsi') }}"
       class="text-black-600 hover:text-blue-800 hover:none">
        Master Provinsi
    </a>
    > Tambah Data
@endsection
@section('subtitle', 'Halaman ini digunakan untuk melakukan tambah data master provinsi kedalam sistem')
@section('content')

<div class="p-3 md:p-6">
    {{-- CARD --}}
    <div class="bg-white rounded-2xl shadow-sm border border-gray-100 p-6">
        <form action="{{ url('/propinsi/store') }}" method="POST" class="space-y-5">
            @csrf
            
            {{-- KODE PROVINSI --}}
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-2">Kode Provinsi</label>
                <input type="text"
                       name="propinsi_kode"
                       value="{{ old('propinsi_kode') }}"
                       maxlength="10"
                       class="w-full rounded-md border border-gray-300 focus:border-blue-500 focus:ring focus:ring-blue-200">
                       
                @error('propinsi_kode')
                    <div class="text-red-500 text-sm mt-1"> {{ $message }}</div>
                @enderror
            </div>

            {{-- NAMA PROVINSI --}}
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-2">Nama Provinsi</label>
                <input type="text"
                       name="propinsi_nama"
                       value="{{ old('propinsi_nama') }}"
                       maxlength="100"
                       class="w-full rounded-md border border-gray-300 focus:border-blue-500 focus:ring focus:ring-blue-200">
                       
                @error('propinsi_nama')
                    <div class="text-red-500 text-sm mt-1"> {{ $message }}</div>
                @enderror
            </div>
            
            {{-- BUTTONS --}}
            <div class="flex justify-end gap-3 mt-8">
                <a href="{{ url('/propinsi') }}" class="px-4 py-2 rounded-md border border-gray-300 text-gray-700 hover:bg-gray-100 transition">Kembali</a>
                <button type="submit" class="px-4 py-2 rounded-md bg-blue-600 hover:bg-blue-700 text-white shadow-sm transition">Simpan</button>
            </div>
        </form>
    </div>
</div>

@endsection
