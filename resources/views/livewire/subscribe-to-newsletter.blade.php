<div class="mt-8">
    @if ($subscribed)
        <p class="text-center text-lg font-medium text-dark">{{ __('home.newsletter.success') }}</p>
    @else
        <form wire:submit="subscribe" class="mx-auto flex max-w-md flex-col gap-3 sm:flex-row sm:items-start">
            {{-- Honeypot: hidden from users, tempting to bots. --}}
            <div class="hidden" aria-hidden="true">
                <label>
                    {{ __('home.newsletter.honeypot_label') }}
                    <input type="text" wire:model="website" tabindex="-1" autocomplete="off" />
                </label>
            </div>

            <flux:field class="flex-1">
                <flux:input
                    wire:model="email"
                    type="email"
                    :placeholder="__('home.newsletter.placeholder')"
                    :aria-label="__('home.newsletter.placeholder')"
                />
                <flux:error name="email" />
            </flux:field>

            <flux:button type="submit" variant="primary" class="w-full sm:w-auto">
                {{ __('actions.subscribe') }}
            </flux:button>
        </form>
    @endif
</div>
