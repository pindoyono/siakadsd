<?php

namespace App\Http\Controllers;

use App\Models\Nilai;
use App\Models\Guru;
use Illuminate\Http\Request;

use Auth;

use App\Models\User;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Spatie\Permission\Traits\HasRoles;
use Spatie\Permission\Models\Role;
use DB;
use Hash;
use Illuminate\Support\Arr;

class NilaiController extends Controller
{

    // function __construct()
    // {
    //      $this->middleware('permission:nilai-list|nilai-create|nilai-edit|nilai-delete', ['only' => ['index','store']]);
    //      $this->middleware('permission:nilai-create', ['only' => ['create','store']]);
    //      $this->middleware('permission:nilai-edit', ['only' => ['edit','update']]);
    //      $this->middleware('permission:nilai-delete', ['only' => ['destroy']]);
    // }

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
        $mapel = DB::table('mapels')
                ->join('relasi_rombel_mapels', 'mapels.id', '=', 'relasi_rombel_mapels.id_mapel')
                ->join('rombels', 'rombels.id', '=', 'relasi_rombel_mapels.id_rombel')
                ->join('gurus', 'gurus.id', '=', 'relasi_rombel_mapels.id_guru')
                ->where('gurus.id',$guru)
                ->select('mapels.nama as nama_mapel','rombels.nama as nama_rombel','mapels.id as id_mapel','relasi_rombel_mapels.id as id_relasi')
                ->get();

        return view('nilais.index', [
            'mapel' => $mapel
        ]);
    }

    public function sort3($id_relasi)
    {

        $id = Auth::user()->id;
        $guru = Guru::where('user_id',$id)->pluck('id');
        // dd($guru);
        $mapel = DB::table('mapels')
                ->join('relasi_rombel_mapels', 'mapels.id', '=', 'relasi_rombel_mapels.id_mapel')
                ->join('rombels', 'rombels.id', '=', 'relasi_rombel_mapels.id_rombel')
                ->join('gurus', 'gurus.id', '=', 'relasi_rombel_mapels.id_guru')
                ->where('gurus.id',$guru)
                ->select('mapels.nama as nama_mapel','rombels.nama as nama_rombel','mapels.id as id_mapel','relasi_rombel_mapels.id as id_relasi')
                ->get();
        // dd($guru);
        $mapel2 = DB::table('siswas')
                ->join('rombels', 'siswas.id_rombel', '=', 'rombels.id')
                ->join('relasi_rombel_mapels', 'rombels.id', '=', 'relasi_rombel_mapels.id_rombel')
                ->where('relasi_rombel_mapels.id',$id_relasi)
                ->select('siswas.*','relasi_rombel_mapels.id as id_relasi','relasi_rombel_mapels.id_mapel as id_mapel','rombels.nama as nama_rombel')
                ->get();

        return view('nilais.index2', [
            'mapel' => $mapel,
            'mapel2' => $mapel2,
            'id_relasi' => $id_relasi,
        ]);
    }


    public function sort(Request $request)
    {
        //
        $request->validate([
            'id_relasi' => 'required',
        ]);

        // dd($request->id_relasi);

        $id = Auth::user()->id;
        $guru = Guru::where('user_id',$id)->pluck('id');
        // dd($guru);
        $mapel = DB::table('mapels')
                ->join('relasi_rombel_mapels', 'mapels.id', '=', 'relasi_rombel_mapels.id_mapel')
                ->join('rombels', 'rombels.id', '=', 'relasi_rombel_mapels.id_rombel')
                ->join('gurus', 'gurus.id', '=', 'relasi_rombel_mapels.id_guru')
                ->where('gurus.id',$guru)
                ->select('mapels.nama as nama_mapel','rombels.nama as nama_rombel','mapels.id as id_mapel','relasi_rombel_mapels.id as id_relasi')
                ->get();
        // dd($guru);
        $mapel2 = DB::table('siswas')
                ->join('rombels', 'siswas.id_rombel', '=', 'rombels.id')
                ->join('relasi_rombel_mapels', 'rombels.id', '=', 'relasi_rombel_mapels.id_rombel')
                ->where('relasi_rombel_mapels.id',$request->id_relasi)
                ->select('siswas.*','relasi_rombel_mapels.id as id_relasi','relasi_rombel_mapels.id_mapel as id_mapel','rombels.nama as nama_rombel')
                ->get();

        return redirect()->route('nilais.sort3',$request->id_relasi)
                ->with('success_message', 'Berhasil Memperbarui Nilai');
    }


    public function sort2(Request $request)
    {
        // return redirect()->back()->with('success_message', 'Berhasil Memperbarui Nilai Pengajar');
        $request->validate([
            'nilai' => 'required',
            'id_mapel' => 'required',
            'id_siswa' => 'required',
        ]);


        if(Nilai::where('id_mapel', '=',$request->id_mapel)->where('id_siswa', '=',$request->id_siswa)->count()==0) {
            $data = [
                'pengetahuan' => $request->nilai,
                'id_mapel' => $request->id_mapel,
                'id_siswa' => $request->id_siswa,
            ];
            Nilai::create($data);
        }else{
            $nilai = Nilai::where('id_mapel', '=',$request->id_mapel)->where('id_siswa', '=',$request->id_siswa) ;
            $data = [
                'pengetahuan' => $request->nilai,
                'id_mapel' => $request->id_mapel,
                'id_siswa' => $request->id_siswa,
            ];
            $nilai->update($data);
        }

        return redirect()->route('nilais.sort3',$request->id_relasi)
        ->with('success_message', 'Berhasil Memperbarui Nilai');
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
     * @param  \App\Models\Nilai  $nilai
     * @return \Illuminate\Http\Response
     */
    public function show(Nilai $nilai)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Nilai  $nilai
     * @return \Illuminate\Http\Response
     */
    public function edit(Nilai $nilai)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Nilai  $nilai
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Nilai $nilai)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Nilai  $nilai
     * @return \Illuminate\Http\Response
     */
    public function destroy(Nilai $nilai)
    {
        //
    }
}
