<?php

namespace App\Http\Controllers;

use App\Models\LogAktivitas;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LogAktivitasController extends Controller
{
    public function index(){
        $data = [
            'log'   =>  LogAktivitas::latest()->paginate(10),
        ];
        return view('log.index', $data);
    }

    public function store($aksi,$detail){
        LogAktivitas::create([
            'user_id'   =>  Auth::user()->id,
            'aksi'  =>  $aksi,
            'detail'    =>  $detail
        ]);
    }
}
