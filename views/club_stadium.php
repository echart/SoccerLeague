<style>
#map{
  height: 300px;
}
</style>
<main>
  <div class="content grid-container">
    <h3 class='title'>Estádio</h3>
    <div class='grid-100'>
      <div class='box'>
        <div class='box-content write' id='map'>

        </div>
      </div>
    </div>
  </div>
</main>
<script>
var map;
function initMap() {
  map = new google.maps.Map(document.getElementById('map'), {
    center: {lat: -34.397, lng: 150.644},
    zoom: 8
  });
}
</script>
<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyDSf5Vam_PKKaynrG_8KNm2EisbK9f9mz4&callback=initMap" async defer></script>
