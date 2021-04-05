/// <reference path="../typings/google.maps.d.ts" />
/// <reference path="site.ts" />
/// <reference path="PrintMapControl.ts" />
var locationsAdded = 1;
var map;
var points = [];
var markers = [];
var directionsDisplay;
$(document).ready(function () {
    loadSettings("Waypoints");
    loadGoogleMaps("places", function () {
        var latlng = new google.maps.LatLng(54.559322, -4.174804);
        var options = {
            zoom: 6,
            center: latlng,
            mapTypeId: google.maps.MapTypeId.ROADMAP,
            draggableCursor: "crosshair",
            gestureHandling: getGestureHandling(),
            fullscreenControl: true
        };
        map = new google.maps.Map(document.getElementById("map"), options);
        map.controls[google.maps.ControlPosition.TOP_RIGHT].push(printMapControl(map));
        google.maps.event.addListener(map, "click", function (location) {
            getWapointInfo(location.latLng, "Location " + locationsAdded);
            locationsAdded++;
        });
        var renderOptions = { markerOptions: { visible: false } };
        directionsDisplay = new google.maps.DirectionsRenderer(renderOptions);
        // autocomplete
        var autocomplete = new google.maps.places.Autocomplete(document.getElementById("location"), {
            bounds: null, componentRestrictions: null, types: []
        });
        google.maps.event.addListener(autocomplete, "place_changed", function () {
            var place = autocomplete.getPlace();
            if (place != null && place.geometry != null) {
                getWapointInfo(place.geometry.location, $("#location").val());
                map.setCenter(place.geometry.location);
                $("#location").val("");
            }
        });
    });
});

function addLatLng() {
    "use strict";
    var latLong = new google.maps.LatLng($("#lat").val(), $("#lng").val());
    getWapointInfo(latLong, "Location " + locationsAdded);
    locationsAdded++;
    map.setCenter(latLong);
    $("#lat").val("");
    $("#lng").val("");
}

function addLocation() {
    "use strict";
    geocodeAddress($("#location").val(), function (latLng) {
        if (latLng != null) {
            getWapointInfo(latLng, $("#location").val());
            map.setCenter(latLng);
            $("#location").val("");
        }
        else {
            showError("Location not found");
        }
    });
}

function getWapointInfo(latlng, locationName) {
    "use strict";
    if (latlng != null) {
        var point = { latLng: latlng, locationName: locationName };
        points.push(point);
        buildPoints();
    }
}

function clearWaypointMarkers() {
    "use strict";
    for (var _i = 0, markers_1 = markers; _i < markers_1.length; _i++) {
        var marker_1 = markers_1[_i];
        marker_1.setMap(null);
    }
    markers = [];
}

function buildPoints() {
    "use strict";
    clearWaypointMarkers();
    var html = "";
    for (var i_1 = 0; i_1 < points.length; i_1++) {
        var marker_2 = new google.maps.Marker({
            position: points[i_1].latLng,
            icon: "https://www.doogal.co.uk/images/red.png",
            title: points[i_1].locationName
        });
        markers.push(marker_2);
        marker_2.setMap(map);
        html += "<tr><td>" + points[i_1].locationName + "</td><td>" + roundNumber(points[i_1].latLng.lat(), 6) +
            "</td><td>" + roundNumber(points[i_1].latLng.lng(), 6) +
            "</td><td><button class=\"delete btn btn-default\" onclick=\"removeRow(" + i_1 + ");\">Delete</button></td><td>";
        if (i_1 < points.length - 1) {
            html += "<button class=\"moveDown btn btn-default\" onclick=\"moveRowDown(" + i_1 + ");\">Move down</button>";
        }
        html += "</td><td>";
        if (i_1 > 0) {
            html += "<button class=\"moveUp btn btn-default\" onclick=\"moveRowUp(" + i_1 + ");\">Move up</button>";
        }
        html += "</td></tr>";
    }
    $("#waypointsLocations tbody").html(html);
}

function clearRoute() {
    "use strict";
    points = [];
    buildPoints();
    clearRouteDetails();
}

function clearRouteDetails() {
    "use strict";
    directionsDisplay.setMap(null);
    directionsDisplay.setPanel(null);
    $("#distance").html("");
    $("#duration").html("");
}

function removeRow(index) {
    "use strict";
    points.splice(index, 1);
    buildPoints();
    clearRouteDetails();
}

function moveRowDown(index) {
    "use strict";
    var item = points[index];
    points.splice(index, 1);
    points.splice(index + 1, 0, item);
    buildPoints();
    clearRouteDetails();
}

function moveRowUp(index) {
    "use strict";
    var item = points[index];
    points.splice(index, 1);
    points.splice(index - 1, 0, item);
    buildPoints();
    clearRouteDetails();
}

function getDirections() {
    "use strict";
    saveSettings("Waypoints");
    if (points.length < 2) {
        showError("You need to add at least two locations");
        return;
    }
    $("#directions").html("Loading...");
    var directions = new google.maps.DirectionsService();
    // build array of waypoints (excluding start and end)
    var waypts = [];
    var end = points.length - 1;
    var dest = points[end].latLng;
    if (document.getElementById("roundTrip").checked) {
        end = points.length;
        dest = points[0].latLng;
    }
    for (var i_2 = 1; i_2 < end; i_2++) {
        waypts.push({ location: points[i_2].latLng });
    }
    var routeType = $("#routeType").val();
    var travelMode = google.maps.TravelMode.DRIVING;
    if (routeType === "Walking") {
        travelMode = google.maps.TravelMode.WALKING;
    }
    else if (routeType === "Public transport") {
        travelMode = google.maps.TravelMode.TRANSIT;
    }
    else if (routeType === "Cycling") {
        travelMode = google.maps.TravelMode.BICYCLING;
    }
    var unitsVal = $("#directionUnits").val();
    var directionUnits = google.maps.UnitSystem.METRIC;
    if (unitsVal === "Miles") {
        directionUnits = google.maps.UnitSystem.IMPERIAL;
    }
    var optimiseRoute = document.getElementById("optimise").checked;
    var request = {
        origin: points[0].latLng,
        destination: dest,
        waypoints: waypts,
        travelMode: travelMode,
        unitSystem: directionUnits,
        optimizeWaypoints: optimiseRoute
    };
    directions.route(request, function (result, status) {
        if (status === google.maps.DirectionsStatus.OK) {
            $("#directions").html("");
            directionsDisplay.setMap(map);
            directionsDisplay.setPanel($("#directions")[0]);
            directionsDisplay.setDirections(result);
            // calculate total distance and duration
            var distance_1 = 0;
            var time = 0;
            var theRoute = result.routes[0];
            // start KML
            var kmlCode = kmlDocumentStart(points[0].locationName + " to " + points[end].locationName) +
                kmlStyleThickLine() + "<Placemark>\n" + kmlLineStart();
            for (var _i = 0, _a = theRoute.legs; _i < _a.length; _i++) {
                var theLeg = _a[_i];
                distance_1 += theLeg.distance.value;
                time += theLeg.duration.value;
                for (var _b = 0, _c = theLeg.steps; _b < _c.length; _b++) {
                    var step = _c[_b];
                    for (var _d = 0, _e = step.path; _d < _e.length; _d++) {
                        var thisPoint = _e[_d];
                        kmlCode += roundNumber(thisPoint.lng(), 6) + "," + roundNumber(thisPoint.lat(), 6) + " ";
                    }
                }
            }
            $("#distance").html("Total distance: " + getDistance(distance_1) + ", ");
            $("#duration").html("total duration: " + Math.round(time / 60) + " minutes");
            // end KML
            kmlCode += kmlLineEnd() + kmlStyleUrl("thickLine") + "</Placemark>\n" + kmlDocumentEnd();
            $("#kmlData").val(kmlCode);
        }
        else {
            var statusText = getDirectionStatusText(status);
            $("#directions").html("An error occurred - " + statusText);
        }
    });
}

function getDistance(distance) {
    "use strict";
    if ($("#directionUnits").val() === "Miles") {
        return Math.round((distance * 0.621371192) / 100) / 10 + " miles";
    }
    else {
        return Math.round(distance / 100) / 10 + " km";
    }
}

function saveKml() {
    "use strict";
    $("#progress").html("Uploading...");
    // post data to server
    $.ajax({
        url: "postKml.ashx",
        type: "POST",
        data: { data: $("#kmlData").val() },
        success: function (data) {
            $("#progress").html("Complete. <a href=\"KmlViewer.php?url=http://www.doogal.co.uk/GeocodedKml/" +
                data + "\">Save this link to view the route later</a>");
        },
        error: function () {
            $("#progress").html("Failed to upload KML");
        }
    });
}
