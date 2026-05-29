@extends('layouts.app')
@section('title')
    <a href="{{ url('/supir') }}" class="text-black-600 hover:text-blue-800 hover:none">Master Supir</a> > Tambah Data
@endsection
@section('subtitle', 'Halaman ini digunakan untuk menambah data supir ke dalam sistem')
@section('content')

<div class="p-3 md:p-6">
    <div class="bg-white rounded-2xl shadow-sm border border-gray-100 p-6">
        <form action="{{ url('/supir/store') }}" method="POST" class="space-y-5">
            @csrf

            <div>
                <label class="block text-sm font-medium text-gray-700 mb-2">Nama Supir *</label>
                <input type="text" name="driver_nama" value="{{ old('driver_nama') }}" maxlength="100" class="w-full rounded-md border border-gray-300 focus:border-blue-500 focus:ring focus:ring-blue-200">
                @error('driver_nama')<div class="text-red-500 text-sm mt-1">{{ $message }}</div>@enderror
            </div>

            <div>
                <label class="block text-sm font-medium text-gray-700 mb-2">Nomor KTP *</label>
                <input type="text" name="driver_ktp" value="{{ old('driver_ktp') }}" maxlength="20" class="w-full rounded-md border border-gray-300 focus:border-blue-500 focus:ring focus:ring-blue-200">
                @error('driver_ktp')<div class="text-red-500 text-sm mt-1">{{ $message }}</div>@enderror
            </div>

            <div>
                <label class="block text-sm font-medium text-gray-700 mb-2">No. HP *</label>
                <input type="text" name="driver_hp" value="{{ old('driver_hp') }}" maxlength="20" class="w-full rounded-md border border-gray-300 focus:border-blue-500 focus:ring focus:ring-blue-200">
                @error('driver_hp')<div class="text-red-500 text-sm mt-1">{{ $message }}</div>@enderror
            </div>

            <div>
                <label class="block text-sm font-medium text-gray-700 mb-2">Transporter *</label>
                <select name="transporter_id" class="w-full rounded-md border border-gray-300 focus:border-blue-500 focus:ring focus:ring-blue-200">
                    <option value="">-- Pilih Transporter --</option>
                    @foreach($transporters as $transporter)
                        <option value="{{ $transporter->transporter_id }}" {{ old('transporter_id') == $transporter->transporter_id ? 'selected' : '' }}>{{ $transporter->transporter_nama }}</option>
                    @endforeach
                </select>
                @error('transporter_id')<div class="text-red-500 text-sm mt-1">{{ $message }}</div>@enderror
            </div>

            <div>
                <label class="block text-sm font-medium text-gray-700 mb-2">Jenis SIM *</label>
                <select name="jns_sim_id" class="w-full rounded-md border border-gray-300 focus:border-blue-500 focus:ring focus:ring-blue-200">
                    <option value="">-- Pilih Jenis SIM --</option>
                    @foreach($jenisSim as $sim)
                        <option value="{{ $sim->jns_sim_id }}" {{ old('jns_sim_id') == $sim->jns_sim_id ? 'selected' : '' }}>{{ $sim->jns_sim_nama }}</option>
                    @endforeach
                </select>
                @error('jns_sim_id')<div class="text-red-500 text-sm mt-1">{{ $message }}</div>@enderror
            </div> 
            
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-2">No BPJS *</label>
                <input type="text" name="driver_no_bpjs" value="{{ old('driver_no_bpjs') }}" maxlength="20" class="w-full rounded-md border border-gray-300 focus:border-blue-500 focus:ring focus:ring-blue-200">
                @error('driver_no_bpjs')<div class="text-red-500 text-sm mt-1">{{ $message }}</div>@enderror
            </div>

            <div class="grid md:grid-cols-2 gap-4">
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">No SIM *</label>
                    <input type="text" name="driver_no_sim" value="{{ old('driver_no_sim') }}" maxlength="20" class="w-full rounded-md border border-gray-300 focus:border-blue-500 focus:ring focus:ring-blue-200">
                    @error('driver_no_sim')<div class="text-red-500 text-sm mt-1">{{ $message }}</div>@enderror
                </div>

                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">Tgl Expired SIM *</label>
                    <input type="date" name="tgl_exipred_sim" value="{{ old('tgl_exipred_sim') }}" class="w-full rounded-md border border-gray-300 focus:border-blue-500 focus:ring focus:ring-blue-200">
                    @error('tgl_exipred_sim')<div class="text-red-500 text-sm mt-1">{{ $message }}</div>@enderror
                </div>
            </div>

            <div class="grid md:grid-cols-2 gap-4">
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">Status Blokir</label>
                    <select name="flag_blokir" class="w-full rounded-md border border-gray-300 focus:border-blue-500 focus:ring focus:ring-blue-200">
                        <option value="1" {{ old('flag_blokir') == '1' ? 'selected' : '' }}>Ya</option>
                        <option value="2" {{ old('flag_blokir', '2') == '2' ? 'selected' : '' }}>Tidak</option>
                    </select>
                    @error('flag_blokir')<div class="text-red-500 text-sm mt-1">{{ $message }}</div>@enderror
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">Status Supir</label>
                    <select name="driver_status" class="w-full rounded-md border border-gray-300 focus:border-blue-500 focus:ring focus:ring-blue-200">
                        <option value="1" {{ old('driver_status') == '1' ? 'selected' : '' }}>Aktif</option>
                        <option value="2" {{ old('driver_status') == '2' ? 'selected' : '' }}>Tidak Aktif</option>
                    </select>
                    @error('driver_status')<div class="text-red-500 text-sm mt-1">{{ $message }}</div>@enderror
                </div>
            </div>

            <div class="flex justify-end gap-3 mt-8">
                <a href="{{ url('/supir') }}" class="px-4 py-2 rounded-md border border-gray-300 text-gray-700 hover:bg-gray-100 transition">Kembali</a>
                <button type="submit" class="px-4 py-2 rounded-md bg-blue-600 hover:bg-blue-700 text-white shadow-sm transition">Simpan</button>
            </div>
        </form>
    </div>
</div>

@endsection
