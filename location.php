<html lang="sk">
<head>
    <title>Mashup</title>
    <meta charset="UTF-8">
    <meta name="author" content="Juraj Lapčák">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"
            integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/css/bootstrap.min.css" rel="stylesheet"
          integrity="sha384-BmbxuPwQa2lc/FVzBcNJ7UAyJxM6wuqIj61tLrc4wSX0szH/Ev+nYRRuWlolflfl" crossorigin="anonymous">

    <link href="/mashup/assets/css/style.css" rel="stylesheet">
    <script src="/mashup/assets/js/location-script.js"></script>
    <script src="/mashup/assets/js/script.js"></script>
</head>
<body>
<?php include(__DIR__ . "/partials/header.php"); ?>

<div class="row mt-5">
    <div class="col-lg ">
        <main class="site-content">
            <div class="container-fluid">
                <div class="row justify-content-md-center">
                    <div class="col-md-auto">
                        <p>Tieto údaje su získané na základe vašej IP adresy.</p>
                        <table>
                            <tr>
                                <th class="naming-cell">IP adresa:</th>
                                <th class="value-cell d-flex" id="ip">
                                    <div>Načítava sa</div>
                                    <div class="loader"></div>
                                </th>
                            </tr>
                            <tr>
                                <th class="naming-cell">GPS lokácia:</th>
                                <th class="value-cell d-flex" id="coords">
                                    <div>Načítava sa</div>
                                    <div class="loader"></div>
                                </th>
                            </tr>
                            <tr>
                                <th class="naming-cell">Mesto:</th>
                                <th class="value-cell d-flex" id="city">
                                    <div>Načítava sa</div>
                                    <div class="loader"></div>
                                </th>
                            </tr>
                            <tr>
                                <th class="naming-cell">Krajina:</th>
                                <th class="value-cell d-flex" id="country">
                                    <div>Načítava sa</div>
                                    <div class="loader"></div>
                                </th>
                            </tr>
                            <tr>
                                <th class="naming-cell">Hlavné mesto:</th>
                                <th class="value-cell d-flex" id="capital">
                                    <div>Načítava sa</div>
                                    <div class="loader"></div>
                                </th>
                            </tr>
                        </table>
                    </div>
                </div>
            </div>
        </main>
    </div>
</div>

<?php include(__DIR__ . "/partials/footer.php"); ?>
<?php include(__DIR__ . "/partials/site-modal.php"); ?>
</body>
</html>
