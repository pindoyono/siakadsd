<?php

namespace App\Http\Controllers;

use App\Models\Rombel;
use App\Models\Siswa;
use Illuminate\Http\Request;

class RombelController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    function __construct()
    {
         $this->middleware('permission:kelas-list|kelas-create|kelas-edit|kelas-delete', ['only' => ['index','store']]);
         $this->middleware('permission:kelas-create', ['only' => ['create','store']]);
         $this->middleware('permission:kelas-edit', ['only' => ['edit','update']]);
         $this->middleware('permission:kelas-delete', ['only' => ['destroy']]);
    }


    public function index()
    {
        //
        $rombels = Rombel::all();
        return view('kelas.index', [
            'rombels' => $rombels
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

        $rombels = Rombel::create($request->all());
        return redirect()->route('rombels.index')
            ->with('success_message', 'Berhasil menambah Kelas baru');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Rombel  $rombel
     * @return \Illuminate\Http\Response
     */
    public function show(Rombel $rombel)
    {
        //
        $anggota = Siswa::where('id_rombel',$rombel->id)->get();
        $non_anggota = Siswa::where('id_rombel',0)->get();
        return view('kelas.anggota', [
            'rombel' => $rombel,
            'anggota' => $anggota,
            'non_anggota' => $non_anggota,
        ]);
    }

    public function anggota(Request $request)
    {
        //
        dd($request->all());
        $request->validate([
            'nama' => 'required',
            'tingkat' => 'required',
        ]);

        $rombels = Rombel::create($request->all());
        return redirect()->route('rombels.index')
            ->with('success_message', 'Berhasil menambah Kelas baru');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Rombel  $rombel
     * @return \Illuminate\Http\Response
     */
    public function edit(Rombel $rombel)
    {
        //
        return view('kelas.edit', [
            'rombel' => $rombel
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Rombel  $rombel
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Rombel $rombel)
    {
        //
        $request->validate([
            'nama' => 'required',
            'tingkat' => 'required',
        ]);

        $rombel->update($request->all());
        return redirect()->route('rombels.index')
            ->with('success_message', 'Berhasil mengUbah Kelas baru');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Rombel  $rombel
     * @return \Illuminate\Http\Response
     */
    public function destroy(Rombel $rombel)
    {
        //
        $rombel->delete();

        return redirect()->route('rombels.index')
                        ->with('success_message','Data Kelas Berhasi Di Hapus');
    }
}
