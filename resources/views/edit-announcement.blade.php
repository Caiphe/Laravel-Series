<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Edit Announcement') }}
        </h2>
    </x-slot>

    <div class="bg-white rounded-md border my-8 px-6 py-5" style="width: 700px; margin: 30px auto">
        @if (session('success'))
            <div class="bg-green-200 text-green-800 px-4 py-2">
                {{ session('success') }}
            </div>
        @endif

        <form action="{{ route('update-announcement') }}" method="POST" class="max-w-2xl mt-4" id="update-announcement">
            @csrf
            @method('PATCH')

            <div class="mt-2">
                <h4 class="font-semibold">Is Active ?</h4>
                <div class="mt-2">
                    <div>
                        <input type="radio" name="isActive" id="isActiveYes" @checked($announcement->isActive) value="1" required />
                        <label for="isActiveYes">Yes</label>
                    </div>

                    <div>
                        <input type="radio" name="isActive" @checked(!$announcement->isActive) id="isActiveNo" value="0" required />
                        <label for="isActiveYes">No</label>
                    </div>
                </div>
            </div>

            <div class="mt-4">
                <label for="bannerText" class="font-semibold black">Banner Text</label>
                <input type="text" value="{{ $announcement->bannerText }}" name="bannerText" id="bannerText" class="border border-gray-400 rounded w-full px-2 py-2 mt-2"/>
            </div>

            <div class="mt-4">
                <label for="bannerColor" class="font-semibold black">Banner Color</label>
                <br>
                <input type="color" value="{{ $announcement->bannerColor }}" name="bannerColor" id="bannerColor"/>
            </div>

            <div class="mt-4">
                <label for="titleText" class="font-semibold black">Title Text</label> <br />
                <input type="text" value="{{ $announcement->titleText }}" name="titleText" id="titleText" class="border border-gray-400 rounded w-full px-2 py-2 mt-2"/>
            </div>

            <div class="mt-4">
                <label for="titleColor" class="font-semibold black">Title Color</label> <br />
                <input type="color" value="{{ $announcement->titleColor }}" name="titleColor" id="titleColor"/>
            </div>

            <div class="mt-4">
                <label for="content" class="font-semibold black">Content</label>
                <textarea name="content" id="content" class="border border-gray-400 rounded w-full px-2 py-2 mt-2 hidden"> {{ $announcement->content }}</textarea>

                <div id="editor">
                    {!! $announcement->content !!}
                </div>

            </div>

            <div class="mt-4">
                <label for="buttonText" class="font-semibold black">Button Text</label>
                <input type="text" value="{{ $announcement->buttonText }}" name="buttonText" id="buttonText" class="border border-gray-400 rounded w-full px-2 py-2 mt-2"/>
            </div>

            <div class="mt-4">
                <label for="buttonLink" class="font-semibold black">Button Link</label>
                <input type="text" value="{{ $announcement->buttonLink }}" name="buttonLink" id="buttonLink" class="border border-gray-400 rounded w-full px-2 py-2 mt-2"/>
            </div>

            <div class="mt-4">
                <label for="buttonColor" class="font-semibold black">Button Color</label><br />
                <input type="color" value="{{ $announcement->buttonColor }}" name="buttonColor" id="buttonColor"/>
            </div>

            <button type="submit" class="mt-5 bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
                Edit Announcement
            </button>

        </form>
    </div>

    <!-- Include the Quill library -->
    <script src="https://cdn.quilljs.com/1.3.6/quill.js"></script>

    <!-- Initialize Quill editor -->
    <script>
        var quill = new Quill('#editor', {
            theme: 'snow',
            placeholder: "enter announcement",
        });

        var updateForm = document.querySelector('#update-announcement');

        updateForm.addEventListener('submit', submitForm);
        function submitForm(e){
            e.preventDefault();

            const quillEditor = document.querySelector('#editor');
            const html = quillEditor.children[0].innerHTML;

            document.querySelector('#content').value = html;

            updateForm.submit();
        }

    </script>
        
</x-app-layout>