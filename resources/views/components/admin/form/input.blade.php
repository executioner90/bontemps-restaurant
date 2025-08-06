<label for="{{ $id }}" class="block font-medium text-sm text-gray-700 dark:text-gray-300" for="password" >
    {{ $label }}
</label>

<input
        id="{{ $id }}"
        name="{{ $name }}"
        type="{{ $type }}"
        value="{{ old($name) }}"
        placeholder="{{ $placeholder }}"
        class="{{ $class }}"
        @if($required) required @endif
        @if($disabled) disabled @endif
>
