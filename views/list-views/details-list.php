<?php

session_start();

// namespace PhPKnights\Model;

use PhPKnights\Model\{Database, Lists};
// require_once '../vendor/autoload.php';  <---- Not working for some reason, to figure out later

require_once '../../Model/Database.php';
require_once '../../Model/List.php';

$dbcon = Database::getDb();

// Checkign to see if the detailsList button is set? From list???? 
if(isset($_POST['detailsList'])){
    // retrieving the id of the car to be updated
    $userListId= $_POST['id'];
    $_SESSION['userListId'] = $userListId;
    $db = Database::getDb();

    $listClass = new Lists();

    // getting the info for the car based on the id
    $lists = $listClass->getListDetails($userListId, $db);
    $specificList = $listClass->getListById($userListId,$db);

    // foreach ($lists as $list) {
    //     $movies = $movie->getMovie($list->movie_id, $db);
    //     var_dump($movies);
    // }
    $title = $specificList->list_name;
    // var_dump($title);
} else {

    $userListId = $_SESSION['userListId'] ;

    $db = Database::getDb();

    $listClass = new Lists();

    // getting the info for the car based on the id
    $lists = $listClass->getListDetails($userListId, $db);
    $specificList = $listClass->getListById($userListId,$db);

    $title = $specificList->list_name;

}

?>

<html lang="en">
<head>
    <title> User Created Movie Lists</title>
    <meta name="description" content="User Created Movie Lists">
    <meta name="keywords" content="Movie Lists">
    <link rel="stylesheet" href="../../styles/style.css" type="text/css">
    <!-- <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous"> -->
</head>

    <body>
        <!--Header-->
        <?php require_once '../header.php' ?>

        <main id="main">
            <p class="h1 text-center"> <?= $title; ?></p>
            <div class="m-1">
                <!--    Displaying Data in Table-->
                <table class="table table-bordered tbl">
                    <thead>
                    <tr>
                        <th scope="col">Movie Id</th>
                        <th scope="col">Movie Name</th>
                        <th scope="col">Movie Description</th>
                    </tr>
                    </thead>
                    <tbody>
                    <?php foreach ($lists as $list) { 
                        $movies = $listClass->getMovie($list->movie_id, $db);
                        ?>
                        <tr>
                            <td><?= $list->movie_id; ?></td>
                            <td><?= $movies->name; ?></td>
                            <td><?= $movies->description; ?></td>
                        </tr>
                    <?php } ?>
                    </tbody>
                </table>
                <a href="./add-movie-to-list.php" id="btn_addList" class="btn btn-success btn-lg float-right">Add Movie To List</a>
                <div>
                    <a href="./user-lists.php" id="btn_back" class="btn btn-success float-left">Back</a>
                </div>
            </div>
        </main>

        <!--Footer-->
        <?php require_once '../footer.php' ?>
    </body>
</html>