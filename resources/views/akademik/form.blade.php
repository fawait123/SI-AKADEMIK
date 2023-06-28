@extends('layouts.app')

@section('content')
    @include('layouts.breadcrumb')
    <div class="card">
        <div class="card-body flex flex-col p-6">
            <header class="flex mb-5 items-center border-b border-slate-100 dark:border-slate-700 pb-5 -mx-6 px-6">
                <div class="flex-1">
                    <div class="card-title text-slate-900 dark:text-white">{{isset($id) ? 'Ubah' : 'Tambah'}} tahun-akademik</div>
                </div>
            </header>
            <form action="{{isset($id)?route('tahun-akademik.update',$id):route('tahun-akademik.store')}}" method="post">
                @csrf
                @if(isset($id))
                    @method('put')
                @endif
                <div class="card-text h-full space-y-4">
                    <div class="input-area">
                        <label for="tahun_akademik" class="form-label">tahun akademik</label>
                        <input id="tahun_akademik" value="{{old('tahun_akademik',isset($id)? $tahun->tahun_akademik:'')}}" name="tahun_akademik" type="text" class="form-control @error('tahun_akademik') is-invalid @enderror" placeholder="tahun_akademik">
                        @error('tahun_akademik')
                        <div class="invalid-feedback">{{$message}}</div>
                        @enderror
                    </div>
                    <div class="input-area">
                        <label for="semester" class="form-label">semester</label>
                        <input id="semester" value="{{old('semester',isset($id)? $tahun->semester:'')}}" name="semester" type="text" class="form-control @error('semester') is-invalid @enderror" placeholder="semester">
                        @error('semester')
                        <div class="invalid-feedback">{{$message}}</div>
                        @enderror
                    </div>
                    <div class="input-area">
                        <label for="status" class="form-label">status</label>
                        <select name="status" id="status" class="form-control @error('status') is-invalid @enderror">
                            <option value="">pilih</option>
                            <option value="aktif"  {{old('status',isset($id)?$tahun->status : '') == 'aktif' ? 'selected':'' }}>Aktif</option>
                            <option value="tidak aktif"  {{old('status',isset($id)?$tahun->status : '') == 'tidak aktif' ? 'selected':'' }}>Tidak Aktif</option>
                        </select>
                        @error('status')
                        <div class="invalid-feedback">{{$message}}</div>
                        @enderror
                    </div>
                    <button type="submit" class="btn btn-primary">{{isset($id)?'Ubah':'Tambah'}}</button>
                </div>
            </form>
        </div>
    </div>
@endsection
