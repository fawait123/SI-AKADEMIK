@extends('layouts.app')

@section('content')
@include('layouts.breadcrumb')
    <div class=" space-y-5">
        <div class="card">
            <header class=" card-header noborder">
                <a href="{{route('wali-kelas.create')}}" class="btn btn-primary btn-sm">Tambah</a>
            </header>
            <div class="card-body px-6 pb-6">
                <div class="overflow-x-auto -mx-6 dashcode-data-table">
                    <span class=" col-span-8  hidden"></span>
                    <span class="  col-span-4 hidden"></span>
                    <div class="inline-block min-w-full align-middle">
                        <div class="overflow-hidden ">
                            <table class="min-w-full divide-y divide-slate-100 table-fixed dark:divide-slate-700 data-table">
                                <thead class=" bg-slate-200 dark:bg-slate-700">
                                <tr>
                                    <th scope="col" class=" table-th ">
                                        UUID
                                    </th>

                                    <th scope="col" class=" table-th ">
                                        Nama Kelas
                                    </th>

                                    <th scope="col" class=" table-th ">
                                        Guru
                                    </th>

                                    <th scope="col" class=" table-th ">
                                        Aksi
                                    </th>

                                </tr>
                                </thead>
                                <tbody class="bg-white divide-y divide-slate-100 dark:bg-slate-800 dark:divide-slate-700">
                                    @foreach($data as $item)
                                        <tr>
                                            <td class="table-td">{{$item->id_wali ?? ''}}</td>
                                            <td class="table-td ">{{$item->nama_kelas ?? ''}}</td>
                                            <td class="table-td ">{{$item->guru->nama ?? ''}}</td>
                                            <td class="table-td ">
                                                <div class="flex space-x-3 rtl:space-x-reverse">
{{--                                                    <button class="action-btn" type="button">--}}
{{--                                                        <iconify-icon icon="heroicons:eye"></iconify-icon>--}}
{{--                                                    </button>--}}
                                                    <button class="action-btn" type="button" onclick="window.location.href='{{route('wali-kelas.edit',$item->id_wali)}}'">
                                                        <iconify-icon icon="heroicons:pencil-square"></iconify-icon>
                                                    </button>
                                                    <button class="action-btn" type="button"  data-bs-toggle="modal" data-bs-target="#small_modal{{$loop->iteration}}">
                                                        <iconify-icon icon="heroicons:trash"></iconify-icon>
                                                    </button>
                                                </div>
                                            </td>
                                        </tr>

                                        <div class="modal fade fixed top-0 left-0 hidden w-full h-full outline-none overflow-x-hidden overflow-y-auto" id="small_modal{{$loop->iteration}}" tabindex="-1" aria-labelledby="small_modal" aria-hidden="true">
                                            <div class="modal-dialog modal-sm relative w-auto pointer-events-none">
                                                <div class="modal-content border-none shadow-lg relative flex flex-col w-full pointer-events-auto bg-white bg-clip-padding
                    rounded-md outline-none text-current">
                                                    <div class="relative bg-white rounded-lg shadow dark:bg-slate-700">
                                                        <!-- Modal header -->
                                                        <div class="flex items-center justify-between p-5 border-b rounded-t dark:border-slate-600 bg-black-500">
                                                            <h3 class="text-xl font-medium text-white dark:text-white capitalize">
                                                                Hapus Data ?
                                                            </h3>
                                                            <button type="button" class="text-slate-400 bg-transparent hover:text-slate-900 rounded-lg text-sm p-1.5 ml-auto inline-flex items-center
                                dark:hover:bg-slate-600 dark:hover:text-white" data-bs-dismiss="modal">
                                                                <svg aria-hidden="true" class="w-5 h-5" fill="#ffffff" viewbox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                                                                    <path fill-rule="evenodd" d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10
                                        11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z" clip-rule="evenodd"></path>
                                                                </svg>
                                                                <span class="sr-only">Close modal</span>
                                                            </button>
                                                        </div>
                                                        <!-- Modal body -->
                                                        <div class="p-6 space-y-4">
                                                            <p class="text-base text-slate-600 dark:text-slate-400 leading-6">
                                                                apakah anda yakin ingin menghapus data {{$item->nama_kelas}} ?
                                                            </p>
                                                        </div>
                                                        <!-- Modal footer -->
                                                        <form action="{{route('wali-kelas.destroy',$item->id_wali)}}" method="post">
                                                            @method('delete')
                                                            @csrf
                                                            <div class="flex items-center justify-end p-6 space-x-2 border-t border-slate-200 rounded-b dark:border-slate-600">
                                                                <button class="btn inline-flex justify-center text-white bg-black-500">Hapus</button>
                                                            </div>
                                                        </form>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
