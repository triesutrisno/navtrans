<?php

namespace App\Http\Controllers;

use App\Models\Transporter;
use Illuminate\Http\Request;

class TransporterController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        if (!hasMenuAccess(8, 'mrr')) {
            return redirect('/dashboard')
                ->with('error', 'Anda tidak memiliki akses untuk melihat data dihalaman tersebut');
        }

        $data = Transporter::whereNull('deleted_at')
            ->paginate(10);

        return view('transporter.index', [
            'data' => $data,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        if (!hasMenuAccess(8, 'mrc')) {
            return redirect('/vendor')
                ->with('error', 'Anda tidak memiliki akses untuk menambah data dihalaman tersebut');
        }

        return view('transporter.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'transporter_nama' => [
                'required',
                'max:100',
            ],
            'transporter_pic' => [
                'nullable',
                'max:100',
            ],
            'transporter_hp' => [
                'required',
                'max:20',
            ],
            'transporter_status' => [
                'required',
            ],
        ], [
            'transporter_nama.required' => 'Nama transporter wajib diisi',
            'transporter_nama.max' => 'Nama transporter maksimal 100 karakter',
            'transporter_pic.max' => 'Nama PIC maksimal 100 karakter',
            'transporter_hp.required' => 'No HP transporter wajib diisi',
            'transporter_hp.max' => 'No HP maksimal 20 karakter',
            'transporter_status.required' => 'Status transporter wajib dipilih',
        ]);

        Transporter::create([
            'transporter_nama' => $request->transporter_nama,
            'transporter_pic' => $request->transporter_pic,
            'transporter_hp' => $request->transporter_hp,
            'transporter_status' => $request->transporter_status,
            'flag_deleted' => '0',
        ]);

        return redirect('/vendor')
            ->with('success', 'Data transporter berhasil ditambahkan!');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        if (!hasMenuAccess(8, 'mru')) {
            return redirect('/vendor')
                ->with('error', 'Anda tidak memiliki akses untuk mengubah data dihalaman tersebut');
        }

        $data = Transporter::findOrFail($id);

        return view('transporter.edit', [
            'data' => $data,
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $data = Transporter::findOrFail($id);

        $request->validate([
            'transporter_nama' => [
                'required',
                'max:100',
            ],
            'transporter_pic' => [
                'nullable',
                'max:100',
            ],
            'transporter_hp' => [
                'required',
                'max:20',
            ],
            'transporter_status' => [
                'required',
            ],
        ], [
            'transporter_nama.required' => 'Nama transporter wajib diisi',
            'transporter_nama.max' => 'Nama transporter maksimal 100 karakter',
            'transporter_pic.max' => 'Nama PIC maksimal 100 karakter',
            'transporter_hp.required' => 'No HP transporter wajib diisi',
            'transporter_hp.max' => 'No HP maksimal 20 karakter',
            'transporter_status.required' => 'Status transporter wajib dipilih',
        ]);

        $data->update([
            'transporter_nama' => $request->transporter_nama,
            'transporter_pic' => $request->transporter_pic,
            'transporter_hp' => $request->transporter_hp,
            'transporter_status' => $request->transporter_status,
        ]);

        return redirect('/vendor')
            ->with('success', 'Data transporter berhasil diupdate!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        if (!hasMenuAccess(8, 'mrd')) {
            return redirect('/vendor')
                ->with('error', 'Anda tidak memiliki akses untuk menghapus data dihalaman tersebut');
        }

        $data = Transporter::findOrFail($id);
        $data->update(['flag_deleted' => '1']);
        $data->delete();

        return redirect('/vendor')
            ->with('success', 'Data transporter berhasil dihapus!');
    }
}
