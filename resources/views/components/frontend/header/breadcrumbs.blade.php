<div class="small d-flex align-items-center gap-2">
    @foreach ($breadcrumbs as $breadcrumb)
        @if ($breadcrumb->url && $breadcrumb->url !== url()->current())
            <a href="{{ $breadcrumb->url }}" class="decoration-0">
                @endif

                {{ $breadcrumb->title }}

                @if ($breadcrumb->url && $breadcrumb->url !== url()->current())
            </a>
        @endif

        @if (!$loop->last)
            <i class="fas fa-chevron-right text-xs"></i>
        @endif
    @endforeach
</div>
