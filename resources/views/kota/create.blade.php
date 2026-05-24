@extends('layouts.app')
@section('title')
    <a href="{{ url('/kota') }}"
       class="text-black-600 hover:text-blue-800 hover:none">
        Master Kota
    </a>
    > Tambah Data
@endsection
@section('subtitle', 'Halaman ini digunakan untuk melakukan tambah data master kota kedalam sistem')
@section('content')

<div class="p-3 md:p-6">
    {{-- CARD --}}
    <div class="bg-white rounded-2xl shadow-sm border border-gray-100 p-6">
        <form action="{{ url('/kota/store') }}" method="POST" class="space-y-5">
            @csrf
            
            {{-- PROVINSI INDUK --}}
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-2">Provinsi</label>
                <select name="propinsi_id" class="w-full rounded-md border border-gray-300 focus:border-blue-500 focus:ring focus:ring-blue-200">
                    <option value="">-- Pilih Provinsi --</option>
                    @foreach($propinsi as $prop)
                        <option value="{{ $prop->id }}" {{ old('propinsi_id') == $prop->id ? 'selected' : '' }}>
                            {{ $prop->propinsi_nama }}
                        </option>
                    @endforeach
                </select>
                @error('propinsi_id')
                    <div class="text-red-500 text-sm mt-1"> {{ $message }}</div>
                @enderror
            </div>

            {{-- KODE KOTA --}}
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-2">Kode Kota</label>
                <input type="text"
                       name="kota_kode"
                       value="{{ old('kota_kode') }}"
                       maxlength="10"
                       class="w-full rounded-md border border-gray-300 focus:border-blue-500 focus:ring focus:ring-blue-200">
                       
                @error('kota_kode')
                    <div class="text-red-500 text-sm mt-1"> {{ $message }}</div>
                @enderror
            </div>

            {{-- NAMA KOTA --}}
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-2">Nama Kota</label>
                <input type="text"
                       name="kota_nama"
                       value="{{ old('kota_nama') }}"
                       maxlength="100"
                       class="w-full rounded-md border border-gray-300 focus:border-blue-500 focus:ring focus:ring-blue-200">
                       
                @error('kota_nama')
                    <div class="text-red-500 text-sm mt-1"> {{ $message }}</div>
                @enderror
            </div>
            
            {{-- BUTTONS --}}
            <div class="flex justify-end gap-3 mt-8">
                <a href="{{ url('/kota') }}" class="px-4 py-2 rounded-md border border-gray-300 text-gray-700 hover:bg-gray-100 transition">Kembali</a>
                <button type="submit" class="px-4 py-2 rounded-md bg-blue-600 hover:bg-blue-700 text-white shadow-sm transition">Simpan</button>
            </div>
        </form>
    </div>
</div>

@endsection
