<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\Alat;
use App\Models\Peminjaman;
use App\Models\Pengembalian;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class PengembalianController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        if (Auth::user()->role === 'peminjam') {
            $pengembalian = Pengembalian::whereHas('peminjaman', function ($q) {
                $q->where('user_id', Auth::user()->id);
            })->get();
        } else {
            $pengembalian = Pengembalian::all();
        }
        return view('pengembalian.index', compact('pengembalian'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $data = [
            'peminjaman'    =>  Peminjaman::all()
        ];
        return view('pengembalian.create', $data);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'peminjaman_id'    =>  'required|exists:peminjamen,id',
            'tanggal_pengembalian'  =>  'required|date'
        ]);

        $peminjaman = Peminjaman::findOrFail($request->peminjaman_id);
        $alat = Alat::findOrFail($peminjaman->alat_id);

        $hargaDenda = 2000;
        $tanggalKembaliDijanjikan = Carbon::parse($peminjaman->tgl_kembali);
        $tanggalPengembalian = Carbon::parse($request->tanggal_pengembalian);

        $selisihHari = $tanggalKembaliDijanjikan->diffInDays($tanggalPengembalian);
        $totalDenda = $selisihHari * $hargaDenda;

        if ($request->tanggal_pengembalian < $peminjaman->tgl_pinjam) {
            return redirect()->back()->with('error', 'tanggal pengembalian tidak boleh lebih kecil dari tanggal pinjam');
        }

        DB::transaction(function () use ($request, $peminjaman, $alat, $totalDenda) {
            $peminjaman->status = 'dikembalikan';
            $peminjaman->save();

            $alat->stok = $alat->stok + $peminjaman->jumlah;
            $alat->save();


            Pengembalian::create([
                'peminjaman_id' =>  $request->peminjaman_id,
                'tanggal_pengembalian'  =>  $request->tanggal_pengembalian,
                'denda' =>  $totalDenda
            ]);

            $log = new LogAktivitasController();
            $log->store('store', 'mengembalikan alat ' . $peminjaman->alat->nama_alat);
        });

        return redirect()->route('pengembalian.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(Pengembalian $pengembalian)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Pengembalian $pengembalian)
    {
        
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Pengembalian $pengembalian)
    {
        
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Pengembalian $pengembalian)
    {
        $pengembalian->delete();
        return redirect()->route('pengembalian.index');
    }

    public function kembalikan(Peminjaman $peminjaman){
        $alat = Alat::findOrFail($peminjaman->alat_id);
        $alat->stok = $alat->stok + $peminjaman->jumlah;
        $alat->save();

        $hargaDenda = 2000;
        $tanggalKembaliDijanjikan  = Carbon::parse($peminjaman->tgl_kembali);
        $tanggal_pengembalian = Carbon::parse(now());
        $selisihHari = $tanggalKembaliDijanjikan->diffInDays($tanggal_pengembalian);

        $totalDenda = $selisihHari * $hargaDenda;

        $peminjaman->update([
            'status'    => 'dikembalikan'
        ]);
        
        Pengembalian::create([
            'peminjaman_id' =>  $peminjaman->id,
            'tanggal_pengembalian'  =>  now(),
            'denda' =>  $totalDenda,
        ]);

        return redirect()->route('pengembalian.index');
    }
}
