<html>
  <head>
    <style media="screen">
        *{
          margin: 0;
          padding: 0;
        }
        #map{
          width: 100vw;
          height: 100vh;
        }
        .controls{
          height: 75px;
          position: absolute;
          bottom: 0;
          width: 100vw;
          z-index: 9999;
          background: #333;
        }
    </style>
  </head>
  <body>
    <div class='controls'></div>
    <div id="map"></div>
    <script>
      function initMap() {
        // Create a map object and specify the DOM element for display.
        var map = new google.maps.Map(document.getElementById('map'), {
          center: {lat: -15.7942287, lng: -47.8821658},
          zoom: 8,
          disableDefaultUI: true,
          streetViewControl: false
        });
      }
    </script>
    <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyDSf5Vam_PKKaynrG_8KNm2EisbK9f9mz4&callback=initMap" async defer></script>
