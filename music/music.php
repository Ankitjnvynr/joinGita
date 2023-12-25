<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0/dist/css/bootstrap.min.css" rel="stylesheet">
  <style>
    body {
      padding: 20px;
      background-color: #f8f9fa;
    }

    .music-player {
      max-height: 300px;
      overflow-y: auto;
    }

    .music-item {
      cursor: pointer;
    }

    .music-item:hover {
      background-color: #e9ecef;
    }

    #audioPlayer {
      width: 100%;
      margin-top: 20px;
      background-color: #ffffff;
      border: 1px solid #dee2e6;
      border-radius: 8px;
    }

    #albumCover {
      max-height: 200px;
      width: 100%;
      object-fit: cover;
      border-radius: 8px;
      margin-top: 20px;
    }

    /* Custom styles for the range input */
    input[type="range"] {
      -webkit-appearance: none;
      width: 100%;
      height: 5px;
      border-radius: 5px;
      background-color: #d1d1d1;
      outline: none;
      margin-top: 10px;
    }

    input[type="range"]::-webkit-slider-thumb {
      -webkit-appearance: none;
      appearance: none;
      width: 15px;
      height: 15px;
      border-radius: 50%;
      background-color: #007bff;
      cursor: pointer;
    }

    input[type="range"]::-moz-range-thumb {
      width: 15px;
      height: 15px;
      border-radius: 50%;
      background-color: #007bff;
      cursor: pointer;
    }

    input[type="range"]::-webkit-slider-runnable-track {
      height: 5px;
      background-color: #007bff;
      border-radius: 5px;
    }
  </style>
  <title>Music Player</title>
</head>
<body>

<div class="container">
  <h1 class="mt-4 mb-4">Music Player</h1>

  <div class="row">
    <div class="col-md-8">
      <div class="music-player">
        <ul class="list-group">
          <!-- Replace the following list items with your actual music data -->
          <li class="list-group-item music-item" data-src="audio/song1.mp3" data-cover="images/cover1.jpg">Song 1</li>
          <li class="list-group-item music-item" data-src="audio/song2.mp3" data-cover="images/cover2.jpg">Song 2</li>
          <li class="list-group-item music-item" data-src="audio/song3.mp3" data-cover="images/cover3.jpg">Song 3</li>
        </ul>
      </div>
    </div>
    <div class="col-md-4">
      <img src="" alt="Album Cover" id="albumCover">
      <audio controls id="audioPlayer" class="w-100">
        Your browser does not support the audio element.
      </audio>
      <input type="range" id="timeline" step="1" value="0">
    </div>
  </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0/dist/js/bootstrap.bundle.min.js"></script>
<script>
  document.addEventListener("DOMContentLoaded", function() {
    const musicItems = document.querySelectorAll('.music-item');
    const audioPlayer = document.getElementById('audioPlayer');
    const albumCover = document.getElementById('albumCover');
    const timeline = document.getElementById('timeline');

    musicItems.forEach(item => {
      item.addEventListener('click', function() {
        const audioSrc = this.getAttribute('data-src');
        const coverSrc = this.getAttribute('data-cover');

        audioPlayer.src = audioSrc;
        albumCover.src = coverSrc;
        audioPlayer.play();
      });
    });

    audioPlayer.addEventListener('timeupdate', function() {
      const percent = (audioPlayer.currentTime / audioPlayer.duration) * 100;
      timeline.value = percent;
    });

    timeline.addEventListener('input', function() {
      const seekTime = (timeline.value / 100) * audioPlayer.duration;
      audioPlayer.currentTime = seekTime;
    });
  });
</script>

</body>
</html>
