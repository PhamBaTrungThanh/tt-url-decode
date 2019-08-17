<?php
require __DIR__ . '/vendor/autoload.php';

use GuzzleHttp\Client;

$isPost = $_SERVER['REQUEST_METHOD'] === "POST";

if ($isPost) {
    $link = str_replace("bit.@ly", "bit.ly", $_POST["link"]);
    $client = new Client(['allow_redirects' => ['track_redirects' => true]]);
    $response = $client->get($link);
    $headersRedirect = $response->getHeader(\GuzzleHttp\RedirectMiddleware::HISTORY_HEADER);
    $final_link = str_replace("https://www.hoichiaselink.info/p/lay-link.html?url=", "", $headersRedirect[0]);

    $final_link_decoded = urldecode(base64_decode($final_link));
    header("Location: " . $final_link_decoded, true, 302);
    exit();
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <title>Decode URL</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="diemdanh.css">
</head>

<body>
    <section class="hero is-fullheight">
        <div class="hero-body">
            <div class="container has-text-centered">
                <header>
                    <p class="title is-2 is-size-1-desktop is-spaced has-text-primary">Decode URL</p>
                </header>
                <section class="container">
                    <form method="POST">
                        <p class="field">
                            <input type="text" name="link" value="" class="input">
                        </p>
                        <br />
                        <p>
                            <button class="button is-info is-large" type="submit">
                                <span>Lấy link</span>
                            </button>
                        </p>
                    </form>
                </section>
            </div>
        </div>
    </section>
</body>

</html>