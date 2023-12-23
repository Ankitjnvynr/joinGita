document.addEventListener("DOMContentLoaded", function () {
    const audioPlayer = document.getElementById('audioPlayer');
    const playPauseBtn = document.querySelector('.playpause-track');
    const seekSlider = document.querySelector('.seek_slider');
    const currentTime = document.querySelector('.current-time');
    const totalDuration = document.querySelector('.total-duration');
    const musicItemsContainer = document.querySelector('.list-group');
    const trackArt = document.querySelector('.track-art');
    const trackName = document.querySelector('.track-name');
    const trackArtist = document.querySelector('.track-artist');
    const prevTrackBtn = document.querySelector('.prev-track');
    const nextTrackBtn = document.querySelector('.next-track');
    const volumeSlider = document.querySelector('.volume_slider');

    let isPlaying = false;
    let currentTrackIndex = 0;

    // Manually define an array of music items with their paths and names
    const musicItemsData = [
      { src: 'audio/song1.mp3', cover: 'images/cover1.jpg', name: 'Song 1' },
      { src: 'audio/song2.mp3', cover: 'images/cover2.jpg', name: 'Song 2' },
      { src: 'audio/song3.mp3', cover: 'images/cover3.jpg', name: 'Song 3' }
      // Add more items as needed
    ];

    // Function to play or pause the track
    function playpauseTrack() {
      if (isPlaying) {
        audioPlayer.pause();
      } else {
        audioPlayer.play();
      }
      isPlaying = !isPlaying;
      updatePlayPauseIcon();
    }

    // Function to update the play/pause button icon
    function updatePlayPauseIcon() {
      const icon = isPlaying ? 'fa-pause-circle' : 'fa-play-circle';
      playPauseBtn.innerHTML = `<i class="fa ${icon} fa-5x"></i>`;
    }

    // Function to update the current time and total duration
    function updateTimers() {
      currentTime.textContent = formatTime(audioPlayer.currentTime);
      totalDuration.textContent = formatTime(audioPlayer.duration);
    }

    // Function to format time in mm:ss format
    function formatTime(seconds) {
      const minutes = Math.floor(seconds / 60);
      const remainingSeconds = Math.floor(seconds % 60);
      return `${String(minutes).padStart(2, '0')}:${String(remainingSeconds).padStart(2, '0')}`;
    }

    // Function to update the seek slider position
    function updateSeekSlider() {
      const newPosition = (audioPlayer.currentTime / audioPlayer.duration) * 100;
      seekSlider.value = newPosition;
    }

    // Function to seek to a specific position
    function seekTo() {
      const seekPosition = (seekSlider.value / 100) * audioPlayer.duration;
      audioPlayer.currentTime = seekPosition;
    }

    // Function to set the volume
    function setVolume() {
      audioPlayer.volume = volumeSlider.value / 100;
    }

    // Function to play the next track
    function nextTrack() {
      currentTrackIndex = (currentTrackIndex + 1) % musicItemsData.length;
      loadTrack(currentTrackIndex);
    }

    // Function to play the previous track
    function prevTrack() {
      currentTrackIndex = (currentTrackIndex - 1 + musicItemsData.length) % musicItemsData.length;
      loadTrack(currentTrackIndex);
    }

    // Function to load a track based on its index
    function loadTrack(index) {
      const selectedTrack = musicItemsData[index];
      // audioPlayer.src = selectedTrack.src;
      trackArt.style.backgroundImage = `url(${selectedTrack.cover})`;
      trackName.textContent = selectedTrack.name;
      trackArtist.textContent = "Track Artist"; // Replace with actual track artist
      isPlaying = false;
      playpauseTrack();
    }

    // Render the initial music items
    function renderMusicItems() {
      musicItemsContainer.innerHTML = '';
      musicItemsData.forEach((item, index) => {
        const listItem = document.createElement('li');
        listItem.classList.add('list-group-item', 'music-item');
        listItem.setAttribute('data-src', item.src);
        listItem.setAttribute('data-cover', item.cover);
        listItem.textContent = item.name;
        listItem.addEventListener('click', () => loadTrack(index));
        musicItemsContainer.appendChild(listItem);
      });
    }

    // Event listeners
    // audioPlayer.addEventListener('timeupdate', function () {
    //   updateTimers();
    //   updateSeekSlider();
    // });

    // audioPlayer.addEventListener('ended', function () {
    //   nextTrack();
    // });

    playPauseBtn.addEventListener('click', playpauseTrack);
    seekSlider.addEventListener('input', seekTo);
    volumeSlider.addEventListener('input', setVolume);
    prevTrackBtn.addEventListener('click', prevTrack);
    nextTrackBtn.addEventListener('click', nextTrack);

    // Load the first track and render initial music items
    loadTrack(currentTrackIndex);
    renderMusicItems();
  });