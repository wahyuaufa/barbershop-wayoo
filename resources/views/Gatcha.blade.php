<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Scrolling Names</title>
  <link rel="stylesheet" href="{{ asset('css/styleHome.css') }}">
  <style>
    @import url('https://fonts.cdnfonts.com/css/casino');
    @import url('https://fonts.cdnfonts.com/css/aver');
  </style>

</head>

<body>
  <div class="judul">
    <h1>Name Drawing</h1>
  </div>
  <div class="container">
    <div class="name-list">
      <ul id="names">
        <!-- Nama-nama akan diisi melalui JavaScript -->
      </ul>
    </div>
    <div class="progress-visual"></div>
    <div class="total-names">Total Names: <span id="totalCount">0</span></div>
  </div>

  <div id="popupNotification" class="overlay">
    <div class="popup">
      <h2 id="popupTitle">Here I am</h2>
      <a class="close" href="#">&times;</a>
      <div class="content" id="popupContent">
        Thank you for popping me out, but now you can close this window.
      </div>
    </div>
  </div>

  <div class="controls"> <!-- Ubah 'control' menjadi 'controls' untuk konsistensi -->
    <button id="startBtn">Go!</button>
  </div>
  <script src="{{ asset('js/cobaJs.js') }}"></script>
</body>

</html>