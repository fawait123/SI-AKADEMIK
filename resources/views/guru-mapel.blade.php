@extends('layouts.app')

@section('content')
    @include('layouts.breadcrumb')
    <div class="grid xl:grid-cols-3 md:grid-cols-2 grid-cols-1 gap-5 ">
        @foreach($data as $item)
            <div class="card rounded-md bg-white dark:bg-slate-800 shadow-base custom-class card-body p-6">
                <header class="flex justify-between items-end">
                    <div class="flex space-x-4 items-center rtl:space-x-reverse">
                        <div class="flex-none">
                            <div class="h-10 w-10 rounded-md text-lg bg-slate-100 text-slate-900 dark:bg-slate-600 dark:text-slate-200 flex flex-col items-center justify-center font-normal capitalize">
                                {{$item->mapel[0]}}
                            </div>
                        </div>
                        <div class="font-medium text-base leading-6">
                            <div class="dark:text-slate-200 text-slate-900 max-w-[160px] truncate">
                                {{$item->mapel}}
                            </div>
                        </div>
                    </div>
                    <div>
                        <div class="dropstart relative">
                            <button class="inline-flex justify-center items-center" type="button" id="tableDropdownMenuButton3" data-bs-toggle="dropdown" aria-expanded="false">
                                <iconify-icon class="text-xl ltr:ml-2 rtl:mr-2" icon="heroicons-outline:dots-vertical"></iconify-icon>
                            </button>
                            <ul class="dropdown-menu min-w-max absolute text-sm text-slate-700 dark:text-white hidden bg-white dark:bg-slate-700 shadow z-[2] float-left overflow-hidden list-none text-left rounded-lg mt-1 m-0 bg-clip-padding border-none">
                                <li>
                                    <a href="project-details.html" class="hover:bg-slate-900 dark:hover:bg-slate-600 dark:hover:bg-opacity-70 hover:text-white
                   w-full border-b border-b-gray-500 border-opacity-10 px-4 py-2 text-sm dark:text-slate-300  last:mb-0 cursor-pointer first:rounded-t last:rounded-b flex space-x-2 items-center capitalize  rtl:space-x-reverse">
                                        <iconify-icon icon="heroicons-outline:eye"></iconify-icon>
                                        <span>View</span></a>
                                </li>
                                <li>
                                    <a href="#" data-bs-toggle="modal" data-bs-target="#editModal" class="hover:bg-slate-900 dark:hover:bg-slate-600 dark:hover:bg-opacity-70 hover:text-white w-full border-b border-b-gray-500 border-opacity-10 px-4 py-2 text-sm dark:text-slate-300 last:mb-0 cursor-pointer first:rounded-t last:rounded-b flex space-x-2 items-center capitalize rtl:space-x-reverse">
                                        <iconify-icon icon="clarity:note-edit-line"></iconify-icon>
                                        <span>Edit</span></a>
                                </li>
                                <li>
                                    <a href="#" class="hover:bg-slate-900 dark:hover:bg-slate-600 dark:hover:bg-opacity-70 hover:text-white w-full border-b border-b-gray-500 border-opacity-10 px-4 py-2 text-sm dark:text-slate-300 last:mb-0 cursor-pointer first:rounded-t last:rounded-b flex space-x-2 items-center capitalize rtl:space-x-reverse">
                                        <iconify-icon icon="fluent:delete-28-regular"></iconify-icon>
                                        <span>Delete</span></a>
                                </li>
                            </ul>
                        </div>
                    </div>
                </header>
                <div class="text-slate-600 dark:text-slate-400 text-sm pt-4 pb-8"></div>
                <div class="flex space-x-4 rtl:space-x-reverse">
                   @if(count($item->sesi)>0)
                        @foreach($item->sesi as $sesi)
                            <div>
                                <span class="block date-label">{{$sesi->hari}}</span>
                                <span class="block date-text">{{$sesi->jam_mulai .' - '.$sesi->jam_selesai}}</span>
                            </div>
                        @endforeach
                    @else
                       <div>
                           <span class="block date-label">Belum disetting</span>
                       </div>
                   @endif
                </div>
                <div class="ltr:text-right rtl:text-left text-xs text-slate-600 dark:text-slate-300 mb-1 font-medium">
                    50%
                </div>
                <div class="w-full bg-slate-200 h-2 rounded-xl overflow-hidden">
                    <div class="bg-primary-500 progress-bar h-full rounded-xl" style="width: 0%"></div>
                </div>
                <div class="grid grid-cols-2 gap-4 mt-6">
                    <div>
                        <div class="text-slate-400 dark:text-slate-400 text-sm font-normal mb-3">
                            {{$item->nama_kelas}}
                        </div>
                    </div>

                    <div class="ltr:text-right rtl:text-left">
                            <span class="inline-flex items-center space-x-1 bg-danger-500 bg-opacity-[0.16] text-danger-500 text-xs font-normal px-2 py-1 rounded-full rtl:space-x-reverse">
                <span>
                  <iconify-icon icon="heroicons-outline:clipboard-list"></iconify-icon>
                </span>
                            <span>{{$item->updated_at->diffForHumans()}}</span>
                            </span>
                    </div>
                </div>
            </div>
        @endforeach
    </div>
@endsection
