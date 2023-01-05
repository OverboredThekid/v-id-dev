<!-- blade view HTML -->
<div>
    <!-- webcam toggle button -->
    <button
        x-on:click="toggleWebcam"
        x-bind:class="{ 'hidden': fileOn }"
    >
        Toggle Webcam
    </button>

    <!-- file input toggle button -->
    <button
        x-on:click="toggleFile"
        x-bind:class="{ 'hidden': webcamOn }"
    >
        Choose Photo
    </button>

    <!-- webcam -->
    <div
        x-bind:class="{ 'hidden': !webcamOn }"
    >
        <div id="my_camera"></div>
        <button x-on:click="capture">Capture</button>
    </div>

    <!-- file input -->
    <div
        x-bind:class="{ 'hidden': !fileOn }"
    >
        <input
            type="file"
            wire:model="photo"
            x-on:change="updatedPhoto"
        />
    </div>

    <!-- photo preview -->
    <img
        x-bind:src="photo"
        x-bind:class="{ 'hidden': !fileOn && !webcamOn }"
        x-ref="photo"
    />

    <!-- crop button -->
    <button
        x-on:click="crop"
        x-bind:class="{ 'hidden': !fileOn && !webcamOn }"
    >
        Crop
    </button>

    <!-- cropped photo preview -->
    <img
        x-bind:src="croppedPhoto"
        x-bind:class="{ 'hidden': !croppedPhoto }"
    />

    <!-- submit button -->
    <button
        x-on:click="submit"
        x-bind:class="{ 'hidden': !croppedPhoto }"
    >
        Submit
    </button>
</div>