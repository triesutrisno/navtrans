@extends('layouts.app')
@section('title', 'Master Supir')
@section('subtitle', 'Daftar supir untuk sistem TMS')
@section('content')

<div class="p-3 md:p-6">
    <div class="flex flex-col md:flex-row md:items-center md:justify-between gap-4 mb-6">
        <div class="flex items-center gap-2">
            @if(hasMenuAccess(9, 'mrr'))
            <a href="{{ url('/supir') }}" class="inline-flex items-center gap-1.5 px-3 py-1.5 bg-yellow-500 hover:bg-yellow-600 text-white text-sm rounded-lg transition">
                    <svg xmlns="http://www.w3.org/2000/svg"
                        class="w-4 h-4"
                        fill="none"
                        viewBox="0 0 24 24"
                        stroke="currentColor">
                        <path stroke-linecap="round"
                            stroke-linejoin="round"
                            stroke-width="2"
                            d="M4 6h16M4 12h16M4 18h16" />

                    </svg>
                    Lihat Data
            </a>            
            @endif
            @if(hasMenuAccess(9, 'mrc'))
            <a href="{{ url('/supir/create') }}" class="inline-flex items-center gap-1.5 px-3 py-1.5 bg-blue-600 hover:bg-blue-700 text-white text-sm rounded-lg transition">
                    <svg xmlns="http://www.w3.org/2000/svg"
                        class="w-4 h-4"
                        fill="none"
                        viewBox="0 0 24 24"
                        stroke="currentColor">
                        <path stroke-linecap="round"
                            stroke-linejoin="round"
                            stroke-width="2"
                            d="M12 4v16m8-8H4" />
                    </svg>
                    Tambah Data
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
                        <th class="px-6 py-4">Nama Supir</th>
                        <th class="px-6 py-4">HP</th>
                        <th class="px-6 py-4">Transporter</th>
                        <th class="px-6 py-4">Jenis SIM</th>
                        <th class="px-6 py-4">Armada</th>
                        <th class="px-6 py-4">No. SIM</th>
                        <th class="px-6 py-4">Status</th>
                        <th class="px-6 py-4 text-center">Action</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-100">
                    @forelse($data as $key => $item)
                        <tr class="hover:bg-gray-50 transition">
                            <td class="px-6 py-4 text-gray-500">{{ $data->firstItem() + $key }}</td>
                            <td class="px-6 py-4 text-xs font-semibold">{{ $item->driver_nama }}</td>
                            <td class="px-6 py-4 text-xs text-gray-600">{{ $item->driver_hp }}</td>
                            <td class="px-6 py-4 text-xs">{{ optional($item->transporter)->transporter_nama ?? '-' }}</td>
                            <td class="px-6 py-4 text-xs">{{ optional($item->jenisSim)->jns_sim_nama ?? '-' }}</td>
                            <td class="px-6 py-4 text-xs">{{ $item->fleets->count() }}</td>
                            <td class="px-6 py-4 text-xs">{{ $item->driver_no_sim }}</td>
                            <td class="px-6 py-4">
                                @if($item->driver_status == '1')
                                    <span class="px-3 py-1 text-xs rounded-md bg-green-100 text-green-700">Aktif</span>
                                @else
                                    <span class="px-3 py-1 text-xs rounded-md bg-red-100 text-red-700">Tidak Aktif</span>
                                @endif
                            </td>
                            <td class="px-6 py-4">
                                <div class="flex flex-col md:flex-row justify-center gap-2">
                                    @if(hasMenuAccess(9, 'mru'))
                                    <a href="{{ url('/supir/edit/'.$item->supir_id) }}" class="p-2 rounded-lg bg-yellow-100 text-yellow-600 hover:bg-yellow-200 transition" title="Edit">
                                        Edit
                                    </a>
                                    @endif
                                    @if(hasMenuAccess(9, 'mrd'))
                                    <a href="{{ route('supir.delete', $item->supir_id) }}" onclick="return confirm('Anda yakin akan menghapus data ini?')" class="p-2 rounded-lg bg-red-100 text-red-600 hover:bg-red-200 transition" title="Delete">
                                        Hapus
                                    </a>
                                    @endif
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="8" class="px-6 py-10 text-center text-gray-400">Data supir belum tersedia.</td>
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
