@extends('layouts.app')

@section('content')
    @include('layouts.breadcrumb')
    <div class="space-y-6">
        <div class="card">
            <div class="card-body flex flex-col p-6">
                <header class="flex mb-5 items-center border-b border-slate-100 dark:border-slate-700 pb-5 -mx-6 px-6">
                    <div class="flex-1">
                        <div class="card-title text-slate-900 dark:text-white">Kehadiran</div>
                    </div>
                </header>
                <div class="card-text h-full space-y-4">
                    <form action="{{ route('guru.kehadiran') }}">
                        <div class="input-area mb-3">
                            <label for="id_mapel" class="form-label">MATAPELAJARAN</label>
                            <select name="id_mapel" id="id_mapel"
                                class="form-control @error('id_mapel') is-invalid @enderror @if (\Illuminate\Support\Facades\Session::get('message')) is-invalid @endif">
                                <option value="">pilih</option>
                                @foreach ($mapel as $item)
                                    <option value="{{ $item->id_mapel }}"
                                        {{ old('kelas', \Illuminate\Support\Facades\Request::get('id_mapel')) == $item->id_mapel ? 'selected' : '' }}>
                                        {{ $item->nama_kelas . ' ' . $item->mapel }}</option>
                                @endforeach
                            </select>
                            @error('id_mapel')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                            @if (\Illuminate\Support\Facades\Session::get('message'))
                                <div class="invalid-feedback">{{ \Illuminate\Support\Facades\Session::get('message') }}
                                </div>
                            @endif
                        </div>
                        <button type="submit" class="btn btn-primary btn-sm">Cari</button>
                    </form>
                </div>
            </div>
        </div>
        @if ($cari)
            <div class="card">
                <div class="card-body flex flex-col p-6">
                    <header class="flex mb-5 items-center border-b border-slate-100 dark:border-slate-700 pb-5 -mx-6 px-6">
                        <div class="flex-1">
                            <div class="card-title text-slate-900 dark:text-white">Daftar Siswa</div>
                            <p class="text-sm text-secondary-500">Default kehadiran yaitu <span
                                    class="font-bold">HADIR</span>, anda bisa mengubahnya dengan <span
                                    class="font-bold">IJIN</span> atau <span class="font-bold">ALPHA</span> sesuai dengan
                                kehadiran siswa</p>
                        </div>
                    </header>
                    <div class="card-text h-full space-y-4">
                        @if (count($data) > 0)
                            <form action="{{ route('guru.kehadiran') }}" method="post">
                                @csrf
                                <input type="hidden" name="id_mapel"
                                    value="{{ \Illuminate\Support\Facades\Request::get('id_mapel') }}">
                                @php
                                    $no = 0;
                                @endphp
                                @foreach ($data as $item)
                                    <div class="flex items-center space-x-7 flex-wrap mb-3">
                                        <div class="input-area">
                                            <input type="hidden" class="form-control" name="id_siswa[]"
                                                value="{{ $item->id_siswa }}" placeholder="Siswa">
                                            <input type="text" class="form-control" name="nama[]"
                                                value="{{ $item->nama }}" placeholder="Siswa" readonly>
                                        </div>
                                        <div class="basicRadio">
                                            <label class="flex items-center cursor-pointer">
                                                <input type="radio" class="hidden" name="kehadiran[{{ $no }}]"
                                                    required value="hadir" checked>
                                                <span
                                                    class="flex-none bg-white dark:bg-slate-500 rounded-full border inline-flex ltr:mr-2 rtl:ml-2 relative transition-all
                                        duration-150 h-[16px] w-[16px] border-slate-400 dark:border-slate-600 dark:ring-slate-700"></span>
                                                <span class="text-secondary-500 text-sm leading-6 capitalize">HADIR</span>
                                            </label>
                                        </div>
                                        <div class="basicRadio">
                                            <label class="flex items-center cursor-pointer">
                                                <input type="radio" class="hidden" name="kehadiran[{{ $no }}]"
                                                    required value="ijin">
                                                <span
                                                    class="flex-none bg-white dark:bg-slate-500 rounded-full border inline-flex ltr:mr-2 rtl:ml-2 relative transition-all
                                        duration-150 h-[16px] w-[16px] border-slate-400 dark:border-slate-600 dark:ring-slate-700"></span>
                                                <span class="text-secondary-500 text-sm leading-6 capitalize">IJIN</span>
                                            </label>
                                        </div>
                                        <div class="basicRadio">
                                            <label class="flex items-center cursor-pointer">
                                                <input type="radio" class="hidden" name="kehadiran[{{ $no }}]"
                                                    required value="alpha">
                                                <span
                                                    class="flex-none bg-white dark:bg-slate-500 rounded-full border inline-flex ltr:mr-2 rtl:ml-2 relative transition-all
                                        duration-150 h-[16px] w-[16px] border-slate-400 dark:border-slate-600 dark:ring-slate-700"></span>
                                                <span class="text-secondary-500 text-sm leading-6 capitalize">ALPHA</span>
                                            </label>
                                        </div>
                                        <div class="basicRadio">
                                            <label class="flex items-center cursor-pointer">
                                                <input type="radio" class="hidden" name="kehadiran[{{ $no }}]"
                                                    required value="sakit">
                                                <span
                                                    class="flex-none bg-white dark:bg-slate-500 rounded-full border inline-flex ltr:mr-2 rtl:ml-2 relative transition-all
                                        duration-150 h-[16px] w-[16px] border-slate-400 dark:border-slate-600 dark:ring-slate-700"></span>
                                                <span class="text-secondary-500 text-sm leading-6 capitalize">SAKIT</span>
                                            </label>
                                        </div>
                                    </div>
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
