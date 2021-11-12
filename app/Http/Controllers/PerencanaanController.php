<?php

namespace App\Http\Controllers;

use App\Models\Perencanaan;
use Illuminate\Http\Request;
use App\Models\Guru;
use Auth;
use DB;

class PerencanaanController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $id = Auth::user()->id;
        $guru = Guru::where('user_id',$id)->pluck('id');
        // dd($guru);
        $perencanaan = Perencanaan::where('id_guru',$guru)->get();
        // dd($perencanaan);
        return view('perencanaans.index', [
            'perencanaan' => $perencanaan,
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
        $id = Auth::user()->id;
        $guru = Guru::where('user_id',$id)->pluck('id');
        // dd($guru);
        $mapel = DB::table('mapels')
                ->join('relasi_rombel_mapels', 'mapels.id', '=', 'relasi_rombel_mapels.id_mapel')
                ->join('rombels', 'rombels.id', '=', 'relasi_rombel_mapels.id_rombel')
                ->join('gurus', 'gurus.id', '=', 'relasi_rombel_mapels.id_guru')
                ->where('gurus.id',$guru)
                ->select('mapels.nama as nama_mapel','rombels.nama as nama_rombel','rombels.id as id_rombel','mapels.id as id_mapel','relasi_rombel_mapels.id as id_relasi')
                ->groupBy('nama_mapel')
                ->get();


        $rombel = DB::table('rombels')
                ->join('relasi_rombel_mapels', 'rombels.id', '=', 'relasi_rombel_mapels.id_rombel')
                ->join('gurus', 'gurus.id', '=', 'relasi_rombel_mapels.id_guru')
                ->where('gurus.id',$guru)
                ->select('rombels.nama as nama_rombel','rombels.id as id_rombel','relasi_rombel_mapels.id as id_relasi')
                ->groupBy('nama_rombel')
                ->get();
        return view('perencanaans.create', [
            'mapel' => $mapel,
            'rombel' => $rombel
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
            'id_mapel' => 'required',
            'id_rombel'  => 'required',
            'bobot' => 'required',
            'nama_penilaian' => 'required',
        ]);


        $id = Auth::user()->id;
        $guru = Guru::where('user_id',$id)->first()->id;

        $data = [
            'id_mapel' => $request->id_mapel,
            'id_rombel'  => $request->id_rombel,
            'bobot' => $request->bobot,
            'nama_penilaian' => $request->nama_penilaian,
            'id_guru' => $guru,
        ];



        $perencanaan = Perencanaan::create($data);
        return redirect()->route('perencanaans.index')
            ->with('success_message', 'Berhasil menambah Perencanaan baru');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Perencanaan  $perencanaan
     * @return \Illuminate\Http\Response
     */
    public function show(Perencanaan $perencanaan)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Perencanaan  $perencanaan
     * @return \Illuminate\Http\Response
     */
    public function edit(Perencanaan $perencanaan)
    {
        //
        $id = Auth::user()->id;
        $guru = Guru::where('user_id',$id)->first()->id;

        $mapel = DB::table('mapels')
        ->join('relasi_rombel_mapels', 'mapels.id', '=', 'relasi_rombel_mapels.id_mapel')
        ->join('rombels', 'rombels.id', '=', 'relasi_rombel_mapels.id_rombel')
        ->join('gurus', 'gurus.id', '=', 'relasi_rombel_mapels.id_guru')
        ->where('gurus.id',$guru)
        ->select('mapels.nama as nama_mapel','rombels.nama as nama_rombel','rombels.id as id_rombel','mapels.id as id_mapel','relasi_rombel_mapels.id as id_relasi')
        ->groupBy('nama_mapel')
        ->get();


        $rombel = DB::table('rombels')
        ->join('relasi_rombel_mapels', 'rombels.id', '=', 'relasi_rombel_mapels.id_rombel')
        ->join('gurus', 'gurus.id', '=', 'relasi_rombel_mapels.id_guru')
        ->where('gurus.id',$guru)
        ->select('rombels.nama as nama_rombel','rombels.id as id_rombel','relasi_rombel_mapels.id as id_relasi')
        ->groupBy('nama_rombel')
        ->get();


        return view('perencanaans.edit', [
            'perencanaan' => $perencanaan,
            'mapel' => $mapel,
            'rombel' => $rombel
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Perencanaan  $perencanaan
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Perencanaan $perencanaan)
    {
        //
        $request->validate([
            'id_mapel' => 'required',
            'id_rombel'  => 'required',
            'bobot' => 'required',
            'nama_penilaian' => 'required',
        ]);


        $id = Auth::user()->id;
        $guru = Guru::where('user_id',$id)->first()->id;

        $data = [
            'id_mapel' => $request->id_mapel,
            'id_rombel'  => $request->id_rombel,
            'bobot' => $request->bobot,
            'nama_penilaian' => $request->nama_penilaian,
            'id_guru' => $guru,
        ];



        $perencanaan->update($data);
        return redirect()->route('perencanaans.index')
            ->with('success_message', 'Berhasil menambah Perencanaan baru');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Perencanaan  $perencanaan
     * @return \Illuminate\Http\Response
     */
    public function destroy(Perencanaan $perencanaan)
    {
        //
        $perencanaan->delete();
        return redirect()->route('perencanaans.index')
                        ->with('success_message','Data Perencanaan Berhasil Di Hapus');
    }
}
