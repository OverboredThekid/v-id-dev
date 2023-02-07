<div>
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <h1>SVG File Upload</h1>

                <form action="{{ route('upload.svg') }}" method="post" enctype="multipart/form-data" id="image-upload" class="dropzone">
                    @csrf
                </form>
            </div>
        </div>
    </div>
    <button wire:click="$emit('refreshComponent')"><h3>Refreshing Page Test</h3></button>
    <h2>Extracted SVG IDs</h2>
    <ul>
        @foreach($svgIds as $id)
            <li>{{ $id }}</li>
        @endforeach
    </ul>
    
    {{ Log::debug('Blade View Rendered') }}

    <script type="text/javascript">
        Dropzone.autoDiscover = false;

        var dropzone = new Dropzone('#image-upload', {
            thumbnailWidth: 200,
            maxFilesize: 25,
            acceptedFiles: ".svg"
        });

       Livewire.on('refreshComponent', function() {
           console.log('SVG uploaded event received');
       });
    </script>
</div>