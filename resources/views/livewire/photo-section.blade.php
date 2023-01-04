<div>
<div x-data="{ photo: null }">
  <video x-ref="video" autoplay muted playsinline width="100%"></video>
  <canvas x-ref="canvas" width="480" height="360"></canvas>
  <button x-on:click="capture()">Capture</button>
  <input type="file" x-ref="fileInput" accept="image/*" class="hidden">
  <button x-on:click="$refs.fileInput.click()">Choose File</button>
  <button x-bind:class="{ 'hidden': !photo }" x-on:click="photo = null">Clear</button>
  <div x-bind:class="{ 'hidden': !photo }">
    <div x-data="{ crop: { aspectRatio: 1 } }">
      <img x-bind:src="photo" x-ref="photo" x-init="new Cropper($refs.photo, $data)">
      <button x-on:click="crop()">Crop</button>
    </div>
  </div>
</div>

<script src="/path/to/alpine.js"></script>
<script src="/path/to/cropper.js"></script>
<script>
  function capture() {
    const video = this.$refs.video;
    const canvas = this.$refs.canvas;
    const context = canvas.getContext('2d');
    context.drawImage(video, 0, 0, canvas.width, canvas.height);
    this.photo = canvas.toDataURL();
  }

  function crop() {
    const cropper = this.$refs.photo.cropper;
    const canvas = cropper.getCroppedCanvas();
    this.photo = canvas.toDataURL();
  }
</script>
</div>
