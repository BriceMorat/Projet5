class LeafletMap {
    constructor(map, latLng, zoom, minZoom, maxZoom, layer, maxBounds) {
        this.map = map;
        this.latLng = latLng;
        this.zoom = zoom;
        this.layer = layer;
        this.minZoom = minZoom;
        this.maxZoom = maxZoom;
        this.maxBounds = maxBounds;
        
        this.init();
    }

//Lat and Lng recovery data with initialization of the map with location, markers and grouping of markers
    init() {
        this.initMap = L.map(this.map, {maxBounds: this.maxBounds}).setView(this.latLng, this.zoom);
        L.tileLayer(this.layer, {minZoom: this.minZoom, maxZoom: this.maxZoom}).addTo(this.initMap);
    }   

    latLngLocationSaved() {
        this.searchControl = L.esri.Geocoding.geosearch({placeholder : 'Nom de la ville ou de l\'endroit visité'}).addTo(this.initMap);
        this.results = L.layerGroup().addTo(this.initMap);
        this.searchControl.on("results", data => {
            this.results.clearLayers();
            for (let i = data.results.length - 1; i >= 0; i--) {
                this.results.addLayer(L.marker(data.results[i].latlng));  
                this.lat = [data.results[i].latlng.lat];
                this.lng = data.results[i].latlng.lng;
                this.city = [data.results[i].text];
                this.cityInput = document.getElementById('city');
                this.cityText = document.getElementById('cityText');
                this.cityInput.value = this.city;
                this.cityText.innerHTML = this.city;
                this.latInput = document.getElementById('lat');
                this.lngInput = document.getElementById('lng');
                this.latInput.value = this.lat;
                this.lngInput.value = this.lng;
                this.submitPost = document.getElementById('submitForm');
                this.submitPost.addEventListener('click', () => {
                    this.cityInput.disabled = false;
                    this.latInput.disabled = false;
                    this.lngInput.disabled = false;
                })  
            }
        });   
    }

    displayMarkers() {
        this.travelerIcon = L.icon({
            iconUrl : 'public/img/traveler-person-icon.png',
            iconSize: [35, 35]
        });

        this.markersCluster = L.markerClusterGroup();
        this.initMap.addLayer(this.markersCluster);
        this.latRec = document.querySelectorAll('.latRec');
        this.lngRec = document.querySelectorAll('.lngRec');

        for (let i = 0; i < this.latRec.length; i++) {

            this.latRec[i].innerText;
            this.lngRec[i].innerText;
            this.marker = L.marker([(this.latRec[i].innerText), (this.lngRec[i].innerText)], {icon: this.travelerIcon});  
            this.markersCluster.addLayer(this.marker);
            this.marker.on('click', () => {
                this.currentSlide = 0;
                this.markerImages = document.getElementsByClassName('markerImagesFigure')[i];
                $(this.markerImages).addClass('visible').siblings().removeClass('visible');
                
            });
        };
    }
}

