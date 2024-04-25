


<?php

/*
backup API keys:

"X-RapidAPI-Key: 7b10f71653msh1434b7aec2de2c1p1add77jsnaa8d1aba73eb"
"X-RapidAPI-Key: 178c93142fmsh7f5c1328c36edfep1de9e9jsnb158b36f17b6"

*/
$actorNames = [];

$url_1 = 'https://online-movie-database.p.rapidapi.com/actors/list-born-today?month=' . $_POST['month'] . '&day=' . $_POST['day'];

$curl_1 = curl_init();

curl_setopt_array($curl_1, [
    CURLOPT_URL => $url_1,
    CURLOPT_RETURNTRANSFER => true,
    CURLOPT_ENCODING => "",
    CURLOPT_MAXREDIRS => 10,
    CURLOPT_TIMEOUT => 30,
    CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
    CURLOPT_CUSTOMREQUEST => "GET",
    CURLOPT_HTTPHEADER => [
        "X-RapidAPI-Host: online-movie-database.p.rapidapi.com",
        "X-RapidAPI-Key: 6325b644e9msh9488be2337c346dp100c01jsnb11b8c371a37"
    ],
]);

$response1 = curl_exec($curl_1);
$response1 = json_decode($response1);
curl_close($curl_1);

$counter = 0;  

foreach ($response1 as $actor) {
    
    if ($counter >= 12) {
        break;  
    }

    $actor_id = basename(parse_url($actor, PHP_URL_PATH));
    $url_2 = "https://online-movie-database.p.rapidapi.com/actors/get-bio?nconst=" . $actor_id;
    $curl_2 = curl_init();

    curl_setopt_array($curl_2, [
        CURLOPT_URL => $url_2,
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_ENCODING => "",
        CURLOPT_MAXREDIRS => 10,
        CURLOPT_TIMEOUT => 30,
        CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
        CURLOPT_CUSTOMREQUEST => "GET",
        CURLOPT_HTTPHEADER => [
            "X-RapidAPI-Host: online-movie-database.p.rapidapi.com",
            "X-RapidAPI-Key: 6325b644e9msh9488be2337c346dp100c01jsnb11b8c371a37"
        ],
    ]);

    $response2 = curl_exec($curl_2);
    $response2 = json_decode($response2);

    if (!empty($response2)) {
        $actorNames[] = $response2->name;
        $counter++;  
    }
    
    curl_close($curl_2);
}

echo json_encode($actorNames);


?>
