<x-dynamic-component
    :component="$getFieldWrapperView()"
    :id="$getId()"
    :label="$getLabel()"
    :label-sr-only="$isLabelHidden()"
    :helper-text="$getHelperText()"
    :hint="$getHint()"
    :hint-action="$getHintAction()"
    :hint-color="$getHintColor()"
    :hint-icon="$getHintIcon()"
    :required="$isRequired()"
    :state-path="$getStatePath()"
>
    <div x-data="{ state: $wire.entangle('{{ $getStatePath() }}').defer }">
    <div class="flex justify-center space-x-12">
    <button class="bg-red-400 text-red-100 pl-6 rounded-full flex items-center" wire:click='$emit("openModal", "show-i-ds", {{ json_encode(["whichSide" => "1" ]) }})' ><span class="mr-6">Edit Front Card ID's</span> <span class="bg-indigo-500 hover:bg-indigo-700 w-16 h-16 inline-block flex items-center justify-center rounded-full">📝</span></button>
</be>
    <button class="bg-blue-400 text-blue-100 pl-6 rounded-full flex items-center" wire:click='$emit("openModal", "show-i-ds", {{ json_encode(["whichSide" => "2" ]) }})'><span class="mr-6">Edit Back Card ID's</span> <span class="bg-indigo-500 hover:bg-indigo-700 w-16 h-16 inline-block flex items-center justify-center rounded-full">📝</span></button>
<div>
@livewire('livewire-ui-modal')
    </div>
</x-dynamic-component>
