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
            return ($optional ? ("<b style=\"color: darkorange;\">OPTIONAL</b>") : ("<b style=\"color: red;\">FAIL</b>")) . " $description - <code>'$excepted'</code> must be same as <code>'$actual'</code><br/>";
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
    <style type="text/css">
        body { font-family: 'Red Hat Text', 'Roboto', sans-serif; font-size: 20px; margin: 0.5em; }
        #page { background-color: #ffffff; padding: 1em; word-spacing: 1px; line-height: 1.5; letter-spacing: 1px; }
        #page .logo { position: fixed; width: 200px; z-index: 1; }
        #page .content { display: flex; align-items: center; justify-content: center; color: #3d3d3d; }
        #page .page { min-width: 350px; width: 100%; max-width: 800px; text-align: justify; margin-bottom: 3em; }
        #page h1.top { font-weight: 700; font-size: 300%; margin-top: 2em; }
        #page h1 {  font-size: 200%; font-weight: 500; letter-spacing: 1px; margin-top: 2em; text-align: left; }
        #page .description { font-size: 0.9em; white-space: pre-line; }
        #page .button { text-decoration: none; border: 2px solid #3d3d3d; border-radius: 25px; padding: 10px 15px; color: #3d3d3d; cursor: pointer; margin: 15px; display: inline-block; font-weight: 500; text-transform: uppercase; }
        #page .button:hover { text-decoration: none; background-color: rgba(0,0,0,0.05); }
        #page a { color: #0080ff; font-weight: 600; text-decoration: none; }
        #page a:hover { text-decoration: underline; }
        #page a:visited { color: #0080ff; }
        #page dd { display: block; margin-inline-start: 40px; margin-top: .5em }
        @media only screen and (max-width: 1280px) {
            body { font-size: 16px; }
            #page .logo { position: static; margin: auto; }
            #page h1.top { font-size: 200%; margin-top: 1em; }
            #page h1 { font-size: 150%; }
        }
        code { background-color: lightslategray; color: white; border-radius: 5px; }
        footer { text-align: center; }
    </style>
</head>

<body>
<main id="page">
    <div class="logo">
        <a href="https://www.bulkgate.com/">
            <img src="https://portal.bulkgate.com/images/white-label/bulkgate/logo/logo-dark.svg" alt="BulkGate" />
        </a>
    </div>
    <div class="content">
        <div class="page">
            <div>
                <h1 class="top">BulkGate Module Tester</h1>
                <p class="description">
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
            </div>
        </div>
    </div>
    <footer>
        &copy; Lukáš Piják 2020 <small>TOPefekt s.r.o.</small><br/> <a href="https://github.com/BulkGate/">
                BulkGate GITHub
            </a>
    </footer>
</main>
</body>
</html>
