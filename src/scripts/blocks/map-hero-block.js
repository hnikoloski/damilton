jQuery(document).ready(function ($) {

    if (!$('#hero-map').length) {
        return;
    }

    const heroMap = $('#hero-map');
    const lat = parseFloat(heroMap.data('lat'));
    const lng = parseFloat(heroMap.data('lng'));

    // Snazzy Maps style JSON
    const mapStyle = [
        {
            "featureType": "all",
            "elementType": "labels.text.fill",
            "stylers": [
                {
                    "saturation": 36
                },
                {
                    "color": "#000000"
                },
                {
                    "lightness": 40
                }
            ]
        },
        {
            "featureType": "all",
            "elementType": "labels.text.stroke",
            "stylers": [
                {
                    "visibility": "on"
                },
                {
                    "color": "#000000"
                },
                {
                    "lightness": 16
                }
            ]
        },
        {
            "featureType": "all",
            "elementType": "labels.icon",
            "stylers": [
                {
                    "visibility": "off"
                }
            ]
        },
        {
            "featureType": "administrative",
            "elementType": "geometry.fill",
            "stylers": [
                {
                    "color": "#000000"
                },
                {
                    "lightness": 20
                }
            ]
        },
        {
            "featureType": "administrative",
            "elementType": "geometry.stroke",
            "stylers": [
                {
                    "color": "#000000"
                },
                {
                    "lightness": 17
                },
                {
                    "weight": 1.2
                }
            ]
        },
        {
            "featureType": "landscape",
            "elementType": "all",
            "stylers": [
                {
                    "visibility": "on"
                }
            ]
        },
        {
            "featureType": "landscape",
            "elementType": "geometry",
            "stylers": [
                {
                    "color": "#000000"
                },
                {
                    "lightness": 20
                }
            ]
        },
        {
            "featureType": "landscape",
            "elementType": "labels.icon",
            "stylers": [
                {
                    "saturation": "-100"
                },
                {
                    "lightness": "-54"
                }
            ]
        },
        {
            "featureType": "poi",
            "elementType": "all",
            "stylers": [
                {
                    "visibility": "on"
                },
                {
                    "lightness": "0"
                }
            ]
        },
        {
            "featureType": "poi",
            "elementType": "geometry",
            "stylers": [
                {
                    "color": "#000000"
                },
                {
                    "lightness": 21
                }
            ]
        },
        {
            "featureType": "poi",
            "elementType": "labels.icon",
            "stylers": [
                {
                    "saturation": "-89"
                },
                {
                    "lightness": "-55"
                }
            ]
        },
        {
            "featureType": "road",
            "elementType": "labels.icon",
            "stylers": [
                {
                    "visibility": "off"
                }
            ]
        },
        {
            "featureType": "road.highway",
            "elementType": "geometry.fill",
            "stylers": [
                {
                    "color": "#000000"
                },
                {
                    "lightness": 17
                }
            ]
        },
        {
            "featureType": "road.highway",
            "elementType": "geometry.stroke",
            "stylers": [
                {
                    "color": "#000000"
                },
                {
                    "lightness": 29
                },
                {
                    "weight": 0.2
                }
            ]
        },
        {
            "featureType": "road.arterial",
            "elementType": "geometry",
            "stylers": [
                {
                    "color": "#000000"
                },
                {
                    "lightness": 18
                }
            ]
        },
        {
            "featureType": "road.local",
            "elementType": "geometry",
            "stylers": [
                {
                    "color": "#000000"
                },
                {
                    "lightness": 16
                }
            ]
        },
        {
            "featureType": "transit",
            "elementType": "geometry",
            "stylers": [
                {
                    "color": "#000000"
                },
                {
                    "lightness": 19
                }
            ]
        },
        {
            "featureType": "transit.station",
            "elementType": "labels.icon",
            "stylers": [
                {
                    "visibility": "on"
                },
                {
                    "saturation": "-100"
                },
                {
                    "lightness": "-51"
                }
            ]
        },
        {
            "featureType": "water",
            "elementType": "geometry",
            "stylers": [
                {
                    "color": "#000000"
                },
                {
                    "lightness": 17
                }
            ]
        }
    ];

    // Initialize the map with the custom style
    const mapOptions = {
        center: { lat: lat, lng: lng },
        zoom: 14,
        styles: mapStyle // Apply the Snazzy Maps style here
    };

    const map = new google.maps.Map(heroMap[0], mapOptions);

    // Custom inline SVG icon
    const svgIcon = `
    <svg width="18" height="22" viewBox="0 0 18 22" fill="none" xmlns="http://www.w3.org/2000/svg">
<path d="M17.6201 7.45C16.5701 2.83 12.5401 0.75 9.0001 0.75C9.0001 0.75 9.0001 0.75 8.9901 0.75C5.4601 0.75 1.4201 2.82 0.370095 7.44C-0.799905 12.6 2.3601 16.97 5.2201 19.72C6.2801 20.74 7.6401 21.25 9.0001 21.25C10.3601 21.25 11.7201 20.74 12.7701 19.72C15.6301 16.97 18.7901 12.61 17.6201 7.45ZM9.0001 12.46C7.2601 12.46 5.8501 11.05 5.8501 9.31C5.8501 7.57 7.2601 6.16 9.0001 6.16C10.7401 6.16 12.1501 7.57 12.1501 9.31C12.1501 11.05 10.7401 12.46 9.0001 12.46Z" fill="#F9DCBC"/>
</svg>

    `;
    const encodedSVG = 'data:image/svg+xml;charset=UTF-8,' + encodeURIComponent(svgIcon);

    // Add a marker with the custom inline SVG icon
    const marker = new google.maps.Marker({
        position: { lat: lat, lng: lng },
        map: map,
        icon: {
            url: encodedSVG,
            scaledSize: new google.maps.Size(44, 44), // Adjust the size as needed
        },
        title: 'We are here',
    });

    // Create custom text overlay
    const textOverlay = new google.maps.OverlayView();
    textOverlay.onAdd = function () {
        const div = document.createElement('div');
        div.style.position = 'absolute';
        div.style.color = 'white';
        div.style.fontSize = '4rem';
        div.style.fontStyle = 'italic';
        div.style.textAlign = 'center';
        div.innerHTML = 'We are here';
        this.div_ = div;

        const panes = this.getPanes();
        panes.overlayLayer.appendChild(div);
    };

    let transformStyle = 'translate(-50%, -150%)';
    // If mobile
    if (window.innerWidth <= 1024) {
        transformStyle = 'translate(-50%, -200%)';
    }
    textOverlay.draw = function () {
        const overlayProjection = this.getProjection();
        const position = overlayProjection.fromLatLngToDivPixel(marker.getPosition());

        const div = this.div_;
        div.style.left = position.x + 'px';
        div.style.top = position.y + 'px';

        // Adjust the text position relative to the marker
        div.style.transform = transformStyle;
    };

    textOverlay.onRemove = function () {
        this.div_.parentNode.removeChild(this.div_);
        this.div_ = null;
    };

    textOverlay.setMap(map);

    // Hide all controls
    map.setOptions({ disableDefaultUI: true });
});
