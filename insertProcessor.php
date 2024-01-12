<?php

session_start();

$id                = "";
$firstname        = "";
$lastname        = "";

if (
    !isset($_POST['id']) ||
    !isset($_POST['firstname']) ||
    !isset($_POST['lastname'])
) {
    $_SESSION['errorMessages'] = "<p class='error-message'>Please register, its real easy to do...</p>";
    header("Location: insert.php");
    die();
}

if (trim($_POST['id']) == "" ||  trim($_POST['firstname']) == "" || trim($_POST['lastname']) == "") {
    $_SESSION['errorMessages'] = "<p class='error-message'>Please fill in the registration form...</p>";
    header("Location: insert.php");
    die();
}

$id                = trim($_POST['id']);
$firstname        = trim($_POST['firstname']);
$lastname        = trim($_POST['lastname']);

require_once "dbinfo.php";
$mysqli = new mysqli(DB_HOST, DB_USER, DB_PASS, DB_NAME);
if ($mysqli->connect_errno) {
    die("<p>Could not connect to DB: " . $mysqli->connect_error . "</p>");
}

$query = "SELECT id, firstname, lastname FROM students";

// regex for student number is $regex = '/^a0[0-9]{7}$/i';
if (strlen($id) != 9) {
    $_SESSION['errorMessages'] = "<p class='error-message'>Please enter a valid student number...</p>";
    header("Location: insert.php");
    die();
} else {
    $regex = '/^a0[0-9]{7}$/i';
    if (!preg_match($regex, $id)) {
        $_SESSION['errorMessages'] = "<p class='error-message'>Please enter a valid student number...</p>";
        header("Location: insert.php");
        die();
    }
}

if ($mysqli->query("SELECT id FROM students WHERE id = '$id'")->num_rows > 0) {
    $mysqli->close();
    $_SESSION['errorMessages'] = "<p class='error-message'>Sorry, this student already exists...</p>";
    header("Location: insert.php");
    die();
} else {

    $escaped_id = $mysqli->real_escape_string($id);
    $escaped_firstname = $mysqli->real_escape_string($firstname);
    $escaped_lastname = $mysqli->real_escape_string($lastname);

    $query = "INSERT INTO students (id, firstname, lastname) VALUES ('$escaped_id', '$escaped_firstname', '$escaped_lastname')";
    $result = $mysqli->query($query);
    if (!$result) {
        die("<p>Could not insert into DB: " . $mysqli->error . "</p>");
    }
    $mysqli->close();
    $_SESSION['successMessage'] = "<p class='success-message'>" . $firstname . " " .  $lastname . " was added to database successfully!</p>";
    header("Location: index.php");
    die();
}