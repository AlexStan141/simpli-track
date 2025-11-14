<label {{ $attributes->merge(['class' => 'block font-medium text-base text-editprofilelabel' ]) }}>
    {{ $value ?? $slot }}
</label>
