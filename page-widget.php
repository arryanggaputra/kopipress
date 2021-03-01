<?php /* Template Name: Page for Widget Covid-19 */?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <?php wp_head();?>
    <style>
    :root {
        --background-color: white;
        --box-color: #ebebeb;
        --text-color: #21262c;
        --number-font-size: 2rem;
        --heading-font-size: 1.6rem;
    }

    html,
    body {
        margin: 0px !important;
        padding: 0px !important;
    }

    body {
        background-color: var(--background-color);
        margin: 0px;
        font-family: "IBM Plex Sans", -apple-system, BlinkMacSystemFont,
            "Segoe UI", Roboto, "Helvetica Neue", Arial, sans-serif,
            "Apple Color Emoji", "Segoe UI Emoji", "Segoe UI Symbol";
        text-align: center;
        color: var(--text-color);
    }

    #root {
        padding: 1rem;
        height: calc(100vh - 2rem);
        display: flex;
        flex-direction: row;
        align-items: center;
    }

    #root .maincontainer {
        width: 100%;
    }

    body.darkmode {
        --background-color: #21262c;
        --box-color: #282d33;
        --text-color: #fff;
    }

    .cornflowerblue {
        color: cornflowerblue;
    }

    .orange {
        color: #f5a623;
    }

    .green {
        color: #219653;
    }

    .red {
        color: #d8232a;
    }

    .container {
        display: grid;
        grid-template-columns: 25% 25% 25% 25%;
        margin-bottom: 1.5rem;
        margin: auto;
    }

    @media (max-width: 640px) {
        .container {
            grid-template-columns: 50% 50%;
        }
    }

    @media (max-width: 480px) {
        body {
            --number-font-size: 1.2rem;
            --heading-font-size: 1.3rem;
        }

        .box {
            margin: 0.2rem !important;
        }

        .box .label {
            font-size: 0.65rem !important;
        }
    }

    h1 {
        margin: 0px;
        padding: 0px;
        font-size: var(--heading-font-size);
    }

    .box {
        margin: 1rem;
        display: flex;
        flex-direction: column;
        align-items: center;
        padding: 0.7rem;
        background-color: var(--box-color);
        border-radius: 6px;
        margin-bottom: 0.3rem;
    }

    .box .number {
        font-family: "IBM Plex Mono", monospace;
        font-size: var(--number-font-size);
    }

    .box .label {
        font-size: 0.8rem;
        text-align: center;
    }

    .footer {
        display: flex;
        flex-direction: column;
        color: #858a93;
        font-weight: 400 !important;
        text-align: center;
    }

    .footer a {
        color: inherit;
    }

    .footer .info {
        font-size: 0.7rem;
    }

    .footer .date {
        font-size: 0.8rem;
        font-family: "IBM Plex Mono", monospace;
    }
    </style>
</head>

<body id="root" class="<?php
if (isset($_GET['dark'])) {
    echo 'darkmode';
}
?>">
    <div class="maincontainer">
        <link href="https://fonts.googleapis.com/css?family=IBM+Plex+Sans:400,700&display=swap" rel="stylesheet" />
        <link href="https://fonts.googleapis.com/css?family=IBM+Plex+Mono&display=swap" rel="stylesheet" />

        <h1>Update COVID-19 Indonesia</h1>

        <?php
$unparsed_json = file_get_contents("https://dekontaminasi.com/api/id/covid19/stats/");

$json_object = json_decode($unparsed_json, true);
$data        = $json_object['numbers'];
$date        = date('Y-m-d H:i:s', strtotime('-3 hour'));

function formatNumber($number)
{
    return number_format($number, 0, ",", ".");
}

?>

        <div class="container">
            <div class="box">
                <span class="number cornflowerblue" id="confirmed"><?php echo formatNumber($data['infected']); ?></span>
                <span class="label">Terkonfirmasi</span>
            </div>
            <div class="box">
                <span class="number orange"
                    id="activeCare"><?php echo formatNumber($data['infected'] - $data['recovered']); ?></span>
                <span class="label">Dirawat</span>
            </div>
            <div class="box">
                <span class="number green" id="recovered"><?php echo formatNumber($data['recovered']); ?></span>
                <span class="label">Sembuh</span>
            </div>
            <div class="box">
                <span class="number red" id="deceased"><?php echo formatNumber($data['fatal']); ?></span>
                <span class="label">Meninggal</span>
            </div>
        </div>

        <div class="footer">
            <span class="info">Pembaruan Terakhir</span>
            <span class="date">
                <span id="metadataDate"><?php echo $date; ?></span>
                <a href="//kopi.dev/widget-kawal-corona-wordpress-blogspot-statistik/" target="_blank"
                    title="Pasang widget kawal corona">
                    Pasang Widget
                </a>
            </span>
        </div>
    </div>


    <!-- Google Analytics -->
    <script>
    (function(i, s, o, g, r, a, m) {
        i['GoogleAnalyticsObject'] = r;
        i[r] = i[r] || function() {
            (i[r].q = i[r].q || []).push(arguments)
        }, i[r].l = 1 * new Date();
        a = s.createElement(o),
            m = s.getElementsByTagName(o)[0];
        a.defer = 1;
        a.src = g;
        m.parentNode.insertBefore(a, m)
    })(window, document, 'script', 'https://www.google-analytics.com/analytics.js', 'ga');

    ga('create', 'UA-142494062-1', 'auto');
    ga('send', 'pageview');
    </script>
    <!-- End Google Analytics -->
</body>

</html>