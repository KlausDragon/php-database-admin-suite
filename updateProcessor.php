<?php

session_start();

$id                = "";
$firstname        = "";
$lastname        = "";

if (!isset($_POST['id']) && !isset($_POST['firstname']) && !isset($_POST['lastname'])) {
    $_SESSION['errorMessages'] = "<p class='error-message'>No data was sent!</p>";
    header("Location: update.php?id=$formerId");
    die();
} else {

    $formerId = trim($_SESSION['formerId']);
    $id = trim($_POST['id']);
    $firstname = trim($_POST['firstname']);
    $lastname = trim($_POST['lastname']);

    if (empty($id) || empty($firstname) || empty($lastname)) {
        $_SESSION['errorMessages'] = "<p class='error-message'>Please fill out all fields!</p>";
        header("Location: update.php?id=$formerId");
        die();
    } else {
        if (strlen($id) != 9) {
            $_SESSION['errorMessages'] = "<p class='error-message'>Please enter a valid student number...</p>";
            header("Location: update.php?id=$formerId");
            die();
        } else if ($id != $formerId) {
            require_once "dbinfo.php";
            $mysqli = new mysqli(DB_HOST, DB_USER, DB_PASS, DB_NAME);
            if ($mysqli->connect_errno) {
                die("<p>Could not connect to DB: " . $mysqli->connect_error . "</p>");
            }
            if ($mysqli->query("SELECT id FROM students WHERE id = '$id'")->num_rows > 0) {
                $_SESSION['errorMessages'] = "<p class='error-message'>Sorry, this student already exists...</p>";
                header("Location: update.php?id=$formerId");
                die();
            }
        }
        require_once "dbinfo.php";
        $mysqli = new mysqli(DB_HOST, DB_USER, DB_PASS, DB_NAME);
        if ($mysqli->connect_errno) {
            die("<p>Could not connect to DB: " . $mysqli->connect_error . "</p>");
        }
        $escaped_id = $mysqli->real_escape_string($id);
        $escaped_firstname = $mysqli->real_escape_string($firstname);
        $escaped_lastname = $mysqli->real_escape_string($lastname);
        $query = "UPDATE students SET id = '$escaped_id', firstname = '$escaped_firstname', lastname = '$escaped_lastname' WHERE id = '$formerId'";
        $result = $mysqli->query($query);
        if (!$result) {
            die("<p>Could not update DB: " . $mysqli->error . "</p>");
        }
        $_SESSION['successMessage'] = "<p class='success-message'>" . $firstname . " " . $lastname . " was updated successfully!</p>";
        header("Location: index.php");
        die();
    }
}
