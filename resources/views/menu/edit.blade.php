@extends('layouts.app')
@section('title')
    <a href="{{ url('/menu') }}"
       class="text-black-600 hover:text-blue-600 hover:none">
        Master Menu
    </a>
    > Ubah Data
@endsection
@section('subtitle', 'Halaman ini digunakan untuk melakukan ubah data master menu kedalam sistem')
@section('content')

<div class="p-3 md:p-6">
    
    {{-- CARD --}}
    <div class="bg-white rounded-2xl shadow-sm border border-gray-100 p-6">
        <form action="{{ route('menu.update', $data->menu_id) }}"
              method="POST"
              class="space-y-5">
            @csrf
            <!--<div class="grid grid-cols-1 md:grid-cols-2 gap-6">-->
                {{-- NAMA MENU --}}
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">Nama Menu</label>
                    <input type="text"
                           name="menu_nama"
                           value="{{ old('menu_nama', $data->menu_nama) }}"
                          class="w-full rounded-md border border-gray-300 focus:border-blue-500 focus:ring focus:ring-blue-200">
                           
                    @error('menu_nama')
                        <div class="text-red-500 text-sm mt-1"> {{ $message }}</div>
                    @enderror
                </div>

                {{-- LINK --}}
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">Link</label>
                    <input type="text"
                           name="menu_link"
                           value="{{ old('menu_link', $data->menu_link) }}"
                           class="w-full rounded-md border border-gray-300 focus:ring-blue-500 focus:ring focus:ring-blue-200">
                    @error('menu_link')
                        <div class="text-red-500 text-sm mt-1"> {{ $message }}</div>
                    @enderror
                </div>

                {{-- PARENT --}}
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">Parent Menu</label>
                    <select name="menu_parent" class="w-full rounded-md border border-gray-300 focus:ring focus:ring-blue-200">
                        <option value="">
                            -- Parent Menu --
                        </option>
                        @foreach($parents as $parent)
                             <option value="{{ $parent->menu_id }}" {{ $data->menu_parent == $parent->menu_id ? 'selected' : '' }}>
                                {{ $parent->menu_nama }}
                            </option>
                        @endforeach
                    </select>
                </div>

                {{-- SORT --}}
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">Sort</label>
                    <input type="number"
                           name="menu_sort"
                           value="{{ old('menu_sort', $data->menu_sort) }}"
                           class="w-full rounded-md border border-gray-300 focus:ring focus:ring-blue-200">

                </div>

                {{-- TYPE --}}
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">Type Menu</label>
                    <select name="menu_type" class="w-full rounded-md border border-gray-300 focus:ring focus:ring-blue-200">
                        <option value="1"  {{ $data->menu_type == '1' ? 'selected' : '' }}>Parent</option>
                        <option value="2"  {{ $data->menu_type == '2' ? 'selected' : '' }}>Children</option>
                    </select>
                </div>

                {{-- STATUS --}}
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">Status</label>
                    <select name="menu_status" class="w-full rounded-md border border-gray-300 focus:ring focus:ring-blue-200">
                        <option value="1"  {{ $data->menu_status == '1' ? 'selected' : '' }}> Aktif</option>
                        <option value="2"  {{ $data->menu_status == '2' ? 'selected' : '' }}>Tidak Aktif</option>
                    </select>
                </div>
                
                {{-- KETERANGAN --}}
                <div class="md:col-span-2">
                    <label class="block text-sm font-medium text-gray-700 mb-2">Keterangan</label>
                    <textarea name="menu_keterangan" rows="4" class="w-full rounded-md border border-gray-300 focus:ring focus:ring-blue-200">{{ old('menu_keterangan', $data->menu_keterangan) }}</textarea>
                </div>
            <!--</div>-->
            {{-- BUTTON --}}
            <div class="flex justify-end gap-3 mt-8">
                <a href="{{ url('/menu') }}" class="px-4 py-2 rounded-md border border-gray-300 text-gray-700 hover:bg-gray-100 transition">Kembali</a>
                <button type="submit" class="px-4 py-2 rounded-md bg-blue-600 hover:bg-blue-700 text-white shadow-sm transition">Simpan</button>
            </div>
        </form>
    </div>
</div>

@endsection