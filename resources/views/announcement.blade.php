<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Announcement') }}
        </h2>
    </x-slot>

    <div class="bg-white xl:w-1/2 mx-auto rounded-lg shadow-md mt-4 overflow-hidden">
        <div class="bg-purple-800 text-white py-4 px-4">
            <h3>{{ $announcement->titleText }}</h3>
        </div>
        <div class="text-gray-600 px-5 py-5">

            <img src="{{ asset($announcement->imageUpload) }}" alt="image" class="mx-auto" /> 

            <div>
                {!! $announcement->content !!}
            </div>
        
            <p class="mt-6 mx-auto py-3">
                <a style="background-color: {{ $announcement->buttonColor }};" href="{{ $announcement->buttonLink }}" class="hover:bg-blue-700  text-white font-bold mt-5 py-3 px-6 rounded">
                    {{ $announcement->buttonText }}
                </a>
            </p>

        </div>
    </div>
</x-app-layout>