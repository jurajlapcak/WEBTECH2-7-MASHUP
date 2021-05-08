function getMainContent(){
    const url = 'https://wt98.fei.stuba.sk/mashup/api/locationApi.php';
    const request = new Request(url, {
        method: 'GET',
        headers: {
            'Content-type': 'application/json; charset=UTF-8'
        }
    });

    fetch(request)
        .then((response) => response.json())
        .then((data) => {
            console.log(data);
            if (data.error === false) {
                document.getElementById("ip").innerHTML = data.data.ip;
                document.getElementById("coords").innerHTML = data.data.lat + ", " + data.data.long;
                document.getElementById("city").innerHTML = data.data.city;
                document.getElementById("country").innerHTML = data.data.country;
                document.getElementById("capital").innerHTML = data.data.capital;
            }
        });
}