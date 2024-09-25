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
                    "visibility": "off"
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
    <svg width="24" height="27" viewBox="0 0 24 27" fill="none" xmlns="http://www.w3.org/2000/svg">
<path d="M20.6201 8.45C19.5701 3.83 15.5401 1.75 12.0001 1.75C12.0001 1.75 12.0001 1.75 11.9901 1.75C8.4601 1.75 4.4201 3.82 3.3701 8.44C2.2001 13.6 5.3601 17.97 8.2201 20.72C9.2801 21.74 10.6401 22.25 12.0001 22.25C13.3601 22.25 14.7201 21.74 15.7701 20.72C18.6301 17.97 21.7901 13.61 20.6201 8.45ZM12.0001 13.46C10.2601 13.46 8.8501 12.05 8.8501 10.31C8.8501 8.57 10.2601 7.16 12.0001 7.16C13.7401 7.16 15.1501 8.57 15.1501 10.31C15.1501 12.05 13.7401 13.46 12.0001 13.46Z" fill="#F9DCBC"/>
<ellipse cx="12" cy="25.5" rx="12" ry="1.5" fill="url(#paint0_radial_45_620)"/>
<defs>
<radialGradient id="paint0_radial_45_620" cx="0" cy="0" r="1" gradientUnits="userSpaceOnUse" gradientTransform="translate(12 25.5) scale(12 1.5)">
<stop/>
<stop offset="1" stop-opacity="0"/>
</radialGradient>
</defs>
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
        div.style.fontSize = '3rem';
        div.style.fontStyle = 'italic';
        div.style.textAlign = 'center';
        div.innerHTML = 'We are here';
        this.div_ = div;

        const panes = this.getPanes();
        panes.overlayLayer.appendChild(div);
    };

    let transformStyle = 'translate(-50%, -1570%)';
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
