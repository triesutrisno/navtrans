<?php

namespace App\Http\Controllers;

use App\Models\Lokasi;
use App\Models\Kecamatan;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class LokasiController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        if (!hasMenuAccess(11, 'mrr')) {
            return redirect('/dashboard')
                ->with('error', 'Anda tidak memiliki akses untuk melihat data dihalaman tersebut');
        }

        $data = Lokasi::with('kecamatan')
            ->whereNull('deleted_at')
            ->paginate(10);

        return view('lokasi.index', [
            'data' => $data,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        if (!hasMenuAccess(11, 'mrc')) {
            return redirect('/lokasi')
                ->with('error', 'Anda tidak memiliki akses untuk menambah data dihalaman tersebut');
        }

        $kecamatan = Kecamatan::whereNull('deleted_at')
            ->orderBy('kecamatan_nama')
            ->get();

        return view('lokasi.create', [
            'kecamatan' => $kecamatan,
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'kecamatan_id' => [
                'required',
                'exists:m_kecamatan,id',
            ],
            'lokasi_kode' => [
                'required',
                'max:20',
                'unique:m_lokasi,lokasi_kode',
            ],
            'lokasi_nama' => [
                'required',
                'max:100',
            ],
            'lokasi_alamat' => [
                'required',
            ],
            'lokasi_tipe' => [
                'required',
                'max:50',
            ],
            'lokasi_kontak' => [
                'required',
                'max:50',
            ],
            'is_plant' => [
                'required',
                'in:0,1',
            ],
            'is_shipto' => [
                'required',
                'in:0,1',
            ],
            'latitude1' => [
                'nullable',
                'max:50',
            ],
            'longitude1' => [
                'nullable',
                'max:50',
            ],
            'radius1' => [
                'nullable',
                'max:50',
            ],
            'lokasi_pic' => [
                'nullable',
                'max:100',
            ],
            'lokasi_status' => [
                'required',
                'in:0,1',
            ],
        ], [
            'kecamatan_id.required' => 'Kecamatan wajib dipilih',
            'kecamatan_id.exists' => 'Kecamatan tidak valid',
            'lokasi_kode.required' => 'Kode lokasi wajib diisi',
            'lokasi_kode.max' => 'Kode lokasi maksimal 20 karakter',
            'lokasi_kode.unique' => 'Kode lokasi sudah digunakan',
            'lokasi_nama.required' => 'Nama lokasi wajib diisi',
            'lokasi_nama.max' => 'Nama lokasi maksimal 100 karakter',
            'lokasi_alamat.required' => 'Alamat lokasi wajib diisi',
            'lokasi_tipe.required' => 'Tipe lokasi wajib diisi',
            'lokasi_tipe.max' => 'Tipe lokasi maksimal 50 karakter',
            'lokasi_kontak.required' => 'Kontak lokasi wajib diisi',
            'lokasi_kontak.max' => 'Kontak lokasi maksimal 50 karakter',
            'is_plant.required' => 'Flag plant wajib dipilih',
            'is_plant.in' => 'Nilai plant tidak valid',
            'is_shipto.required' => 'Flag shipto wajib dipilih',
            'is_shipto.in' => 'Nilai shipto tidak valid',
            'latitude1.max' => 'Latitude maksimal 50 karakter',
            'longitude1.max' => 'Longitude maksimal 50 karakter',
            'radius1.max' => 'Radius maksimal 50 karakter',
            'lokasi_pic.max' => 'PIC lokasi maksimal 100 karakter',
            'lokasi_status.required' => 'Status lokasi wajib dipilih',
            'lokasi_status.in' => 'Nilai status lokasi tidak valid',
        ]);

        Lokasi::create([
            'kecamatan_id' => $request->kecamatan_id,
            'lokasi_kode' => $request->lokasi_kode,
            'lokasi_nama' => $request->lokasi_nama,
            'lokasi_alamat' => $request->lokasi_alamat,
            'lokasi_tipe' => $request->lokasi_tipe,
            'lokasi_kontak' => $request->lokasi_kontak,
            'is_plant' => $request->is_plant,
            'is_shipto' => $request->is_shipto,
            'latitude1' => $request->latitude1,
            'longitude1' => $request->longitude1,
            'radius1' => $request->radius1,
            'lokasi_pic' => $request->lokasi_pic,
            'lokasi_status' => $request->lokasi_status,
        ]);

        return redirect('/lokasi')
            ->with('success', 'Data lokasi berhasil ditambahkan!');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        if (!hasMenuAccess(11, 'mru')) {
            return redirect('/lokasi')
                ->with('error', 'Anda tidak memiliki akses untuk mengubah data dihalaman tersebut');
        }

        $data = Lokasi::findOrFail($id);
        $kecamatan = Kecamatan::whereNull('deleted_at')
            ->orderBy('kecamatan_nama')
            ->get();

        return view('lokasi.edit', [
            'data' => $data,
            'kecamatan' => $kecamatan,
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $data = Lokasi::findOrFail($id);

        $request->validate([
            'kecamatan_id' => [
                'required',
                'exists:m_kecamatan,id',
            ],
            'lokasi_kode' => [
                'required',
                'max:20',
                Rule::unique('m_lokasi', 'lokasi_kode')->ignore($id, 'id'),
            ],
            'lokasi_nama' => [
                'required',
                'max:100',
            ],
            'lokasi_alamat' => [
                'required',
            ],
            'lokasi_tipe' => [
                'required',
                'max:50',
            ],
            'lokasi_kontak' => [
                'required',
                'max:50',
            ],
            'is_plant' => [
                'required',
                'in:0,1',
            ],
            'is_shipto' => [
                'required',
                'in:0,1',
            ],
            'latitude1' => [
                'nullable',
                'max:50',
            ],
            'longitude1' => [
                'nullable',
                'max:50',
            ],
            'radius1' => [
                'nullable',
                'max:50',
            ],
            'lokasi_pic' => [
                'nullable',
                'max:100',
            ],
            'lokasi_status' => [
                'required',
                'in:0,1',
            ],
        ], [
            'kecamatan_id.required' => 'Kecamatan wajib dipilih',
            'kecamatan_id.exists' => 'Kecamatan tidak valid',
            'lokasi_kode.required' => 'Kode lokasi wajib diisi',
            'lokasi_kode.max' => 'Kode lokasi maksimal 20 karakter',
            'lokasi_kode.unique' => 'Kode lokasi sudah digunakan',
            'lokasi_nama.required' => 'Nama lokasi wajib diisi',
            'lokasi_nama.max' => 'Nama lokasi maksimal 100 karakter',
            'lokasi_alamat.required' => 'Alamat lokasi wajib diisi',
            'lokasi_tipe.required' => 'Tipe lokasi wajib diisi',
            'lokasi_tipe.max' => 'Tipe lokasi maksimal 50 karakter',
            'lokasi_kontak.required' => 'Kontak lokasi wajib diisi',
            'lokasi_kontak.max' => 'Kontak lokasi maksimal 50 karakter',
            'is_plant.required' => 'Flag plant wajib dipilih',
            'is_plant.in' => 'Nilai plant tidak valid',
            'is_shipto.required' => 'Flag shipto wajib dipilih',
            'is_shipto.in' => 'Nilai shipto tidak valid',
            'latitude1.max' => 'Latitude maksimal 50 karakter',
            'longitude1.max' => 'Longitude maksimal 50 karakter',
            'radius1.max' => 'Radius maksimal 50 karakter',
            'lokasi_pic.max' => 'PIC lokasi maksimal 100 karakter',
            'lokasi_status.required' => 'Status lokasi wajib dipilih',
            'lokasi_status.in' => 'Nilai status lokasi tidak valid',
        ]);

        $data->update([
            'kecamatan_id' => $request->kecamatan_id,
            'lokasi_kode' => $request->lokasi_kode,
            'lokasi_nama' => $request->lokasi_nama,
            'lokasi_alamat' => $request->lokasi_alamat,
            'lokasi_tipe' => $request->lokasi_tipe,
            'lokasi_kontak' => $request->lokasi_kontak,
            'is_plant' => $request->is_plant,
            'is_shipto' => $request->is_shipto,
            'latitude1' => $request->latitude1,
            'longitude1' => $request->longitude1,
            'radius1' => $request->radius1,
            'lokasi_pic' => $request->lokasi_pic,
            'lokasi_status' => $request->lokasi_status,
        ]);

        return redirect('/lokasi')
            ->with('success', 'Data lokasi berhasil diupdate!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        if (!hasMenuAccess(11, 'mrd')) {
            return redirect('/lokasi')
                ->with('error', 'Anda tidak memiliki akses untuk menghapus data dihalaman tersebut');
        }

        $data = Lokasi::findOrFail($id);
        $data->delete();

        return redirect('/lokasi')
            ->with('success', 'Data lokasi berhasil dihapus!');
    }
}
