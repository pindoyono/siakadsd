<?php

namespace App\Http\Controllers;

use App\Models\Mapel;
use Illuminate\Http\Request;

class MapelController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    function __construct()
    {
     $this->middleware('permission:mapel-list|mapel-create|mapel-edit|mapel-delete', ['only' => ['index','store']]);
     $this->middleware('permission:mapel-create', ['only' => ['create','store']]);
     $this->middleware('permission:mapel-edit', ['only' => ['edit','update']]);
     $this->middleware('permission:mapel-delete', ['only' => ['destroy']]);
    }


    public function index()
    {
        //
        $mapels = Mapel::all();
        return view('mapels.index', [
            'mapels' => $mapels
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
        return view('mapels.create');
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
        // dd($request->all());
        $request->validate([
            'nama' => 'required',
            'kelompok'  => 'required',
            'no_urut' => 'required',
        ]);

        $array = $request->only([
            'nama','kelompok','no_urut',
        ]);

        $guru = Mapel::create($array);
        return redirect()->route('mapels.index')
            ->with('success_message', 'Berhasil menambah Mata Pelajaran baru');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Mapel  $mapel
     * @return \Illuminate\Http\Response
     */
    public function show(Mapel $mapel)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Mapel  $mapel
     * @return \Illuminate\Http\Response
     */
    public function edit(Mapel $mapel)
    {
        //
        return view('mapels.edit', [
            'mapel' => $mapel
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Mapel  $mapel
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Mapel $mapel)
    {
        //
        $request->validate([
            'nama' => 'required',
            'kelompok'  => 'required',
            'no_urut' => 'required',
        ]);
        $mapel->update($request->all());

        return redirect()->route('mapels.index')
                        ->with('success_message','Data Mata Pelajarn Berhasi Di Ubah');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Mapel  $mapel
     * @return \Illuminate\Http\Response
     */
    public function destroy(Mapel $mapel)
    {
        //
        $mapel->delete();

        return redirect()->route('mapels.index')
                        ->with('success_message','Data Mata Pelajaran Berhasi Di Hapus');
    }
}
