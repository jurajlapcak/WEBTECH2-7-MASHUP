window.addEventListener('DOMContentLoaded', (event) => {
    let modal = document.getElementById("site-modal");

    let cookie = getCookie("firsttime");
    if (cookie !== "") {
        hideModal(modal);
        getMainContent();
        countVisitor();
    } else {
        showModal(modal);
        document.getElementById("modal-approve").addEventListener("click", () => {
            setCookie("firsttime", "false", 365);
            hideModal(modal);
            getMainContent();
            countVisitor();
        });
    }
});

function setCookie(cname, cvalue, exdays) {
    var d = new Date();
    d.setTime(d.getTime() + (exdays * 24 * 60 * 60 * 1000));
    var expires = "expires=" + d.toUTCString();
    document.cookie = cname + "=" + cvalue + ";" + expires + ";path=/";
}

function getCookie(cname) {
    var name = cname + "=";
    var ca = document.cookie.split(';');
    for (var i = 0; i < ca.length; i++) {
        var c = ca[i];
        while (c.charAt(0) == ' ') {
            c = c.substring(1);
        }
        if (c.indexOf(name) == 0) {
            return c.substring(name.length, c.length);
        }
    }
    return "";
}

function countVisitor(){
    const url = 'https://wt98.fei.stuba.sk/mashup/api/visitorApi.php';

    const request = new Request(url, {
        method: 'GET',
        headers: {
            'Content-type': 'application/json; charset=UTF-8'
        }
    });

    fetch(request).then((response) => response.json()).then((data) => console.log(data));
}

function showModal(modal) {
    modal.style.display = "block";
}

function hideModal(modal) {
    modal.style.display = "none";
}