<div>
    <form wire:submit.prevent="submit">
        {{ $this->form }}
        <br><br>
        <div class="mt-4">
            <x-filament::button type="submit">
                Save Settings
            </x-filament::button>
        </div>
    </form>
    {{-- Care about people's approval and you will be their prisoner. --}}
</div>
