// Initialize and add the map
function initMap() {
  // The location of raamsdonksveer
  var raamsdonksveer = {lat: 51.694753, lng: 4.874674};
  // The map, centered at raamsdonksveer
  var map = new google.maps.Map(
      document.getElementById('map'), {zoom: 10, center: raamsdonksveer});
  // The marker, positioned at raamsdonksveer
  var marker = new google.maps.Marker({position: raamsdonksveer, map: map});
}