@extends('layouts.app')
@section('title')
    <a href="{{ url('/customer') }}"
       class="text-black-600 hover:text-blue-600 hover:none">
        Master Customer
    </a>
    > Ubah Data
@endsection
@section('subtitle', 'Halaman ini digunakan untuk melakukan ubah data master customer kedalam sistem')
@section('content')

<div class="p-3 md:p-6">
    {{-- CARD --}}
    <div class="bg-white rounded-2xl shadow-sm border border-gray-100 p-6">
        <form action="{{ route('customer.update', $data->id) }}"
              method="POST"
              class="space-y-5">
            @csrf
            
            {{-- NAMA CUSTOMER --}}
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-2">Nama Customer</label>
                <input type="text"
                       name="customer_nama"
                       value="{{ old('customer_nama', $data->customer_nama) }}"
                       maxlength="100"
                       class="w-full rounded-md border border-gray-300 focus:border-blue-500 focus:ring focus:ring-blue-200">
                       
                @error('customer_nama')
                    <div class="text-red-500 text-sm mt-1"> {{ $message }}</div>
                @enderror
            </div>

            {{-- NPWP CUSTOMER --}}
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-2">NPWP</label>
                <input type="text"
                       name="customer_npwp"
                       value="{{ old('customer_npwp', $data->customer_npwp) }}"
                       maxlength="25"
                       class="w-full rounded-md border border-gray-300 focus:border-blue-500 focus:ring focus:ring-blue-200">
                       
                @error('customer_npwp')
                    <div class="text-red-500 text-sm mt-1"> {{ $message }}</div>
                @enderror
            </div>

            {{-- KONTAK CUSTOMER --}}
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-2">Kontak / Telepon</label>
                <input type="text"
                       name="customer_kontak"
                       value="{{ old('customer_kontak', $data->customer_kontak) }}"
                       maxlength="50"
                       class="w-full rounded-md border border-gray-300 focus:border-blue-500 focus:ring focus:ring-blue-200">
                       
                @error('customer_kontak')
                    <div class="text-red-500 text-sm mt-1"> {{ $message }}</div>
                @enderror
            </div>

            {{-- EMAIL CUSTOMER --}}
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-2">Email</label>
                <input type="email"
                       name="customer_email"
                       value="{{ old('customer_email', $data->customer_email) }}"
                       maxlength="100"
                       class="w-full rounded-md border border-gray-300 focus:border-blue-500 focus:ring focus:ring-blue-200">
                       
                @error('customer_email')
                    <div class="text-red-500 text-sm mt-1"> {{ $message }}</div>
                @enderror
            </div>

            {{-- STATUS CUSTOMER --}}
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-2">Status</label>
                <select name="customer_status" class="w-full rounded-md border border-gray-300 focus:border-blue-500 focus:ring focus:ring-blue-200">
                    <option value="1" {{ old('customer_status', $data->customer_status) == '1' ? 'selected' : '' }}>Aktif</option>
                    <option value="2" {{ old('customer_status', $data->customer_status) == '2' ? 'selected' : '' }}>Tidak Aktif</option>
                </select>
                @error('customer_status')
                    <div class="text-red-500 text-sm mt-1"> {{ $message }}</div>
                @enderror
            </div>

            {{-- ALAMAT CUSTOMER --}}
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-2">Alamat Lengkap</label>
                <textarea name="customer_alamat"
                          rows="4"
                          class="w-full rounded-md border border-gray-300 focus:border-blue-500 focus:ring focus:ring-blue-200">{{ old('customer_alamat', $data->customer_alamat) }}</textarea>
                       
                @error('customer_alamat')
                    <div class="text-red-500 text-sm mt-1"> {{ $message }}</div>
                @enderror
            </div>
            
            {{-- BUTTONS --}}
            <div class="flex justify-end gap-3 mt-8">
                <a href="{{ url('/customer') }}" class="px-4 py-2 rounded-md border border-gray-300 text-gray-700 hover:bg-gray-100 transition">Kembali</a>
                <button type="submit" class="px-4 py-2 rounded-md bg-blue-600 hover:bg-blue-700 text-white shadow-sm transition">Simpan</button>
            </div>
        </form>
    </div>
</div>

@endsection
