<?php

namespace App\Http\Controllers;

use App\Models\Role;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class RoleController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // cek apakah user punya akses untuk read
        if (!hasMenuAccess(3, 'mrr')) {
            return redirect('/mrole')
                ->with('error', 'Anda tidak memiliki akses untuk melihat data dihalaman tersebut');
        }

        $dt = Role::whereNull('deleted_at')
        //->orderBy('menu_sort')
        ->paginate(10);
        //dd(get_class($menus));
        
        return view('mrole.index', [
            'data' => $dt,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        // cek apakah user punya akses untuk create
        if (!hasMenuAccess(3, 'mrc')) {
            return redirect('/mrole')
                ->with('error', 'Anda tidak memiliki akses untuk menambah data dihalaman tersebut');
        }

        $dt = Role::whereNull('deleted_at')
        ->get();

        return view('mrole.create', [
            'data' => $dt
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'role_nama' => [
                'required',
                Rule::unique('role', 'role_nama')
                    ->whereNull('deleted_at')
            ],
        ], [
            'role_nama.required' => 'Nama role wajib diisi',
            'role_nama.unique' => 'Nama role sudah digunakan',

        ]);

        Role::create([

            'role_nama' => $request->role_nama,
            'role_keterangan' => $request->role_keterangan,
            'role_status' => $request->role_status,

        ]);

        return redirect('/mrole')
            ->with('success', 'Data berhasil ditambahkan!');
    }

    /**
     * Display the specified resource.
     */
    public function show(Role $role)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        // cek apakah user punya akses untuk update/edit
        if (!hasMenuAccess(3, 'mru')) {
            return redirect('/mrole')
                ->with('error', 'Anda tidak memiliki akses untuk mengubah data dihalaman tersebut');
        }

        $dt = Role::findOrFail($id);
        #dd($dt);

        return view('mrole.edit', [
            'data' => $dt,
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $dt = Role::findOrFail($id);

        $request->validate([
            'role_nama' => [
                'required',
                Rule::unique('role', 'role_nama')
                    ->ignore($id, 'role_nama')
                    ->whereNull('deleted_at')
            ],

        ],[
            'role_nama.required' => 'Nama role wajib diisi',
            'role_nama.unique' => 'Nama role sudah digunakan',

        ]);

        $dt->update([
            //'role_nama' => $request->role_nama,
            'role_keterangan' => $request->role_keterangan,
            'role_status' => $request->role_status,
        ]);

        return redirect('/mrole')
            ->with('success', 'Data berhasil diupdate!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        // cek apakah user punya akses untuk delete
        if (!hasMenuAccess(3, 'mrd')) {
            return redirect('/mrole')
                ->with('error', 'Anda tidak memiliki akses untuk menghapus data dihalaman tersebut');
        }

        $dt = Role::findOrFail($id);

        $dt->delete();

        return redirect('/mrole')
            ->with('success', 'Data berhasil dihapus!');
    }
}
