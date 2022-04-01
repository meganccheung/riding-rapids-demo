/**
 * initMap
 *
 * Renders a Google Map onto the selected jQuery element
 *
 * @date    22/10/19
 * @since   5.8.6
 *
 * @param   jQuery $el The jQuery element.
 * @return  object The map instance.
 */

jQuery(document).ready(function ($) {
    function initMap($el) {

        // Find marker elements within map.
        var $markers = $el.find('.marker');

        // Add styling to map
        var stylesArray = [
            {
                featureType: "landscape.natural.landcover",
                elementType: "geometry.fill",
                stylers: [
                    {
                        color: "#c02626"
                    }
                ]
            },
            {
                featureType: "poi.attraction",
                elementType: "geometry.fill",
                stylers: [
                    {
                        color: "#0e5158"
                    }
                ]
            },
            {
                featureType: "poi.attraction",
                elementType: "labels.text.fill",
                stylers: [
                    {
                        color: "#021c26"
                    }
                ]
            },
            {
                featureType: "poi.attraction",
                elementType: "labels.icon",
                stylers: [
                    {
                        color: "#0e5158"
                    }
                ]
            },
            {
                featureType: "poi.business",
                elementType: "geometry.fill",
                stylers: [
                    {
                        "visibility": "on"
                    }
                ]
            },
            {
                featureType: "poi.business",
                elementType: "labels.text.fill",
                stylers: [
                    {
                        color: "#021c26"
                    }
                ]
            },
            {
                featureType: "poi.business",
                elementType: "labels.icon",
                stylers: [
                    {
                        color: "#0e5158"
                    }
                ]
            },
            {
                featureType: "poi.government",
                elementType: "labels.text.fill",
                stylers: [
                    {
                        color: "#021c26"
                    }
                ]
            },
            {
                featureType: "poi.government",
                elementType: "labels.icon",
                stylers: [
                    {
                        color: "#082f33"
                    }
                ]
            },
            {
                featureType: "poi.medical",
                elementType: "labels.text.fill",
                stylers: [
                    {
                        color: "#432626"
                    }
                ]
            },
            {
                featureType: "poi.medical",
                elementType: "labels.icon",
                stylers: [
                    {
                        color: "#8b3e3e"
                    }
                ]
            },
            {
                featureType: "poi.park",
                elementType: "labels.text.fill",
                stylers: [
                    {
                        color: "#243729"
                    }
                ]
            },
            {
                featureType: "poi.park",
                elementType: "labels.icon",
                stylers: [
                    {
                        color: "#294a31"
                    }
                ]
            },
            {
                featureType: "poi.place_of_worship",
                elementType: "labels.text.fill",
                stylers: [
                    {
                        color: "#021c26"
                    }
                ]
            },
            {
                featureType: "poi.place_of_worship",
                elementType: "labels.icon",
                stylers: [
                    {
                        color: "#082f33"
                    }
                ]
            },
            {
                featureType: "poi.school",
                elementType: "labels.text.fill",
                stylers: [
                    {
                        color: "#021c26"
                    }
                ]
            },
            {
                featureType: "poi.school",
                elementType: "labels.icon",
                stylers: [
                    {
                        color: "#10727c"
                    }
                ]
            },
            {
                featureType: "poi.sports_complex",
                elementType: "labels.text.fill",
                stylers: [
                    {
                        color: "#021c26"
                    }
                ]
            },
            {
                featureType: "poi.sports_complex",
                elementType: "labels.icon",
                stylers: [
                    {
                        color: "#1b474c"
                    }
                ]
            },
            {
                featureType: "road.highway",
                elementType: "geometry.fill",
                stylers: [
                    {
                        color: "#f29f05"
                    }
                ]
            },
            {
                featureType: "road.highway.controlled_access",
                elementType: "geometry.fill",
                stylers: [
                    {
                        color: "#f29f05"
                    }
                ]
            },
            {
                featureType: "transit.line",
                elementType: "geometry.fill",
                stylers: [
                    {
                        color: "#79a7ac"
                    }
                ]
            },
            {
                featureType: "transit.station.airport",
                elementType: "labels.text.fill",
                stylers: [
                    {
                        color: "#021c26"
                    }
                ]
            },
            {
                featureType: "transit.station.airport",
                elementType: "labels.icon",
                stylers: [
                    {
                        color: "#082f33"
                    }
                ]
            },
            {
                featureType: "transit.station.bus",
                elementType: "labels.text.fill",
                stylers: [
                    {
                        color: "#021c26"
                    }
                ]
            },
            {
                featureType: "transit.station.bus",
                elementType: "labels.icon",
                stylers: [
                    {
                        color: "#082f33"
                    }
                ]
            },
            {
                featureType: "transit.station.rail",
                elementType: "labels.text.fill",
                stylers: [
                    {
                        color: "#021c26"
                    }
                ]
            },
            {
                featureType: "transit.station.rail",
                elementType: "labels.icon",
                stylers: [
                    {
                        color: "#082f33"
                    }
                ]
            },
            {
                featureType: "water",
                elementType: "geometry.fill",
                stylers: [
                    {
                        color: "#6fd2dc"
                    }
                ]
            },
            {
                featureType: "water",
                elementType: "labels.text.fill",
                stylers: [
                    {
                        color: "#021c26"
                    }
                ]
            }
        ];

        // Create gerenic map.
        var mapArgs = {
            zoom: $el.data('zoom') || 16,
            mapTypeId: google.maps.MapTypeId.ROADMAP,
            styles: stylesArray,
        };

        var map = new google.maps.Map($el[0], mapArgs);

        // Add markers.
        map.markers = [];
        $markers.each(function () {
            initMarker($(this), map);
        });

        // Center map based on markers.
        centerMap(map);

        // Return map instance.
        return map;
    }

    /**
     * initMarker
     *
     * Creates a marker for the given jQuery element and map.
     *
     * @date    22/10/19
     * @since   5.8.6
     *
     * @param   jQuery $el The jQuery element.
     * @param   object The map instance.
     * @return  object The marker instance.
     */
    function initMarker($marker, map) {

        // Get position from marker.
        var lat = $marker.data('lat');
        var lng = $marker.data('lng');
        var latLng = {
            lat: parseFloat(lat),
            lng: parseFloat(lng)
        };

        // Create marker instance.
        var marker = new google.maps.Marker({
            position: latLng,
            map: map
        });

        // Append to reference for later use.
        map.markers.push(marker);

        // If marker contains HTML, add it to an infoWindow.
        if ($marker.html()) {

            // Create info window.
            var infowindow = new google.maps.InfoWindow({
                content: $marker.html()
            });

            // Show info window when marker is clicked.
            google.maps.event.addListener(marker, 'click', function () {
                infowindow.open(map, marker);
            });
        }
    }

    /**
     * centerMap
     *
     * Centers the map showing all markers in view.
     *
     * @date    22/10/19
     * @since   5.8.6
     *
     * @param   object The map instance.
     * @return  void
     */
    function centerMap(map) {

        // Create map boundaries from all map markers.
        var bounds = new google.maps.LatLngBounds();
        map.markers.forEach(function (marker) {
            bounds.extend({
                lat: marker.position.lat(),
                lng: marker.position.lng()
            });
        });

        // Case: Single marker.
        if (map.markers.length == 1) {
            map.setCenter(bounds.getCenter());

            // Case: Multiple markers.
        } else {
            map.fitBounds(bounds);
        }
    }

    // Render maps on page load.
    $(document).ready(function () {
        $('.acf-map').each(function () {
            var map = initMap($(this));
        });

    });

});
