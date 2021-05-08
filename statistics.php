<?php
require_once (__DIR__ . "/classes/controllers/VisitorController.php");
require_once (__DIR__ . "/classes/controllers/SiteVisitController.php");
$visitorController = new VisitorController();
$siteController = new SiteVisitController();
?>
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

    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.7.1/dist/leaflet.css"
          integrity="sha512-xodZBNTC5n17Xt2atTPuE1HxjVMSvLVW9ocqUKLsCC5CXdbqCmblAshOMAS6/keqq/sMZMZ19scR4PsZChSR7A=="
          crossorigin=""/>

    <script src="https://unpkg.com/leaflet@1.7.1/dist/leaflet.js"
            integrity="sha512-XQoYMqMTK8LvdxXYG3nZ448hOEQiglfqkJs1NOQV44cWnUrBc8PkAOcXy20w0vlaXaVUearIOBhiXZ5V3ynxwA=="
            crossorigin=""></script>

    <link href="/mashup/assets/css/style.css" rel="stylesheet">
    <script src="/mashup/assets/js/stats-script.js"></script>
    <script src="/mashup/assets/js/script.js"></script>
</head>
<body>
<?php include(__DIR__ . "/partials/header.php"); ?>

<div class="row mt-5">
    <div class="col-lg ">
        <main class="site-content">
            <div class="container-fluid">

                <div class="row">

                    <?php echo $visitorController->getCountryIpTable();?>
                    <div id="mapid" class="mb-2"></div>
                    <?php echo $visitorController->getTimeStats();?>
                    <?php echo $siteController->visitTable();?>
                </div>
            </div>
        </main>
    </div>
</div>

<?php include(__DIR__ . "/partials/footer.php"); ?>
<?php include(__DIR__ . "/partials/site-modal.php"); ?>
</body>
</html>
