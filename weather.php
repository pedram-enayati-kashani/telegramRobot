<?php

$url = 'https://dummy.restapiexample.com/api/v1/employees';

$data = file_get_contents($url);

$response = json_decode($data);

$users = $response->data;

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    
    <?php foreach($users as  $user): ?>

        <h2> <?= $user->employee_name ?></h2>

    <?php endforeach; ?>

</body>
</html>