<?php

   require '../includes/dbh.inc.php';

 ?>
 <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
 <script src="https://api.mapbox.com/mapbox-gl-js/v1.7.0/mapbox-gl.js"></script>
 <link href="https://api.mapbox.com/mapbox-gl-js/v1.7.0/mapbox-gl.css" rel="stylesheet" />
<style>
* {box-sizing: border-box}
main{background-color: #ccc;height: auto;}
.main-content{width: 80%;margin: auto;
            background-color: white;padding: 20px;padding-top: 10px;margin-top: 20px;}
.main-content::after{content: "";clear: both;display: table;}
.col-one {float: left;border: none;background-color: #f1f1f1;width: 20%;height: auto;position: sticky;top: 0;}
.col-one button {display: block;background-color: white;color: black;padding: 18px 16px;width: 100%;border: 1px solid black;
             outline: none;text-align: left;cursor: pointer;transition: 0.3s;font-size: 17px;}
.col-one button:hover {background-color: #1b3f51;opacity: 0.6;color: white;}
.col-one button.active {background-color: #1b3f51;color: white;}
.col-two {float: left;padding: 0px 20px;width: 80%;border-left: none;height: auto;}
#map { width: 50%; }
</style>
<div class="main-content">
  <div style="text-align:center; margin:10px;background-color: #1b3f51;color:white;"><h1>Admin Panel</h1></div>
 <div class="col-one">
   <button class="tablinks" onclick="openId(event, 'violations')"><i class="fa fa-user-o"></i> Violations</button>
   <button class="tablinks" onclick="openId(event, 'notify')" id="defaultOpen"><i class="fa fa-user-o"></i>Notify </button>
   <button class="tablinks" onclick="openId(event, 'women-safety')"><i class="fa fa-address-card-o"></i>Women Safety</button>
   <button class="tablinks" onclick="document.getElementById('map_').click();"><i class="fa fa-address-card-o"></i>Map</button>
   <button class="tablinks" onclick="document.getElementById('los').click();"><i class="fa fa-sign-out"></i>Sign Out</button>
 </div>

 <div id="violations" class="col-two">
    <?php require 'violations.php';  ?>
 </div>

 <div id="notify" class="col-two">
    <?php require 'notify.php'; ?>
 </div>

 <div id="women-safety" class="col-two">
    <?php require 'report.php' ?>
 </div>

 <div id="map" style="height: 300px;" class="col-two">
   <form  action="temp_map.php" method="post">
     <button type="submit" id="map_" name="map">Logout</button>
   </form>
 </div>


 <div id="log-out" class="col-two">
   <form id="lout" action="admin-logout.php" method="post">
     <button type="submit" id="los" name="logout-submit">Logout</button>
   </form>
 </div>


</div>

<script>
 function openId(evt, Name) {
   var i, tabcontent, tablinks;
   tabcontent = document.getElementsByClassName("col-two");
   for (i = 0; i < tabcontent.length; i++) {
     tabcontent[i].style.display = "none";
   }
   tablinks = document.getElementsByClassName("tablinks");
   for (i = 0; i < tablinks.length; i++) {
     tablinks[i].className = tablinks[i].className.replace("active", "");
   }
   document.getElementById(Name).style.display = "block";
   evt.currentTarget.className += " active";
 }
   document.getElementById("defaultOpen").click();

   function logout() {
     $.ajax({
         type:'POST',
         url:'../admin/admin-logout.php',
     });
   }


</script>

<script>
	mapboxgl.accessToken = 'pk.eyJ1Ijoic2loY29ubmVjdCIsImEiOiJjazY2bXVlZ3gxZjNrM29vNG96Y3B6dGd0In0.AJ7GNmESyePCWI09ehbpbQ';
    var map = new mapboxgl.Map({
        container: 'map',
        style: 'mapbox://styles/mapbox/streets-v9',
				center: [86.1462746, 22.7719006],
        zoom: 10

    });

    var size = 200;

    // implementation of CustomLayerInterface to draw a pulsing dot icon on the map
    // see https://docs.mapbox.com/mapbox-gl-js/api/#customlayerinterface for more info
    var pulsingDot = {
        width: size,
        height: size,
        data: new Uint8Array(size * size * 4),

        // get rendering context for the map canvas when layer is added to the map
        onAdd: function() {
            var canvas = document.createElement('canvas');
            canvas.width = this.width;
            canvas.height = this.height;
            this.context = canvas.getContext('2d');
        },

        // called once before every frame where the icon will be used
        render: function() {
            var duration = 1000;
            var t = (performance.now() % duration) / duration;

            var radius = (size / 2) * 0.3;
            var outerRadius = (size / 2) * 0.7 * t + radius;
            var context = this.context;

            // draw outer circle
            context.clearRect(0, 0, this.width, this.height);
            context.beginPath();
            context.arc(
                this.width / 2,
                this.height / 2,
                outerRadius,
                0,
                Math.PI * 2
            );
            context.fillStyle = 'rgba(255, 200, 200,' + (1 - t) + ')';
            context.fill();

            // draw inner circle
            context.beginPath();
            context.arc(
                this.width / 2,
                this.height / 2,
                radius,
                0,
                Math.PI * 2
            );
            context.fillStyle = 'rgba(255, 100, 100, 1)';
            context.strokeStyle = 'white';
            context.lineWidth = 2 + 4 * (1 - t);
            context.fill();
            context.stroke();

            // update this image's data with data from the canvas
            this.data = context.getImageData(
                0,
                0,
                this.width,
                this.height
            ).data;

            // continuously repaint the map, resulting in the smooth animation of the dot
            map.triggerRepaint();

            // return `true` to let the map know that the image was updated
            return true;
        }
    };

    map.on('load', function() {
        map.addImage('pulsing-dot', pulsingDot, { pixelRatio: 1 });

        map.addSource('points', {
            'type': 'geojson',
            'data': {
                'type': 'FeatureCollection',
                'features': [
                    {
                        'type': 'Feature',
                        'geometry': {
                            'type': 'Point',
                            'coordinates': [86.1462746, 22.7719006]
                        }
                    },

										{
                        'type': 'Feature',
                        'geometry': {
                            'type': 'Point',
                            'coordinates': [87.1462746, 22.7719006]
                        }
                    }
                ]
            }
        });
        map.addLayer({
            'id': 'points',
            'type': 'symbol',
            'source': 'points',
            'layout': {
                'icon-image': 'pulsing-dot'
            }
        });
    });
</script>
