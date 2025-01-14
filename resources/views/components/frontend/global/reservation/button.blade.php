@if($button)
    <button type="submit" class="px-4 py-2 bg-green-400 hover:bg-green-600 rounded-lg text-white">
        Make reservation
    </button>
@else
    <a href="{{ $url }}" type="button"
       class="inline-flex items-center justify-center px-6 py-2 text-base font-bold leading-6 text-white bg-green-600 rounded-full md:w-auto hover:bg-green-500 focus:outline-none">
        Make reservation
    </a>
@endif
