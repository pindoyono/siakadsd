<!DOCTYPE html>
<html>
<head>
    <title>Hi</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <style>
    .center {
    /* display: block; */
    margin-left: auto;
    margin-right: auto;
    text-align: center;
    }

    .judul{
        margin-bottom:150px;
    }

    .kotak {
        width: 310px;  /* content width */
        height: 10px;  /* content height */
        float: left;
        padding: 15px;  /* space between content and border */
        border-width: 0px;  /* border thickness */

        border-style:solid;
        border-radius:0px; /* round corners */
        /* background-color:#F4F4F4; try red, orange, ... */
    }

    .box {
        width: 300px;  /* content width */
        height: 10px;  /* content height */
        padding: 20px;  /* space between content and border */
        border-width: 2px;  /* border thickness */

        border-style:solid;
        border-radius:0px; /* round corners */
        /* background-color:#F4F4F4; try red, orange, ... */
    }
    .box1 {
        margin-left: auto;
        margin-right: auto;
        width: 300px;  /* content width */
        height: 300px;  /* content height */
        padding: 20px;  /* space between content and border */
        border-width: 0px;  /* border thickness */

        border-style:solid;
        border-radius:0px; /* round corners */
        background-image: url("{{ public_path('images/tutwuri.png') }}");
        background-size:cover;
        /* background-color:#F4F4F4; try red, orange, ... */
    }

    .jarak{
        padding-top:40px;
        padding-bottom:40px;
        width: 30px;  /* content width */
        height: 30px;
        border-width: 0px;  /* border thickness */

    }
    .jarak2{
        width: 25px;  /* content width */
        height: 25px;
        border-width: 0px;  /* border thickness */

    }
    .page-break {
    page-break-after: always;
    }

    table {
  font-family: arial, sans-serif;
  border-collapse: collapse;
  width: 100%;
  margin-bottom: 100px;
}

td, th {
  border: 1px solid #dddddd;
  text-align: left;
  padding: 8px;
}

tr:nth-child(even) {
  background-color: #dddddd;
}

    </style>
</head>
<body>
    <div class="">
        <div class="box1">

        </div>
    </div>
    <div class="jarak">

    </div>
    <div class="center judul">
        <h2 class="center judul"> RAPOR PESERTA DIDIK SEKOLAH DASAR (SD) </h2>
    </div>
    <div class="jarak">

    </div>
    <h3 class="center"> Nama Peserta Didik </h3>
    <div class="jarak2">

    </div>
    <div class="box center">
        {{ $siswa->nama }}
    </div>
    <h3 class="center"> NISN/NIS </h3>
    <div class="jarak2">

    </div>
    <div class="box center">
        {{ removeWhiteSpace($siswa->tanggal_lahir) }}
    </div>
    <div class="jarak2">

    </div>
    <div class="center judul">
        <h2 class="center judul"> KEMENTERIAN PENDIDIKAN DAN KEBUDAYAAN REPUBLIK INDONESIA </h2>
    </div>


    <div class="page-break"></div>
    <h2>Daftar Nilai Siswa</h2>

<table>
  <tr style="text-align:center">
    <th style="text-align:center">No.</th>
    <th style="text-align:center">Mata Pelajaran</th>
    <th style="text-align:center">Nilai</th>
    <th style="text-align:center">Predikat</th>
  </tr>
  <tr>
    <td colspan="4"> Kelompok A</td>
</tr>
    @foreach($mapela as $key => $map)
        <tr>
            <td>{{$key+1}}</td>
            <td>
                {{$map->nama_mapel}}
            </td>
            <td style="text-align:center">
                {{
                    getNilai($map->id_mapel,$id_siswa)
                }}
            </td>
            <td style="text-align:center">
                @php
                        if (getNilai($map->id_mapel,$id_siswa) == "") {
                        echo "";
                    } else if (getNilai($map->id_mapel,$id_siswa) >= 0 && getNilai($map->id_mapel,$id_siswa) <= 49) {
                    echo 'E';
                    } else if (getNilai($map->id_mapel,$id_siswa) >= 50 && getNilai($map->id_mapel,$id_siswa) <= 59) {
                        echo 'D';
                    } else if (getNilai($map->id_mapel,$id_siswa) >= 60 && getNilai($map->id_mapel,$id_siswa) <= 69) {
                        echo 'C';
                    } else if (getNilai($map->id_mapel,$id_siswa) >= 70 && getNilai($map->id_mapel,$id_siswa) <= 79) {
                        echo 'B';
                    }else if (getNilai($map->id_mapel,$id_siswa) >= 80 && getNilai($map->id_mapel,$id_siswa) <= 100) {
                        echo 'A';
                    } else{
                        echo '-';
                    }
                @endphp
            </td>
        </tr>
    @endforeach
<tr>
    <td colspan="4"> Kelompok B</td>
</tr>
    @foreach($mapelb as $key => $map)
    <tr>
        <td>{{$key+1}}</td>
        <td>
            {{$map->nama_mapel}}
        </td>
        <td style="text-align:center">
            {{
                getNilai($map->id_mapel,$id_siswa)
            }}
        </td>
        <td style="text-align:center">
                @php
                    if (getNilai($map->id_mapel,$id_siswa) == "") {
                        echo "";
                    } else if (getNilai($map->id_mapel,$id_siswa) >= 0 && getNilai($map->id_mapel,$id_siswa) <= 49) {
                    echo 'E';
                    } else if (getNilai($map->id_mapel,$id_siswa) >= 50 && getNilai($map->id_mapel,$id_siswa) <= 59) {
                        echo 'D';
                    } else if (getNilai($map->id_mapel,$id_siswa) >= 60 && getNilai($map->id_mapel,$id_siswa) <= 69) {
                        echo 'C';
                    } else if (getNilai($map->id_mapel,$id_siswa) >= 70 && getNilai($map->id_mapel,$id_siswa) <= 79) {
                        echo 'B';
                    }else if (getNilai($map->id_mapel,$id_siswa) >= 80 && getNilai($map->id_mapel,$id_siswa) <= 100) {
                        echo 'A';
                    } else{
                        echo '-';
                    }
                @endphp
        </td>
    </tr>
    @endforeach
</table>

<div style="text-align: center" class="kotak">
    Mengetahui: <br>
    Orangtua/Wali,
    <br>
    <br>
    <br>
    <br>
    <br>
    <hr style="width:200px">
</div>

<div style="text-align: center" class="kotak">
        Malinau, {{ getTanggal() }} <br>
        Guru Kelas,
        <br>
        <br>
        <br>
        <br>
        <br>
        <hr style="width:200px">
</div>
<div class="jarak">

</div>
<div class="jarak">

</div>
<div style="text-align: center">
    Mengetahui, <br>
    Kepala Sekolah
    <br>
    <br>
    <br>
    <br>
    <br>
    <hr style="width:200px">
</div>

</body>
</html>
