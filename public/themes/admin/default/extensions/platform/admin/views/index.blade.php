<script src="https://maps.googleapis.com/maps/api/js?v=3.exp"></script>
<script type="text/javascript" src="http://google-maps-utility-library-v3.googlecode.com/svn/tags/markerwithlabel/1.1.5/src/markerwithlabel_packed.js"></script>
@extends('layouts/default')

{{-- Page title --}}
@section('title')
	@parent
	: {{{ trans('platform/admin::general.title') }}}
@stop

{{-- Queue assets: Asset::queue('name-your-asset', 'path-to-asset', array('dependency-name')) --}}

{{-- Inline scripts --}}
@section('scripts')
@parent
<script>
    $(document).ready(function() {

        $('#city').on('change', function() {

            $("#map-container").show();
            $("#city").hide();

        });

    });
</script>

<script>

        var map;
        var infoWindow;

        function initialize() {
            var myOptions = {
                zoom: 10,
                center: new google.maps.LatLng(30.337219, -97.720241),
                mapTypeId: google.maps.MapTypeId.ROADMAP
            };

            map = new google.maps.Map(document.getElementById("map-canvas"), myOptions);

            // Define the LatLng coordinates for the polygon's path.
            downtownCoords = [
                new google.maps.LatLng(30.309169, -97.756706),
                new google.maps.LatLng(30.273743, -97.770267),
                new google.maps.LatLng(30.253134, -97.737480),
                new google.maps.LatLng(30.295089, -97.720142)
            ];

            downtownLabel = "Downtown";

            southCongress = [
                new google.maps.LatLng(30.272409, -97.771984),
                new google.maps.LatLng(30.236080, -97.822452),
                new google.maps.LatLng(30.218133, -97.751899),
                new google.maps.LatLng(30.249798, -97.736579)
            ];

            southCongressLabel = "South Congress";

            eastAustin = [
                new google.maps.LatLng(30.251799, -97.735420),
                new google.maps.LatLng(30.247796, -97.683063),
                new google.maps.LatLng(30.285944, -97.666854),
                new google.maps.LatLng(30.314030, -97.663378),
                new google.maps.LatLng(30.337470, -97.699371)
            ];

            eastAustinLabel = "East Austin";

            lowerEastAustin = [
                new google.maps.LatLng(30.248285, -97.734317),
                new google.maps.LatLng(30.218178, -97.749080),
                new google.maps.LatLng(30.213579, -97.709598),
                new google.maps.LatLng(30.224704, -97.685050),
                new google.maps.LatLng(30.244133, -97.691745)
            ];

            lowerEastLabel = "Lower East Side";

            brentwood = [
                new google.maps.LatLng(30.378249, -97.737750),
                new google.maps.LatLng(30.339589, -97.701702),
                new google.maps.LatLng(30.295727, -97.719898),
                new google.maps.LatLng(30.309510, -97.756633)
            ];

            brentwoodLabel = "Brentwood";

            tarrytown = [
                new google.maps.LatLng(30.275863, -97.772254),
                new google.maps.LatLng(30.309065, -97.758693),
                new google.maps.LatLng(30.315438, -97.775001),
                new google.maps.LatLng(30.287130, -97.785129)
            ];

            tarrytownLabel = "Tarrytown";

            farwest = [
                new google.maps.LatLng(30.316623, -97.774658),
                new google.maps.LatLng(30.310399, -97.758178),
                new google.maps.LatLng(30.378990, -97.739295),
                new google.maps.LatLng(30.388319, -97.748393),
                new google.maps.LatLng(30.373658, -97.782039),
                new google.maps.LatLng(30.350552, -97.795600)
            ];

            farwestLabel = "Far West";

            westlake = [
                new google.maps.LatLng(30.253179, -97.806930),
                new google.maps.LatLng(30.274084, -97.773799),
                new google.maps.LatLng(30.296764, -97.788905),
                new google.maps.LatLng(30.318846, -97.778091),
                new google.maps.LatLng(30.348182, -97.797145),
                new google.maps.LatLng(30.314400, -97.825641),
                new google.maps.LatLng(30.281793, -97.821693)
            ];

            westlakeLabel = "Westlake";

            south = [
                new google.maps.LatLng(30.193996, -97.921428),
                new google.maps.LatLng(30.155709, -97.834567),
                new google.maps.LatLng(30.142646, -97.796802),
                new google.maps.LatLng(30.216546, -97.753887),
                new google.maps.LatLng(30.234345, -97.824268),
                new google.maps.LatLng(30.260148, -97.908382)

            ];

            southLabel = "South Austin";

            north = [
                new google.maps.LatLng(30.403570, -97.853450),
                new google.maps.LatLng(30.363587, -97.793712),
                new google.maps.LatLng(30.391429, -97.748737),
                new google.maps.LatLng(30.343738, -97.701015),
                new google.maps.LatLng(30.329515, -97.672519),
                new google.maps.LatLng(30.342552, -97.593898),
                new google.maps.LatLng(30.473427, -97.596645),
                new google.maps.LatLng(30.457447, -97.828731)

            ];

            northLabel = "North Austin";

            burbs = [
                new google.maps.LatLng(30.463366, -97.842807),
                new google.maps.LatLng(30.477865, -97.592182),
                new google.maps.LatLng(30.644601, -97.579822),
                new google.maps.LatLng(30.650213, -97.892246)

            ];

            burbsLabel = "The Suburbs";

            makePolygon(downtownCoords, downtownLabel);
            makePolygon(southCongress, southCongressLabel);
            makePolygon(eastAustin, eastAustinLabel);
            makePolygon(lowerEastAustin, lowerEastLabel);
            makePolygon(brentwood, brentwoodLabel);
            makePolygon(tarrytown, tarrytownLabel);
            makePolygon(farwest, farwestLabel);
            makePolygon(westlake, westlakeLabel);
            makePolygon(south, southLabel);
            makePolygon(north, northLabel);
            makePolygon(burbs, burbsLabel);
        }

        function makePolygon(polyCoords, polyLabel) {
            var marker = new MarkerWithLabel({
                position: new google.maps.LatLng(0,0),
                draggable: false,
                raiseOnDrag: false,
                map: map,
                labelContent: polyLabel,
                labelAnchor: new google.maps.Point(30, 20),
                labelClass: "labels", // the CSS class for the label
                labelStyle: {opacity: 1.0},
                icon: "http://placehold.it/1x1",
                visible: false
            });

            var poly = new google.maps.Polygon({
                paths: polyCoords,
                strokeColor: "#FF0000",
                strokeOpacity: 0.8,
                strokeWeight: 3,
                fillColor: "#FF0000",
                fillOpacity: 0.35,
                map: map
            });

            google.maps.event.addListener(poly, "mousemove", function(event) {
                marker.setPosition(event.latLng);
                marker.setVisible(true);
            });
            google.maps.event.addListener(poly, "mouseout", function(event) {
                marker.setVisible(false);
            });

            poly.setMap(map);

            // Add a listener for the click event.
            google.maps.event.addListener(poly, 'click', showArrays);

            infoWindow = new google.maps.InfoWindow();

        }

        /** @this {google.maps.Polygon} */
        function showArrays(event) {

            var contentString = '<b>Austin Area</b><br>' +
                'Clicked location: <br>' + event.latLng.lat() + ',' + event.latLng.lng() +
                '<br>';

            // Replace the info window's content and position.
            infoWindow.setContent(contentString);
            infoWindow.setPosition(event.latLng);

            infoWindow.open(map);
        }

    google.maps.event.addDomListener(window, 'load', initialize);

</script>
@stop

{{-- Inline styles --}}
@section('styles')
@parent
<style>
    #map-canvas {
        height: 100%;
        width: 50%;
        margin: 0px;
        padding: 0px
    }

    #map-canvas {
        margin: 0 auto;
    }

    .labels {
        color: #70C067;
        background-color: #2C3F5E;
        font-family: "Lucida Grande", "Arial", sans-serif;
        font-size: 10px;
        font-weight: bold;
        text-align: center;
        width: 100px;
        border-radius: 14%;
        white-space: nowrap;
    }
</style>
@stop

{{-- Page content --}}
@section('content')

<div class="jumbotron">

	<div class="container">

		<h1>CitySnap</h1>
		<p>Find your better life</p>

	</div>
</div>


    <h2>Where do you want to go?</h2>

    <form method="get" accept-charset="UTF-8">

        <select class="form-control" name="city" id="city">
            <option value="">Choose a city</option>
            <option value="Austin">Austin</option>
            <option value="Dallas">Dallas</option>
            <option value="Houston">Houston</option>
            <option value="Ft. Worth">Ft. Worth</option>
            <option value="San Antonio">San Antonio</option>
        </select>

    </form>

    <div id="map-canvas"></div>

</div>

@stop
