@extends('layouts.app')

@section('content')
    @include('layouts.breadcrumb')
    <div class=" space-y-5">
        <div class="card">
            <div class="card-body px-6 pb-6">
                <div style="display: grid; grid-template-columns: auto auto">
                    <div>
                        <p>Kelas : {{$data->header->kelas}}</p>
                        <p>Madrasah : Madrasah Aliyah Nur Iman</p>
                        &nbsp;
                        <p>Download : <a href="{{route('legger.download')}}" target="_blank" class="btn btn-primary btn-sm">klik disini</a></p>
                    </div>
                    <div>
                        <p>Tahun Ajaran : {{$data->header->tahunajaran}}</p>
                        <p>Semester : {{$data->header->semester}}</p>
                    </div>
                </div>
                <h6 class="text-center mt-5">LEGGER KELAS</h6>

                <div class="table-responsive">
                   @foreach($data->body as $item)
                        <h6 class="mb-5 mt-5">{{$loop->iteration}}. {{$item->mapel}}</h6>
                        <table class="w-full">
                            <tr>
                                <th class="border-[1.5px]" rowspan="2" width="5%">NO</th>
                                <th class="border-[1.5px]" rowspan="2" width="45%">NAMA</th>
                                <th class="border-[1.5px]" colspan="5">
                                    NILAI
                            <tr>
                                <th class="border-[1.5px]">UH1</th>
                                <th class="border-[1.5px]">UH2</th>
                                <th class="border-[1.5px]">UH3</th>
                                <th class="border-[1.5px]">UTS</th>
                                <th class="border-[1.5px]">UAS</th>
                            </tr>
                            @foreach($item->detail as $d)
                                <tr>
                                    <td class="border-[1.5px]">{{$loop->iteration}}</td>
                                    <td class="border-[1.5px]">{{$d->nama}}</td>
                                    <td class="border-[1.5px]">{{$d->nilai->uh1}}</td>
                                    <td class="border-[1.5px]">{{$d->nilai->uh2}}</td>
                                    <td class="border-[1.5px]">{{$d->nilai->uh3}}</td>
                                    <td class="border-[1.5px]">{{$d->nilai->uts}}</td>
                                    <td class="border-[1.5px]">{{$d->nilai->uas}}</td>
                                </tr>
                            @endforeach
                        </table>
                   @endforeach
                </div>
            </div>
        </div>
    </div>
@endsection
