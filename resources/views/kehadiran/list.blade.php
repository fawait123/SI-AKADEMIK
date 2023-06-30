@extends('layouts.app')

@section('content')
    @include('layouts.breadcrumb')
    <div class=" space-y-5">

        <div class="card">
            <div class="card-body flex flex-col p-6">
                <header class="flex mb-5 items-center border-b border-slate-100 dark:border-slate-700 pb-5 -mx-6 px-6">
                    <div class="flex-1">
                        <div class="card-title text-slate-900 dark:text-white">Kehadiran</div>
                    </div>
                </header>
                <div class="card-text h-full space-y-4">
                    <form action="{{route('kehadiran.list')}}">

                        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-7 mb-3">
                            <div class="input-area relative">
                                <label for="id_mapel" class="form-label">MATAPELAJARAN</label>
                                <select name="id_mapel" id="id_mapel" class="form-control @error('id_mapel') is-invalid @enderror @if(\Illuminate\Support\Facades\Session::get('message')) is-invalid @endif" required>
                                    <option value="">pilih</option>
                                    @foreach($mapel as $item)
                                        <option value="{{$item->id_mapel}}"  {{old('kelas', \Illuminate\Support\Facades\Request::get('id_mapel')) == $item->id_mapel ? 'selected':'' }}>{{$item->nama_kelas.' '.$item->mapel}}</option>
                                    @endforeach
                                </select>
                                @error('id_mapel')
                                <div class="invalid-feedback">{{$message}}</div>
                                @enderror
                                @if(\Illuminate\Support\Facades\Session::get('message'))
                                    <div class="invalid-feedback">{{\Illuminate\Support\Facades\Session::get('message')}}</div>
                                @endif
                            </div>
                            <div class="input-area relative">
                                <label for="largeInput" class="form-label">Tanggal Mulai</label>
                                <input type="date" name="start_date" class="form-control" value="{{\Illuminate\Support\Facades\Request::get('end_date')}}" placeholder="Full Name">
                            </div>
                            <div class="input-area relative">
                                <label for="largeInput" class="form-label">Tanggal Akhir</label>
                                <input type="date" name="end_date" class="form-control" value="{{\Illuminate\Support\Facades\Request::get('end_date')}}" placeholder="Enter Your Email">
                            </div>
                        </div>
                        <button type="submit" class="btn btn-primary btn-sm">Cari</button>
                    </form>

                    @if(count($datas)>0)
                        <div class="overflow-x-auto -mx-6">
                            <span class=" col-span-8  hidden"></span>
                            <span class="  col-span-4 hidden"></span>
                            <div class="inline-block min-w-full align-middle">
                                <div class="overflow-hidden">
                                    <table class="min-w-full divide-y divide-slate-100 table-fixed dark:divide-slate-700">
                                        <thead class=" bg-slate-200 dark:bg-slate-700">
                                        <tr>
                                            <th scope="col" class=" table-th">#</th>
                                            @foreach($dataMonth as $month)
                                                <th scope="col" class=" table-th">{{$month->format('d M y')}}</th>
                                            @endforeach
                                        </tr>
                                        </thead>
                                        <tbody class="bg-white divide-y divide-slate-100 dark:bg-slate-800 dark:divide-slate-700">
                                        @foreach($datas as $item)
                                            <tr>
                                                <td class="table-td">{{$item['siswa']}}</td>
                                                @foreach($item['detail'] as $absen)
                                                    <td class="table-td bg-{{$absen['absen'] == 'hadir' ? 'success': ''}}{{$absen['absen'] == 'ijin' ? 'warning': ''}}{{$absen['absen'] == 'alpha' ? 'danger': ''}}-300 p-2 m-3"><span class="font-bold">{{ucfirst($absen['absen'][0])}}</span></td>
                                                @endforeach
                                            </tr>
                                        @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
@endsection
