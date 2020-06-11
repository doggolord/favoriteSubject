<?php
require 'connection.php';

if ($_GET['limit']) {
    $limitSQL = ' limit 0, ' . $_GET['limit'];
} else {
    $limitSQL = '';
}

$query = "SELECT * FROM games" . mysqli_real_escape_string($mysqli ,$limitSQL);

$games =
    [
        'info' => [
            'name' => 'Gert Indrek Poljakov',
            'description' => 'Games'
        ],
    ];

if ($result = $mysqli->query($query)) {
    while ($game = $result->fetch_array()) {
        $games['data'][] =
            [
                'id' => $game['id'],
                'title' => $game['title'],
                'description' => $game['description'],
                'image' => $game['image'],
                'topic1'=> $game['genre'],
                'topic2' => $game['price']
        ];
    }
    $result->close();
}
header('Content-Type: application/json');
echo json_encode($games);