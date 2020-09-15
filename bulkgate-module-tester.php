<?php

    /**
     * @author Lukáš Piják 2020 TOPefekt s.r.o.
     * @link https://www.bulkgate.com/
     */

    $tests = 0; $success = 0;

    function same($excepted, $actual, $description, $optional = false)
    {
        global $tests, $success;

        $tests ++;

        if ($excepted === $actual)
        {
            $success ++;
            return "<b style=\"color: limegreen;\">OK</b> $description<br/>";
        }
        else
        {
            $error = error_get_last(); $error_message = '';

            if ($error !== null)
            {
                $error_message = $error['message'];
            }

            return ($optional ? ("<b style=\"color: darkorange;\">OPTIONAL</b>") : ("<b style=\"color: red;\">FAIL</b>")) . " $description - <b>Required:</b> <code>'$excepted'</code> must be same as <b>Actual:</b> <code>'$actual'</code><br/><b>ERROR: </b><code>$error_message</code><br/>";
        }
    }
?><!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no"/>
    <meta name="author" content="Lukáš Piják pijak(at)topefekt.com TOPefekt s.r.o.">

    <title>BulkGate Module Tester</title>

    <link rel="icon" href="https://portal.bulkgate.com/favicon_bulkgate.ico"/>
    <meta name="theme-color" content="#ffffff"/>

    <meta name="apple-mobile-web-app-status-bar-style" content="black">
    <meta name="apple-mobile-web-app-capable" content="yes">

    <link href="https://fonts.googleapis.com/css2?family=Red+Hat+Text:wght@400;500;700&family=Roboto&display=swap" rel="stylesheet">
    <link href="https://portal.bulkgate.com/static/bulkgate-simple-page.css" rel="stylesheet" />
</head>

<body>
    <header>
        <a href="https://www.bulkgate.com/">
            <img src="https://portal.bulkgate.com/images/white-label/bulkgate/logo/logo-dark.svg" alt="BulkGate" data-logo/>
        </a>
    </header>
    <main>
        <section>
            <h1>BulkGate Module Tester</h1>
            <p data-description>
                <?= 'PHP VERSION: <b>' . phpversion() . '</b><br/>' ?>
                <?= same(true, PHP_VERSION_ID >= 50300, 'PHP >= 5.3 version') ?>
                <?= same(true, extension_loaded('intl'), 'INTL extension', true) ?>
                <?= same(true, extension_loaded('curl'), 'cURL extension', true) ?>
                <?= same('s:8:"BulkGate";', serialize('BulkGate'), 'Serialize') ?>
                <?= same('BulkGate', unserialize('s:8:"BulkGate";'), 'Unserialize') ?>
                <?= same('QnVsa0dhdGU=', base64_encode('BulkGate'), 'Base64 encode') ?>
                <?= same('BulkGate', base64_decode('QnVsa0dhdGU='), 'Base64 decode') ?>
                <?= same('BulkGate', unserialize(gzinflate(substr(base64_decode(base64_encode(gzencode(serialize('BulkGate'), 9))), 10, -8))), 'Compress encode') ?>
                <?= same('BulkGate', unserialize(gzinflate(substr(base64_decode('H4sIAAAAAAACCiu2srBScirNyXZPLElVsgYA7fL+4A8AAAA='), 10, -8))), 'Compress decode') ?>
                <?= same('"BulkGate Encode"', json_encode('BulkGate Encode'), 'JSON encode') ?>
                <?= same('BulkGate Encode', json_decode('"BulkGate Encode"'), 'JSON decode') ?>
                <?= same(true, function_exists('apache_request_headers'), 'Function: apache_request_headers', true) ?>
                <?= same(true, function_exists('array_change_key_case'), 'Function: array_change_key_case') ?>
                <?= same(true, file_get_contents('https://portal.bulkgate.com/api/welcome'), 'Portal connection') ?>
            </p>
            <h2><?php
                if ($tests === $success)
                {
                    echo "All tests are <b style=\"color: limegreen;\">success</b>";
                }
                else
                {
                    echo "Some tests are <b style=\"color: red;\">failed</b>";
                }
            ?></h2>
        </section>
    </main>
    <footer>
        &copy; Lukáš Piják 2020 <small>TOPefekt s.r.o.</small><br/>
        <a href="https://github.com/BulkGate/">BulkGate GITHub</a>
    </footer>
</body>
</html>
