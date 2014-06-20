<?php

// Get new instance of PDO object
$dbc = new PDO('mysql:host=127.0.0.1;dbname=codeup_pdo_test_db', 'creyna', 'chris');

// Tell PDO to throw exceptions on error
$dbc->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

echo $dbc->getAttribute(PDO::ATTR_CONNECTION_STATUS) . "\n";

// // Create INSERT query
// $query = "INSERT INTO users (email, name) VALUES ('benb@codeup.com', 'Ben Batschelet')";

// // Execute Query
// $numRows = $dbc->exec($query);
// echo "Inserted $numRows row." . PHP_EOL;

$users = [
    ['email' => 'jason@codeup.com',   'name' => 'Jason Straughan'],
    ['email' => 'chris@codeup.com',   'name' => 'Chris Turner'],
    ['email' => 'michael@codeup.com', 'name' => 'Michael Girdley']
];

foreach ($users as $user) {
    $query = "INSERT INTO users (email, name) VALUES ('{$user['email']}', '{$user['name']}')";

    $dbc->exec($query);

    echo "Inserted ID: " . $dbc->lastInsertId() . PHP_EOL;
}