import L from 'leaflet'
import 'leaflet/dist/leaflet.css'
export default class Map {

    static init () {
        let map = document.querySelector('#map')
        if (map === null) {
            return
        }
        let icon = L.icon({
            iconUrl: '/images/marker-icon.png',
           
           
        });
        let center = [map.dataset.lat, map.dataset.lng]
        map = L.map('map').setView(center, 13)
        let token = 'pk.eyJ1IjoibW9pbWVkIiwiYSI6ImNqdzY0YjFvMTA3YWM0ZW80anRpb2J6a2YifQ.RAQMkgEcqflyItuyKlygvA'
        L.tileLayer(`https://api.mapbox.com/v4/mapbox.streets/{z}/{x}/{y}.png?access_token=${token}`, {
            maxZoom: 18,
            minZoom: 12,
            attribution: '<a href="https://www.mapbox.com/feedback">Mapbox</a> <a href="http://www.openstreetmap.org/copyright">OpenStreetMap</a>'

        }).addTo(map)
        L.marker(center, {icon: icon}).addTo(map)
    
    }

}