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
                        <input id="password" value="{{old('password',isset($id)? $user->password:'')}}" name="password" type="password" class="form-control @error('password') is-invalid @enderror" placeholder="password">
                        @error('password')
                        <div class="invalid-feedback">{{$message}}</div>
                        @enderror
                    </div>

                    <div class="input-area">
                        <label for="agama" class="form-label">agama</label>
                        <select name="agama" id="agama" class="form-control @error('agama') is-invalid @enderror">
                            <option value="">pilih</option>
                            <option value="islam" {{old('agama',isset($id)?$user->agama : '') == 'islam' ? 'selected':'' }}>Islam</option>
                            <option value="kristen" {{old('agama',isset($id)?$user->agama : '') == 'kristen' ? 'selected':'' }}>Kristen</option>
                            <option value="hindu"  {{old('agama',isset($id)?$user->agama : '') == 'hindu' ? 'selected':'' }}>Hindu</option>
                            <option value="buddha"  {{old('agama',isset($id)?$user->agama : '') == 'buddha' ? 'selected':'' }}>Buddha</option>
                            <option value="konghucu"  {{old('agama',isset($id)?$user->agama : '') == 'konghucu' ? 'selected':'' }}>Konghucu</option>
                        </select>
                        @error('agama')
                        <div class="invalid-feedback">{{$message}}</div>
                        @enderror
                    </div>

                    <button type="submit" class="btn btn-primary">{{isset($id)?'Ubah':'Tambah'}}</button>
                </div>
            </form>
        </div>
    </div>
@endsection
