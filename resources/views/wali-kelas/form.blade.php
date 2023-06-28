@extends('layouts.app')

@section('content')
    @include('layouts.breadcrumb')
    <div class="card">
        <div class="card-body flex flex-col p-6">
            <header class="flex mb-5 items-center border-b border-slate-100 dark:border-slate-700 pb-5 -mx-6 px-6">
                <div class="flex-1">
                    <div class="card-title text-slate-900 dark:text-white">{{isset($id) ? 'Ubah' : 'Tambah'}} wali kelas</div>
                </div>
            </header>
            <form action="{{isset($id)?route('wali-kelas.update',$id):route('wali-kelas.store')}}" method="post">
                @csrf
                @if(isset($id))
                    @method('put')
                @endif
                <div class="card-text h-full space-y-4">
                    <div class="input-area">
                        <label for="nama_kelas" class="form-label">nama kelas</label>
                        <select name="nama_kelas" id="nama_kelas" class="form-control @error('nama_kelas') is-invalid @enderror">
                            <option value="">pilih</option>
                            @foreach(\App\Helpers\Kelas::list() as $item)
                                <option value="{{$item}}"  {{old('nama_kelas',isset($id)?$wali->nama_kelas : '') == $item ? 'selected':'' }}>{{$item}}</option>
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
                                <option value="{{$item->id_guru}}"  {{old('id_guru',isset($id)?$wali->id_guru : '') == $item->id_guru ? 'selected':'' }}>{{$item->nama}}</option>
                            @endforeach
                        </select>
                        @error('id_guru')
                        <div class="invalid-feedback">{{$message}}</div>
                        @enderror
                    </div>
                    <button type="submit" class="btn btn-primary">{{isset($id)?'Ubah':'Tambah'}}</button>
                </div>
            </form>
        </div>
    </div>
@endsection
