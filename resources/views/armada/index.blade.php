@extends('layouts.app')
@section('title', 'Master Armada')
@section('subtitle', 'Daftar armada kendaraan dan relasi transporter / supir')
@section('content')

<div class="p-3 md:p-6">
    <div class="flex flex-col md:flex-row md:items-center md:justify-between gap-4 mb-6">
        <div class="flex items-center gap-2">
            @if(hasMenuAccess(10, 'mrr'))
            <a href="{{ url('/dashboard') }}" class="inline-flex items-center gap-1.5 px-3 py-1.5 bg-gray-200 hover:bg-gray-300 text-gray-700 rounded-lg transition">
                Kembali
            </a>
            @endif
            @if(hasMenuAccess(10, 'mrc'))
            <a href="{{ url('/armada/create') }}" class="inline-flex items-center gap-1.5 px-4 py-2 bg-blue-600 hover:bg-blue-700 text-white rounded-lg transition">
                Tambah Armada
            </a>
            @endif
        </div>
    </div>

    @if(session('success'))
        <div class="mb-4 p-4 rounded-lg bg-green-100 text-green-700">{{ session('success') }}</div>
    @endif
    @if(session('error'))
        <div class="mb-4 p-4 rounded-lg bg-red-100 text-red-700">{{ session('error') }}</div>
    @endif

    <div class="bg-white rounded-2xl shadow-sm border border-gray-100 overflow-hidden">
        <div class="w-full overflow-x-auto">
            <table class="min-w-full text-sm text-left whitespace-nowrap">
                <thead class="bg-gray-50 text-gray-600 uppercase text-xs">
                    <tr>
                        <th class="px-6 py-4">No</th>
                        <th class="px-6 py-4">No. Polisi</th>
                        <th class="px-6 py-4">No. Kendaraan</th>
                        <th class="px-6 py-4">Transporter</th>
                        <th class="px-6 py-4">Supir</th>
                        <th class="px-6 py-4">Jenis Armada</th>
                        <th class="px-6 py-4">Tahun</th>
                        <th class="px-6 py-4">Status</th>
                        <th class="px-6 py-4 text-center">Action</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-100">
                    @forelse($data as $key => $item)
                        <tr class="hover:bg-gray-50 transition">
                            <td class="px-6 py-4 text-gray-500">{{ $data->firstItem() + $key }}</td>
                            <td class="px-6 py-4 text-xs font-semibold">{{ $item->fleet_nopol }}</td>
                            <td class="px-6 py-4 text-xs">{{ $item->fleet_nopin }}</td>
                            <td class="px-6 py-4 text-xs">{{ optional($item->transporter)->transporter_nama ?? '-' }}</td>
                            <td class="px-6 py-4 text-xs">{{ optional($item->supir)->driver_nama ?? '-' }}</td>
                            <td class="px-6 py-4 text-xs">{{ optional($item->jenisFleet)->jns_fleet_nama ?? '-' }}</td>
                            <td class="px-6 py-4 text-xs">{{ $item->thn_pembuatan }}</td>
                            <td class="px-6 py-4">
                                @if($item->fleet_status == '1')
                                    <span class="px-3 py-1 text-xs rounded-md bg-green-100 text-green-700">Aktif</span>
                                @else
                                    <span class="px-3 py-1 text-xs rounded-md bg-red-100 text-red-700">Tidak Aktif</span>
                                @endif
                            </td>
                            <td class="px-6 py-4">
                                <div class="flex flex-col md:flex-row justify-center gap-2">
                                    @if(hasMenuAccess(10, 'mru'))
                                    <a href="{{ url('/armada/edit/'.$item->fleet_id) }}" class="p-2 rounded-lg bg-yellow-100 text-yellow-600 hover:bg-yellow-200 transition" title="Edit">
                                        Edit
                                    </a>
                                    @endif
                                    @if(hasMenuAccess(10, 'mrd'))
                                    <a href="{{ route('armada.delete', $item->fleet_id) }}" onclick="return confirm('Anda yakin akan menghapus data ini?')" class="p-2 rounded-lg bg-red-100 text-red-600 hover:bg-red-200 transition" title="Delete">
                                        Hapus
                                    </a>
                                    @endif
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="9" class="px-6 py-10 text-center text-gray-400">Data armada belum tersedia.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        <div class="flex flex-col md:flex-row md:items-center md:justify-between gap-4 px-4 md:px-6 py-4 border-t bg-gray-50">
            <div class="text-sm text-gray-500">
                Menampilkan {{ $data->firstItem() }} sampai {{ $data->lastItem() }} dari {{ $data->total() }} data
            </div>
            <div class="overflow-x-auto">
                {{ $data->links() }}
            </div>
        </div>
    </div>
</div>

@endsection
