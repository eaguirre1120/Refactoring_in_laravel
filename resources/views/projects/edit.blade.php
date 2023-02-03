<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Actualizar proyecto') }}
        </h2>
    </x-slot>

    <div class="flex justify-center flex-wrap p-4 mt-5">
        @include("projects.form")
    </div>
</x-app-layout>
