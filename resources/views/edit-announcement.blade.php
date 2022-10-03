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

        @if (count($errors) > 0)
            <div class="bg-red-200 text-red-700 py-2 px-4">
                <ul class="list-disc ml-4">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form action="{{ route('update-announcement') }}" method="POST" class="max-w-2xl mt-4" id="update-announcement" enctype="multipart/form-data">
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

            <div class="mt-4">
                <label for="imageUpload" class="font-semibold black">Image Upload</label><br />
                <input type="file" value="" name="imageUpload" id="imageUpload" accept="image/*"/>
            </div>

            @if ($announcement->imageUpload)
                <img src="{{ asset($announcement->imageUpload) }}" alt="image" class="" style="width: 60px;margin-top: 9px;" /> ‘
            @endif

            <div class="mt-4">
                <label for="imageUploadFilePond" class="font-semibold black">Image Upload FilePond</label><br />
                <input type="file" value="" name="imageUploadFilePond" id="imageUploadFilePond" accept="image/*"/>
            </div>

            @if ($announcement->imageUploadFilePond)
                <img src="{{ asset($announcement->imageUploadFilePond) }}" alt="image" class="" style="width: 60px;margin-top: 9px;" /> ‘
            @endif
          
            <button type="submit" class="mt-5 bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
                Edit Announcement
            </button>

        </form>
    </div>

    <script src="https://cdn.quilljs.com/1.3.6/quill.js"></script>
    <script src="https://unpkg.com/filepond-plugin-image-preview/dist/filepond-plugin-image-preview.js"></script>
    <script src="https://unpkg.com/filepond-plugin-file-validate-type/dist/filepond-plugin-file-validate-type.js"></script>
    <script src="https://unpkg.com/filepond-plugin-image-transform/dist/filepond-plugin-image-transform.js"></script>
    <script src="https://unpkg.com/filepond-plugin-image-resize/dist/filepond-plugin-image-resize.js"></script>
    <script src="https://unpkg.com/filepond@^4/dist/filepond.js"></script>

    <script>
        FilePond.registerPlugin(FilePondPluginImagePreview);
        FilePond.registerPlugin(FilePondPluginFileValidateType);
        FilePond.registerPlugin(FilePondPluginImageTransform);
        FilePond.registerPlugin(FilePondPluginImageResize);

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

        const inputElement = document.querySelector('#imageUploadFilePond');
        const pond = FilePond.create(inputElement, {
            imageResizeTargetWidth : 300,
            imageResizeMode: 'contain',
            imageResizeUpscale: false,
            server: {
                url: '/upload',
                headers: {
                    'X-CSRF-TOKEN': '{{ csrf_token() }}',
                }
            }
        });

    </script>
        
</x-app-layout>