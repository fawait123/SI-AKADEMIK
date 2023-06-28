@extends('layouts.app')

@section('content')
    @include('layouts.breadcrumb')
    <div class="card">
        <div class="card-body flex flex-col p-6">
            <header class="flex mb-5 items-center border-b border-slate-100 dark:border-slate-700 pb-5 -mx-6 px-6">
                <div class="flex-1">
                    <div class="card-title text-slate-900 dark:text-white">{{isset($id) ? 'Ubah' : 'Tambah'}} Guru</div>
                </div>
            </header>
            <form action="{{isset($id)?route('guru.update',$id):route('guru.store')}}" method="post">
                @csrf
                @if(isset($id))
                    @method('put')
                @endif
                <div class="card-text h-full space-y-4">
                    <div class="input-area">
                        <label for="nama" class="form-label">nama</label>
                        <input id="nama" value="{{old('nama',isset($id)? $guru->nama:'')}}" name="nama" type="text" class="form-control @error('nama') is-invalid @enderror" placeholder="nama">
                        @error('nama')
                        <div class="invalid-feedback">{{$message}}</div>
                        @enderror
                    </div>
                    <div class="input-area">
                        <label for="tempat_lahir" class="form-label">tempat lahir</label>
                        <input id="tempat_lahir" value="{{old('tempat_lahir',isset($id)? $guru->tempat_lahir:'')}}" name="tempat_lahir" type="text" class="form-control @error('tempat_lahir') is-invalid @enderror" placeholder="tempat lahir">
                        @error('tempat_lahir')
                        <div class="invalid-feedback">{{$message}}</div>
                        @enderror
                    </div>
                    <div class="input-area">
                        <label for="tanggal_lahir" class="form-label">tanggal lahir</label>
                        <input id="tanggal_lahir" value="{{old('tanggal_lahir',isset($id)? $guru->tanggal_lahir:'')}}" name="tanggal_lahir" type="date" class="form-control @error('tanggal_lahir') is-invalid @enderror" placeholder="tanggal lahir">
                        @error('tanggal_lahir')
                        <div class="invalid-feedback">{{$message}}</div>
                        @enderror
                    </div>
                    <div class="input-area">
                        <label for="jenis_kelamin" class="form-label">jenis kelamin</label>
                        <select name="jenis_kelamin" id="jenis_kelamin" class="form-control @error('jenis_kelamin') is-invalid @enderror">
                            <option value="">pilih</option>
                            <option value="laki-laki"  {{old('jenis_kelamin',isset($id)?$guru->jenis_kelamin : '') == 'laki-laki' ? 'selected':'' }}>Laki Laki</option>
                            <option value="perempuan"  {{old('jenis_kelamin',isset($id)?$guru->agama : '') == 'perempuan' ? 'selected':'' }}>Perempuan</option>
                        </select>
                        @error('jenis_kelamin')
                        <div class="invalid-feedback">{{$message}}</div>
                        @enderror
                    </div>
                    <div class="input-area">
                        <label for="status_kepegawaian" class="form-label">status kepegawaian</label>
                        <select name="status_kepegawaian" id="status_kepegawaian" class="form-control @error('status_kepegawaian') is-invalid @enderror">
                            <option value="">pilih</option>
                            <option value="tetap"  {{old('status_kepegawaian',isset($id)?$guru->status_kepegawaian : '') == 'tetap' ? 'selected':'' }}>Tetap</option>
                            <option value="tidak tetap"  {{old('status_kepegawaian',isset($id)?$guru->status_kepegawaian : '') == 'tidak tetap' ? 'selected':'' }}>Tidak Tetap</option>
                        </select>
                        @error('status_kepegawaian')
                        <div class="invalid-feedback">{{$message}}</div>
                        @enderror
                    </div>
                    <div class="input-area">
                        <label for="agama" class="form-label">agama</label>
                        <select name="agama" id="agama" class="form-control @error('agama') is-invalid @enderror">
                            <option value="">pilih</option>
                            <option value="islam" {{old('agama',isset($id)?$guru->agama : '') == 'islam' ? 'selected':'' }}>Islam</option>
                            <option value="kristen" {{old('agama',isset($id)?$guru->agama : '') == 'kristen' ? 'selected':'' }}>Kristen</option>
                            <option value="hindu"  {{old('agama',isset($id)?$guru->agama : '') == 'hindu' ? 'selected':'' }}>Hindu</option>
                            <option value="buddha"  {{old('agama',isset($id)?$guru->agama : '') == 'buddha' ? 'selected':'' }}>Buddha</option>
                            <option value="konghucu"  {{old('agama',isset($id)?$guru->agama : '') == 'konghucu' ? 'selected':'' }}>Konghucu</option>
                        </select>
                        @error('agama')
                        <div class="invalid-feedback">{{$message}}</div>
                        @enderror
                    </div>
                    <div class="input-area">
                        <label for="no_hp" class="form-label">no hp</label>
                        <input id="no_hp" value="{{old('no_hp',isset($id)? $guru->no_hp:'')}}" name="no_hp" type="text" class="form-control @error('no_hp') is-invalid @enderror" placeholder="no hp">
                        @error('no_hp')
                        <div class="invalid-feedback">{{$message}}</div>
                        @enderror
                    </div>
                    <div class="input-area">
                        <label for="alamat" class="form-label">alamat</label>
                        <textarea name="alamat" id="alamat" class="form-control @error('alamat') is-invalid @enderror" cols="30" rows="10">{{old('alamat',isset($id)?$guru->alamat : '')}}</textarea>
                        @error('alamat')
                        <div class="invalid-feedback">{{$message}}</div>
                        @enderror
                    </div>
                    <button type="submit" class="btn btn-primary">{{isset($id)?'Ubah':'Tambah'}}</button>
                </div>
            </form>
        </div>
    </div>
@endsection
