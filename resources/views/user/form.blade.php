@extends('layouts.app')

@section('content')
    @include('layouts.breadcrumb')
    <div class="card">
        <div class="card-body flex flex-col p-6">
            <header class="flex mb-5 items-center border-b border-slate-100 dark:border-slate-700 pb-5 -mx-6 px-6">
                <div class="flex-1">
                    <div class="card-title text-slate-900 dark:text-white">{{isset($id) ? 'Ubah' : 'Tambah'}} User</div>
                </div>
            </header>
            <form action="{{isset($id)?route('user.update',$id):route('user.store')}}" method="post">
                @csrf
                @if(isset($id))
                    @method('put')
                @endif
                <div class="card-text h-full space-y-4">
                    <div class="input-area">
                        <label for="name" class="form-label">nama</label>
                        <input id="name" value="{{old('name',isset($id)? $user->name:'')}}" name="name" type="text" class="form-control @error('name') is-invalid @enderror" placeholder="name">
                        @error('name')
                        <div class="invalid-feedback">{{$message}}</div>
                        @enderror
                    </div>
                    <div class="input-area">
                        <label for="username" class="form-label">username</label>
                        <input id="username" value="{{old('username',isset($id)? $user->username:'')}}" name="username" type="text" class="form-control @error('username') is-invalid @enderror" placeholder="username">
                        @error('username')
                        <div class="invalid-feedback">{{$message}}</div>
                        @enderror
                    </div>
                    <div class="input-area">
                        <label for="email" class="form-label">email</label>
                        <input id="email" value="{{old('email',isset($id)? $user->email:'')}}" name="email" type="text" class="form-control @error('email') is-invalid @enderror" placeholder="email">
                        @error('email')
                        <div class="invalid-feedback">{{$message}}</div>
                        @enderror
                    </div>
                    <div class="input-area">
                        <label for="password" class="form-label">password</label>
                        <input id="password" value="" name="password" type="password" class="form-control @error('password') is-invalid @enderror" placeholder="password">
                        @error('password')
                        <div class="invalid-feedback">{{$message}}</div>
                        @enderror
                    </div>
                    <div class="input-area">
                        <label for="agama" class="form-label">model</label>
                        <select name="modelID" id="modelID" class="form-control @error('modelID') is-invalid @enderror" onchange="selectedModel(this)">
                            <option value="">pilih</option>
                            <optgroup label="SISWA">
                                @foreach($siswa as $item)
                                    <option value="{{$item->id_siswa}}"  data-namespace="\App\Models\Siswa" {{old('modelID',isset($id)?$user->modelID : '') == $item->id_siswa ? 'selected':'' }}>{{$item->nama}}</option>
                                @endforeach
                            </optgroup>
                            <optgroup label="GURU">
                                @foreach($guru as $item)
                                    <option value="{{$item->id_guru}}" data-namespace="\App\Models\Guru" {{old('modelID',isset($id)?$user->modelID : '') == $item->id_guru ? 'selected':'' }}>{{$item->nama}}</option>
                                @endforeach
                            </optgroup>
                        </select>
                        @error('modelID')
                        <div class="invalid-feedback">{{$message}}</div>
                        @enderror
                    </div>
                    <input type="hidden" name="namespace" value="{{isset($id)?$user->namespace:''}}">

                    <button type="submit" class="btn btn-primary">{{isset($id)?'Ubah':'Tambah'}}</button>
                </div>
            </form>
        </div>
    </div>
@endsection
@push('customjs')
    <script>
        function selectedModel(sel){
            let namespace = $(sel).find(':selected').data('namespace')
            $("input[name='namespace']").val(namespace)
        }

    </script>
@endpush
