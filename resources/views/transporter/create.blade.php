@extends('layouts.app')
@section('title')
    <a href="{{ url('/vendor') }}"
       class="text-black-600 hover:text-blue-800 hover:none">
        Master Transporter
    </a>
    > Tambah Data
@endsection
@section('subtitle', 'Halaman ini digunakan untuk melakukan tambah data master transporter kedalam sistem')
@section('content')

<div class="p-3 md:p-6">
    {{-- CARD --}}
    <div class="bg-white rounded-2xl shadow-sm border border-gray-100 p-6">
        <form action="{{ url('/vendor/store') }}" method="POST" class="space-y-5">
            @csrf
            
            {{-- NAMA TRANSPORTER --}}
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-2">Nama Transporter</label>
                <input type="text"
                       name="transporter_nama"
                       value="{{ old('transporter_nama') }}"
                       maxlength="100"
                       class="w-full rounded-md border border-gray-300 focus:border-blue-500 focus:ring focus:ring-blue-200">
                       
                @error('transporter_nama')
                    <div class="text-red-500 text-sm mt-1"> {{ $message }}</div>
                @enderror
            </div>

            {{-- PIC TRANSPORTER --}}
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-2">Nama PIC</label>
                <input type="text"
                       name="transporter_pic"
                       value="{{ old('transporter_pic') }}"
                       maxlength="100"
                       class="w-full rounded-md border border-gray-300 focus:border-blue-500 focus:ring focus:ring-blue-200">
                       
                @error('transporter_pic')
                    <div class="text-red-500 text-sm mt-1"> {{ $message }}</div>
                @enderror
            </div>

            {{-- HP TRANSPORTER --}}
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-2">No. HP / Kontak</label>
                <input type="text"
                       name="transporter_hp"
                       value="{{ old('transporter_hp') }}"
                       maxlength="20"
                       class="w-full rounded-md border border-gray-300 focus:border-blue-500 focus:ring focus:ring-blue-200">
                       
                @error('transporter_hp')
                    <div class="text-red-500 text-sm mt-1"> {{ $message }}</div>
                @enderror
            </div>

            {{-- STATUS TRANSPORTER --}}
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-2">Status</label>
                <select name="transporter_status" class="w-full rounded-md border border-gray-300 focus:border-blue-500 focus:ring focus:ring-blue-200">
                    <option value="1" {{ old('transporter_status') == '1' ? 'selected' : '' }}>Aktif</option>
                    <option value="2" {{ old('transporter_status') == '2' ? 'selected' : '' }}>Tidak Aktif</option>
                </select>
                @error('transporter_status')
                    <div class="text-red-500 text-sm mt-1"> {{ $message }}</div>
                @enderror
            </div>
            
            {{-- BUTTONS --}}
            <div class="flex justify-end gap-3 mt-8">
                <a href="{{ url('/vendor') }}" class="px-4 py-2 rounded-md border border-gray-300 text-gray-700 hover:bg-gray-100 transition">Kembali</a>
                <button type="submit" class="px-4 py-2 rounded-md bg-blue-600 hover:bg-blue-700 text-white shadow-sm transition">Simpan</button>
            </div>
        </form>
    </div>
</div>

@endsection
