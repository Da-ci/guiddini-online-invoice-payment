<x-filament-panels::page>
    <x-filament-panels::form wire:submit="create">
        {{ $this->form }}

        <div class="p-4 mb-4 text-sm text-red-800 rounded-lg bg-red-50 dark:bg-gray-800 dark:text-red-400" role="alert">
            <span class="font-medium">Warning !</span> This page is for creating admins only !.
        </div>

        <x-filament-panels::form.actions :actions="$this->getCachedFormActions()" :full-width="$this->hasFullWidthFormActions()" />
    </x-filament-panels::form>
</x-filament-panels::page>
