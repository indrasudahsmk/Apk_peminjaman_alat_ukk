<?php

namespace App\Http\Controllers;

use App\Models\Alat;
use App\Models\User;
use App\Models\Peminjaman;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class PeminjamanController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        if(Auth::user()->role === 'peminjam'){
            $peminjaman = Peminjaman::where('user_id', Auth::user()->id)->get();
        }else{
            $peminjaman = Peminjaman::all();
        }

        return view('peminjaman.index', compact('peminjaman'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $data = [
            'user'  =>  User::all(),
            'alat'  =>  Alat::all()
        ];
        return view('peminjaman.create', $data);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'user_id'   =>  'required|exists:users,id',
            'alat_id'   =>  'required|exists:alats,id',
            'jumlah'    =>  'required|integer',
            'tgl_kembali'   =>  'required|date',
        ]);

        $alat = Alat::findOrFail($request->alat_id);

        if ($request->jumlah > $alat->stok) {
            return back()->with('error', 'jumlah tidak boleh melebihi stok' . '[' . $alat->stok . ']');
        }

        DB::transaction(function () use ($request,$alat) {

            Peminjaman::create([
                'user_id'   =>  $request->user_id,
                'alat_id'   =>  $request->alat_id,
                'jumlah'    =>  $request->jumlah,
                'tgl_pinjam'    =>  now(),
                'tgl_kembali'   =>  $request->tgl_kembali,
            ]);


            $alat->stok = $alat->stok - $request->jumlah;
            $alat->save();

            $log = new LogAktivitasController();
            $log->store('create', 'tambah data peminjaman');
        });

        return redirect()->route('peminjaman.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(Peminjaman $peminjaman)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Peminjaman $peminjaman)
    {
        $data = [
            'peminjaman'    =>  $peminjaman,
            'user'  =>  User::all(),
            'alat'  =>  Alat::all()
        ];
        return view('peminjaman.edit', $data);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Peminjaman $peminjaman)
    {
        $request->validate([
            'user_id'   =>  'required|exists:users,id',
            'alat_id'   =>  'required|exists:alats,id',
            'jumlah'    =>  'required|integer',
            'tgl_kembali'   =>  'required|date',
            'status'    =>  'required|in:menunggu,dipinjam,ditolak,dikembalikan,menunggu_dikembalikan'
        ]);

        $peminjaman->update($request->all());

        $log = new LogAktivitasController();
        $log->store('update', 'ubah data peminjaman');

        return redirect()->route('peminjaman.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Peminjaman $peminjaman)
    {
        $peminjaman->delete();

        $log = new LogAktivitasController();
        $log->store('destroy', 'hapus data peminjaman');

        return redirect()->route('peminjaman.index');
    }

    public function PetugasIndex()
    {
        $data = [
            'peminjaman'    =>  Peminjaman::all()
        ];
        return view('petugas.peminjaman.index', $data);
    }

    public function setuju(Peminjaman $peminjaman)
    {
        $peminjaman->update([
            'status'    =>  'dipinjam'
        ]);
        return redirect()->route('peminjaman.index');
    }

    public function tolak(Peminjaman $peminjaman) {
        $alat = Alat::findOrFail($peminjaman->alat_id);
        $alat->stok = $alat->stok + $peminjaman->jumlah;
        $alat->save();

        $peminjaman->update([
            'status'    =>  'ditolak'
        ]);
        return redirect()->route('peminjaman.index');
    }

    public function print(){
        $peminjaman = Peminjaman::all();
        return view('peminjaman.print', compact('peminjaman'));
    }
}
