<?php

namespace App\Http\Controllers;

use App\Models\Propinsi;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class PropinsiController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        if (!hasMenuAccess(13, 'mrr')) {
            return redirect('/dashboard')
                ->with('error', 'Anda tidak memiliki akses untuk melihat data dihalaman tersebut');
        }

        $data = Propinsi::whereNull('deleted_at')
            ->paginate(10);

        return view('propinsi.index', [
            'data' => $data,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        if (!hasMenuAccess(13, 'mrc')) {
            return redirect('/propinsi')
                ->with('error', 'Anda tidak memiliki akses untuk menambah data dihalaman tersebut');
        }

        return view('propinsi.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'propinsi_kode' => [
                'required',
                'max:10',
                Rule::unique('m_propinsi', 'propinsi_kode')
                    ->whereNull('deleted_at')
            ],
            'propinsi_nama' => [
                'required',
                'max:100',
                Rule::unique('m_propinsi', 'propinsi_nama')
                    ->whereNull('deleted_at')
            ],
        ], [
            'propinsi_kode.required' => 'Kode provinsi wajib diisi',
            'propinsi_kode.max' => 'Kode provinsi maksimal 10 karakter',
            'propinsi_kode.unique' => 'Kode provinsi sudah digunakan',
            'propinsi_nama.required' => 'Nama provinsi wajib diisi',
            'propinsi_nama.max' => 'Nama provinsi maksimal 100 karakter',
            'propinsi_nama.unique' => 'Nama provinsi sudah digunakan',
        ]);

        Propinsi::create([
            'propinsi_kode' => $request->propinsi_kode,
            'propinsi_nama' => $request->propinsi_nama,
        ]);

        return redirect('/propinsi')
            ->with('success', 'Data provinsi berhasil ditambahkan!');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        if (!hasMenuAccess(13, 'mru')) {
            return redirect('/propinsi')
                ->with('error', 'Anda tidak memiliki akses untuk mengubah data dihalaman tersebut');
        }

        $data = Propinsi::findOrFail($id);

        return view('propinsi.edit', [
            'data' => $data,
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $data = Propinsi::findOrFail($id);

        $request->validate([
            'propinsi_kode' => [
                'required',
                'max:10',
                Rule::unique('m_propinsi', 'propinsi_kode')
                    ->ignore($id, 'id')
                    ->whereNull('deleted_at')
            ],
            'propinsi_nama' => [
                'required',
                'max:100',                
                Rule::unique('m_propinsi', 'propinsi_nama')
                    ->ignore($id, 'id')
                    ->whereNull('deleted_at')
            ],
        ], [
            'propinsi_kode.required' => 'Kode provinsi wajib diisi',
            'propinsi_kode.max' => 'Kode provinsi maksimal 10 karakter',
            'propinsi_kode.unique' => 'Kode provinsi sudah digunakan',
            'propinsi_nama.required' => 'Nama provinsi wajib diisi',
            'propinsi_nama.max' => 'Nama provinsi maksimal 100 karakter',
            'propinsi_nama.unique' => 'Nama provinsi sudah digunakan',
        ]);

        $data->update([
            'propinsi_kode' => $request->propinsi_kode,
            'propinsi_nama' => $request->propinsi_nama,
        ]);

        return redirect('/propinsi')
            ->with('success', 'Data provinsi berhasil diupdate!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        if (!hasMenuAccess(13, 'mrd')) {
            return redirect('/propinsi')
                ->with('error', 'Anda tidak memiliki akses untuk menghapus data dihalaman tersebut');
        }

        $data = Propinsi::findOrFail($id);
        $data->delete();

        return redirect('/propinsi')
            ->with('success', 'Data provinsi berhasil dihapus!');
    }
}
