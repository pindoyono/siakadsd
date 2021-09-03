<?php

namespace App\Http\Controllers;

use App\Models\Siswa;
use Illuminate\Http\Request;


class SiswaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    function __construct()
    {
         $this->middleware('permission:siswa-list|siswa-create|siswa-edit|siswa-delete', ['only' => ['index','store']]);
         $this->middleware('permission:siswa-create', ['only' => ['create','store']]);
         $this->middleware('permission:siswa-edit', ['only' => ['edit','update']]);
         $this->middleware('permission:siswa-delete', ['only' => ['destroy']]);
    }


    public function index()
    {
        //
        $siswas = Siswa::all();
        return view('siswas.index', [
            'siswas' => $siswas
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
        return view('siswas.create');
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
            'nama' => 'required',
            'email' => 'required|email|unique:gurus,email',
            'jenis_kelamin' => 'required',
            'tempat_lahir'  => 'required',
            'agama' => 'required',
            'alamat'    => 'required',
            'hp'    => 'required',
        ]);

        $array = $request->only([
            'nama','email','jenis_kelamin','tempat_lahir','tanggal_lahir','agama','alamat','hp',
        ]);

        $siswa = Siswa::create($array);
        return redirect()->route('siswas.index')
            ->with('success_message', 'Berhasil menambah Siswa baru');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Siswa  $siswa
     * @return \Illuminate\Http\Response
     */
    public function show(Siswa $siswa)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Siswa  $siswa
     * @return \Illuminate\Http\Response
     */
    public function edit(Siswa $siswa)
    {
        //
        return view('siswas.edit', [
            'siswa' => $siswa
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Siswa  $siswa
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Siswa $siswa)
    {
        //
        $request->validate([
            'nama' => 'required',
            'jenis_kelamin' => 'required',
            'tempat_lahir'  => 'required',
            'agama' => 'required',
            'alamat'    => 'required',
            'hp'    => 'required',
        ]);
        $siswa->update($request->all());

        return redirect()->route('siswas.index')
                        ->with('success_message','Data Siswa Berhasi Di Ubah');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Siswa  $siswa
     * @return \Illuminate\Http\Response
     */
    public function destroy(Siswa $siswa)
    {
        //
        $siswa->delete();

        return redirect()->route('siswas.index')
                        ->with('success_message','Data Siswa Berhasi Di Hapus');
    }
}
