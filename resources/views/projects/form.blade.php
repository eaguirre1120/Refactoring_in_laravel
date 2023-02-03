<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{$title}}
        </h2>
    </x-slot>

    <div class="flex justify-center flex-wrap p-4 mt-5">
        <form class="w-full container" method="POST" action="{{ $route }}">
            @csrf
            @isset($update)
                @method("PUT")
            @endisset
            <div class="flex flex-wrap -mx-3 mb-6">
                <div class="w-full px-3">
                    <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2" for="name">
                        {{ __("Nombre") }}
                    </label>
                    <input name="name" value="{{ old("name") ?? $project->name }}" class="appearance-none block w-full bg-gray-200 text-gray-700 border border-gray-200 rounded py-3 px-4 mb-3 leading-tight focus:outline-none focus:bg-white focus:border-gray-500" id="name" type="text">
                    <p class="text-gray-600 text-xs italic">{{ __("Nombre del proyecto") }}</p>
                    @error("name")
                        <div class="border border-red-400 rounded-b bg-red-100 mt-1 px-4 py-3 text-red-700">
                            {{ $message }}
                        </div>
                    @enderror
                </div>
            </div>

            <div class="flex flex-wrap -mx-3 mb-6">
                <div class="w-full px-3">
                    <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2" for="description">
                        {{ __("Descripción") }}
                    </label>
                    <textarea name="description" class="no-resize appearance-none block w-full bg-gray-200 text-gray-700 border border-gray-200 rounded py-3 px-4 mb-3 leading-tight focus:outline-none focus:bg-white focus:border-gray-500 h-48 resize-none" id="description">{{ old("description") ?? $project->description }}</textarea>
                    <p class="text-gray-600 text-xs italic">{{ __("¿De qué trata tu proyecto?") }}</p>
                    @error("description")
                        <div class="border border-red-400 rounded-b bg-red-100 mt-1 px-4 py-3 text-red-700">
                            {{ $message }}
                        </div>
                    @enderror
                </div>
            </div>
            <div class="md:flex md:items-center">
                <div class="md:w-1/3">
                    <button class="shadow bg-teal-400 hover:bg-teal-400 focus:shadow-outline focus:outline-none text-white font-bold py-2 px-4 rounded" type="submit">
                        {{ $textButton }}
                    </button>
                </div>
            </div>
        </form>
    </div>
</x-app-layout>
