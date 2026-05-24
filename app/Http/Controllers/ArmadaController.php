<?php

namespace App\Http\Controllers;

use App\Models\Fleet;
use App\Models\JenisFleet;
use App\Models\Supir;
use App\Models\Transporter;
use Illuminate\Http\Request;

class ArmadaController extends Controller
{
    private const MENU_ID = 10;

    public function index()
    {
        if (!hasMenuAccess(self::MENU_ID, 'mrr')) {
            return redirect('/dashboard')
                ->with('error', 'Anda tidak memiliki akses untuk melihat data di halaman tersebut');
        }

        $data = Fleet::with(['transporter', 'supir', 'jenisFleet'])
            ->where('flag_deleted', '0')
            ->paginate(10);

        return view('armada.index', compact('data'));
    }

    public function create()
    {
        if (!hasMenuAccess(self::MENU_ID, 'mrc')) {
            return redirect('/armada')
                ->with('error', 'Anda tidak memiliki akses untuk menambah data di halaman tersebut');
        }

        $transporters = Transporter::whereNull('deleted_at')->orderBy('transporter_nama')->get();
        $supirs = Supir::where('flag_deleted', '0')->where('driver_status', '1')->orderBy('driver_nama')->get();
        $jenisFleets = JenisFleet::where('flag_deleted', '0')->orderBy('jns_fleet_nama')->get();

        return view('armada.create', compact('transporters', 'supirs', 'jenisFleets'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'jns_fleet_id' => ['required'],
            'transporter_id' => ['required'],
            'supir_id' => ['required'],
            'fleet_nopol' => ['required', 'max:10'],
            'fleet_nopin' => ['required', 'max:10'],
            'thn_pembuatan' => ['required', 'digits:4'],
            'no_stnk' => ['required', 'max:20'],
            'tgl_expired_kir' => ['required', 'date'],
            'tgl_expired_stnk' => ['required', 'date'],
            'tgl_expired_pajak' => ['required', 'date'],
            'flag_blokir' => ['required'],
            'alasan_blokir' => ['nullable', 'max:100'],
            'fleet_status' => ['required'],
            'vendor_gps' => ['nullable', 'max:100'],
            'emai' => ['nullable', 'email', 'max:100'],
        ], [
            'jns_fleet_id.required' => 'Jenis armada wajib dipilih',
            'transporter_id.required' => 'Transporter wajib dipilih',
            'supir_id.required' => 'Supir wajib dipilih',
            'fleet_nopol.required' => 'Nomor polisi wajib diisi',
            'fleet_nopol.max' => 'Nomor polisi maksimal 10 karakter',
            'fleet_nopin.required' => 'Nomor kendaraan wajib diisi',
            'fleet_nopin.max' => 'Nomor kendaraan maksimal 10 karakter',
            'thn_pembuatan.required' => 'Tahun pembuatan wajib diisi',
            'thn_pembuatan.digits' => 'Tahun pembuatan harus 4 digit',
            'no_stnk.required' => 'Nomor STNK wajib diisi',
            'no_stnk.max' => 'Nomor STNK maksimal 20 karakter',
            'tgl_expired_kir.required' => 'Tanggal expired KIR wajib diisi',
            'tgl_expired_stnk.required' => 'Tanggal expired STNK wajib diisi',
            'tgl_expired_pajak.required' => 'Tanggal expired pajak wajib diisi',
            'flag_blokir.required' => 'Status blokir wajib dipilih',
            'fleet_status.required' => 'Status armada wajib dipilih',
            'emai.email' => 'Email tidak valid',
        ]);

        Fleet::create([
            'jns_fleet_id' => $request->jns_fleet_id,
            'transporter_id' => $request->transporter_id,
            'supir_id' => $request->supir_id,
            'fleet_nopol' => $request->fleet_nopol,
            'fleet_nopin' => $request->fleet_nopin,
            'thn_pembuatan' => $request->thn_pembuatan,
            'no_stnk' => $request->no_stnk,
            'tgl_expired_kir' => $request->tgl_expired_kir,
            'tgl_expired_stnk' => $request->tgl_expired_stnk,
            'tgl_expired_pajak' => $request->tgl_expired_pajak,
            'flag_blokir' => $request->flag_blokir,
            'alasan_blokir' => $request->alasan_blokir,
            'fleet_status' => $request->fleet_status,
            'vendor_gps' => $request->vendor_gps,
            'emai' => $request->emai,
            'flag_deleted' => '0',
        ]);

        return redirect('/armada')
            ->with('success', 'Data armada berhasil ditambahkan!');
    }

    public function edit($id)
    {
        if (!hasMenuAccess(self::MENU_ID, 'mru')) {
            return redirect('/armada')
                ->with('error', 'Anda tidak memiliki akses untuk mengubah data di halaman tersebut');
        }

        $data = Fleet::findOrFail($id);
        $transporters = Transporter::whereNull('deleted_at')->orderBy('transporter_nama')->get();
        $supirs = Supir::where('flag_deleted', '0')->where('driver_status', '1')->orderBy('driver_nama')->get();
        $jenisFleets = JenisFleet::where('flag_deleted', '0')->orderBy('jns_fleet_nama')->get();

        return view('armada.edit', compact('data', 'transporters', 'supirs', 'jenisFleets'));
    }

    public function update(Request $request, $id)
    {
        $data = Fleet::findOrFail($id);

        $request->validate([
            'jns_fleet_id' => ['required'],
            'transporter_id' => ['required'],
            'supir_id' => ['required'],
            'fleet_nopol' => ['required', 'max:10'],
            'fleet_nopin' => ['required', 'max:10'],
            'thn_pembuatan' => ['required', 'digits:4'],
            'no_stnk' => ['required', 'max:20'],
            'tgl_expired_kir' => ['required', 'date'],
            'tgl_expired_stnk' => ['required', 'date'],
            'tgl_expired_pajak' => ['required', 'date'],
            'flag_blokir' => ['required'],
            'alasan_blokir' => ['nullable', 'max:100'],
            'fleet_status' => ['required'],
            'vendor_gps' => ['nullable', 'max:100'],
            'emai' => ['nullable', 'email', 'max:100'],
        ], [
            'jns_fleet_id.required' => 'Jenis armada wajib dipilih',
            'transporter_id.required' => 'Transporter wajib dipilih',
            'supir_id.required' => 'Supir wajib dipilih',
            'fleet_nopol.required' => 'Nomor polisi wajib diisi',
            'fleet_nopol.max' => 'Nomor polisi maksimal 10 karakter',
            'fleet_nopin.required' => 'Nomor kendaraan wajib diisi',
            'fleet_nopin.max' => 'Nomor kendaraan maksimal 10 karakter',
            'thn_pembuatan.required' => 'Tahun pembuatan wajib diisi',
            'thn_pembuatan.digits' => 'Tahun pembuatan harus 4 digit',
            'no_stnk.required' => 'Nomor STNK wajib diisi',
            'no_stnk.max' => 'Nomor STNK maksimal 20 karakter',
            'tgl_expired_kir.required' => 'Tanggal expired KIR wajib diisi',
            'tgl_expired_stnk.required' => 'Tanggal expired STNK wajib diisi',
            'tgl_expired_pajak.required' => 'Tanggal expired pajak wajib diisi',
            'flag_blokir.required' => 'Status blokir wajib dipilih',
            'fleet_status.required' => 'Status armada wajib dipilih',
            'emai.email' => 'Email tidak valid',
        ]);

        $data->update([
            'jns_fleet_id' => $request->jns_fleet_id,
            'transporter_id' => $request->transporter_id,
            'supir_id' => $request->supir_id,
            'fleet_nopol' => $request->fleet_nopol,
            'fleet_nopin' => $request->fleet_nopin,
            'thn_pembuatan' => $request->thn_pembuatan,
            'no_stnk' => $request->no_stnk,
            'tgl_expired_kir' => $request->tgl_expired_kir,
            'tgl_expired_stnk' => $request->tgl_expired_stnk,
            'tgl_expired_pajak' => $request->tgl_expired_pajak,
            'flag_blokir' => $request->flag_blokir,
            'alasan_blokir' => $request->alasan_blokir,
            'fleet_status' => $request->fleet_status,
            'vendor_gps' => $request->vendor_gps,
            'emai' => $request->emai,
        ]);

        return redirect('/armada')
            ->with('success', 'Data armada berhasil diupdate!');
    }

    public function destroy($id)
    {
        if (!hasMenuAccess(self::MENU_ID, 'mrd')) {
            return redirect('/armada')
                ->with('error', 'Anda tidak memiliki akses untuk menghapus data di halaman tersebut');
        }

        $data = Fleet::findOrFail($id);
        $data->update(['flag_deleted' => '1']);

        return redirect('/armada')
            ->with('success', 'Data armada berhasil dihapus!');
    }
}
