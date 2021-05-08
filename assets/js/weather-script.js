function getMainContent() {
    let timeoffset = new Date().getTimezoneOffset() / 60 * (-1);
    document.cookie = "timeoffset=" + timeoffset;

    const target = document.getElementById("weather-content");

    const url = 'https://wt98.fei.stuba.sk/mashup/api/weatherApi.php?timeoffset=' + timeoffset;
    const request = new Request(url, {
        method: 'GET',
        headers: {
            'Content-type': 'application/json; charset=UTF-8'
        }
    });

    fetch(request)
        .then((response) => response.json())
        .then((data) => {
            if (data.error === false) {
                target.innerHTML = data.data;
            }
        });
}