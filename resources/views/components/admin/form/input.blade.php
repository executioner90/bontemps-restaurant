<label for="{{ $id }}" class="block font-medium text-sm @if($customLabel) text-gray-700 @else text-gray-700 dark:text-gray-300 @endif">
    {{ $label }}
</label>

<input
        id="{{ $id }}"
        name="{{ $name }}"
        type="{{ $type }}"
        value="{{ old($name) ?? $value }}"
        placeholder="{{ $placeholder }}"
        class="{{ $class }} {{ $errors->get($name) ? 'border-red-400' : '' }}"
        @if($required) required @endif
        @if($disabled) disabled @endif
>

<x-admin.form.input.error :messages="$errors->get($name)" />
