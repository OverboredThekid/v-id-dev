<div>
    <form wire:submit.prevent="upload">
        <input type="file" wire:model="svgContent">

        <button type="submit">Upload</button>
    </form>

    <ul>
        @foreach($svgIds as $svgId)
            <li>{{ $svgId }}</li>
        @endforeach
    </ul>
</div>
