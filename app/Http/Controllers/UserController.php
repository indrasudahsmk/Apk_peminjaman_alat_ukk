<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data = [
            'users' => User::all(),
        ];
        return view('users.index', $data);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $data = [
            'users' => User::all(),
        ];
        return view('users.create', $data);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' =>   'required',
            'email' =>  'required|email|unique:users,email',
            'password'  =>  'required|min:8',
            'role'  =>  'required'
        ],[
            'email.unique'  =>  'email sudah ada'
        ]);



        User::create([
            'name'  =>  $request->name,
            'email' =>  $request->email,
            'password'  =>  Hash::make($request->password),
            'role'  =>  $request->role,
        ]);

        $log = new LogAktivitasController();
        $log->store('create','tambah data user');

        return redirect()->route('users.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $data = [
            'users' => User::findOrFail($id),
        ];
        return view('users.edit', $data);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, User $user)
    {
        $request->validate([
            'name'  =>  'required',
            'email' =>  'required|email|unique:users,email,' . $user->id,
            'password'  =>  'nullable|min:8',
            'role'  =>  'required'
        ],[
            'email.unique'  =>  'email sudah ada'
        ]);

        $data = [
            'name'  =>  $request->name,
            'email' =>  $request->email,
            'role'  =>  $request->role
        ];

        if($request->filled('password')){
            $data['password'] = Hash::make($request->password);
        }

        $user->update($data);

        $log = new LogAktivitasController();
        $log->store('update','ubah data user');

        return redirect()->route('users.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $user = User::findOrFail($id);
        $user->delete();

        $log = new LogAktivitasController();
        $log->store('destroy','hapus data user');
        return redirect()->route('users.index');
    }
}
