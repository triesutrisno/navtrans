<?php

namespace App\Http\Controllers;

use App\Models\JenisSim;
use App\Models\Supir;
use App\Models\Transporter;
use Illuminate\Http\Request;

class SupirController extends Controller
{
    private const MENU_ID = 9;

    public function index()
    {
        if (!hasMenuAccess(self::MENU_ID, 'mrr')) {
            return redirect('/dashboard')
                ->with('error', 'Anda tidak memiliki akses untuk melihat data di halaman tersebut');
        }

        $data = Supir::with(['transporter', 'jenisSim', 'fleets'])
            ->whereNull('deleted_at')
            ->paginate(10);

        return view('supir.index', compact('data'));
    }

    public function create()
    {
        if (!hasMenuAccess(self::MENU_ID, 'mrc')) {
            return redirect('/supir')
                ->with('error', 'Anda tidak memiliki akses untuk menambah data di halaman tersebut');
        }

        $transporters = Transporter::whereNull('deleted_at')->orderBy('transporter_nama')->get();
        $jenisSim = JenisSim::where('flag_deleted', '0')->orderBy('jns_sim_nama')->get();

        return view('supir.create', compact('transporters', 'jenisSim'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'transporter_id' => ['required'],
            'jns_sim_id' => ['required'],
            'driver_nama' => ['required', 'max:100'],
            'driver_ktp' => ['required', 'max:20'],
            'driver_hp' => ['required', 'max:20'],
            'driver_no_sim' => ['required', 'max:20'],
            'driver_no_bpjs' => ['required', 'max:20'],
            'tgl_exipred_sim' => ['required', 'date'],
            'flag_blokir' => ['required'],
            'driver_status' => ['required'],
        ], [
            'transporter_id.required' => 'Transporter wajib dipilih',
            'jns_sim_id.required' => 'Jenis SIM wajib dipilih',
            'driver_nama.required' => 'Nama supir wajib diisi',
            'driver_nama.max' => 'Nama supir maksimal 100 karakter',
            'driver_ktp.required' => 'Nomor KTP wajib diisi',
            'driver_ktp.max' => 'Nomor KTP maksimal 20 karakter',
            'driver_hp.required' => 'No. HP wajib diisi',
            'driver_hp.max' => 'No. HP maksimal 20 karakter',
            'driver_no_sim.required' => 'Nomor SIM wajib diisi',
            'driver_no_sim.max' => 'Nomor SIM maksimal 20 karakter',
            'driver_no_bpjs.required' => 'Nomor BPJS wajib diisi',
            'driver_no_bpjs.max' => 'Nomor BPJS maksimal 20 karakter',
            'tgl_exipred_sim.required' => 'Tanggal kedaluwarsa SIM wajib diisi',
            'tgl_exipred_sim.date' => 'Tanggal kedaluwarsa SIM tidak valid',
            'flag_blokir.required' => 'Status blokir wajib dipilih',
            'driver_status.required' => 'Status supir wajib dipilih',
        ]);

        Supir::create([
            'jns_sim_id' => $request->jns_sim_id,
            'transporter_id' => $request->transporter_id,
            'driver_nama' => $request->driver_nama,
            'driver_ktp' => $request->driver_ktp,
            'driver_hp' => $request->driver_hp,
            'driver_no_sim' => $request->driver_no_sim,
            'driver_no_bpjs' => $request->driver_no_bpjs,
            'tgl_exipred_sim' => $request->tgl_exipred_sim,
            'flag_blokir' => $request->flag_blokir,
            'driver_status' => $request->driver_status,
            'flag_deleted' => '0',
        ]);

        return redirect('/supir')
            ->with('success', 'Data supir berhasil ditambahkan!');
    }

    public function edit($id)
    {
        if (!hasMenuAccess(self::MENU_ID, 'mru')) {
            return redirect('/supir')
                ->with('error', 'Anda tidak memiliki akses untuk mengubah data di halaman tersebut');
        }

        $data = Supir::findOrFail($id);
        $transporters = Transporter::whereNull('deleted_at')->orderBy('transporter_nama')->get();
        $jenisSim = JenisSim::where('flag_deleted', '0')->orderBy('jns_sim_nama')->get();

        return view('supir.edit', compact('data', 'transporters', 'jenisSim'));
    }

    public function update(Request $request, $id)
    {
        $data = Supir::findOrFail($id);

        $request->validate([
            'transporter_id' => ['required'],
            'jns_sim_id' => ['required'],
            'driver_nama' => ['required', 'max:100'],
            'driver_ktp' => ['required', 'max:20'],
            'driver_hp' => ['required', 'max:20'],
            'driver_no_sim' => ['required', 'max:20'],
            'driver_no_bpjs' => ['required', 'max:20'],
            'tgl_exipred_sim' => ['required', 'date'],
            'flag_blokir' => ['required'],
            'driver_status' => ['required'],
        ], [
            'transporter_id.required' => 'Transporter wajib dipilih',
            'jns_sim_id.required' => 'Jenis SIM wajib dipilih',
            'driver_nama.required' => 'Nama supir wajib diisi',
            'driver_nama.max' => 'Nama supir maksimal 100 karakter',
            'driver_ktp.required' => 'Nomor KTP wajib diisi',
            'driver_ktp.max' => 'Nomor KTP maksimal 20 karakter',
            'driver_hp.required' => 'No. HP wajib diisi',
            'driver_hp.max' => 'No. HP maksimal 20 karakter',
            'driver_no_sim.required' => 'Nomor SIM wajib diisi',
            'driver_no_sim.max' => 'Nomor SIM maksimal 20 karakter',
            'driver_no_bpjs.required' => 'Nomor BPJS wajib diisi',
            'driver_no_bpjs.max' => 'Nomor BPJS maksimal 20 karakter',
            'tgl_exipred_sim.required' => 'Tanggal kedaluwarsa SIM wajib diisi',
            'tgl_exipred_sim.date' => 'Tanggal kedaluwarsa SIM tidak valid',
            'flag_blokir.required' => 'Status blokir wajib dipilih',
            'driver_status.required' => 'Status supir wajib dipilih',
        ]);

        $data->update([
            'jns_sim_id' => $request->jns_sim_id,
            'transporter_id' => $request->transporter_id,
            'driver_nama' => $request->driver_nama,
            'driver_ktp' => $request->driver_ktp,
            'driver_hp' => $request->driver_hp,
            'driver_no_sim' => $request->driver_no_sim,
            'driver_no_bpjs' => $request->driver_no_bpjs,
            'tgl_exipred_sim' => $request->tgl_exipred_sim,
            'flag_blokir' => $request->flag_blokir,
            'driver_status' => $request->driver_status,
        ]);

        return redirect('/supir')
            ->with('success', 'Data supir berhasil diupdate!');
    }

    public function destroy($id)
    {
        if (!hasMenuAccess(self::MENU_ID, 'mrd')) {
            return redirect('/supir')
                ->with('error', 'Anda tidak memiliki akses untuk menghapus data di halaman tersebut');
        }

        $data = Supir::findOrFail($id);
        $data->update(['flag_deleted' => '1']);
        $data->delete();

        return redirect('/supir')
            ->with('success', 'Data supir berhasil dihapus!');
    }
}
