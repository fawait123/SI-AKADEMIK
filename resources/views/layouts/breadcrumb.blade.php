<!-- BEGIN: Breadcrumb -->
<div class="mb-5">
    <ul class="m-0 p-0 list-none">
        <li class="inline-block relative top-[3px] text-base text-primary-500 font-Inter ">
            <a href="{{url(explode('/',\Illuminate\Support\Facades\Request::path())[0])}}">
                <iconify-icon icon="heroicons-outline:home"></iconify-icon>
                <iconify-icon icon="heroicons-outline:chevron-right" class="relative text-slate-500 text-sm rtl:rotate-180"></iconify-icon>
            </a>
        </li>
        @foreach(explode('/',\Illuminate\Support\Facades\Request::path()) as $item)
            <li class="inline-block relative text-sm text-slate-500 font-Inter dark:text-white">
                {{ucfirst($item)}}</li>
        @endforeach
    </ul>
</div>
<!-- END: BreadCrumb -->
