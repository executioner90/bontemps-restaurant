<div class="container flex items-center py-4 overflow-x-auto whitespace-nowrap">
    <a href="{{ route('home') }}" class="@if(count($breadcrumbs) > 0)text-gray-500 dark:text-gray-200 hover:text-gray-600 @endif">
        <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" viewBox="0 0 20 20" fill="currentColor">
            <path d="M10.707 2.293a1 1 0 00-1.414 0l-7 7a1 1 0 001.414 1.414L4 10.414V17a1 1 0 001 1h2a1 1 0 001-1v-2a1 1 0 011-1h2a1 1 0 011 1v2a1 1 0 001 1h2a1 1 0 001-1v-6.586l.293.293a1 1 0 001.414-1.414l-7-7z" />
        </svg>
    </a>

    @foreach ($breadcrumbs as $breadcrumb)
        <span class="mx-5 text-gray-500 dark:text-gray-300 rtl:-scale-x-100">
            <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" viewBox="0 0 20 20" fill="currentColor">
                <path fill-rule="evenodd" d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z" clip-rule="evenodd" />
            </svg>
        </span>

        @if ($breadcrumb->url && $breadcrumb->url !== url()->current())
            <a href="{{ $breadcrumb->url }}" class="text-gray-500 dark:text-gray-200 hover:text-gray-600">
                {{ $breadcrumb->title }}
            </a>
        @else
            <span>
                {{ $breadcrumb->title }}
            </span>
        @endif
    @endforeach
</div>

