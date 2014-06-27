<?php
 if ($_POST){
    // Get new instance of PDO object
    $dbc = new PDO('mysql:host=127.0.0.1;dbname=codeup_pdo_test_db', 'creyna', 'chris');

    // Tell PDO to throw exceptions on error
    $dbc->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);


// // Create the query and assign to var
// $query = 'CREATE TABLE fav_teams (
//     id INT UNSIGNED NOT NULL AUTO_INCREMENT,
//     name VARCHAR(24) NOT NULL,
//     location VARCHAR(50) NOT NULL,
//     sport VARCHAR(50) NOT NULL,
//     PRIMARY KEY (id)
// )';

// // Run query, if there are errors they will be thrown as PDOExceptions
// $dbc->exec($query);

// $query1 = "INSERT INTO fav_teams (name, location, sport) VALUES ('{$team['name']}', '{$team['location']}', '{$team['sport']}')";
    $query1 = $dbc->prepare("INSERT INTO fav_teams (name, location, sport) VALUES (:name, :location, :sport)");
//always bind values to prevent SQL injection


    $query1->bindValue(':name', $_POST['name'], PDO::PARAM_STR);
    $query1->bindValue(':location', $_POST['location'], PDO::PARAM_STR);
    $query1->bindValue(':sport', $_POST['sport'], PDO::PARAM_STR);
    $query1->execute();

}