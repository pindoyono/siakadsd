<?php

namespace App\Http\Controllers;

use App\Models\Klas;
use Illuminate\Http\Request;

class KlasController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
     //
    //  function __construct()
    // {
    //  $this->middleware('permission:kelas-list|kelas-create|kelas-edit|kelas-delete', ['only' => ['index','store']]);
    //  $this->middleware('permission:kelas-create', ['only' => ['create','store']]);
    //  $this->middleware('permission:kelas-edit', ['only' => ['edit','update']]);
    //  $this->middleware('permission:kelas-delete', ['only' => ['destroy']]);
    // }

    public function index()
    {
        $klas = Klas::all();
        return view('kelas.index', [
            'klass' => $klas
        ]);
    }

    public function anggota($kelas)
    {
        dd($kelas);
        return view('kelas.index', [
            'klass' => $klas
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
        return view('kelas.create');
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
            'tingkat' => 'required',
        ]);

        $array = $request->only([
            'nama','tingkat',
        ]);

        $klas = Klas::create($array);
        return redirect()->route('kelas.index')
            ->with('success_message', 'Berhasil menambah Kelas baru');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Klas  $klas
     * @return \Illuminate\Http\Response
     */
    public function show(Klas $klas)
    {
        //

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Klas  $klas
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $klas = Klas::find($id);
          return view('kelas.edit', [
              'klas' => $klas
          ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Klas  $klas
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
        $request->validate([
            'nama' => 'required',
            'tingkat' => 'required',
        ]);
        $klas = Klas::find($id);
        $klas->update($request->all());

        return redirect()->route('kelas.index')
                        ->with('success_message','Data Kelas Berhasi Di Ubah');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Klas  $klas
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
        $klas = Klas::find($id);
        $klas->delete();
        return redirect()->route('kelas.index')
                        ->with('success_message','Data Kelas Berhasi Di Hapus');
    }
}
