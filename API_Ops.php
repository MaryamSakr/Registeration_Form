<?php

$url_1 = 'https://online-movie-database.p.rapidapi.com/actors/list-born-today?month=' . $_GET['month'] . '&day=' . $_GET['day'];

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
        "X-RapidAPI-Key: 3ef6d553femsh1fece224baf6632p192d58jsnf7474723fa3b"
    ],
]);

$response1 = curl_exec($curl_1);
$response1= json_decode($response1);
curl_close($curl_1);

foreach ($response1 as $actor) {
    
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
            "X-RapidAPI-Key: 3ef6d553femsh1fece224baf6632p192d58jsnf7474723fa3b"
        ],
    ]);
    $response2 = curl_exec($curl_2);
    $response2 = json_decode($response2);
    if (!empty($respons2)) {

        echo "Actor: " . $response2->name . "<br>";
    }
    curl_close($curl_2);
}

?>
