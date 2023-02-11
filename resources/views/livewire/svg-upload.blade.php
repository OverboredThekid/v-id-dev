<div>   
    <div class="flex justify-center space-x-12">
    <button wire:click='$emit("openModal", "show-i-ds", {{ json_encode(["whichSide" => "1" ]) }})' class="bg-red-400 text-red-100 pl-6 rounded-full flex items-center"><span class="mr-6">Edit Front Card ID's</span> <span class="bg-indigo-500 hover:bg-indigo-700 w-16 h-16 inline-block flex items-center justify-center rounded-full">📝</span></button>
</be>
    <button wire:click='$emit("openModal", "show-i-ds", {{ json_encode(["whichSide" => "2" ]) }})' class="bg-blue-400 text-blue-100 pl-6 rounded-full flex items-center"><span class="mr-6">Edit Back Card ID's</span> <span class="bg-indigo-500 hover:bg-indigo-700 w-16 h-16 inline-block flex items-center justify-center rounded-full">📝</span></button>
<div>
</div>
