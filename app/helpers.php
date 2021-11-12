<?php
use App\Models\Nilai;
use App\Models\Mapel;
use App\Models\Rombel;
use Carbon\Carbon;


function changeDateFormate($date,$date_format){
    return \Carbon\Carbon::createFromFormat('Y-m-d', $date)->format($date_format);
}

function productImagePath($image_name)
{
    return public_path('images/products/'.$image_name);
}

if(!function_exists("removeWhiteSpace")){

    function removeWhiteSpace($string){

        return strtolower(str_replace("/", "", $string));
    }
}

if(!function_exists("getNilai")){

    function getNilai($id_mapel,$id_siswa){
        if(Nilai::where('id_mapel',$id_mapel)->where('id_siswa',$id_siswa)->count()>0){
            $nilai = Nilai::where('id_mapel',$id_mapel)->where('id_siswa',$id_siswa)->first()->pengetahuan;
            return $nilai;
        }else{
            return 0;
        }
    }
}

if(!function_exists("getMapel")){

    function getMapel($id_mapel){
        if(Mapel::where('id',$id_mapel)->count()>0){
            $mapel = Mapel::where('id',$id_mapel)->first()->nama;
            return $mapel;
        }else{
            return 0;
        }
    }
}

if(!function_exists("getRombel")){

    function getRombel($id_rombel){
        if(Rombel::where('id',$id_rombel)->count()>0){
            $rombel = Rombel::where('id',$id_rombel)->first()->nama;
            return $rombel;
        }else{
            return 0;
        }
    }
}

if(!function_exists("getTanggal")){

    function getTanggal(){
        $today = Carbon::now()->isoFormat('D MMMM Y');
        return $today;
    }
}

