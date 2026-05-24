<?php

namespace App\Http\Controllers;

use App\Models\Customer;
use Illuminate\Http\Request;

class CustomerController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        if (!hasMenuAccess(12, 'mrr')) {
            return redirect('/dashboard')
                ->with('error', 'Anda tidak memiliki akses untuk melihat data dihalaman tersebut');
        }

        $data = Customer::whereNull('deleted_at')
            ->paginate(10);

        return view('customer.index', [
            'data' => $data,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        if (!hasMenuAccess(12, 'mrc')) {
            return redirect('/customer')
                ->with('error', 'Anda tidak memiliki akses untuk menambah data dihalaman tersebut');
        }

        return view('customer.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'customer_nama' => [
                'required',
                'max:100',
            ],
            'customer_npwp' => [
                'nullable',
                'max:25',
            ],
            'customer_alamat' => [
                'required',
            ],
            'customer_kontak' => [
                'required',
                'max:50',
            ],
            'customer_email' => [
                'required',
                'email',
                'max:100',
            ],
            'customer_status' => [
                'required',
            ],
        ], [
            'customer_nama.required' => 'Nama customer wajib diisi',
            'customer_nama.max' => 'Nama customer maksimal 100 karakter',
            'customer_npwp.max' => 'NPWP maksimal 25 karakter',
            'customer_alamat.required' => 'Alamat customer wajib diisi',
            'customer_kontak.required' => 'Kontak customer wajib diisi',
            'customer_kontak.max' => 'Kontak customer maksimal 50 karakter',
            'customer_email.required' => 'Email customer wajib diisi',
            'customer_email.email' => 'Email tidak valid',
            'customer_email.max' => 'Email customer maksimal 100 karakter',
            'customer_status.required' => 'Status customer wajib dipilih',
        ]);

        Customer::create([
            'customer_nama' => $request->customer_nama,
            'customer_npwp' => $request->customer_npwp,
            'customer_alamat' => $request->customer_alamat,
            'customer_kontak' => $request->customer_kontak,
            'customer_email' => $request->customer_email,
            'customer_status' => $request->customer_status,
        ]);

        return redirect('/customer')
            ->with('success', 'Data customer berhasil ditambahkan!');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        if (!hasMenuAccess(12, 'mru')) {
            return redirect('/customer')
                ->with('error', 'Anda tidak memiliki akses untuk mengubah data dihalaman tersebut');
        }

        $data = Customer::findOrFail($id);

        return view('customer.edit', [
            'data' => $data,
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $data = Customer::findOrFail($id);

        $request->validate([
            'customer_nama' => [
                'required',
                'max:100',
            ],
            'customer_npwp' => [
                'nullable',
                'max:25',
            ],
            'customer_alamat' => [
                'required',
            ],
            'customer_kontak' => [
                'required',
                'max:50',
            ],
            'customer_email' => [
                'required',
                'email',
                'max:100',
            ],
            'customer_status' => [
                'required',
            ],
        ], [
            'customer_nama.required' => 'Nama customer wajib diisi',
            'customer_nama.max' => 'Nama customer maksimal 100 karakter',
            'customer_npwp.max' => 'NPWP maksimal 25 karakter',
            'customer_alamat.required' => 'Alamat customer wajib diisi',
            'customer_kontak.required' => 'Kontak customer wajib diisi',
            'customer_kontak.max' => 'Kontak customer maksimal 50 karakter',
            'customer_email.required' => 'Email customer wajib diisi',
            'customer_email.email' => 'Email tidak valid',
            'customer_email.max' => 'Email customer maksimal 100 karakter',
            'customer_status.required' => 'Status customer wajib dipilih',
        ]);

        $data->update([
            'customer_nama' => $request->customer_nama,
            'customer_npwp' => $request->customer_npwp,
            'customer_alamat' => $request->customer_alamat,
            'customer_kontak' => $request->customer_kontak,
            'customer_email' => $request->customer_email,
            'customer_status' => $request->customer_status,
        ]);

        return redirect('/customer')
            ->with('success', 'Data customer berhasil diupdate!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        if (!hasMenuAccess(12, 'mrd')) {
            return redirect('/customer')
                ->with('error', 'Anda tidak memiliki akses untuk menghapus data dihalaman tersebut');
        }

        $data = Customer::findOrFail($id);
        $data->delete();

        return redirect('/customer')
            ->with('success', 'Data customer berhasil dihapus!');
    }
}
