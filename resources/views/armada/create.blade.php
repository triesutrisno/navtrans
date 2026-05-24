@extends('layouts.app')
@section('title')
    <a href="{{ url('/armada') }}" class="text-black-600 hover:text-blue-800 hover:none">Master Armada</a> > Tambah Data
@endsection
@section('subtitle', 'Halaman ini digunakan untuk menambah data armada ke dalam sistem')
@section('content')

<div class="p-3 md:p-6">
    <div class="bg-white rounded-2xl shadow-sm border border-gray-100 p-6">
        <form action="{{ url('/armada/store') }}" method="POST" class="space-y-5">
            @csrf

            <div>
                <label class="block text-sm font-medium text-gray-700 mb-2">Transporter</label>
                <select name="transporter_id" class="w-full rounded-md border border-gray-300 focus:border-blue-500 focus:ring focus:ring-blue-200">
                    <option value="">-- Pilih Transporter --</option>
                    @foreach($transporters as $transporter)
                        <option value="{{ $transporter->transporter_id }}" {{ old('transporter_id') == $transporter->transporter_id ? 'selected' : '' }}>{{ $transporter->transporter_nama }}</option>
                    @endforeach
                </select>
                @error('transporter_id')<div class="text-red-500 text-sm mt-1">{{ $message }}</div>@enderror
            </div>

            <div>
                <label class="block text-sm font-medium text-gray-700 mb-2">Supir</label>
                <select name="supir_id" class="w-full rounded-md border border-gray-300 focus:border-blue-500 focus:ring focus:ring-blue-200">
                    <option value="">-- Pilih Supir --</option>
                    @foreach($supirs as $supir)
                        <option value="{{ $supir->supir_id }}" {{ old('supir_id') == $supir->supir_id ? 'selected' : '' }}>{{ $supir->driver_nama }}</option>
                    @endforeach
                </select>
                @error('supir_id')<div class="text-red-500 text-sm mt-1">{{ $message }}</div>@enderror
            </div>

            <div>
                <label class="block text-sm font-medium text-gray-700 mb-2">Jenis Armada</label>
                <select name="jns_fleet_id" class="w-full rounded-md border border-gray-300 focus:border-blue-500 focus:ring focus:ring-blue-200">
                    <option value="">-- Pilih Jenis Armada --</option>
                    @foreach($jenisFleets as $jenisFleet)
                        <option value="{{ $jenisFleet->jns_fleet_id }}" {{ old('jns_fleet_id') == $jenisFleet->jns_fleet_id ? 'selected' : '' }}>{{ $jenisFleet->jns_fleet_nama }}</option>
                    @endforeach
                </select>
                @error('jns_fleet_id')<div class="text-red-500 text-sm mt-1">{{ $message }}</div>@enderror
            </div>

            <div class="grid md:grid-cols-2 gap-4">
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">No. Polisi</label>
                    <input type="text" name="fleet_nopol" value="{{ old('fleet_nopol') }}" maxlength="10" class="w-full rounded-md border border-gray-300 focus:border-blue-500 focus:ring focus:ring-blue-200">
                    @error('fleet_nopol')<div class="text-red-500 text-sm mt-1">{{ $message }}</div>@enderror
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">No. Kendaraan</label>
                    <input type="text" name="fleet_nopin" value="{{ old('fleet_nopin') }}" maxlength="10" class="w-full rounded-md border border-gray-300 focus:border-blue-500 focus:ring focus:ring-blue-200">
                    @error('fleet_nopin')<div class="text-red-500 text-sm mt-1">{{ $message }}</div>@enderror
                </div>
            </div>

            <div class="grid md:grid-cols-2 gap-4">
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">Tahun Pembuatan</label>
                    <input type="text" name="thn_pembuatan" value="{{ old('thn_pembuatan') }}" maxlength="4" class="w-full rounded-md border border-gray-300 focus:border-blue-500 focus:ring focus:ring-blue-200">
                    @error('thn_pembuatan')<div class="text-red-500 text-sm mt-1">{{ $message }}</div>@enderror
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">No. STNK</label>
                    <input type="text" name="no_stnk" value="{{ old('no_stnk') }}" maxlength="20" class="w-full rounded-md border border-gray-300 focus:border-blue-500 focus:ring focus:ring-blue-200">
                    @error('no_stnk')<div class="text-red-500 text-sm mt-1">{{ $message }}</div>@enderror
                </div>
            </div>

            <div class="grid md:grid-cols-3 gap-4">
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">Expire KIR</label>
                    <input type="date" name="tgl_expired_kir" value="{{ old('tgl_expired_kir') }}" class="w-full rounded-md border border-gray-300 focus:border-blue-500 focus:ring focus:ring-blue-200">
                    @error('tgl_expired_kir')<div class="text-red-500 text-sm mt-1">{{ $message }}</div>@enderror
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">Expire STNK</label>
                    <input type="date" name="tgl_expired_stnk" value="{{ old('tgl_expired_stnk') }}" class="w-full rounded-md border border-gray-300 focus:border-blue-500 focus:ring focus:ring-blue-200">
                    @error('tgl_expired_stnk')<div class="text-red-500 text-sm mt-1">{{ $message }}</div>@enderror
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">Expire Pajak</label>
                    <input type="date" name="tgl_expired_pajak" value="{{ old('tgl_expired_pajak') }}" class="w-full rounded-md border border-gray-300 focus:border-blue-500 focus:ring focus:ring-blue-200">
                    @error('tgl_expired_pajak')<div class="text-red-500 text-sm mt-1">{{ $message }}</div>@enderror
                </div>
            </div>

            <div>
                <label class="block text-sm font-medium text-gray-700 mb-2">Vendor GPS</label>
                <input type="text" name="vendor_gps" value="{{ old('vendor_gps') }}" maxlength="100" class="w-full rounded-md border border-gray-300 focus:border-blue-500 focus:ring focus:ring-blue-200">
                @error('vendor_gps')<div class="text-red-500 text-sm mt-1">{{ $message }}</div>@enderror
            </div>

            <div>
                <label class="block text-sm font-medium text-gray-700 mb-2">Email</label>
                <input type="email" name="emai" value="{{ old('emai') }}" maxlength="100" class="w-full rounded-md border border-gray-300 focus:border-blue-500 focus:ring focus:ring-blue-200">
                @error('emai')<div class="text-red-500 text-sm mt-1">{{ $message }}</div>@enderror
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
                    <label class="block text-sm font-medium text-gray-700 mb-2">Status Armada</label>
                    <select name="fleet_status" class="w-full rounded-md border border-gray-300 focus:border-blue-500 focus:ring focus:ring-blue-200">
                        <option value="1" {{ old('fleet_status') == '1' ? 'selected' : '' }}>Aktif</option>
                        <option value="2" {{ old('fleet_status') == '2' ? 'selected' : '' }}>Tidak Aktif</option>
                    </select>
                    @error('fleet_status')<div class="text-red-500 text-sm mt-1">{{ $message }}</div>@enderror
                </div>
            </div>

            <div>
                <label class="block text-sm font-medium text-gray-700 mb-2">Alasan Blokir</label>
                <input type="text" name="alasan_blokir" value="{{ old('alasan_blokir') }}" maxlength="100" class="w-full rounded-md border border-gray-300 focus:border-blue-500 focus:ring focus:ring-blue-200">
                @error('alasan_blokir')<div class="text-red-500 text-sm mt-1">{{ $message }}</div>@enderror
            </div>

            <div class="flex justify-end gap-3 mt-8">
                <a href="{{ url('/armada') }}" class="px-4 py-2 rounded-md border border-gray-300 text-gray-700 hover:bg-gray-100 transition">Kembali</a>
                <button type="submit" class="px-4 py-2 rounded-md bg-blue-600 hover:bg-blue-700 text-white shadow-sm transition">Simpan</button>
            </div>
        </form>
    </div>
</div>

@endsection
