@if($isButton)
    <button type="submit" class="{{ $classes }} rounded-lg">
        {{ $text }}
    </button>
@else
    <a href="{{ $url }}" class="{{ $classes }} rounded-full">
        {{ $text }}
    </a>
@endif
