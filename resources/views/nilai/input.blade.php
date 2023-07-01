@extends('layouts.app')

@section('content')
    @include('layouts.breadcrumb')
    <div class="space-y-6">
        <div class="card">
            <div class="card-body flex flex-col p-6">
                <header class="flex mb-5 items-center border-b border-slate-100 dark:border-slate-700 pb-5 -mx-6 px-6">
                    <div class="flex-1">
                        <div class="card-title text-slate-900 dark:text-white">Nilai</div>
                    </div>
                </header>
                <div class="card-text h-full space-y-4">
                    <form action="{{route('guru.nilai')}}">
                        <div class="input-area mb-3">
                            <label for="id_mapel" class="form-label">MATAPELAJARAN</label>
                            <select name="id_mapel" id="id_mapel" class="form-control @error('id_mapel') is-invalid @enderror @if(\Illuminate\Support\Facades\Session::get('message')) is-invalid @endif">
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
                        <button type="submit" class="btn btn-primary btn-sm">Cari</button>
                    </form>
                </div>
            </div>
        </div>
        @if($cari)
            <div class="card">
                <div class="card-body flex flex-col p-6">
                    <header class="flex mb-5 items-center border-b border-slate-100 dark:border-slate-700 pb-5 -mx-6 px-6">
                        <div class="flex-1">
                            <div class="card-title text-slate-900 dark:text-white">Daftar Siswa</div>
                            <p class="text-sm text-secondary-500">Default nilai yaitu <span class="font-bold">0</span>, anda bisa mengubahnya dengan <span class="font-bold">ANGKA LAIN</span>  sesuai dengan nilai siswa</p>
                        </div>
                    </header>
                    <div class="card-text h-full space-y-4">
                        @if(count($data)>0)
                            <form action="{{route('guru.nilai')}}" method="post">
                                @csrf
                                <input type="hidden" name="id_mapel" value="{{\Illuminate\Support\Facades\Request::get('id_mapel')}}">
                                @php
                                    $no = 0;
                                @endphp
                                @foreach($data as $item)
                                    <div class="flex items-center space-x-7 flex-wrap mb-3">
                                        <div class="input-area">
                                            <input type="hidden" class="form-control" name="id_siswa[]" value="{{$item->id_siswa}}" placeholder="Siswa">
                                            <input type="text" class="form-control" name="nama[]" value="{{$item->nama}}" placeholder="Siswa" readonly>
                                        </div>
                                        <div>
                                            <div class="input-area mb-3">
                                                <label for="uh1" class="form-label">NILAI UH1</label>
                                                <input id="uh1" value="{{old('uh1',0)}}" name="uh1[]" type="number" class="form-control @error('uh1') is-invalid @enderror" placeholder="uh1">
                                                @error('uh1')
                                                <div class="invalid-feedback">{{$message}}</div>
                                                @enderror
                                            </div>
                                            <div class="input-area mb-3">
                                                <label for="uh2" class="form-label">NILAI UH2</label>
                                                <input id="uh2" value="{{old('uh2',0)}}" name="uh2[]" type="number" class="form-control @error('uh2') is-invalid @enderror" placeholder="uh2">
                                                @error('uh2')
                                                <div class="invalid-feedback">{{$message}}</div>
                                                @enderror
                                            </div>
                                            <div class="input-area mb-3">
                                                <label for="uh3" class="form-label">NILAI UH3</label>
                                                <input id="uh3" value="{{old('uh3',0)}}" name="uh3[]" type="number" class="form-control @error('uh3') is-invalid @enderror" placeholder="uh3">
                                                @error('uh3')
                                                <div class="invalid-feedback">{{$message}}</div>
                                                @enderror
                                            </div>
                                            <div class="input-area mb-3">
                                                <label for="uts" class="form-label">NILAI UTS</label>
                                                <input id="uts" value="{{old('uts',0)}}" name="uts[]" type="number" class="form-control @error('uts') is-invalid @enderror" placeholder="uts">
                                                @error('uts')
                                                <div class="invalid-feedback">{{$message}}</div>
                                                @enderror
                                            </div>
                                            <div class="input-area mb-3">
                                                <label for="uas" class="form-label">NILAI UAS</label>
                                                <input id="uas" value="{{old('uas',0)}}" name="uas[]" type="number" class="form-control @error('uas') is-invalid @enderror" placeholder="uas">
                                                @error('uas')
                                                <div class="invalid-feedback">{{$message}}</div>
                                                @enderror
                                            </div>
                                        </div>
                                    </div>
                                    <hr>
                                    @php
                                        $no += 1;
                                    @endphp
                                @endforeach
                                <button type="submit" class="btn btn-primary btn-sm mt-4">Simpan</button>
                            </form>
                        @else
                            <h6 class="text-center text-secondary-500">Data kosong</h6>
                        @endif
                    </div>
                </div>
            </div>
        @endif
    </div>
@endsection
