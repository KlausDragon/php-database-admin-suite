<?php
session_start();

if (isset($_POST["confirm"])) {
    if ($_POST['confirm'] == "yes") {
        require_once "dbinfo.php";
        $mysqli = new mysqli(DB_HOST, DB_USER, DB_PASS, DB_NAME);
        if ($mysqli->connect_errno) {
            die("<p>Could not connect to DB: " . $mysqli->connect_error . "</p>");
        }
        $escaped_id = $mysqli->real_escape_string(trim($_POST['id']));
        $query = "DELETE FROM students WHERE id = '$escaped_id'";
        $result = $mysqli->query($query);
        if (!$result) {
            die("<p>Could not delete from DB: " . $mysqli->error . "</p>");
        }
        $firstname = trim($_POST['firstname']);
        $lastname = trim($_POST['lastname']);
        $_SESSION['successMessage'] = "<p class='success-message'>" . $firstname . " " . $lastname . " was deleted from the database successfully!</p>";
        header("Location: index.php");
        die();
    } else {
        $_SESSION['errorMessages'] = "<p class='error-message'>Deletion cancelled!</p>";
        header("Location: index.php");
        die();
    }
}

$mysqli->close();
