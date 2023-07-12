@extends('layouts.app')

@section('content')
    @include('layouts.breadcrumb')
    <div class=" space-y-5">
        <div class="card px-6 pb-6">
            <div class="card-body p-4">
                <form action="{{route('raport.index')}}" method="get" style="display: inline;">
                    <div class="flex-row mb-3">
                        <div class="form-group">
                            <label for="id_siswa">SISWA</label>
                            <select name="id_siswa" id="id_siswa" class="form-control">
                                <option value="">pilih</option>
                                @foreach($data->siswa as $item)
                                    <option value="{{$item->id_siswa}}" {{ \Illuminate\Support\Facades\Request::filled('id_siswa')  ? \Illuminate\Support\Facades\Request::get('id_siswa') == $item->id_siswa ? 'selected':'':''}}>{{$item->nama}}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <button type="submit" class="btn btn-success btn-sm">Cari</button>
                </form>
                <a href="{{route('raport.download')}}{{\Illuminate\Support\Facades\Request::filled('id_siswa') ? '?id_siswa='.\Illuminate\Support\Facades\Request::get('id_siswa'):''}}" target="_blank" class="btn btn-primary btn-sm">Download</a>
            </div>
        </div>
        <div class="card">
            <div class="card-body px-6 pb-6">
                <h6 class="text-center mt-5">RAPORT KELAS</h6>

                <div class="table-responsive">
                    @foreach($data->body as $item)
                        <div style="border: 1px dashed black; margin-top: 30px;"></div>
                        <div style="display: grid; grid-template-columns: auto auto; margin-top: 20px; margin-bottom: 20px">
                            <div>
                                <p>Nama : {{$item->siswa->nama}}</p>
                                <p>NIS : {{$item->siswa->nis}}</p>
                                <p>NISN : {{$item->siswa->nisn}}</p>
                                <p>Status Kelas : <span class="badge bg-{{$item->rata_rata > 70 ? 'primary':'danger'}}-400 text-white">{{$item->rata_rata > 70 ? 'Naik Kelas':'Tidak Naik Kelas'}}</span></p>
                            </div>
                            <div>
                                <p>Madrasah : Madrasah Aliyah Nur Iman</p>
                                <p>Kelas/semester : {{$data->header->kelas}}</p>
                                <p>Tahun Ajaran : {{$data->header->tahunajaran}}</p>
                            </div>
                        </div>
                        <div style="border: 1px dashed black; margin-bottom: 30px"></div>
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
                                    <td class="border-[1.5px]">{{$d->mapel}}</td>
                                    <td class="border-[1.5px]">{{$d->nilai->uh1}}</td>
                                    <td class="border-[1.5px]">{{$d->nilai->uh2}}</td>
                                    <td class="border-[1.5px]">{{$d->nilai->uh3}}</td>
                                    <td class="border-[1.5px]">{{$d->nilai->uts}}</td>
                                    <td class="border-[1.5px]">{{$d->nilai->uas}}</td>
                                </tr>
                            @endforeach
                            <tr>
                                <th class="border-[1.5px] text-left" colspan="2">NILAI RATA RATA</th>
                                <th class="border-[1.5px] text-left" colspan="5">{{$item->rata_rata}}</th>
                            </tr>
                        </table>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
@endsection
