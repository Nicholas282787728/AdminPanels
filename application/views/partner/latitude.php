<!doctype html>

<html>

<head>



  
</head>

<body>
pincode:<input type="text" name="txtAddress" id="txtAddress" onblur="GetLocation()"/><br><br>
latitude:<input type="text" name="textbox3" id="textbox3" />
	longitude<input type="text" name="textbox4" id="textbox4" /><br>
 <!--  <input type="button" onclick="GetLocation()" value="Get Location" /><br> -->
	

  <script async defer src="https://maps.googleapis.com/maps/api/js?key=AIzaSyC-QWLBOFf2TuPL8w0PC5akC4-_Yi0Th7A"
  type="text/javascript"></script>
	  <script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.7.2/jquery.js"></script>
</body>




<script type="text/javascript">
        function GetLocation() {

            var geocoder = new google.maps.Geocoder();
            var address = document.getElementById("txtAddress").value;
            geocoder.geocode({ 'address': address }, function (results, status) {
                if (status == google.maps.GeocoderStatus.OK) {
                    var latitude = results[0].geometry.location.lat();
                    var longitude = results[0].geometry.location.lng();
					
          					var textbox3 = document.getElementById('textbox3');
          					var textbox4 = document.getElementById('textbox4');
          					textbox3.value= +latitude ;
          					textbox4.value=+longitude;
					
                   
                } else {
                    alert("Request failed.")
                }
            });
        };
    </script>
    
</html>    