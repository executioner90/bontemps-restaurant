<div class="max-w-xl mx-auto sm:px-6 lg:px-8">
    <div class="flex justify-start mb-2">
        <h1 class="font-semibold">{{ $title }}</h1>
    </div>

    <div class="bg-slate-100 rounded">
        <div class="w-10/12 py-9 mx-auto">
            <form method="POST" action="{{ $action }}" enctype="multipart/form-data">
                @csrf
                @method($method)

                {{ $slot }}

                <div class="flex justify-between">
                    <a class="text-gray-500 py-2 hover:text-gray-700 underline" href="{{ $backRoute }}">
                        Back
                    </a>

                    <button type="submit"
                            class="px-4 py-2 bg-gray-500 hover:bg-gray-700 rounded-lg text-white">{{ $submitButton }}</button>
                </div>
            </form>
        </div>
    </div>
</div>
