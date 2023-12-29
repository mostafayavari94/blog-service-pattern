<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Articles') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <a href="{{route('article.create')}}"
                       class="rounded-md bg-indigo-600 px-3.5 py-2.5 text-sm font-semibold text-white shadow-sm hover:bg-indigo-500 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-600">Add</a>

                </div>
                @if (session('message'))
                    <div class="bg-green-100 border-l-4 border-green-500 text-green-700 p-4" role="alert">
                        {{ session('message') }}
                    </div>
                @endif
            </div>
        </div>
    </div>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">

                    <ul role="list" class="divide-y divide-gray-100">

                        @foreach($data['articles'] as $value)
                            <li class="flex justify-between gap-x-6 py-5">
                                <div class="flex min-w-0 gap-x-4">
                                    <div class="min-w-0 flex-auto">
                                        <p class="text-sm font-semibold leading-6 text-gray-900">{{$value->title}}</p>
                                        <p class="mt-1 truncate text-xs leading-5 text-gray-500">writer: {{$value->author->name}}</p>
                                    </div>
                                </div>
                                <div class="hidden shrink-0 sm:flex sm:flex-col sm:items-end">
                                    <p class="text-sm font-semibold leading-6 text-gray-900">
                                        Status:
                                        @if($value->publication_status === \App\Enums\ArticleStatus::Publish)
                                            Published - {{$value->publication_date}}
                                        @else
                                            Drafted
                                        @endif</p>
                                </div>
                                <div class="hidden shrink-0 sm:flex sm:flex-col sm:items-end">

                                    @role('admin')


                                    @if($value->publication_status === \App\Enums\ArticleStatus::Draft)
                                        <form method="POST"
                                              action="{{ route('article.publish', ['id' => $value->id]) }}">
                                            @csrf
                                            <button
                                                class="ml-2 rounded-md bg-indigo-600 px-2 py-2 text-sm font-semibold text-white shadow-sm hover:bg-indigo-500 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-600"
                                                type="submit" onclick="event.preventDefault();
                                                this.closest('form').submit();">Publish
                                            </button>
                                        </form>
                                    @else
                                        <form method="POST"
                                              action="{{ route('article.draft', ['id' => $value->id]) }}">
                                            @csrf
                                            <button
                                                class="ml-2 rounded-md bg-indigo-600 px-2 py-2 text-sm font-semibold text-white shadow-sm hover:bg-indigo-500 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-600"
                                                type="submit" onclick="e().preventDefault();
                                                this.closest('form').submit();">Draft
                                            </button>
                                        </form>
                                    @endif

                                    <form method="POST" action="{{route('article.destroy', ['id' => $value->id])}}">
                                        @csrf
                                        <button
                                            class="ml-2 rounded-md bg-red-500 px-2 py-2 text-sm font-semibold text-white shadow-sm hover:bg-indigo-500 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-600"
                                            type="submit" onclick="event.preventDefault();
                                                this.closest('form').submit();">Delete
                                        </button>
                                    </form>
                                    @endrole
                                    <a href="{{route('article.edit', ['id' => $value->id])}}"
                                       class="ml-2 rounded-md bg-indigo-600 px-2 py-2 text-sm font-semibold text-white shadow-sm hover:bg-indigo-500 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-600">Edit</a>
                                </div>
                            </li>
                        @endforeach
                    </ul>

                </div>
            </div>
        </div>
    </div>
</x-app-layout>
