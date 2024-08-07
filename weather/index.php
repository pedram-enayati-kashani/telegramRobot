<?php 

$curl = curl_init();

$apiKey = '0e5e3bce723d478d9be95137240508';

$url = "http://api.weatherapi.com/v1/current.json?key=$apiKey&q=tehran&aqi=no";

curl_setopt($curl,CURLOPT_URL,$url);
curl_setopt($curl,CURLOPT_RETURNTRANSFER,true);
$output = curl_exec($curl);
$data = json_decode($output,true);
curl_close($curl);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <h1><?= $data['location']['name'] ?></h1>
    <h4><?= $data['location']['country'] ?></h4>
    <hr>
    <h2><?= round($data['current']['temp_c']) ?></h2>
    <h5><?= $data['current']['condition']['text'] ?></h5>
    <div>
        <pre>
        <?php var_dump($data)  ?>
    </div>
</body>
</html>