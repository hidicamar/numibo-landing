@php($socials = config('company.socials'))

@if ($socials)
    <ul role="list" {{ $attributes->merge(['class' => 'flex items-center gap-4']) }}>
        @foreach ($socials as $platform => $social)
            <li>
                <a
                    href="{{ $social['url'] }}"
                    target="_blank"
                    rel="noopener noreferrer"
                    aria-label="{{ $social['name'] }}"
                    class="block text-dark/60 transition duration-300 ease-in-out hover:text-dark"
                >
                    <x-dynamic-component :component="'icons.'.$platform" />
                </a>
            </li>
        @endforeach
    </ul>
@endif
