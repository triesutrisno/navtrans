<?php

namespace App\Http\Controllers;

use App\Models\Menu;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class MenuController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // cek apakah user punya akses untuk read
        if (!hasMenuAccess(2, 'mrr')) {
            return redirect('/menu')
                ->with('error', 'Anda tidak memiliki akses untuk melihat data dihalaman tersebut');
        }

        $menus = Menu::whereNull('deleted_at')
        //->orderBy('menu_sort')
        ->paginate(10);
        //dd(get_class($menus));

        //return view('menu.index', compact('menus'));
        return view('menu.index', [
            'data' => $menus,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        // cek apakah user punya akses untuk create
        if (!hasMenuAccess(2, 'mrc')) {
            return redirect('/menu')
                ->with('error', 'Anda tidak memiliki akses untuk menambah data dihalaman tersebut');
        }

        $menus = Menu::whereNull('deleted_at')
        ->orderBy('menu_nama')
        ->get();

        return view('menu.create', [
            'data' => $menus
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'menu_nama' => [
                'required',
                Rule::unique('menu', 'menu_nama')
                    ->whereNull('deleted_at')
            ],
            'menu_link' => [
                'required',
                Rule::unique('menu', 'menu_link')
                    ->whereNull('deleted_at')
            ],
            'menu_sort' => 'required|numeric',
        ], [
            'menu_nama.required' => 'Nama menu wajib diisi',
            'menu_nama.unique' => 'Nama menu sudah digunakan',
            'menu_link.required' => 'Link menu wajib diisi',
            'menu_link.unique' => 'Link menu sudah digunakan',

        ]);

        Menu::create([

            'menu_nama' => $request->menu_nama,
            'menu_link' => $request->menu_link,
            'menu_keterangan' => $request->menu_keterangan,
            'menu_parent' => $request->menu_parent,
            'menu_sort' => $request->menu_sort,
            'menu_status' => $request->menu_status,
            'menu_type' => $request->menu_type,

        ]);

        return redirect('/menu')
            ->with('success', 'Data berhasil ditambahkan!');
    }

    /**
     * Display the specified resource.
     */
    //public function show(Menu $menu)
    //{
        //
    //}

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        // cek apakah user punya akses untuk update/edit
        if (!hasMenuAccess(2, 'mru')) {
            return redirect('/menu')
                ->with('error', 'Anda tidak memiliki akses untuk mengubah data dihalaman tersebut');
        }

        $menus = Menu::findOrFail($id);
        #dd($menus);

        $parents = Menu::whereNull('menu_parent')
            ->where('menu_id', '!=', $id)
            ->orderBy('menu_nama')
            ->get();
        //dd($parents);

        return view('menu.edit', [
            'data' => $menus,
            'parents' => $parents,
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $menu = Menu::findOrFail($id);

        $request->validate([
            'menu_nama' => [
                'required',
                Rule::unique('menu', 'menu_nama')
                    ->ignore($id, 'menu_id')
                    ->whereNull('deleted_at')
            ],
            'menu_link' => [
                'required',
                Rule::unique('menu', 'menu_link')
                    ->ignore($id, 'menu_id')
                    ->whereNull('deleted_at')
            ],
            'menu_sort' => 'required|numeric',

        ]);

        $menu->update([
            'menu_nama' => $request->menu_nama,
            'menu_link' => $request->menu_link,
            'menu_keterangan' => $request->menu_keterangan,
            'menu_parent' => $request->menu_parent,
            'menu_sort' => $request->menu_sort,
            'menu_status' => $request->menu_status,
            'menu_type' => $request->menu_type,

        ]);

        return redirect('/menu')
            ->with('success', 'Data berhasil diupdate!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        // cek apakah user punya akses untuk delete
        if (!hasMenuAccess(2, 'mrd')) {
            return redirect('/menu')
                ->with('error', 'Anda tidak memiliki akses untuk menghapus data dihalaman tersebut');
        }

        $menu = Menu::findOrFail($id);

        // CEK APAKAH PUNYA CHILD
        $child = Menu::where('menu_parent', $id)->count();

        if ($child > 0) {
            return redirect('/menu')
                ->with('error', 'Data memiliki child menu!');
        }

        $menu->delete();

        return redirect('/menu')
            ->with('success', 'Data berhasil dihapus!');
    }
}
