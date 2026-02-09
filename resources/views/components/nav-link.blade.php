@props(['active', 'icon'])

@php
$itemClasses = ($active ?? false)
            ? 'flex flex-col items-center justify-center p-2 text-white bg-secondary-blue rounded-lg transition-all duration-300 ease-in-out'
            : 'flex flex-col items-center justify-center p-2 text-text-on-creamy hover:text-secondary-blue transition-all duration-300 ease-in-out';
$iconClasses = ($active ?? false)
            ? 'h-6 w-6 text-white'
            : 'h-6 w-6 text-text-on-creamy group-hover:text-secondary-blue';
$textClasses = ($active ?? false)
            ? 'text-xs mt-1 text-white'
            : 'text-xs mt-1 text-text-on-creamy group-hover:text-secondary-blue';
@endphp

<a {{ $attributes->merge(['class' => $itemClasses]) }}>
    <div class="{{ $iconClasses }}">
        {{ $icon }}
    </div>
    <span class="{{ $textClasses }}">
        {{ $slot }}
    </span>
</a>