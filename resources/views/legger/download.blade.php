<!doctype html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport"
        content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>LEGGER {{ $data->header->kelas }}</title>
    <style>
        body {
            padding: 10px;
        }
    </style>
</head>

<body>
    <div style="display: grid; grid-template-columns: 140px auto">
        <div style="text-align: center">
            <img src="{{ asset('favicon.png') }}" alt="" width="100px" style="margin-top: 15px">
        </div>
        <div style="text-align: left">
            <h3>MADRARASAH ALIYAH NUR IMAN</h3>
            <p>JL. MASJID PATHOK NEGORO NO. 09, MLANGI, NOGOTIRTO</p>
            <p>Kecamatan Gamping, Kabupaten Sleman - Di Yogyakarta </p>
        </div>
    </div>
    <div style="border:1px dashed black"></div>
    <div style="display: grid; grid-template-columns: auto auto">
        <div>
            <p>Kelas : {{ $data->header->kelas }}</p>
            <p>Madrasah : Madrasah Aliyah Nur Iman</p>
        </div>
        <div>
            <p>Tahun Ajaran : {{ $data->header->tahunajaran }}</p>
            <p>Semester : {{ $data->header->semester }}</p>
        </div>
    </div>
    <h4 style="text-align: center">LEGGER KELAS</h4>

    <div class="table-responsive">
        @foreach ($data->body as $item)
            <h4 class="mb-5 mt-5">{{ $loop->iteration }}. {{ $item->mapel }}</h4>
            <table style="width: 100%;">
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
                @foreach ($item->detail as $d)
                    <tr>
                        <td style="border: 1px solid black">{{ $loop->iteration ?? '' }}</td>
                        <td style="border: 1px solid black">{{ $d->nama ?? '' }}</td>
                        <td style="border: 1px solid black">{{ $d->nilai->uh1 ?? 0 }}</td>
                        <td style="border: 1px solid black">{{ $d->nilai->uh2 ?? 0 }}</td>
                        <td style="border: 1px solid black">{{ $d->nilai->uh3 ?? 0 }}</td>
                        <td style="border: 1px solid black">{{ $d->nilai->uts ?? 0 }}</td>
                        <td style="border: 1px solid black">{{ $d->nilai->uas ?? 0 }}</td>
                    </tr>
                @endforeach
            </table>
        @endforeach
    </div>
    <script>
        window.print();
    </script>
</body>

</html>
