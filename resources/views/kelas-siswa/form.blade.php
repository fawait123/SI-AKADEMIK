@extends('layouts.app')

@section('content')
    @include('layouts.breadcrumb')
    <div class="card">
        <div class="card-body flex flex-col p-6">
            <header class="flex mb-5 items-center border-b border-slate-100 dark:border-slate-700 pb-5 -mx-6 px-6">
                <div class="flex-1">
                    <div class="card-title text-slate-900 dark:text-white">{{isset($id) ? 'Ubah' : 'Tambah'}} kelas siswa</div>
                </div>
            </header>
            <form action="{{isset($id)?route('kelas-siswa.update',$id):route('kelas-siswa.store')}}" method="post">
                @csrf
                @if(isset($id))
                    @method('put')
                @endif
                <div class="card-text h-full space-y-4">
                    <div class="input-area">
                        <label for="id_siswa" class="form-label">siswa</label>
                        <select name="id_siswa" id="id_siswa" class="form-control @error('id_siswa') is-invalid @enderror">
                            <option value="">pilih</option>
                            @foreach($siswa as $item)
                                <option value="{{$item->id_siswa}}"  {{old('id_siswa',isset($id)?$kelas->id_siswa : '') == $item->id_siswa ? 'selected':'' }}>{{$item->nama}}</option>
                            @endforeach
                        </select>
                        @error('id_siswa')
                        <div class="invalid-feedback">{{$message}}</div>
                        @enderror
                    </div>
                    <div class="input-area">
                        <label for="id_tahun" class="form-label">tahun ajaran</label>
                        <select name="id_tahun" id="id_tahun" class="form-control @error('id_tahun') is-invalid @enderror">
                            <option value="">pilih</option>
                            @foreach($tahun as $item)
                                <option value="{{$item->id_tahun}}"  {{old('id_tahun',isset($id)?$kelas->id_tahun : '') == $item->id_tahun ? 'selected':'' }}>{{$item->tahun_akademik .' - '.$item->semester}}</option>
                            @endforeach
                        </select>
                        @error('id_tahun')
                        <div class="invalid-feedback">{{$message}}</div>
                        @enderror
                    </div>
                    <div class="input-area">
                        <label for="nama_kelas" class="form-label">kelas</label>
                        <select name="nama_kelas" id="nama_kelas" class="form-control @error('nama_kelas') is-invalid @enderror">
                            <option value="">pilih</option>
                            @foreach(\App\Helpers\Kelas::list() as $item)
                                <option value="{{$item}}"  {{old('nama_kelas',isset($id)?$kelas->nama_kelas : '') == $item ? 'selected':'' }}>{{$item}}</option>
                            @endforeach
                        </select>
                        @error('nama_kelas')
                        <div class="invalid-feedback">{{$message}}</div>
                        @enderror
                    </div>
                    <button type="submit" class="btn btn-primary">{{isset($id)?'Ubah':'Tambah'}}</button>
                </div>
            </form>
        </div>
    </div>
@endsection
