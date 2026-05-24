@extends('layouts.app')
@section('title', 'Master Kecamatan')
@section('subtitle', 'Halaman ini digunakan untuk mendefinisikan master kecamatan kedalam sistem')
@section('content')

<div class="p-3 md:p-6">
    {{-- HEADER --}}
    <div class="flex flex-col md:flex-row md:items-center md:justify-between gap-4 mb-6">
        <div class="flex items-center gap-2">
            @if(hasMenuAccess(15, 'mrr'))
            <a href="{{ url('/kecamatan') }}" class="inline-flex items-center gap-1.5 px-3 py-1.5 bg-yellow-500 hover:bg-yellow-600 text-white text-sm rounded-lg transition">
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
            @if(hasMenuAccess(15, 'mrc'))
            <a href="{{ url('/kecamatan/create') }}" class="inline-flex items-center gap-1.5 px-3 py-1.5 bg-blue-600 hover:bg-blue-700 text-white text-sm rounded-lg transition">
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
    {{-- ALERT --}}
    @if(session('success'))
        <div class="mb-4 p-4 rounded-lg bg-green-100 text-green-700">
            {{ session('success') }}
        </div>
    @endif
    @if(session('error'))
        <div class="mb-4 p-4 rounded-lg bg-red-100 text-red-700">
            {{ session('error') }}
        </div>
    @endif

    {{-- CARD --}}
    <div class="bg-white rounded-2xl shadow-sm border border-gray-100 overflow-hidden">
        {{-- TABLE --}}
        <div class="w-full overflow-x-auto">
            <table class="min-w-full text-sm text-left whitespace-nowrap">
                <thead class="bg-gray-50 text-gray-600 uppercase text-xs">
                    <tr>
                        <th class="px-6 py-4">No</th>
                        <th class="px-6 py-4">Kode Kecamatan</th>
                        <th class="px-6 py-4">Nama Kecamatan</th>
                        <th class="px-6 py-4">Kota</th>
                        <th class="px-6 py-4 text-center">Action</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-100">
                    @forelse($data as $key => $kec)
                        <tr class="hover:bg-gray-50 transition">
                            <td class="px-6 py-4 text-gray-500">{{ $data->firstItem() + $key }}</td>                           
                            <td class="px-6 py-4"><div class="px-6 py-4 text-xs font-semibold">{{ $kec->kecamatan_kode }}</div></td>
                            <td class="px-6 py-4 text-xs">{{ $kec->kecamatan_nama }}</td>
                            <td class="px-6 py-4 text-xs text-gray-600">
                                {{ $kec->kota ? $kec->kota->kota_nama : '-' }}
                            </td>
                            <td class="px-6 py-4">
                                <div class="flex flex-col md:flex-row justify-center gap-2">
                                    @if(hasMenuAccess(15, 'mru'))
                                    <a href="{{ url('/kecamatan/edit') }}/{{ $kec->id }}"
                                       class="p-2 rounded-lg bg-yellow-100 text-yellow-600 hover:bg-yellow-200 transition"
                                       title="Edit">
                                            <svg xmlns="http://www.w3.org/2000/svg"
                                                 class="w-4 h-4"
                                                 fill="none"
                                                 viewBox="0 0 24 24"
                                                 stroke="currentColor">
                                                <path stroke-linecap="round"
                                                      stroke-linejoin="round"
                                                      stroke-width="2"
                                                      d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l9.586-9.586z" />
                                            </svg>
                                    </a>
                                    @endif
                                    @if(hasMenuAccess(15, 'mrd'))
                                    <a href="{{ route('kecamatan.delete', $kec->id) }}"
                                       onclick="return confirm('Anda yakin akan menghapus data ini?')"
                                       class="p-2 rounded-lg bg-red-100 text-red-600 hover:bg-red-200 transition"
                                       title="Delete">
                                            <svg xmlns="http://www.w3.org/2000/svg"
                                                 class="w-4 h-4"
                                                 fill="none"
                                                 viewBox="0 0 24 24"
                                                 stroke="currentColor">
                                                <path stroke-linecap="round"
                                                      stroke-linejoin="round"
                                                      stroke-width="2"
                                                      d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6M1 7h22m-5-3V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v1" />
                                            </svg>
                                    </a>
                                    @endif
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="5" class="px-6 py-10 text-center text-gray-400">Data Kosong !</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
        {{-- Paginator --}}
        <div class="flex flex-col md:flex-row md:items-center md:justify-between gap-4 px-4 md:px-6 py-4 border-t bg-gray-50">
            <div class="text-sm text-gray-500">
                Menampilkan
                {{ $data->firstItem() }}
                sampai
                {{ $data->lastItem() }}
                dari
                {{ $data->total() }}
                data
            </div>
            <div class="overflow-x-auto">
                {{ $data->links() }}
            </div>
        </div>
    </div>
</div>

@endsection
