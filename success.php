<?php
    session_start();

    require 'vendor/autoload.php';

    use Goutte\Client;

    if (!isset($_SESSION['logged_in']) || $_SESSION['logged_in'] !== true) {
        header("Location: index.html");
        exit;
    }

    // $url = 'https://auto.suzuki.com.ph/';

    // $options = [
    //     'http' => [web scraping
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
        <table class="min-w-full bg-white border border-gray-200">
            <thead>
                <tr class="w-full bg-gray-100">
                    <th class="py-2 px-4 border-b border-gray-200 text-left">Image</th>
                    <th class="py-2 px-4 border-b border-gray-200 text-left">Title</th>
                    <th class="py-2 px-4 border-b border-gray-200 text-left">Price</th>
                    <th class="py-2 px-4 border-b border-gray-200 text-left">Action</th>

                </tr>
            </thead>
            <tbody>
                <?php
                    $client = new Client();
                    $crawler = $client->request('GET', 'https://books.toscrape.com/');
                    $crawler->filter('.product_pod')->each(function ($node) {
                        echo '<tr>';
                        echo '<td class="py-2 px-4 border-b border-gray-200"><img src="https://books.toscrape.com/'.$node->filter('a img')->attr('src').'"></td>';
                        echo '<td class="py-2 px-4 border-b border-gray-200">'.$node->filter('.image_container img')->attr('alt').'</td>';
                        echo '<td class="py-2 px-4 border-b border-gray-200">'.$node->filter('.price_color')->text().'</td>';
                        echo '</tr>';
                    });
                ?>

            </tbody>
        </table>
    </div>
</body>
</html>

