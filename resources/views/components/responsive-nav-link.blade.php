@props(['active'])

@php
$classes = ($active ?? false)
            ? 'block w-full ps-3 pe-4 py-2 border-l-4 border-secondary-blue text-start text-base font-medium text-secondary-blue bg-primary-creamy focus:outline-none focus:text-secondary-blue focus:bg-neutral-grey focus:border-secondary-blue transition duration-150 ease-in-out'
            : 'block w-full ps-3 pe-4 py-2 border-l-4 border-transparent text-start text-base font-medium text-text-on-creamy hover:text-secondary-blue hover:bg-neutral-grey hover:border-secondary-blue focus:outline-none focus:text-secondary-blue focus:bg-neutral-grey focus:border-secondary-blue transition duration-150 ease-in-out';
@endphp

<a {{ $attributes->merge(['class' => $classes]) }}>
    {{ $slot }}
</a>