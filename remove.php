<?php
const STYLE = "styles/styles.css";
?>

<head>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>php-project</title>
    <link rel="stylesheet" href="styles/normalize-fwd.css">
    <link rel="stylesheet" href="<?php echo STYLE ?>">
    <script src="scripts/script.js" defer></script>
</head>

<body class="dark-mode">
    <header>
        <div class="site-header">
            <a href="#" class="logo"><img src="images/klaus.ico" alt="logo"></a>
            <span class="bordered-text">secure database administration interface</span>
            <input class="switch" type="checkbox">
        </div>
    </header>
    <div id="wrapper">
        <main>
            <h2>Administering Database from a form</h2>
            <h3>Delete a student..</h3>
            <?php
            session_start();
            if (isset($_SESSION['errorMessages'])) {
                echo $_SESSION['errorMessages'];
                unset($_SESSION['errorMessages']);
            }
            require_once "dbinfo.php";
            $mysqli = new mysqli(DB_HOST, DB_USER, DB_PASS, DB_NAME);
            if ($mysqli->connect_errno) {
                die("<p>Could not connect to DB: " . $mysqli->connect_error . "</p>");
            }
            if (isset($_GET['id'])) {
                $id = $_GET['id'];
                $query = "SELECT id, firstname, lastname FROM students WHERE id = '$id'";
                $result = $mysqli->query($query);
                if (!$result) {
                    die("<p>Could not query DB: " . $mysqli->error . "</p>");
                }
                if ($result->num_rows === 0) {
                    die("<p>Nothing to delete!</p>");
                }
                $row = $result->fetch_assoc();
                $firstname = $row['firstname'];
                $lastname = $row['lastname'];
                $id = $row['id'];
            } else {
                die("<p>No ID specified!</p>");
            }
            ?>
            <section>
                <h4>Delete a record - Sure?</h4>
                <form action="removeProcessor.php" method="post">
                    <fieldset>
                        <label for="id"><?php echo "$id $firstname $lastname" ?></label>
                        <br>
                        <input type="hidden" name="id" value="<?php echo $id ?>">
                        <input type="hidden" name="firstname" value="<?php echo $firstname ?>">
                        <input type="hidden" name="lastname" value="<?php echo $lastname ?>">
                        <input type="radio" name="confirm" value="yes">
                        <label for="yes">Yes</label>
                        <input type="radio" name="confirm" value="no">
                        <label for="no">No</label>
                        <br>
                        <input type="submit" value="Confirm">
                    </fieldset>
                </form>
            </section>
        </main>
    </div>
    <footer>
        <div class="site-footer">
            <ul class="social-icons">
                <li><a href="https://github.com/KlausDragon" target="_blank" rel="noopener"><i><img src="images/square-github.svg" alt="GitHub"></i></a></li>
                <li><a href="https://www.linkedin.com/in/aliiabbasii/" target="_blank" rel="noopener"><i><img src="images/linkedin.svg" alt="linkedin"></i></a></li>
                <li><a href="https://www.instagram.com/klaus.dragon/" <li><a href="https://www.instagram.com/klaus.dragon/" target="_blank" rel="noopener"><i><img src="images/square-instagram.svg" alt="Instagram"></i></a></li>
            </ul>
            <p>&copy; <?php echo date("Y"); ?> Ali Abbasi.</p>
        </div>
    </footer>
</body>

</html>