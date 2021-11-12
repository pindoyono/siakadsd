<?php

namespace App\Http\Controllers;

use App\Models\Jadwal;
use App\Models\Rombel;
use App\Models\Guru;
use App\Models\Siswa;
use App\Models\Mapel;
use Illuminate\Http\Request;
use DB;
use Auth;

class JadwalController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $kelas = Rombel::all();
        $guru = Guru::all();
        $mapel = Mapel::all();
        // $mapel = DB::table('mapels')
        // ->join('relasi_rombel_mapels', 'mapels.id', '=', 'relasi_rombel_mapels.id_mapel')
        // ->join('rombels', 'rombels.id', '=', 'relasi_rombel_mapels.id_rombel')
        // ->join('gurus', 'gurus.id', '=', 'relasi_rombel_mapels.id_guru')
        // ->select('mapels.*','gurus.nama as nama_guru','relasi_rombel_mapels.id_guru as id_guru')
        // ->get();
        return view('jadwals.index', [
            'kelas' => $kelas,
            'guru' => $guru,
            'mapel' => $mapel,
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
        $request->validate([
            'hari_id' => 'required',
            'kelas_id' => 'required',
            'guru_id' => 'required',
            'jam_mulai' => 'required',
            'jam_selesai' => 'required',
            'mapel_id' => 'required',
        ]);

        $data = [
            'hari' => $request->hari_id,
            'jam_mulai' => $request->jam_mulai,
            'jam_selesai' => $request->jam_selesai,
            'id_mapel' => $request->mapel_id,
            'id_guru' => $request->guru_id,
            'id_rombel' => $request->kelas_id,
        ];

        // dd($data);

        $jadwals = Jadwal::create($data);
        return redirect()->route('jadwals.lihat',$request->kelas_id)
            ->with('success_message', 'Berhasil menambah Jadwal baru');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Jadwal  $jadwal
     * @return \Illuminate\Http\Response
     */
    public function show(Jadwal $jadwal)
    {
        //

        // dd('tes');
        $kelas = Rombel::all();
        $guru = Guru::all();
        $mapel = Mapel::all();
        // $mapel = DB::table('mapels')
        // ->join('relasi_rombel_mapels', 'mapels.id', '=', 'relasi_rombel_mapels.id_mapel')
        // ->join('rombels', 'rombels.id', '=', 'relasi_rombel_mapels.id_rombel')
        // ->join('gurus', 'gurus.id', '=', 'relasi_rombel_mapels.id_guru')
        // ->select('mapels.*','gurus.nama as nama_guru','relasi_rombel_mapels.id_guru as id_guru')
        // ->get();
        return view('jadwals.show', [
            'kelas' => $kelas,
            'guru' => $guru,
            'mapel' => $mapel,
        ]);
    }
    public function lihat($id_kelas)
    {
        //

        // dd('tes');
        $kelas = Rombel::all();
        $guru = Guru::all();
        $mapel = Mapel::all();
        $jadwal = DB::table('jadwals')
        ->join('rombels', 'rombels.id', '=', 'jadwals.id_rombel')
        ->join('gurus', 'gurus.id', '=', 'jadwals.id_guru')
        ->join('mapels', 'mapels.id', '=', 'jadwals.id_mapel')
        ->select('jadwals.*','rombels.nama as nama_rombel','gurus.Nama as nama_guru','mapels.nama as nama_mapel')
        ->where('rombels.id',$id_kelas)
        ->orderBy('jadwals.id')
        ->get();
        return view('jadwals.show', [
            'jadwal' => $jadwal,
            'kelas' => $kelas,
            'guru' => $guru,
            'mapel' => $mapel,
        ]);
    }

    public function jadwal_siswa()
    {
        //
        $id = Auth::user()->id;
        $id_rombel = Siswa::where('user_id',$id)->pluck('id_rombel');
        $kelas = Rombel::all();
        $guru = Guru::all();
        $mapel = Mapel::all();
        $jadwal = DB::table('jadwals')
        ->join('rombels', 'rombels.id', '=', 'jadwals.id_rombel')
        ->join('gurus', 'gurus.id', '=', 'jadwals.id_guru')
        ->join('mapels', 'mapels.id', '=', 'jadwals.id_mapel')
        ->select('jadwals.*','rombels.nama as nama_rombel','gurus.Nama as nama_guru','mapels.nama as nama_mapel')
        ->where('rombels.id',$id_rombel)
        ->orderBy('jadwals.hari')
        ->get();
        return view('jadwals.guru', [
            'jadwal' => $jadwal,
            'kelas' => $kelas,
            'guru' => $guru,
            'mapel' => $mapel,
        ]);
    }

    public function jadwal_guru()
    {
        //

        // dd('tes');
        $id = Auth::user()->id;
        $id_guru = Guru::where('user_id',$id)->pluck('id');
        $kelas = Rombel::all();
        $guru = Guru::all();
        $mapel = Mapel::all();
        $jadwal = DB::table('jadwals')
        ->join('rombels', 'rombels.id', '=', 'jadwals.id_rombel')
        ->join('gurus', 'gurus.id', '=', 'jadwals.id_guru')
        ->join('mapels', 'mapels.id', '=', 'jadwals.id_mapel')
        ->select('jadwals.*','rombels.nama as nama_rombel','gurus.Nama as nama_guru','mapels.nama as nama_mapel')
        ->where('id_guru',$id_guru)
        ->orderBy('jadwals.hari')
        ->get();
        return view('jadwals.guru', [
            'jadwal' => $jadwal,
            'kelas' => $kelas,
            'guru' => $guru,
            'mapel' => $mapel,
        ]);
    }
    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Jadwal  $jadwal
     * @return \Illuminate\Http\Response
     */
    public function edit(Jadwal $jadwal)
    {
        //
        $kelas = Rombel::all();
        $guru = Guru::all();
        $mapel = Mapel::all();
        return view('jadwals.edit', [
            'jadwal' => $jadwal,
            'kelas' => $kelas,
            'guru' => $guru,
            'mapel' => $mapel,
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Jadwal  $jadwal
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Jadwal $jadwal)
    {
        //
        $id_rombel = $jadwal->id_rombel;
        $request->validate([
            'hari_id' => 'required',
            'kelas_id' => 'required',
            'guru_id' => 'required',
            'jam_mulai' => 'required',
            'jam_selesai' => 'required',
            'mapel_id' => 'required',
        ]);


        $data = [
            'hari' => $request->hari_id,
            'jam_mulai' => $request->jam_mulai,
            'jam_selesai' => $request->jam_selesai,
            'id_mapel' => $request->mapel_id,
            'id_guru' => $request->guru_id,
            'id_rombel' => $request->kelas_id,
        ];

        // dd($data);
        $jadwal->update($data);
        return redirect()->route('jadwals.lihat',$id_rombel)
            ->with('success_message', 'Berhasil menambah Jadwal baru');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Jadwal  $jadwal
     * @return \Illuminate\Http\Response
     */
    public function destroy(Jadwal $jadwal)
    {
        $id_rombel = $jadwal->id_rombel;
        // dd($jadwal->id_rombel);
        $jadwal->delete();
        return redirect()->route('jadwals.lihat',$id_rombel)
                        ->with('success_message','Data Jadwal Berhasi Di Hapus');
    }
}
