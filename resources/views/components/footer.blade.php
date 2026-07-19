<footer class="border-t border-blue-100 bg-white">
    <div class="mx-auto max-w-5xl px-5 pt-16 pb-14 lg:px-8">
        <div class="flex flex-col items-start gap-10 md:flex-row">
            <div class="flex w-full max-w-xs flex-col gap-6">
                <a href="{{ route('home') }}" class="block" wire:navigate>
                    <img class="h-9" src="{{ asset('img/logo/png/primary.png') }}" alt="{{ __('app.name') }}" />
                </a>

                <p class="text-sm/6 text-dark/70">{{ __('Addition, subtraction, multiplication, division – all in one place for effective learning!') }}</p>
            </div>

            <div class="flex flex-1 items-start justify-start md:justify-end">
                <div class="flex flex-col items-start gap-10 sm:flex-row sm:gap-16">
                    <div>
                        <h6 class="text-dark">{{ __('titles.navigation') }}</h6>

                        <ul role="list" class="mt-4 space-y-3">
                            <li><a href="{{ route('home') }}" class="nav-link text-sm text-dark/70 hover:text-dark" wire:navigate>{{ __('titles.home') }}</a></li>
                            <li><a href="{{ route('pricing') }}" class="nav-link text-sm text-dark/70 hover:text-dark" wire:navigate>{{ __('titles.pricing') }}</a></li>
                            <li><a href="{{ route('posts.index') }}" class="nav-link text-sm text-dark/70 hover:text-dark" wire:navigate>{{ __('titles.blog') }}</a></li>
                        </ul>
                    </div>

                    <div>
                        <h6 class="text-dark">{{ __('Contact') }}</h6>

                        <ul role="list" class="mt-4 space-y-3">
                            <li><a href="mailto:{{ config('mail.from.address') }}" class="nav-link text-sm text-dark/70 hover:text-dark">{{ config('mail.from.address') }}</a></li>
                        </ul>
                    </div>

                    <div>
                        <h6 class="text-dark">{{ __('titles.legal.heading') }}</h6>

                        <ul role="list" class="mt-4 space-y-3">
                            <li><a href="{{ route('legal.privacy-policy') }}" class="nav-link text-sm text-dark/70 hover:text-dark" wire:navigate>{{ __('titles.legal.privacy_policy') }}</a></li>
                            <li><a href="{{ route('legal.terms-and-conditions') }}" class="nav-link text-sm text-dark/70 hover:text-dark" wire:navigate>{{ __('titles.legal.terms_and_conditions') }}</a></li>
                            <li><a href="{{ route('legal.cookies') }}" class="nav-link text-sm text-dark/70 hover:text-dark" wire:navigate>{{ __('titles.legal.cookies') }}</a></li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>

        <div class="mt-16 border-t border-blue-100 pt-8">
            <p class="text-center text-sm text-dark/60 md:text-left">&copy; {{ now()->year }} {{ __('app.name') }}. {{ __('All rights reserved.') }}</p>
        </div>
    </div>
</footer>
