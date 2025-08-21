<button {{ $attributes->merge(['type' => 'submit', 'class' => "btn btn-{$button}"]) }}>
    {{ $label }}
</button>
