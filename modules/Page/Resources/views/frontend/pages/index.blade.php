@extends('frontend.layouts.app')

@section('title') {{ __($module_title) }} @endsection

@section('content')

<section class="bg-gray-100 text-gray-600 py-20">
    <div class="container mx-auto flex px-5 items-center justify-center flex-col">
        <div class="text-center lg:w-2/3 w-full">
            <h1 class="text-3xl sm:text-4xl mb-4 font-medium text-gray-800">
                {{ __($module_title) }}
            </h1>
            <p class="mb-8 leading-relaxed">
                The list of {{ __($module_name) }}.
            </p>

            @include('frontend.includes.messages')
        </div>
    </div>
</section>

<section class="bg-white text-gray-600 p-6 sm:p-20">
    <div class="mx-auto flex md:flex-row flex-col">
        <!-- Pages list -->
        <div class="flex flex-col lg:flex-grow sm:w-8/12 sm:pr-8">
            <div class="grid grid-cols-1 gap-6">
                @foreach ($pages_data as $page_singular)
                    @php
                    $detail_url = route("frontend.$module_name.show",[encode_id($page_singular->id), $page_singular->slug]);
                    @endphp
                
                    <x-frontend.list 
                        :url="$detail_url"
                        :title="$page_singular->name"
                    >
                        <p class="mb-3 font-normal text-gray-700 dark:text-gray-400">
                            {{$page_singular->description}}
                        </p>
                    </x-frontend.list>
        
                @endforeach
            </div>
        </div>
        <!-- Recent pages -->
        <div class="flex flex-col sm:w-4/12">
            <div class="py-5 sm:pt-0">
                <div class="w-full mx-auto flex flex-col items-center justify-center border border-gray-200 rounded-md shadow hover:shadow-lg">
                    <div class="w-full px-4 py-3 border-b border-gray-100">
                        <h3 class="text-lg leading-6 font-medium text-gray-800">
                            @lang('Recent Pages')
                        </h3>
                        <p class="max-w-2xl text-sm text-gray-500 mb-0">
                            {{__('Recently published pages')}}
                        </p>
                    </div>
                    <ul class="w-full py-3">
                        @foreach ($recent_data as $row)
                        @php
                        $detail_url = route("frontend.pages.show",[encode_id($row->id), $row->slug]);
                        @endphp
                        <li class="flex items-center flex-row flex-1 transition duration-500 ease-in-out transform hover:-translate-y-1 px-4 py-3">
                            @if($row->featured_image != "")     
                            <div class="flex flex-col h-10 justify-center items-center mr-4">
                                <a href="{{$detail_url}}" class="block relative">
                                    <img alt="{{ $row->name }}" src="{{$row->featured_image}}" class="mx-auto object-cover rounded h-10 " />
                                </a>
                            </div>
                            @endif
                            <div class="flex-1">
                                <div class="font-medium">
                                    <a href="{{$detail_url}}">
                                        {{ $row->name }}
                                    </a>
                                </div>
                                <div class="text-gray-600 text-sm">
                                    {{$row->created_at}}
                                </div>
                            </div>
                            <button class="w-10 text-right flex justify-end">
                                <svg width="12" fill="currentColor" height="12" class="hover:text-gray-800 text-gray-500" viewBox="0 0 1792 1792" xmlns="http://www.w3.org/2000/svg">
                                    <path d="M1363 877l-742 742q-19 19-45 19t-45-19l-166-166q-19-19-19-45t19-45l531-531-531-531q-19-19-19-45t19-45l166-166q19-19 45-19t45 19l742 742q19 19 19 45t-19 45z">
                                    </path>
                                </svg>
                            </button>
                        </li>
                        @endforeach
                    </ul>
                </div>

            </div>
        </div>
    </div>
    <div class="d-flex justify-content-center w-100 mt-3">
        {{$pages_data->links()}}
    </div>
</section>

@endsection