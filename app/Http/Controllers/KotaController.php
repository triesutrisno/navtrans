<?php

namespace App\Http\Controllers;

use App\Models\Kota;
use App\Models\Propinsi;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class KotaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        if (!hasMenuAccess(14, 'mrr')) {
            return redirect('/dashboard')
                ->with('error', 'Anda tidak memiliki akses untuk melihat data dihalaman tersebut');
        }

        $data = Kota::with('propinsi')
            ->whereNull('deleted_at')
            ->paginate(10);

        return view('kota.index', [
            'data' => $data,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        if (!hasMenuAccess(14, 'mrc')) {
            return redirect('/kota')
                ->with('error', 'Anda tidak memiliki akses untuk menambah data dihalaman tersebut');
        }

        $propinsi = Propinsi::whereNull('deleted_at')
            ->orderBy('propinsi_nama')
            ->get();

        return view('kota.create', [
            'propinsi' => $propinsi,
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'propinsi_id' => [
                'required',
                'exists:m_propinsi,id',
            ],
            'kota_kode' => [
                'required',
                'max:10',
                Rule::unique('m_kota', 'kota_kode')
                    ->whereNull('deleted_at')
            ],
            'kota_nama' => [
                'required',
                'max:100',
            ],
        ], [
            'propinsi_id.required' => 'Provinsi wajib dipilih',
            'propinsi_id.exists' => 'Provinsi tidak valid',
            'kota_kode.required' => 'Kode kota wajib diisi',
            'kota_kode.max' => 'Kode kota maksimal 10 karakter',
            'kota_kode.unique' => 'Kode kota sudah digunakan',
            'kota_nama.required' => 'Nama kota wajib diisi',
            'kota_nama.max' => 'Nama kota maksimal 100 karakter',
        ]);

        Kota::create([
            'propinsi_id' => $request->propinsi_id,
            'kota_kode' => $request->kota_kode,
            'kota_nama' => $request->kota_nama,
        ]);

        return redirect('/kota')
            ->with('success', 'Data kota berhasil ditambahkan!');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        if (!hasMenuAccess(14, 'mru')) {
            return redirect('/kota')
                ->with('error', 'Anda tidak memiliki akses untuk mengubah data dihalaman tersebut');
        }

        $data = Kota::findOrFail($id);
        $propinsi = Propinsi::whereNull('deleted_at')
            ->orderBy('propinsi_nama')
            ->get();

        return view('kota.edit', [
            'data' => $data,
            'propinsi' => $propinsi,
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $data = Kota::findOrFail($id);

        $request->validate([
            'propinsi_id' => [
                'required',
                'exists:m_propinsi,id',
            ],
            'kota_kode' => [
                'required',
                'max:10',
                Rule::unique('m_kota', 'kota_kode')
                    ->ignore($id, 'id')
                    ->whereNull('deleted_at')
            ],
            'kota_nama' => [
                'required',
                'max:100',
            ],
        ], [
            'propinsi_id.required' => 'Provinsi wajib dipilih',
            'propinsi_id.exists' => 'Provinsi tidak valid',
            'kota_kode.required' => 'Kode kota wajib diisi',
            'kota_kode.max' => 'Kode kota maksimal 10 karakter',
            'kota_kode.unique' => 'Kode kota sudah digunakan',
            'kota_nama.required' => 'Nama kota wajib diisi',
            'kota_nama.max' => 'Nama kota maksimal 100 karakter',
        ]);

        $data->update([
            'propinsi_id' => $request->propinsi_id,
            'kota_kode' => $request->kota_kode,
            'kota_nama' => $request->kota_nama,
        ]);

        return redirect('/kota')
            ->with('success', 'Data kota berhasil diupdate!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        if (!hasMenuAccess(14, 'mrd')) {
            return redirect('/kota')
                ->with('error', 'Anda tidak memiliki akses untuk menghapus data dihalaman tersebut');
        }

        $data = Kota::findOrFail($id);
        $data->delete();

        return redirect('/kota')
            ->with('success', 'Data kota berhasil dihapus!');
    }
}
