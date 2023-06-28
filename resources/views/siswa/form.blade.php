@extends('layouts.app')

@section('content')
    @include('layouts.breadcrumb')
    <div class="card">
        <div class="card-body flex flex-col p-6">
            <header class="flex mb-5 items-center border-b border-slate-100 dark:border-slate-700 pb-5 -mx-6 px-6">
                <div class="flex-1">
                    <div class="card-title text-slate-900 dark:text-white">{{isset($id) ? 'Ubah' : 'Tambah'}} siswa</div>
                </div>
            </header>
            <form action="{{isset($id)?route('siswa.update',$id):route('siswa.store')}}" method="post">
                @csrf
                @if(isset($id))
                    @method('put')
                @endif
                <div class="card-text h-full space-y-4">
                    <div class="input-area">
                        <label for="nisn" class="form-label">nisn</label>
                        <input id="nisn" value="{{old('nisn',isset($id)? $siswa->nisn:'')}}" name="nisn" type="text" class="form-control @error('nisn') is-invalid @enderror" placeholder="nisn">
                        @error('nisn')
                        <div class="invalid-feedback">{{$message}}</div>
                        @enderror
                    </div>
                    <div class="input-area">
                        <label for="nis" class="form-label">nis</label>
                        <input id="nis" value="{{old('nis',isset($id)? $siswa->nis:'')}}" name="nis" type="text" class="form-control @error('nis') is-invalid @enderror" placeholder="nis">
                        @error('nis')
                        <div class="invalid-feedback">{{$message}}</div>
                        @enderror
                    </div>
                    <div class="input-area">
                        <label for="nama" class="form-label">nama</label>
                        <input id="nama" value="{{old('nama',isset($id)? $siswa->nama:'')}}" name="nama" type="text" class="form-control @error('nama') is-invalid @enderror" placeholder="nama">
                        @error('nama')
                        <div class="invalid-feedback">{{$message}}</div>
                        @enderror
                    </div>
                    <div class="input-area">
                        <label for="tempat_lahir" class="form-label">tempat lahir</label>
                        <input id="tempat_lahir" value="{{old('tempat_lahir',isset($id)? $siswa->tempat_lahir:'')}}" name="tempat_lahir" type="text" class="form-control @error('tempat_lahir') is-invalid @enderror" placeholder="tempat lahir">
                        @error('tempat_lahir')
                        <div class="invalid-feedback">{{$message}}</div>
                        @enderror
                    </div>
                    <div class="input-area">
                        <label for="tanggal_lahir" class="form-label">tanggal lahir</label>
                        <input id="tanggal_lahir" value="{{old('tanggal_lahir',isset($id)? $siswa->tanggal_lahir:'')}}" name="tanggal_lahir" type="date" class="form-control @error('tanggal_lahir') is-invalid @enderror" placeholder="tanggal lahir">
                        @error('tanggal_lahir')
                        <div class="invalid-feedback">{{$message}}</div>
                        @enderror
                    </div>
                    <div class="input-area">
                        <label for="jenis_kelamin" class="form-label">jenis kelamin</label>
                        <select name="jenis_kelamin" id="jenis_kelamin" class="form-control @error('jenis_kelamin') is-invalid @enderror">
                            <option value="">pilih</option>
                            <option value="laki-laki"  {{old('jenis_kelamin',isset($id)?$siswa->jenis_kelamin : '') == 'laki-laki' ? 'selected':'' }}>Laki Laki</option>
                            <option value="perempuan"  {{old('jenis_kelamin',isset($id)?$siswa->agama : '') == 'perempuan' ? 'selected':'' }}>Perempuan</option>
                        </select>
                        @error('jenis_kelamin')
                        <div class="invalid-feedback">{{$message}}</div>
                        @enderror
                    </div>
                    <div class="input-area">
                        <label for="agama" class="form-label">agama</label>
                        <select name="agama" id="agama" class="form-control @error('agama') is-invalid @enderror">
                            <option value="">pilih</option>
                            <option value="islam" {{old('agama',isset($id)?$siswa->agama : '') == 'islam' ? 'selected':'' }}>Islam</option>
                            <option value="kristen" {{old('agama',isset($id)?$siswa->agama : '') == 'kristen' ? 'selected':'' }}>Kristen</option>
                            <option value="hindu"  {{old('agama',isset($id)?$siswa->agama : '') == 'hindu' ? 'selected':'' }}>Hindu</option>
                            <option value="buddha"  {{old('agama',isset($id)?$siswa->agama : '') == 'buddha' ? 'selected':'' }}>Buddha</option>
                            <option value="konghucu"  {{old('agama',isset($id)?$siswa->agama : '') == 'konghucu' ? 'selected':'' }}>Konghucu</option>
                        </select>
                        @error('agama')
                        <div class="invalid-feedback">{{$message}}</div>
                        @enderror
                    </div>
                    <div class="input-area">
                        <label for="no_hp" class="form-label">no hp</label>
                        <input id="no_hp" value="{{old('no_hp',isset($id)? $siswa->no_hp:'')}}" name="no_hp" type="text" class="form-control @error('no_hp') is-invalid @enderror" placeholder="no hp">
                        @error('no_hp')
                        <div class="invalid-feedback">{{$message}}</div>
                        @enderror
                    </div>
                    <div class="input-area">
                        <label for="alamat" class="form-label">alamat</label>
                        <textarea name="alamat" id="alamat" class="form-control @error('alamat') is-invalid @enderror" cols="30" rows="10">{{old('alamat',isset($id)?$siswa->alamat : '')}}</textarea>
                        @error('alamat')
                        <div class="invalid-feedback">{{$message}}</div>
                        @enderror
                    </div>
                    <div class="input-area">
                        <label for="nama_ayah" class="form-label">nama ayah</label>
                        <input id="nama_ayah" value="{{old('nama_ayah',isset($id)? $siswa->nama_ayah:'')}}" name="nama_ayah" type="text" class="form-control @error('nama_ayah') is-invalid @enderror" placeholder="nama_ayah">
                        @error('nama_ayah')
                        <div class="invalid-feedback">{{$message}}</div>
                        @enderror
                    </div>
                    <div class="input-area">
                        <label for="pekerjaan_ayah" class="form-label">pekerjaan ayah</label>
                        <input id="pekerjaan_ayah" value="{{old('pekerjaan_ayah',isset($id)? $siswa->pekerjaan_ayah:'')}}" name="pekerjaan_ayah" type="text" class="form-control @error('pekerjaan_ayah') is-invalid @enderror" placeholder="pekerjaan_ayah">
                        @error('pekerjaan_ayah')
                        <div class="invalid-feedback">{{$message}}</div>
                        @enderror
                    </div>
                    <div class="input-area">
                        <label for="nama_ibu" class="form-label">nama ibu</label>
                        <input id="nama_ibu" value="{{old('nama_ibu',isset($id)? $siswa->nama_ibu:'')}}" name="nama_ibu" type="text" class="form-control @error('nama_ibu') is-invalid @enderror" placeholder="nama_ibu">
                        @error('nama_ibu')
                        <div class="invalid-feedback">{{$message}}</div>
                        @enderror
                    </div>
                    <div class="input-area">
                        <label for="pekerjaan_ibu" class="form-label">pekerjaan ibu</label>
                        <input id="pekerjaan_ibu" value="{{old('pekerjaan_ibu',isset($id)? $siswa->pekerjaan_ibu:'')}}" name="pekerjaan_ibu" type="text" class="form-control @error('pekerjaan_ibu') is-invalid @enderror" placeholder="pekerjaan_ibu">
                        @error('pekerjaan_ibu')
                        <div class="invalid-feedback">{{$message}}</div>
                        @enderror
                    </div>
                    <button type="submit" class="btn btn-primary">{{isset($id)?'Ubah':'Tambah'}}</button>
                </div>
            </form>
        </div>
    </div>
@endsection
