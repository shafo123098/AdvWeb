<h4 style="border-bottom: 2px solid dodgerblue;width:max-content;margin-bottom:20px;">Track Bus</h4>

<!--The div element for the map -->
<?php echo form_open('/map/trackBusByRegNo/'); ?>

<select class="form-select" name="trackBus" aria-label="Default select example" style="width: 40%;float:left;margin-right:10px" required>
  <?php foreach ($buses as $bus) : ?>
    <option value=<?php echo strtoupper($bus['registration_no']); ?>><?php echo strtoupper($bus['registration_no']); ?></option>
  <?php endforeach; ?>
</select>
<button class="btn btn-outline-primary" id="start" type="submit">Search</button>
</form>
<input type="hidden" id="lat" value="32.6407">
<input type="hidden" id="lng" value="74.1667">

<?php if (count($locations)  > 0) : ?>

  <div id="map"></div>
  <script type="module">
    var data;
    import { initializeApp } from "https://www.gstatic.com/firebasejs/9.9.1/firebase-app.js";

    import { getFirestore, collection, getDocs } from 'https://www.gstatic.com/firebasejs/9.9.1/firebase-firestore.js'
    import { getDatabase, ref, child, get } from 'https://www.gstatic.com/firebasejs/9.9.1/firebase-database.js'

    const firebaseConfig = {
        apiKey: "AIzaSyDEJwG1bcUy4sG2wZTwrKQHX_yyBwEi8Ak",
        authDomain: "test-weblive-location.firebaseapp.com",
        projectId: "test-weblive-location",
        storageBucket: "test-weblive-location.appspot.com",
        messagingSenderId: "896688744237",
        appId: "1:896688744237:web:eb79ce6df00146be9895a4",
        measurementId: "G-MH907H2XB6"
    };
    
    const app = initializeApp(firebaseConfig);

    const dbRef = ref(getDatabase());
    $(document).ready(function() {
    get(child(dbRef, `data/`)).then((snapshot) => {
        if (snapshot.exists()) {
            // here you are getting the lat and long
            var data = snapshot.val();
            //console.log(data.latitude);
            //console.log(data.longitude);
            document.getElementById('lat').value = data.latitude;
            document.getElementById('lng').value = data.longitude;

        } else {
            console.log("No data available");
        }
    }).catch((error) => {
        console.error(error);
    });
  }, 4000);





</script>


  <script>
    var oldStatus = '<?php echo $locatedBus[0]['location_status']; ?>';
    var speed = 0;
    //var lat = document.getElementById('lat').value;
    //var lng = document.getElementById('lng').value;
    var lat = 32.641294;
    var lng = 74.167110;
    $(document).ready(function() {
      setInterval(function() {

      var xhr = new XMLHttpRequest();
      xhr.open('GET', 'https://asia.gpswox.com//api/get_devices?lang=en&user_api_hash=a4bc0f9990b14ba6d7f6d3ce815aa64f&time=1', true);
      xhr.onload = function() {
        if (this.status == 200) {
          var locat = JSON.parse(this.response);

          speed = locat[0]['items'][0]['speed'];
          lat = locat[0]['items'][0]['lat'];
          lng = locat[0]['items'][0]['lng'];

          //console.log("Speed " + speed);
          console.log("Lat " + parseFloat(document.getElementById('lat').value));
          console.log("Lng " + parseFloat(document.getElementById('lng').value));
          //console.log("Status " + oldStatus);

          var distance = calculateDistance(
            marker.getPosition().lat(),
            marker.getPosition().lng(),
            32.6407,
            74.1667,
            "K"
          );

          function calculateDistance(lat1, lon1, lat2, lon2, unit) {
            var radlat1 = Math.PI * lat1 / 180;
            var radlat2 = Math.PI * lat2 / 180;
            var radlon1 = Math.PI * lon1 / 180;
            var radlon2 = Math.PI * lon2 / 180;
            var theta = lon1 - lon2;
            var radtheta = Math.PI * theta / 180;
            var dist = Math.sin(radlat1) * Math.sin(radlat2) + Math.cos(radlat1) * Math.cos(radlat2) * Math.cos(radtheta);
            dist = Math.acos(dist);
            dist = dist * 180 / Math.PI;
            dist = dist * 60 * 1.1515;
            if (unit == "K") {
              dist = dist * 1.609344;
            }
            if (unit == "N") {
              dist = dist * 0.8684;
            }
            if (radius < dist) {
              //alert("outside");
              $.ajax({
                url: "<?php echo base_url('map/updateBusStatusOut'); ?>",
                // data: {
                //   lat: lat,
                //   lng: lng,
                //   speed: speed,
                //   bus_id: <?php echo $locatedBus[0]['id'] ?>
                // },
                type: "POST",
                //async: false,
                dataType: 'json',
                success: function(response) {
                  alert('Successfully inserted');
                },
                error: function() {
                  //alert("error");
                }
              });
              //if bus enters in Uni 
              if (oldStatus == 'IN') {
                //alert("location status changed to OUT");
                $.ajax({
                  url: "<?php echo base_url('map/updateBusInOutHistory'); ?>",
                  data: {
                    status: 'OUT',
                  },
                  type: "POST",
                  //async: false,
                  dataType: 'json',
                  success: function(response) {
                    alert('Successfully inserted');
                  },
                  error: function() {
                    //alert("error");
                  }
                });
              }

            } else if (dist < radius) {
              //alert("inside");
              $.ajax({
                url: "<?php echo base_url('map/updateBusStatusIn'); ?>",
                // data: {
                //   lat: lat,
                //   lng: lng,
                //   speed: speed,
                //   bus_id: <?php echo $locatedBus[0]['id'] ?>
                // },
                type: "POST",
                //async: false,
                dataType: 'json',
                success: function(response) {
                  //alert('Successfully inserted');
                },
                error: function() {
                  //alert("error");
                }
              });

              //if bus leaves Uni
              if (oldStatus == 'OUT') {
                //alert("location status changed to IN");
                $.ajax({
                  url: "<?php echo base_url('map/updateBusInOutHistory'); ?>",
                  data: {
                    status: 'IN',
                  },
                  type: "POST",
                  //async: false,
                  dataType: 'json',
                  success: function(response) {
                    alert('Successfully inserted');
                  },
                  error: function() {
                    //alert("error");
                  }
                });
              }
            }
            return dist;
          }
          $.ajax({
            url: "<?php echo base_url('map/addBusLocation'); ?>",
            data: {
              lat: lat,
              lng: lng,
              speed: speed,
              bus_id: <?php echo $locatedBus[0]['id'] ?>
            },
            type: "POST",
            //async: false,
            dataType: 'json',
            success: function(response) {
              //alert('Successfully inserted');
            },
            error: function() {
              //alert("error");
            }
          });
          //});
        }
      };
      lat = lat + 10;
      lng = lng + 10;
      xhr.send();
      }, 10000);
    });

   
    var marker;
    const radius = 300 / 1000;

    // Initialize and add the map
    function initMap() {
      // The location of Uluru
      //const uluru = {
         //var lat = parseFloat(document.getElementById('lat').value);
         //var lng = parseFloat(document.getElementById('lng').value);

      //};


      // The map, centered at Uluru
      const map = new google.maps.Map(document.getElementById("map"), {
        zoom: 17,
        center: {
          //lat: parseFloat(document.getElementById('lat').value),
          //  lng: parseFloat(document.getElementById('lng').value)
          lat:lat,
          lng:lng
        },
      });


      // The marker, positioned at Uluru

      // marker = new google.maps.Marker({
      //   position: new google.maps.LatLng(parseFloat(document.getElementById('lat').value), parseFloat(document.getElementById('lng').value)),
      //   map: map,
      //   title: "bus",
      // });

      marker = new google.maps.Marker({
        position: new google.maps.LatLng(lat, lng),
        map: map,
        title: "bus",
      });

      const marker1 = new google.maps.Marker({
        position: new google.maps.LatLng(32.6407, 74.1667),
        map: map,
        title: "bus",
      });

      var circle = new google.maps.Circle({
        map: map,
        radius: 300,
        fillColor: '#AA0000'
      });
      circle.bindTo('center', marker1, 'position');

      google.maps.event.addListener(marker, 'mouseover', function() {
        infowindow.open(map, marker);
      });

      const contentString =
        '<div id="content">' +
        '<div id="siteNotice">' +
        "</div>" +
        `<h6 id="firstHeading" class="firstHeading">Registration No </h6> <?php echo strtoupper($locatedBus[0]['registration_no']); ?>` + '<hr>' +
        '<div id="bodyContent">' +
        "</div>" +
        "</div>";


      const infowindow = new google.maps.InfoWindow({
        content: contentString,
      });
    }
  </script>


  <!-- If there is no bus location then the default Map -->

<?php elseif (count($locations) == 0) : ?>
  <div id="map"></div>

  <script>
    // Initialize and add the map
    function initMap() {
      // The location of Uluru

      const uluru = {
        lat: 32.6407,
        lng: 74.1667
      };

      // The map, centered at Uluru
      const map = new google.maps.Map(document.getElementById("map"), {
        zoom: 17,
        center: uluru,
      });
      // The marker, positioned at Uluru

      const marker = new google.maps.Marker({
        position: new google.maps.LatLng(32.6407, 74.1667),
        map: map,
        title: "bus",
      });

      var circle = new google.maps.Circle({
        map: map,
        radius: 300, // 10 miles in metres
        fillColor: '#AA0000'
      });
      circle.bindTo('center', marker, 'position');

    }
  </script>
<?php endif; ?>

<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyB41DRUbKWJHPxaFjMAwdrzWzbVKartNGg&callback=initMap&v=weekly" defer></script>