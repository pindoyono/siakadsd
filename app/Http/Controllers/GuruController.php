<?php

namespace App\Http\Controllers;

use App\Models\Guru;
use Illuminate\Http\Request;

class GuruController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    function __construct()
    {
         $this->middleware('permission:role-list|role-create|role-edit|role-delete', ['only' => ['index','store']]);
         $this->middleware('permission:role-create', ['only' => ['create','store']]);
         $this->middleware('permission:role-edit', ['only' => ['edit','update']]);
         $this->middleware('permission:role-delete', ['only' => ['destroy']]);
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
        return view('gurus.create');
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
        ]);

        $array = $request->only([
            'Nama','email','jenis_kelamin','tempat_lahir','tanggal_lahir','agama','alamat','hp',
        ]);

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
          return view('gurus.edit', [
              'guru' => $guru
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
        ]);
        $guru->update($request->all());

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
        $guru->delete();

        return redirect()->route('gurus.index')
                        ->with('success_message','Data Guru Berhasi Di Hapus');
    }
}
