<?php
    session_start();

    if (!isset($_SESSION['logged_in']) || $_SESSION['logged_in'] !== true) {
        header("Location: index.html");
        exit;
    }

    // $url = 'https://auto.suzuki.com.ph/';

    // $options = [
    //     'http' => [
    //         'header' => "User-Agent: Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/58.0.3029.110 Safari/537.36"
    //     ]
    // ];
    // $context = stream_context_create($options);

    // $html = file_get_contents($url, false, $context);

    // $dom = new DOMDocument();
    // @$dom->loadHTML($html);

    // $links = $dom->getElementsByTagName('homeSuzukiCard');

    // foreach ($links as $link) {
    //     echo $link->getAttribute('href') . "<br>";
    // }

?>



<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
</head>
<body>

    <?php
        include('includes/nav.html');
    ?>
    <div id="links-container" class="mt-16 pl-4">
        <?php
        $url = 'https://auto.suzuki.com.ph/';

        $options = [
            'http' => [
                'header' => "User-Agent: Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/58.0.3029.110 Safari/537.36"
            ]
        ];
        $context = stream_context_create($options);

        $html = file_get_contents($url, false, $context);

        $dom = new DOMDocument();
        @$dom->loadHTML($html);

        $links = $dom->getElementsByTagName('a');

        foreach ($links as $link) {
            echo "<a href='" .$url.$link->getAttribute('href') . "'>" . $link->nodeValue . "</a><br>";
        }

        var_dump($_SESSION['logged_in']);
        ?>
    </div>
</body>
</html>

