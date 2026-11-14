@props(['questions'])

{{-- The FAQ list shared by the home and pricing pages. Flux pads the item around its
     heading button, which leaves a 20px tap target; here that padding sits on the button,
     so the whole 44px row opens the answer. The negative margins cancel the first row's top
     padding and the last row's bottom padding, keeping the list flush with its neighbours. --}}
<flux:accordion transition exclusive {{ $attributes->class('-mt-4 -mb-2') }}>
    @foreach ($questions as $question)
        <flux:accordion.item wire:key="faq-{{ $question->id }}" class="pt-0! pb-2!">
            <flux:accordion.heading class="pt-4 pb-2">{{ $question->question }}</flux:accordion.heading>
            <flux:accordion.content class="pt-0! pb-2">{!! $question->answer !!}</flux:accordion.content>
        </flux:accordion.item>
    @endforeach
</flux:accordion>
