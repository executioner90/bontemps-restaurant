@if ($messages)
    <ul class="text-xs text-red-600 dark:text-red-400 space-y-1">
        @foreach ($messages as $message)
            <li>{{ $message }}</li>
        @endforeach
    </ul>
@endif
