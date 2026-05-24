@extends('layouts.app')
@section('title')
    <a href="{{ url('/kecamatan') }}"
       class="text-black-600 hover:text-blue-600 hover:none">
        Master Kecamatan
    </a>
    > Ubah Data
@endsection
@section('subtitle', 'Halaman ini digunakan untuk melakukan ubah data master kecamatan kedalam sistem')
@section('content')

<div class="p-3 md:p-6">
    {{-- CARD --}}
    <div class="bg-white rounded-2xl shadow-sm border border-gray-100 p-6">
        <form action="{{ route('kecamatan.update', $data->id) }}"
              method="POST"
              class="space-y-5">
            @csrf
            
            {{-- KOTA INDUK --}}
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-2">Kota/Kabupaten</label>
                <select name="kota_id" class="w-full rounded-md border border-gray-300 focus:border-blue-500 focus:ring focus:ring-blue-200">
                    <option value="">-- Pilih Kota --</option>
                    @foreach($kota as $k)
                        <option value="{{ $k->id }}" {{ old('kota_id', $data->kota_id) == $k->id ? 'selected' : '' }}>
                            {{ $k->kota_nama }}
                        </option>
                    @endforeach
                </select>
                @error('kota_id')
                    <div class="text-red-500 text-sm mt-1"> {{ $message }}</div>
                @enderror
            </div>

            {{-- KODE KECAMATAN --}}
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-2">Kode Kecamatan</label>
                <input type="text"
                       name="kecamatan_kode"
                       value="{{ old('kecamatan_kode', $data->kecamatan_kode) }}"
                       maxlength="10"
                       class="w-full rounded-md border border-gray-300 focus:border-blue-500 focus:ring focus:ring-blue-200">
                       
                @error('kecamatan_kode')
                    <div class="text-red-500 text-sm mt-1"> {{ $message }}</div>
                @enderror
            </div>

            {{-- NAMA KECAMATAN --}}
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-2">Nama Kecamatan</label>
                <input type="text"
                       name="kecamatan_nama"
                       value="{{ old('kecamatan_nama', $data->kecamatan_nama) }}"
                       maxlength="100"
                       class="w-full rounded-md border border-gray-300 focus:border-blue-500 focus:ring focus:ring-blue-200">
                       
                @error('kecamatan_nama')
                    <div class="text-red-500 text-sm mt-1"> {{ $message }}</div>
                @enderror
            </div>
            
            {{-- BUTTONS --}}
            <div class="flex justify-end gap-3 mt-8">
                <a href="{{ url('/kecamatan') }}" class="px-4 py-2 rounded-md border border-gray-300 text-gray-700 hover:bg-gray-100 transition">Kembali</a>
                <button type="submit" class="px-4 py-2 rounded-md bg-blue-600 hover:bg-blue-700 text-white shadow-sm transition">Simpan</button>
            </div>
        </form>
    </div>
</div>

@endsection
