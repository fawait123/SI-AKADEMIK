<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <style>
        body{
            padding: 20px;
        }
    </style>
</head>
<body>
<div  style="display: grid; grid-template-columns: 140px auto">
    <div style="text-align: center">
        <img src="{{asset('favicon.png')}}" alt="" width="100px" style="margin-top: 15px">
    </div>
    <div style="text-align: left">
        <h3>MADRARASAH ALIYAH NUR IMAN</h3>
        <p>JL. MASJID PATHOK NEGORO NO. 09, MLANGI, NOGOTIRTO</p>
        <p>Kecamatan Gamping, Kabupaten Sleman - Di Yogyakarta </p>
    </div>
</div>
@foreach($data->body as $item)
    <div style="border: 1px dashed black; margin-top: 30px;"></div>
    <div style="display: grid; grid-template-columns: auto auto; margin-top: 20px; margin-bottom: 20px">
        <div>
            <p>Nama : {{$item->siswa->nama}}</p>
            <p>NIS : {{$item->siswa->nis}}</p>
            <p>NISN : {{$item->siswa->nisn}}</p>
            <p>Status Kelas : {{$item->rata_rata > 70 ? 'Naik Kelas' : 'Tidak Naik Kelas'}}</p>
        </div>
        <div>
            <p>Madrasah : Madrasah Aliyah Nur Iman</p>
            <p>Kelas/semester : {{$data->header->kelas}}</p>
            <p>Tahun Ajaran : {{$data->header->tahunajaran}}</p>
        </div>
    </div>
    <div style="border: 1px dashed black; margin-bottom: 30px"></div>
    <table class="w-full" style="width: 100%">
        <tr>
            <th style="border: 1px solid black" rowspan="2" width="5%">NO</th>
            <th style="border: 1px solid black" rowspan="2" width="45%">NAMA</th>
            <th style="border: 1px solid black" colspan="5">
                NILAI
        <tr>
            <th style="border: 1px solid black">UH1</th>
            <th style="border: 1px solid black">UH2</th>
            <th style="border: 1px solid black">UH3</th>
            <th style="border: 1px solid black">UTS</th>
            <th style="border: 1px solid black">UAS</th>
        </tr>
        @foreach($item->detail as $d)
            <tr>
                <td style="border: 1px solid black">{{$loop->iteration}}</td>
                <td style="border: 1px solid black">{{$d->mapel}}</td>
                <td style="border: 1px solid black">{{$d->nilai->uh1}}</td>
                <td style="border: 1px solid black">{{$d->nilai->uh2}}</td>
                <td style="border: 1px solid black">{{$d->nilai->uh3}}</td>
                <td style="border: 1px solid black">{{$d->nilai->uts}}</td>
                <td style="border: 1px solid black">{{$d->nilai->uas}}</td>
            </tr>
        @endforeach
        <tr>
            <th style="border: 1px solid black; text-align: left" colspan="2">NILAI RATA RATA</th>
            <th style="border: 1px solid black; text-align: left" colspan="5">{{$item->rata_rata}}</th>
        </tr>
    </table>
@endforeach
<script>
    window.print()
</script>
</body>
</html>
