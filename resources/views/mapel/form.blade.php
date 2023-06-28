@extends('layouts.app')

@section('content')
    @include('layouts.breadcrumb')
    <div class="card">
        <div class="card-body flex flex-col p-6">
            <header class="flex mb-5 items-center border-b border-slate-100 dark:border-slate-700 pb-5 -mx-6 px-6">
                <div class="flex-1">
                    <div class="card-title text-slate-900 dark:text-white">{{isset($id) ? 'Ubah' : 'Tambah'}} mapel</div>
                </div>
            </header>
            <form action="{{isset($id)?route('mapel.update',$id):route('mapel.store')}}" method="post">
                @csrf
                @if(isset($id))
                    @method('put')
                @endif
                <div class="card-text h-full space-y-4">
                    <div class="input-area">
                        <label for="mapel" class="form-label">mapel</label>
                        <input id="mapel" value="{{old('mapel',isset($id)? $mapel->mapel:'')}}" name="mapel" type="text" class="form-control @error('mapel') is-invalid @enderror" placeholder="mapel">
                        @error('mapel')
                        <div class="invalid-feedback">{{$message}}</div>
                        @enderror
                    </div>
                    <div class="input-area">
                        <label for="nama_kelas" class="form-label">kelas</label>
                        <select name="nama_kelas" id="nama_kelas" class="form-control @error('nama_kelas') is-invalid @enderror">
                            <option value="">pilih</option>
                            @foreach(\App\Helpers\Kelas::list() as $item)
                                <option value="{{$item}}"  {{old('nama_kelas',isset($id)?$mapel->nama_kelas : '') == $item ? 'selected':'' }}>
                                    {{$item}}</option>
                            @endforeach
                        </select>
                        @error('nama_kelas')
                        <div class="invalid-feedback">{{$message}}</div>
                        @enderror
                    </div>
                    <div class="input-area">
                        <label for="id_guru" class="form-label">guru</label>
                        <select name="id_guru" id="id_guru" class="form-control @error('id_guru') is-invalid @enderror">
                            <option value="">pilih</option>
                            @foreach($guru as $item)
                                <option value="{{$item->id_guru}}"  {{old('id_guru',isset($id)?$mapel->id_guru : '') == $item->id_guru ? 'selected':'' }}>
                                    {{$item->nama}}</option>
                            @endforeach
                        </select>
                        @error('id_guru')
                        <div class="invalid-feedback">{{$message}}</div>
                        @enderror
                    </div>
                    <div class="input-area">
                        <label for="id_tahun" class="form-label">tahun akademik</label>
                        <select name="id_tahun" id="id_tahun" class="form-control @error('id_tahun') is-invalid @enderror">
                            <option value="">pilih</option>
                            @foreach($tahun as $item)
                                <option value="{{$item->id_tahun}}"  {{old('id_tahun',isset($id)?$mapel->id_tahun : '') == $item->id_tahun ? 'selected':'' }}>
                                    {{$item->tahun_akademik}}</option>
                            @endforeach
                        </select>
                        @error('id_tahun')
                        <div class="invalid-feedback">{{$message}}</div>
                        @enderror
                    </div>
                    <button type="submit" class="btn btn-primary">{{isset($id)?'Ubah':'Tambah'}}</button>
                </div>
            </form>
        </div>
    </div>
@endsection
