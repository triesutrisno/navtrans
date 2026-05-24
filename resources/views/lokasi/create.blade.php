@extends('layouts.app')
@section('title')
    <a href="{{ url('/lokasi') }}"
       class="text-black-600 hover:text-blue-800 hover:none">
        Master Lokasi
    </a>
    > Tambah Data
@endsection
@section('subtitle', 'Halaman ini digunakan untuk melakukan tambah data master lokasi kedalam sistem')
@section('content')

<div class="p-3 md:p-6">
    {{-- CARD --}}
    <div class="bg-white rounded-2xl shadow-sm border border-gray-100 p-6">
        <form action="{{ url('/lokasi/store') }}" method="POST" class="space-y-5">
            @csrf
            
            {{-- KECAMATAN --}}
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-2">Kecamatan</label>
                <select name="kecamatan_id" class="w-full rounded-md border border-gray-300 focus:border-blue-500 focus:ring focus:ring-blue-200">
                    <option value="">-- Pilih Kecamatan --</option>
                    @foreach($kecamatan as $kec)
                        <option value="{{ $kec->id }}" {{ old('kecamatan_id') == $kec->id ? 'selected' : '' }}>
                            {{ $kec->kecamatan_nama }}
                        </option>
                    @endforeach
                </select>
                @error('kecamatan_id')
                    <div class="text-red-500 text-sm mt-1"> {{ $message }}</div>
                @enderror
            </div>

            {{-- KODE LOKASI --}}
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-2">Kode Lokasi</label>
                <input type="text"
                       name="lokasi_kode"
                       value="{{ old('lokasi_kode') }}"
                       maxlength="20"
                       class="w-full rounded-md border border-gray-300 focus:border-blue-500 focus:ring focus:ring-blue-200">
                @error('lokasi_kode')
                    <div class="text-red-500 text-sm mt-1"> {{ $message }}</div>
                @enderror
            </div>

            {{-- NAMA LOKASI --}}
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-2">Nama Lokasi</label>
                <input type="text"
                       name="lokasi_nama"
                       value="{{ old('lokasi_nama') }}"
                       maxlength="100"
                       class="w-full rounded-md border border-gray-300 focus:border-blue-500 focus:ring focus:ring-blue-200">
                @error('lokasi_nama')
                    <div class="text-red-500 text-sm mt-1"> {{ $message }}</div>
                @enderror
            </div>

            {{-- IS PLANT --}}
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-2">Is Plant</label>
                <select name="is_plant" class="w-full rounded-md border border-gray-300 focus:border-blue-500 focus:ring focus:ring-blue-200">
                    <option value="">-- Pilih --</option>
                    <option value="1" {{ old('is_plant') === '1' ? 'selected' : '' }}>Ya</option>
                    <option value="0" {{ old('is_plant') === '0' ? 'selected' : '' }}>Tidak</option>
                </select>
                @error('is_plant')
                    <div class="text-red-500 text-sm mt-1"> {{ $message }}</div>
                @enderror
            </div>

            {{-- IS SHIPTO --}}
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-2">Is Shipto</label>
                <select name="is_shipto" class="w-full rounded-md border border-gray-300 focus:border-blue-500 focus:ring focus:ring-blue-200">
                    <option value="">-- Pilih --</option>
                    <option value="1" {{ old('is_shipto') === '1' ? 'selected' : '' }}>Ya</option>
                    <option value="0" {{ old('is_shipto') === '0' ? 'selected' : '' }}>Tidak</option>
                </select>
                @error('is_shipto')
                    <div class="text-red-500 text-sm mt-1"> {{ $message }}</div>
                @enderror
            </div>

            {{-- LATITUDE --}}
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-2">Latitude</label>
                <input type="text"
                       name="latitude1"
                       value="{{ old('latitude1') }}"
                       maxlength="50"
                       class="w-full rounded-md border border-gray-300 focus:border-blue-500 focus:ring focus:ring-blue-200">
                @error('latitude1')
                    <div class="text-red-500 text-sm mt-1"> {{ $message }}</div>
                @enderror
            </div>

            {{-- LONGITUDE --}}
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-2">Longitude</label>
                <input type="text"
                       name="longitude1"
                       value="{{ old('longitude1') }}"
                       maxlength="50"
                       class="w-full rounded-md border border-gray-300 focus:border-blue-500 focus:ring focus:ring-blue-200">
                @error('longitude1')
                    <div class="text-red-500 text-sm mt-1"> {{ $message }}</div>
                @enderror
            </div>

            {{-- RADIUS --}}
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-2">Radius</label>
                <input type="text"
                       name="radius1"
                       value="{{ old('radius1') }}"
                       maxlength="50"
                       class="w-full rounded-md border border-gray-300 focus:border-blue-500 focus:ring focus:ring-blue-200">
                @error('radius1')
                    <div class="text-red-500 text-sm mt-1"> {{ $message }}</div>
                @enderror
            </div>

            {{-- LOKASI PIC --}}
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-2">PIC Lokasi</label>
                <input type="text"
                       name="lokasi_pic"
                       value="{{ old('lokasi_pic') }}"
                       maxlength="100"
                       class="w-full rounded-md border border-gray-300 focus:border-blue-500 focus:ring focus:ring-blue-200">
                @error('lokasi_pic')
                    <div class="text-red-500 text-sm mt-1"> {{ $message }}</div>
                @enderror
            </div>

            {{-- STATUS LOKASI --}}
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-2">Status Lokasi</label>
                <select name="lokasi_status" class="w-full rounded-md border border-gray-300 focus:border-blue-500 focus:ring focus:ring-blue-200">
                    <option value="">-- Pilih --</option>
                    <option value="1" {{ old('lokasi_status') === '1' ? 'selected' : '' }}>Aktif</option>
                    <option value="0" {{ old('lokasi_status') === '0' ? 'selected' : '' }}>Tidak Aktif</option>
                </select>
                @error('lokasi_status')
                    <div class="text-red-500 text-sm mt-1"> {{ $message }}</div>
                @enderror
            </div>

            {{-- TIPE LOKASI --}}
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-2">Tipe Lokasi</label>
                <input type="text"
                       name="lokasi_tipe"
                       value="{{ old('lokasi_tipe') }}"
                       maxlength="50"
                       placeholder="Contoh: Warehouse, Port, Kantor, Depo"
                       class="w-full rounded-md border border-gray-300 focus:border-blue-500 focus:ring focus:ring-blue-200">
                       
                @error('lokasi_tipe')
                    <div class="text-red-500 text-sm mt-1"> {{ $message }}</div>
                @enderror
            </div>

            {{-- KONTAK LOKASI --}}
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-2">Kontak Lokasi</label>
                <input type="text"
                       name="lokasi_kontak"
                       value="{{ old('lokasi_kontak') }}"
                       maxlength="50"
                       class="w-full rounded-md border border-gray-300 focus:border-blue-500 focus:ring focus:ring-blue-200">
                       
                @error('lokasi_kontak')
                    <div class="text-red-500 text-sm mt-1"> {{ $message }}</div>
                @enderror
            </div>

            {{-- ALAMAT LOKASI --}}
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-2">Alamat Lengkap</label>
                <textarea name="lokasi_alamat"
                          rows="4"
                          class="w-full rounded-md border border-gray-300 focus:border-blue-500 focus:ring focus:ring-blue-200">{{ old('lokasi_alamat') }}</textarea>
                       
                @error('lokasi_alamat')
                    <div class="text-red-500 text-sm mt-1"> {{ $message }}</div>
                @enderror
            </div>
            
            {{-- BUTTONS --}}
            <div class="flex justify-end gap-3 mt-8">
                <a href="{{ url('/lokasi') }}" class="px-4 py-2 rounded-md border border-gray-300 text-gray-700 hover:bg-gray-100 transition">Kembali</a>
                <button type="submit" class="px-4 py-2 rounded-md bg-blue-600 hover:bg-blue-700 text-white shadow-sm transition">Simpan</button>
            </div>
        </form>
    </div>
</div>

@endsection
