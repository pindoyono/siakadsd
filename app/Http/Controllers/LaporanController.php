<?php

namespace App\Http\Controllers;

use App\Models\Laporan;
use App\Models\Siswa;
use App\Models\Guru;
use Illuminate\Http\Request;
use Auth;
use DB;
use PDF;

class LaporanController extends Controller
{
    function __construct()
    {
         $this->middleware('permission:laporan-list|laporan-create|laporan-edit|laporan-delete', ['only' => ['index','store']]);
         $this->middleware('permission:laporan-create', ['only' => ['create','store']]);
         $this->middleware('permission:laporan-edit', ['only' => ['edit','update']]);
         $this->middleware('permission:laporan-delete', ['only' => ['destroy']]);
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $id = Auth::user()->id;
        $wali_id = Guru::where('user_id',$id)->pluck('wali_id');
        // dd($guru);
        $siswa = DB::table('siswas')
        ->join('rombels', 'siswas.id_rombel', '=', 'rombels.id')
        ->join('relasi_rombel_mapels', 'rombels.id', '=', 'relasi_rombel_mapels.id_rombel')
        ->join('gurus', 'gurus.id', '=', 'relasi_rombel_mapels.id_guru')
        ->join('mapels', 'mapels.id', '=', 'relasi_rombel_mapels.id_mapel')
        ->select('siswas.*','relasi_rombel_mapels.id as id_relasi','relasi_rombel_mapels.id_mapel as id_mapel','rombels.nama as nama_rombel','rombels.id as id_rombel')
        ->where('gurus.wali_id',$wali_id)
        ->groupBy('siswas.id')
        ->get();


        return view('laporans.index2', [
            'siswa' => $siswa,
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
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Laporan  $laporan
     * @return \Illuminate\Http\Response
     */
    public function show($id_siswa)
    {
        //

        $id_rombel = Siswa::where('id',$id_siswa)->pluck('id_rombel');

        $mapel = DB::table('mapels')
        ->join('relasi_rombel_mapels', 'mapels.id', '=', 'relasi_rombel_mapels.id_mapel')
        ->join('rombels', 'rombels.id', '=', 'relasi_rombel_mapels.id_rombel')
        ->where('rombels.id',$id_rombel)
        ->select('mapels.nama as nama_mapel','mapels.id as id_mapel')
        ->get();


        return view('laporans.index', [
            'mapel' => $mapel,
            'id_siswa' => $id_siswa,
        ]);

    }

    public function nilai_siswa()
    {
        //
        $id = Auth::user()->id;
        $id_siswa = Siswa::where('user_id',$id)->first()->id;

        $id_rombel = Siswa::where('id',$id_siswa)->pluck('id_rombel');

        $mapel = DB::table('mapels')
        ->join('relasi_rombel_mapels', 'mapels.id', '=', 'relasi_rombel_mapels.id_mapel')
        ->join('rombels', 'rombels.id', '=', 'relasi_rombel_mapels.id_rombel')
        ->where('rombels.id',$id_rombel)
        ->select('mapels.nama as nama_mapel','mapels.id as id_mapel')
        ->get();


        return view('laporans.index', [
            'mapel' => $mapel,
            'id_siswa' => $id_siswa,
        ]);

    }

    public function cetak($id_siswa)
    {
        //

        $id_rombel = Siswa::where('id',$id_siswa)->pluck('id_rombel');
        $siswa = Siswa::find($id_siswa);

        $mapela = DB::table('mapels')
        ->join('relasi_rombel_mapels', 'mapels.id', '=', 'relasi_rombel_mapels.id_mapel')
        ->join('rombels', 'rombels.id', '=', 'relasi_rombel_mapels.id_rombel')
        ->where('rombels.id',$id_rombel)
        ->where('mapels.kelompok','Kelompok A')
        ->select('mapels.nama as nama_mapel','mapels.id as id_mapel')
        ->get();
        $mapelb = DB::table('mapels')
        ->join('relasi_rombel_mapels', 'mapels.id', '=', 'relasi_rombel_mapels.id_mapel')
        ->join('rombels', 'rombels.id', '=', 'relasi_rombel_mapels.id_rombel')
        ->where('rombels.id',$id_rombel)
        ->where('mapels.kelompok','Kelompok B')
        ->select('mapels.nama as nama_mapel','mapels.id as id_mapel')
        ->get();

        $data = [
            'mapela' => $mapela,
            'mapelb' => $mapelb,
            'id_siswa' => $id_siswa,
            'siswa' => $siswa,
        ];

        $pdf = PDF::loadView('laporans.cetak', $data);
        return $pdf->stream('Rapor.pdf');

        // return view('laporans.cetak', [
        //     'mapel' => $mapel,
        //     'id_siswa' => $id_siswa,
        // ]);

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Laporan  $laporan
     * @return \Illuminate\Http\Response
     */
    public function edit(Laporan $laporan)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Laporan  $laporan
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Laporan $laporan)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Laporan  $laporan
     * @return \Illuminate\Http\Response
     */
    public function destroy(Laporan $laporan)
    {
        //
    }
}
