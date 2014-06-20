<?php

// Get new instance of PDO object
$dbc = new PDO('mysql:host=127.0.0.1;dbname=codeup_pdo_test_db', 'creyna', 'chris');

// Tell PDO to throw exceptions on error
$dbc->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

echo $dbc->getAttribute(PDO::ATTR_CONNECTION_STATUS) . "\n";

// Create the query and assign to var
$query = 'CREATE TABLE fav_teams (
    id INT UNSIGNED NOT NULL AUTO_INCREMENT,
    name VARCHAR(24) NOT NULL,
    location VARCHAR(50) NOT NULL,
    sport VARCHAR(50) NOT NULL,
    PRIMARY KEY (id)
)';

// Run query, if there are errors they will be thrown as PDOExceptions
$dbc->exec($query);

$teams = [
    ['name' => 'Spurs',   'location' => 'San Antonio', 'sport' => 'Basketball'],
    ['name' => 'Cowboys',   'location' => 'Dallas', 'sport' => 'Football'],
    ['name' => 'Rangers', 'location' => 'Texas', 'sport' => 'Baseball']
];

foreach ($teams as $team) {
    $query1 = "INSERT INTO fav_teams (name, location, sport) VALUES ('{$team['name']}', '{$team['location']}', '{$team['sport']}')";

    $dbc->exec($query1);

    echo "Inserted ID: " . $dbc->lastInsertId() . PHP_EOL;
}