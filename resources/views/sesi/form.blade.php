@extends('layouts.app')

@section('content')
    @include('layouts.breadcrumb')
    <div class="card">
        <div class="card-body flex flex-col p-6">
            <header class="flex mb-5 items-center border-b border-slate-100 dark:border-slate-700 pb-5 -mx-6 px-6">
                <div class="flex-1">
                    <div class="card-title text-slate-900 dark:text-white">{{isset($id) ? 'Ubah' : 'Tambah'}} sesi</div>
                </div>
            </header>
            <form action="{{isset($id)?route('sesi.update',$id):route('sesi.store')}}" method="post">
                @csrf
                @if(isset($id))
                    @method('put')
                @endif
                <div class="card-text h-full space-y-4">
                    <div class="input-area">
                        <label for="hari" class="form-label">hari</label>
                        <select name="hari" id="hari" class="form-control @error('hari') is-invalid @enderror">
                            <option value="">pilih</option>
                            @foreach(\App\Helpers\Hari::list() as $item)
                                <option value="{{$item}}"  {{old('hari',isset($id)?$sesi->hari : '') == $item ? 'selected':'' }}>
                                    {{$item}}</option>
                            @endforeach
                        </select>
                        @error('hari')
                        <div class="invalid-feedback">{{$message}}</div>
                        @enderror
                    </div>
                    <div class="input-area">
                        <label for="jam_mulai" class="form-label">jam mulai</label>
                        <input id="jam_mulai" value="{{old('jam_mulai',isset($id)? $sesi->jam_mulai:'')}}" name="jam_mulai" type="time" class="form-control @error('jam_mulai') is-invalid @enderror" placeholder="jam_mulai">
                        @error('jam_mulai')
                        <div class="invalid-feedback">{{$message}}</div>
                        @enderror
                    </div>
                    <div class="input-area">
                        <label for="jam_selesai" class="form-label">jam mulai</label>
                        <input id="jam_selesai" value="{{old('jam_selesai',isset($id)? $sesi->jam_selesai:'')}}" name="jam_selesai" type="time" class="form-control @error('jam_selesai') is-invalid @enderror" placeholder="jam_selesai">
                        @error('jam_selesai')
                        <div class="invalid-feedback">{{$message}}</div>
                        @enderror
                    </div>
                    <div class="input-area">
                        <label for="id_mapel" class="form-label">mapel</label>
                        <select name="id_mapel" id="id_mapel" class="form-control @error('id_mapel') is-invalid @enderror">
                            <option value="">pilih</option>
                            @foreach($mapel as $item)
                                <option value="{{$item->id_mapel}}"  {{old('id_mapel',isset($id)?$sesi->id_mapel : '') == $item->id_mapel ? 'selected':'' }}>
                                    {{$item->mapel.' - '.$item->nama_kelas}}</option>
                            @endforeach
                        </select>
                        @error('id_mapel')
                        <div class="invalid-feedback">{{$message}}</div>
                        @enderror
                    </div>
                    <button type="submit" class="btn btn-primary">{{isset($id)?'Ubah':'Tambah'}}</button>
                </div>
            </form>
        </div>
    </div>
@endsection
