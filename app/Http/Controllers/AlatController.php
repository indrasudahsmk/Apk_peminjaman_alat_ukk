<?php

namespace App\Http\Controllers;

use App\Models\Alat;
use App\Models\Kategori;
use Illuminate\Http\Request;

class AlatController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data = [
            'alat'  =>  Alat::all()
        ];
        return view('alat.index', $data);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $data = [
            'kategori'  =>  Kategori::all()
        ];
        return view('alat.create', $data);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'nama_alat'  =>  'required',
            'kategori_id' =>  'required|exists:kategoris,id',
            'stok'  =>  'required|integer'
        ]);

        Alat::create($request->all());

        $log = new LogAktivitasController();
        $log->store('create','tambah data alat');
        
        return redirect()->route('alat.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(Alat $alat)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Alat $alat)
    {
        $data = [
            'kategori'  =>  Kategori::all(),
            'alat'  =>  $alat
        ];
        return view('alat.edit', $data);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Alat $alat)
    {
        $request->validate([
            'nama_alat' =>  'required',
            'kategori_id'   =>  'required|exists:kategoris,id',
            'stok'  =>  'required|integer'
        ]);

        $alat->update($request->all());

        $log = new LogAktivitasController();
        $log->store('update','ubah data alat');

        return redirect()->route('alat.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Alat $alat)
    {
        $alat->delete();

        $log = new LogAktivitasController();
        $log->store('destroy','hapus data alat');

        return redirect()->route('alat.index');
    }
}
