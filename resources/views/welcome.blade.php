<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Laravel</title>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,600&display=swap" rel="stylesheet" />

        <!-- Vite -->
        @vite(['resources/js/app.js','resources/css/app.css'])

    </head>
    <body>
        <div class="container mx-auto my-10">

            <div class=" mb-3">
                <p class="text-base font-bold text-gray-900 dark:text-white">Upload From File</p>
            </div>
            <div class=" mb-5">
                <a href="{{ url('/download') }}" class="font-medium text-gray-500 dark:text-white hover:underline">Download Excel Template</a>
            </div>

            <form name="uploadFile" id="uploadFile" method="post" action="/"  enctype="multipart/form-data">
                @csrf
                <div class="mb-5">
                    <div>
                        <input
                        class="relative m-0 block w-full min-w-0 flex-auto rounded border border-solid border-neutral-300 bg-clip-padding px-3 py-[0.32rem] text-base font-normal text-neutral-700 transition duration-300 ease-in-out file:-mx-3 file:-my-[0.32rem] file:overflow-hidden file:rounded-none file:border-0 file:border-solid file:border-inherit file:bg-neutral-100 file:px-3 file:py-[0.32rem] file:text-neutral-700 file:transition file:duration-150 file:ease-in-out file:[border-inline-end-width:1px] file:[margin-inline-end:0.75rem] hover:file:bg-neutral-200 focus:border-primary focus:text-neutral-700 focus:shadow-te-primary focus:outline-none dark:border-neutral-600 dark:text-neutral-200 dark:file:bg-neutral-700 dark:file:text-neutral-100 dark:focus:border-primary"
                        type="file"
                        id="fileUpload" name="fileUpload"/>
                    </div>
                </div>
                @if (count($errors) > 0)
                    <div class="text-red-500">
                        @foreach($errors->all() as $error)
                            {{ $error }} <br>
                        @endforeach
                    </div>
                @endif
                <div class="text-green-500">
                    {{ session('success') }}
                </div>
                <div class="flex flex-row mt-5">
                    <button type="submit" class="bg-transparent hover:bg-blue-500 text-blue-700 font-semibold hover:text-white py-2 px-4 border border-blue-500 hover:border-transparent rounded mr-5 w-1/2 rounded-xl">
                        Submit
                    </button>
                    <button type="button" class="bg-transparent hover:bg-red-500 text-red-700 font-semibold hover:text-white py-2 px-4 border border-red-500 hover:border-transparent rounded w-1/2 rounded-xl" onclick="emptyUploadField()">
                        Cancel
                    </button>
                </div>
            </form>
            <div class="mt-9">
                <div class="relative overflow-x-auto">
                    <table class="w-full text-sm text-left text-gray-500 dark:text-gray-400">
                        <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                        <tr>
                            <th scope="col" class="px-6 py-3">
                                Name
                            </th>
                            <th scope="col" class="px-6 py-3">
                                Level
                            </th>
                            <th scope="col" class="px-6 py-3">
                                Class
                            </th>
                            <th scope="col" class="px-6 py-3">
                                Parents Contact
                            </th>
                        </tr>
                        </thead>
                        <tbody>
                            @foreach($students as $student)
                                <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700">
                                    <th scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                                        {{ $student->name }}
                                    </th>
                                    <td class="px-6 py-4">
                                        {{ $student->level }}
                                    </td>
                                    <td class="px-6 py-4">
                                        {{ $student->class }}
                                    </td>
                                    <td class="px-6 py-4">
                                        {{ $student->parent_phone_no }}
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </body>
    <script>
        function emptyUploadField(){
            var field = document.getElementById('fileUpload');
            field.value = null;
        }
    </script>
</html>
