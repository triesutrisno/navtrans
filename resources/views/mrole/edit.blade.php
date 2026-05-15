@extends('layouts.app')
@section('title')
    <a href="{{ url('/mrole') }}"
       class="text-black-600 hover:text-blue-600 hover:none">
        Master Role
    </a>
    > Ubah Data
@endsection
@section('subtitle', 'Halaman ini digunakan untuk melakukan ubah data master role kedalam sistem')
@section('content')

<div class="p-3 md:p-6">
    
    {{-- CARD --}}
    <div class="bg-white rounded-2xl shadow-sm border border-gray-100 p-6">
        <form action="{{ route('mrole.update', $data->role_nama) }}"
              method="POST"
              class="space-y-5">
            @csrf
            <!--<div class="grid grid-cols-1 md:grid-cols-2 gap-6">-->
                {{-- NAMA MENU --}}
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">Nama Role</label>
                    <input type="text"
                           name="role_nama"
                           value="{{ old('role_nama', $data->role_nama) }}"
                          class="w-full rounded-md border border-gray-300 focus:border-blue-500 focus:ring focus:ring-blue-200">
                           
                    @error('role_nama')
                        <div class="text-red-500 text-sm mt-1"> {{ $message }}</div>
                    @enderror
                </div>
                {{-- STATUS --}}
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">Status</label>
                    <select name="role_status" class="w-full rounded-md border border-gray-300 focus:ring focus:ring-blue-200">
                        <option value="1"  {{ $data->role_status == '1' ? 'selected' : '' }}> Aktif</option>
                        <option value="2"  {{ $data->role_status == '2' ? 'selected' : '' }}>Tidak Aktif</option>
                    </select>
                </div>                
                {{-- KETERANGAN --}}
                <div class="md:col-span-2">
                    <label class="block text-sm font-medium text-gray-700 mb-2">Keterangan</label>
                    <textarea name="role_keterangan" rows="4" class="w-full rounded-md border border-gray-300 focus:ring focus:ring-blue-200">{{ old('role_keterangan', $data->role_keterangan) }}</textarea>
                </div>
            <!--</div>-->
            {{-- BUTTON --}}
            <div class="flex justify-end gap-3 mt-8">
                <a href="{{ url('/mrole') }}" class="px-4 py-2 rounded-md border border-gray-300 text-gray-700 hover:bg-gray-100 transition">Kembali</a>
                <button type="submit" class="px-4 py-2 rounded-md bg-blue-600 hover:bg-blue-700 text-white shadow-sm transition">Simpan</button>
            </div>
        </form>
    </div>
</div>

@endsection