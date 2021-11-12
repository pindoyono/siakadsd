<?php

namespace App\Http\Controllers;

use App\Models\Guru;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Spatie\Permission\Traits\HasRoles;
use Spatie\Permission\Models\Role;
use DB;
use Hash;
use Illuminate\Support\Arr;
class GuruController extends Controller
{
    use HasRoles;
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    function __construct()
    {
         $this->middleware('permission:guru-list|guru-create|guru-edit|guru-delete', ['only' => ['index','store']]);
         $this->middleware('permission:guru-create', ['only' => ['create','store']]);
         $this->middleware('permission:guru-edit', ['only' => ['edit','update']]);
         $this->middleware('permission:guru-delete', ['only' => ['destroy']]);
    }


    public function index()
    {
        //
        $gurus = Guru::all();
        return view('gurus.index', [
            'gurus' => $gurus
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        $roles = Role::all();
        return view('gurus.create', [
            'roles' => $roles
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //

        $request->validate([
            'Nama' => 'required',
            'email' => 'required|email|unique:gurus,email',
            'jenis_kelamin' => 'required',
            'tempat_lahir'  => 'required',
            'tanggal_lahir' => 'required',
            'agama' => 'required',
            'alamat'    => 'required',
            'hp'    => 'required',
            'role'    => 'required',
        ]);
        // dd($request->role);

        $array_user = [
            'name' => $request->Nama,
            'email' => $request->email,
            'password' => bcrypt(12345678) ,
        ];
        $user = User::create($array_user);

        $user->assignRole($request->role);




        $array = $request->only([
            'Nama','email','jenis_kelamin','tempat_lahir','tanggal_lahir','agama','alamat','hp',
        ]);
        $array['user_id'] = $user->id;

        $guru = Guru::create($array);



        return redirect()->route('gurus.index')
            ->with('success_message', 'Berhasil menambah Guru baru');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Guru  $guru
     * @return \Illuminate\Http\Response
     */
    public function show(Guru $guru)
    {
        //

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Guru  $guru
     * @return \Illuminate\Http\Response
     */
    public function edit(Guru $guru)
    {
        $roles = Role::all();
        $user = User::find($guru->user_id);
          return view('gurus.edit', [
              'guru' => $guru,
              'roles' => $roles,
              'user' => $user,
          ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Guru  $guru
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Guru $guru)
    {
        //
        // dd($guru);

        $request->validate([
            'Nama' => 'required',
            'jenis_kelamin' => 'required',
            'tempat_lahir'  => 'required',
            'agama' => 'required',
            'alamat'    => 'required',
            'hp'    => 'required',
            'role'    => 'required',
        ]);
        $guru->update($request->all());
        $user = User::find($guru->user_id);
        $array_user = [
            'name' => $request->Nama,
            'email' => $request->email,
            'password' => bcrypt(12345678) ,
        ];
        $user->update($array_user);
        $user->syncRoles($request->role);
        return redirect()->route('gurus.index')
                        ->with('success_message','Data Guru Berhasi Di Ubah');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Guru  $guru
     * @return \Illuminate\Http\Response
     */
    public function destroy(Guru $guru)
    {
        //
        $user = User::find($guru->user_id);
        $user->delete();
        $guru->delete();
        return redirect()->route('gurus.index')
                        ->with('success_message','Data Guru Berhasi Di Hapus');
    }
}
