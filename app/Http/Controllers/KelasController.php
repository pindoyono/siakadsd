<?php

namespace App\Http\Controllers;

use App\Models\Kelas;
use Illuminate\Http\Request;

class KelasController extends Controller
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
        //
        $kelas = Kelas::all();
        return view('kelas.index', [
            'kelas' => $kelas
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
            'tingkat'    => 'required',
        ]);

        $array = $request->only([
            'nama','tingkat',
        ]);

        $kelas = Kelas::create($array);
        return redirect()->route('kelas.index')
            ->with('success_message', 'Berhasil menambah Kelas baru');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Kelas  $kelas
     * @return \Illuminate\Http\Response
     */
    public function show(Kelas $kelas)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Kelas  $kelas
     * @return \Illuminate\Http\Response
     */
    public function edit(Kelas $kelas)
    {
        //
        return view('kelas.edit', [
            'kelas' => $kelas
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Kelas  $kelas
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Kelas $kelas)
    {
        //
        $request->validate([
            'nama' => 'required',
            'tingkat'    => 'required',
        ]);
        $kelas->update($request->all());

        return redirect()->route('kelas.index')
                        ->with('success_message','Data Kelas Berhasi Di Ubah');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Kelas  $kelas
     * @return \Illuminate\Http\Response
     */
    public function destroy(Kelas $kelas)
    {
        //
    }
}
