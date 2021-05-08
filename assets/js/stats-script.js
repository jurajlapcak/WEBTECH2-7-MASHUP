function getMainContent() {
    const url = 'https://wt98.fei.stuba.sk/mashup/api/statsApi.php';
    const request = new Request(url, {
        method: 'GET',
        headers: {
            'Content-type': 'application/json; charset=UTF-8'
        }
    });

    fetch(request)
        .then((response) => response.json())
        .then((data) => {
            var mymap = L.map('mapid').setView([51.505, -0.09], 13);

            L.tileLayer('https://api.mapbox.com/styles/v1/{id}/tiles/{z}/{x}/{y}?access_token={accessToken}', {
                attribution: 'Map data &copy; <a href="https://www.openstreetmap.org/">OpenStreetMap</a> contributors, <a href="https://creativecommons.org/licenses/by-sa/2.0/">CC-BY-SA</a>, Imagery © <a href="https://www.mapbox.com/">Mapbox</a>',
                maxZoom: 18,
                id: 'mapbox/streets-v11',
                tileSize: 512,
                zoomOffset: -1,
                accessToken: 'pk.eyJ1IjoibGp1cmFqIiwiYSI6ImNraDNhYnQwcDBtdG0zMGxzNjJoa2V4c3QifQ.nv7w4gQJ_HylQv8pPGiVSQ'
            }).addTo(mymap);

            if (data.location !== false) {
                mymap.setView([data.location[0].lat, data.location[0].lng],2);
                data.location.forEach(element => {
                    console.log(element)
                    var marker = L.marker([element.lat, element.lng]).addTo(mymap);

                });
            }
        });
}
