<?php
    require_once "dbinfo.php";
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
            <h3>Students:</h3>
            <a href="insert.php">Add a Student</a>
            <?php
                session_start();
                if(isset($_SESSION['successMessage'])){
                    echo $_SESSION['successMessage'];
                    unset($_SESSION['successMessage']);
                }
                if(isset($_SESSION['errorMessages'])){
                    echo $_SESSION['errorMessages'];
                    unset($_SESSION['errorMessages']);
                }
            ?>
            <table>
                <tr>
                    <th>id Number</th>
                    <th>Firstname</th>
                    <th>Lastname</th>
                    <th>Update</th>
                    <th>Delete</th>
                </tr>
                <?php
                    $mysqli = new mysqli(DB_HOST, DB_USER, DB_PASS, DB_NAME);

                    if ($mysqli->connect_errno) {
                        die("<p>Could not connect to DB: " . $mysqli->connect_error . "</p>");
                    }

                    $sql = "SELECT id, firstname, lastname FROM students";
                    $result = mysqli_query($mysqli, $sql);
                    if (mysqli_num_rows($result) > 0) {
                        while($row = mysqli_fetch_assoc($result)) {
                            echo "<tr>";
                            echo "<td>" . htmlspecialchars($row["id"]) . "</td>";
                            echo "<td>" . htmlspecialchars($row["firstname"]) . "</td>";
                            echo "<td>" . htmlspecialchars($row["lastname"]) . "</td>";
                            echo "<td><a href='update.php?id=" . htmlspecialchars($row["id"]) . "'>Update</a></td>";
                            echo "<td><a href='remove.php?id=" . htmlspecialchars($row["id"]) . "'>Delete</a></td>";
                            echo "</tr>";
                        }
                    } else {
                        echo "0 results";
                    }
                    mysqli_close($mysqli);
                ?>
            </table>
        </main>
    </div>
    <footer>
        <div class="site-footer">
            <ul class="social-icons">
                <li><a href="https://github.com/KlausDragon" target="_blank" rel="noopener"><i><img src="images/square-github.svg" alt="GitHub"></i></a></li>
                <li><a href="https://www.linkedin.com/in/aliiabbasii/" target="_blank" rel="noopener"><i><img src="images/linkedin.svg" alt="linkedin"></i></a></li>
                <li><a href="https://www.instagram.com/klaus.dragon/"
				<li><a href="https://www.instagram.com/klaus.dragon/" target="_blank" rel="noopener"><i><img src="images/square-instagram.svg" alt="Instagram"></i></a></li>
			</ul>
			<p>&copy; <?php echo date("Y");?> Ali Abbasi.</p>
		</div>
	</footer>
</body>

</html>