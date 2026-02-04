<?php

namespace App\Http\Controllers;

use App\Models\Kategori;
use App\Models\LogAktivitas;
use Illuminate\Http\Request;

class KategoriController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data = [
            'kategori'  =>  Kategori::all()
        ];
        return view('kategori.index', $data);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('kategori.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name'  =>  'required',
            'deskripsi' =>  'required'
        ]);

        Kategori::create($request->all());

        $log = new LogAktivitasController();
        $log->store('create','tambah data kategori');
        return redirect()->route('kategori.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(Kategori $kategori)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Kategori $kategori)
    {
        $data = [
            'kategori'  =>  Kategori::findOrFail($kategori->id)
        ];
        return view('kategori.edit', $data);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Kategori $kategori)
    {
        $request->validate([
            'name'  =>  'required',
            'deskripsi' =>  'required'
        ]);

        $log = new LogAktivitasController();
        $log->store('update','ubah data kategori');

        $kategori->update($request->all());
        return redirect()->route('kategori.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Kategori $kategori)
    {
        Kategori::findOrFail($kategori->id)->delete();

        $log = new LogAktivitasController();
        $log->store('destroy','hapus data kategori');

        return redirect()->route('kategori.index');
    }
}
