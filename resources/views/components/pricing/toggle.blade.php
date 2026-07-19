@props(['savings' => null])

<div class="flex flex-col items-center gap-3">
    <flux:radio.group x-model="period" variant="segmented" size="sm">
        <flux:radio value="monthly" :label="__('billing.pricing.monthly')" />
        <flux:radio value="yearly" :label="__('billing.pricing.yearly')" />
    </flux:radio.group>

    @if ($savings)
        <div x-cloak x-show="period === 'yearly'">
            <flux:badge color="green" size="sm" icon="sparkles">
                {{ __('pricing.save_up_to', ['percent' => $savings]) }}
            </flux:badge>
        </div>
    @endif
</div>
