<?php

namespace App\Http\Controllers;

use App\Models\Rombel;
use App\Models\Siswa;
use App\Models\Guru;
use App\Models\Mapel;
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
        // dd($rombel);
        $mapel = Mapel::where('id_rombel',$rombel)->get();
        $rombel = Rombel::find($rombel);
        $all_mapel = Mapel::get();
        $guru = Guru::all();
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
                $mapel = Mapel::find($map);
                $mapel->id_rombel = $rombel;
                $mapel->update();
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

        $mapel = mapel::find($id);
        $rombel = Rombel::find($mapel->id_rombel);
        $mapel->id_rombel = 0;
        $mapel->update();

        return redirect()->route('rombels.pembelajaran',$rombel)
            ->with('success_message', 'Berhasil Mengeluarkan Pembelajaran Kelas baru');
    }

    public function set_guru(Request $request, $mapel)
    {

            $request->validate([
                'guru_id' => 'required',
            ]);

            $guru = Guru::find($request->guru_id);
        // dd($guru);
        $guru->mapel_id = $mapel;
        $guru->update();

        $mapel = mapel::find($mapel);
        $rombel = Rombel::find($mapel->id_rombel);

        return redirect()->route('rombels.pembelajaran',$rombel)
            ->with('success_message', 'Berhasil Memperbarui Guru Pengajar');
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
