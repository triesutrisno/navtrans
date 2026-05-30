<?php

namespace App\Http\Controllers;

use App\Models\Kecamatan;
use App\Models\Kota;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class KecamatanController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        if (!hasMenuAccess(15, 'mrr')) {
            return redirect('/dashboard')
                ->with('error', 'Anda tidak memiliki akses untuk melihat data dihalaman tersebut');
        }

        $data = Kecamatan::with('kota')
            ->paginate(10);

        return view('kecamatan.index', [
            'data' => $data,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        if (!hasMenuAccess(15, 'mrc')) {
            return redirect('/kecamatan')
                ->with('error', 'Anda tidak memiliki akses untuk menambah data dihalaman tersebut');
        }

        $kota = Kota::whereNull('deleted_at')
            ->orderBy('kota_nama')
            ->get();

        return view('kecamatan.create', [
            'kota' => $kota,
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'kota_id' => [
                'required',
                'exists:m_kota,id',
            ],
            'kecamatan_kode' => [
                'required',
                'max:10',
                Rule::unique('m_kecamatan', 'kecamatan_kode')
                    ->whereNull('deleted_at')
            ],
            'kecamatan_nama' => [
                'required',
                'max:100',
            ],
        ], [
            'kota_id.required' => 'Kota wajib dipilih',
            'kota_id.exists' => 'Kota tidak valid',
            'kecamatan_kode.required' => 'Kode kecamatan wajib diisi',
            'kecamatan_kode.max' => 'Kode kecamatan maksimal 10 karakter',
            'kecamatan_kode.unique' => 'Kode kecamatan sudah digunakan',
            'kecamatan_nama.required' => 'Nama kecamatan wajib diisi',
            'kecamatan_nama.max' => 'Nama kecamatan maksimal 100 karakter',
        ]);

        Kecamatan::create([
            'kota_id' => $request->kota_id,
            'kecamatan_kode' => $request->kecamatan_kode,
            'kecamatan_nama' => $request->kecamatan_nama,
        ]);

        return redirect('/kecamatan')
            ->with('success', 'Data kecamatan berhasil ditambahkan!');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        if (!hasMenuAccess(15, 'mru')) {
            return redirect('/kecamatan')
                ->with('error', 'Anda tidak memiliki akses untuk mengubah data dihalaman tersebut');
        }

        $data = Kecamatan::findOrFail($id);
        $kota = Kota::whereNull('deleted_at')
            ->orderBy('kota_nama')
            ->get();

        return view('kecamatan.edit', [
            'data' => $data,
            'kota' => $kota,
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $data = Kecamatan::findOrFail($id);

        $request->validate([
            'kota_id' => [
                'required',
                'exists:m_kota,id',
            ],
            'kecamatan_kode' => [
                'required',
                'max:10',
                Rule::unique('m_kecamatan', 'kecamatan_kode')
                    ->ignore($id, 'id')
                    ->whereNull('deleted_at')
            ],
            'kecamatan_nama' => [
                'required',
                'max:100',
            ],
        ], [
            'kota_id.required' => 'Kota wajib dipilih',
            'kota_id.exists' => 'Kota tidak valid',
            'kecamatan_kode.required' => 'Kode kecamatan wajib diisi',
            'kecamatan_kode.max' => 'Kode kecamatan maksimal 10 karakter',
            'kecamatan_kode.unique' => 'Kode kecamatan sudah digunakan',
            'kecamatan_nama.required' => 'Nama kecamatan wajib diisi',
            'kecamatan_nama.max' => 'Nama kecamatan maksimal 100 karakter',
        ]);

        $data->update([
            'kota_id' => $request->kota_id,
            'kecamatan_kode' => $request->kecamatan_kode,
            'kecamatan_nama' => $request->kecamatan_nama,
        ]);

        return redirect('/kecamatan')
            ->with('success', 'Data kecamatan berhasil diupdate!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        if (!hasMenuAccess(15, 'mrd')) {
            return redirect('/kecamatan')
                ->with('error', 'Anda tidak memiliki akses untuk menghapus data dihalaman tersebut');
        }

        $data = Kecamatan::findOrFail($id);
        $data->delete();

        return redirect('/kecamatan')
            ->with('success', 'Data kecamatan berhasil dihapus!');
    }
}
