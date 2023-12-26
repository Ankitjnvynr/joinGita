var currentAudio = document.getElementById("currentAudio");
var playPause = document.querySelector(".playpause-track");
var playTrackName = document.querySelector(".track-name");
var Allmusic = document.querySelectorAll(".music-item");
var currentTimeDisplay = document.querySelector(".current-time");
var totalTimeDisplay = document.querySelector(".total-duration");
var seek_slider = document.querySelector(".seek_slider");
var volume_slider = document.querySelector(".volume_slider");
var next_track = document.querySelector(".next-track");
var prev_track = document.querySelector(".prev-track");

function playpauseTrack() {
    if (currentAudio.paused) {
        currentAudio.play();
        playPause.innerHTML = '<i class="fa fa-pause-circle fa-5x"></i>';
    } else {
        currentAudio.pause();
        playPause.innerHTML = '<i class="fa fa-play-circle fa-5x"></i>';
    }
}

Array.from(Allmusic).forEach((element) => {
    element.addEventListener("click", (e) => {
        currentAudio.src = e.target.dataset.src;
        playTrackName.innerHTML = e.target.innerHTML;
        playPause.innerHTML = '<i class="fa fa-play-circle fa-5x"></i>';
        console.log(e.target);
        let a = document.createElement("audio");
        a.src = e.target.dataset.src;
        console.log(a);
        const duration = a.duration;
        console.log(duration);
        const totalMinutes = Math.floor(duration / 60);
        const totalSeconds = Math.floor(duration % 60);
        totalTimeDisplay.textContent = `${totalMinutes}:${totalSeconds < 10 ? "0" : ""
            }${totalSeconds}`;
    });
});
currentAudio.addEventListener("timeupdate", () => {
    const currentTime = currentAudio.currentTime;
    const duration = currentAudio.duration;

    const currentMinutes = Math.floor(currentTime / 60);
    const currentSeconds = Math.floor(currentTime % 60);
    const totalMinutes = Math.floor(duration / 60);
    const totalSeconds = Math.floor(duration % 60);

    currentTimeDisplay.textContent = `${currentMinutes}:${currentSeconds < 10 ? "0" : ""
        }${currentSeconds}`;
    totalTimeDisplay.textContent = `${totalMinutes}:${totalSeconds < 10 ? "0" : ""
        }${totalSeconds}`;

    // const progress = (currentTime / duration) * 100;

    seekPosition = currentAudio.currentTime * (100 / currentAudio.duration);
    seek_slider.value = seekPosition;
});
function setVolume() {
    // Set the volume according to the
    // percentage of the volume slider set
    currentAudio.volume = volume_slider.value / 100;
}
function seekTo() {
    // Calculate the seek position by the
    // percentage of the seek slider
    // and get the relative duration to the track
    let seekto = currentAudio.duration * (seek_slider.value / 100);

    // Set the current track position to the calculated seek position
    currentAudio.currentTime = seekto;
}

if(currentAudio.dataset.music == '0'){
    prev_track.style.opacity = "0.3";
}
function prevTrack() {
    next_track.style.opacity = "1";
    let music = Number(currentAudio.dataset.music);
    
    if (music = 0) {
        let a = document.getElementById(music);
        
        currentAudio.src = a.dataset.src;
        playTrackName.innerHTML = a.innerHTML;
        currentAudio.dataset.music = music;
    } else {
        console.log("No next track available");
        prev_track.style.opacity = "0.3";
    }
}

function nextTrack() {
    prev_track.style.opacity = "1";
    let totalMusicCount = document.querySelectorAll(".music-item");
    totalMusicCount = Array.from(totalMusicCount).length - 1;
    console.log(totalMusicCount);
    let music = Number(currentAudio.dataset.music) + 1;

    // Check if the next music is within the total count
    if (music <= totalMusicCount) {
        let a = document.getElementById(music);
        //   console.log(a);
        currentAudio.src = a.dataset.src;
        playTrackName.innerHTML = a.innerHTML;
        currentAudio.dataset.music = music;
    } else {
        // If there is no next music, you can add a message or perform any other action
        console.log("No next track available");
        next_track.style.opacity = "0.3";
        // Optionally, you can stop playback or loop back to the first track
        // currentAudio.src = document.getElementById(1).dataset.src;
        // playTrackName.innerHTML = document.getElementById(1).innerHTML;
        // currentAudio.dataset.music = 1;
    }
}
