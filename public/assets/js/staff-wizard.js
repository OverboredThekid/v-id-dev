import { Livewire, wire } from 'laravel-livewire';
import alpinejs from 'alpinejs';

export default class WebcamCapture extends Livewire {
    video = null;
    canvas = null;
    image = null;

    startWebcam() {
        this.video = document.getElementById('video');
        this.canvas = document.getElementById('canvas');

        navigator.getUserMedia = navigator.getUserMedia || navigator.webkitGetUserMedia || navigator.mozGetUserMedia;

        if (navigator.getUserMedia) {
            navigator.getUserMedia(
                { video: true },
                stream => {
                    this.video.srcObject = stream;
                    this.video.play();
                },
                error => console.log(error)
            );
        }
    }
    captureImage() {
        this.canvas.width = this.video.videoWidth;
        this.canvas.height = this.video.videoHeight;
        this.canvas.getContext('2d').drawImage(this.video, 0, 0);
        this.image = this.canvas.toDataURL('image/png');
    }
}