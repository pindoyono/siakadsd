<?php

namespace App\Http\Controllers;

use App\Models\Rombel;
use App\Models\Siswa;
use App\Models\Guru;
use App\Models\Mapel;
use App\Models\Relasi_rombel_mapel;
use Illuminate\Http\Request;
use DB;


class RombelController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    // function __construct()
    // {
    //      $this->middleware('permission:kelas-list|kelas-create|kelas-edit|kelas-delete', ['only' => ['index','store']]);
    //      $this->middleware('permission:kelas-create', ['only' => ['create','store']]);
    //      $this->middleware('permission:kelas-edit', ['only' => ['edit','update']]);
    //      $this->middleware('permission:kelas-delete', ['only' => ['destroy']]);
    // }


    public function index()
    {
        //
        $rombels = Rombel::all();
        $guru = Guru::all();

        return view('kelas.index', [
            'rombels' => $rombels,
            'guru' => $guru
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
        // dd($rombel);
        $anggota = Siswa::where('id_rombel',$rombel->id)->get();
        $non_anggota = Siswa::where('id_rombel',0)->get();
        return view('kelas.anggota', [
            'rombel' => $rombel,
            'anggota' => $anggota,
            'non_anggota' => $non_anggota,
        ]);
    }

    public function pembelajaran($rombel)
    {
        //
        // $mapel = Mapel::where('id_rombel',$rombel)->get();
        $mapel = DB::table('mapels')
            ->join('relasi_rombel_mapels', 'mapels.id', '=', 'relasi_rombel_mapels.id_mapel')
            ->join('rombels', 'rombels.id', '=', 'relasi_rombel_mapels.id_rombel')
            ->where('rombels.id', $rombel)
            ->select('mapels.*','relasi_rombel_mapels.id as id_relasi_rombel_mapels','relasi_rombel_mapels.id_guru as id_guru')
            ->get();

        $notin = DB::table('mapels')
        ->join('relasi_rombel_mapels', 'mapels.id', '=', 'relasi_rombel_mapels.id_mapel')
        ->join('rombels', 'rombels.id', '=', 'relasi_rombel_mapels.id_rombel')
        ->where('rombels.id', $rombel)
        ->select('mapels.id')
        ->get()->toArray();

        foreach ($notin as $not) {
            $array[] = $not->id;
        }




        // $all_mapel = DB::table('mapels')
        // ->whereNotIn('id', $array)
        // ->get();
        $all_mapel = Mapel::whereNotIn('id', $array)->get();

        // dd($all_mapel);

        $guru = Guru::all();
        $rombel = Rombel::find($rombel);

        return view('kelas.pembelajaran', [
            'rombel' => $rombel,
            'mapel' => $mapel,
            'guru' => $guru,
            'all_mapel' => $all_mapel,
        ]);
    }

    public function anggota(Request $request,$rombel)
    {
        //

        $request->validate([
            'anggota' => 'required',
        ]);

        foreach ($request->anggota as $agg){
                $siswa = Siswa::find($agg);
                $siswa->id_rombel = $rombel;
                $siswa->update();
            }

        $rombel = Rombel::find($rombel);
        return redirect()->route('rombels.show',$rombel)
            ->with('success_message', 'Berhasil Menambahkan anggota Kelas baru');
    }

    public function mapel(Request $request,$rombel)
    {
        //

        $request->validate([
            'mapel' => 'required',
        ]);

        foreach ($request->mapel as $map){

            if (Relasi_rombel_mapel::where('id_mapel', '=',$map)->where('id_rombel', '=',$rombel)->count()==0) {
                $data = [
                    'id_mapel' => $map,
                    'id_rombel' => $rombel,
                ];

                Relasi_rombel_mapel::create($data);
            }

        }


        $rombel = Rombel::find($rombel);
        return redirect()->route('rombels.pembelajaran',$rombel)
            ->with('success_message', 'Berhasil Menambahkan anggota Pembeljaran baru');
    }

    public function keluar($id)
    {

        $siswa = Siswa::find($id);
        $rombel = Rombel::find($siswa->id_rombel);
        $siswa->id_rombel = 0;
        $siswa->update();

        return redirect()->route('rombels.show',$rombel)
            ->with('success_message', 'Berhasil Mengeluarkan anggota Kelas baru');
    }

    public function keluar2($id)
    {

        $relasi = Relasi_rombel_mapel::find($id);
        $rombel = Rombel::find($relasi->id_rombel);
        $relasi->delete();

        return redirect()->route('rombels.pembelajaran',$rombel)
            ->with('success_message', 'Berhasil Mengeluarkan Pembelajaran Kelas baru');
    }

    public function set_guru(Request $request, $relasi)
    {

            $request->validate([
                'guru_id' => 'required',
            ]);

            $relasi = Relasi_rombel_mapel::find($relasi);
        // dd($guru);
        $data = [
            'id_guru' => $request->guru_id,
        ];

        $relasi->update($data);


        return redirect()->back()->with('success_message', 'Berhasil Memperbarui Guru Pengajar');
    }

    public function set_wali(Request $request, $rombel_id)
    {

            $request->validate([
                'guru_id' => 'required',
            ]);

            $guru = Guru::find($request->guru_id);
        // dd($guru);
        $data = [
            'wali_id' => $rombel_id,
        ];

        if(Guru::where('wali_id',$rombel_id)->count()>0){
            return redirect()->back()->with('errors_message', 'Silahkan pilih Guru Lain,Guru Sudah Menjadi walikelas ');
        }else{
            $guru->update($data);
            return redirect()->back()->with('success_message', 'Berhasil Memperbarui Wali Kelas');
        }

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
