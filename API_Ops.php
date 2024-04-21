<?php


$url_1='https://online-movie-database.p.rapidapi.com/actors/list-born-today?month='.$_GET['month'].'&day='.$_GET['day'];

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

$response_1=curl_exec($curl_1);
$responsejson_1=json_decode($response_1,true);
//$err = curl_error($curl_1);
curl_close($curl_1);
/*
if ($err) {
    echo "cURL Error #:" . $err;
} else {
    echo $response;
}*/





if(!empty($responsejson_1['data']))
{
    foreach ($responsejson_1['data'] as $actor) {
        $actor_id=$actor['nconst'];
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
        $response = curl_exec($curl_2);
        $responsejson = json_decode($response,true);
        if (!empty($response_json['data'])) {

            echo "Actor: " . $actor['primaryName'] . "<br>";
        }


        curl_close($curl_2);

    }
}
else
{
    echo "No actors found for today.";
}
?>
