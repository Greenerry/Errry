document.addEventListener('DOMContentLoaded', function() {
    const audioPlayer = document.getElementById('audio-player');
    const vinyls = document.querySelectorAll('.vinyl-item');
    let currentVinyl = null;

    vinyls.forEach(vinyl => {
        vinyl.addEventListener('click', function() {
            const songSrc = this.getAttribute('data-src');

            // If there's a song playing, stop it
            if (currentVinyl) {
                currentVinyl.classList.remove('playing');
            }

            // If clicking the same vinyl, toggle play/pause
            if (currentVinyl === this && !audioPlayer.paused) {
                audioPlayer.pause();
                this.classList.remove('playing');
                return;
            }

            // Play the new song
            audioPlayer.src = songSrc;
            audioPlayer.play();
            currentVinyl = this;
            this.classList.add('playing');
        });
    });

    // Update playing status when song ends
    audioPlayer.addEventListener('ended', function() {
        if (currentVinyl) {
            currentVinyl.classList.remove('playing');
        }
    });
}); 