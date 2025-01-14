@if($button)
    <button type="submit" class="{{ $classes }} rounded-lg">
        Make reservation
    </button>
@else
    <a href="{{ $url }}" class="{{ $classes }} rounded-full">
        Make reservation
    </a>
@endif
