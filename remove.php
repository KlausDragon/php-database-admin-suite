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
            <h3>Delete a student..</h3>
            <?php
                session_start();
                if(isset($_SESSION['errorMessages'])){
                    echo $_SESSION['errorMessages'];
                    unset($_SESSION['errorMessages']);
                }
            ?>
            <section>
                <h4>Delete a record - Sure?</h4>
                <form action="deleteProcessor.php" method="post">
                    <fieldset>
                        <label for="id">Ali Abbasi</label>
                        <br>
                        <input type="radio" id="yes" name="confirm" value="yes">
                        <label for="yes">Yes</label>
                        <input type="radio" id="no" name="confirm" value="no">
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
                <li><a href="https://www.instagram.com/klaus.dragon/"
				<li><a href="https://www.instagram.com/klaus.dragon/" target="_blank" rel="noopener"><i><img src="images/square-instagram.svg" alt="Instagram"></i></a></li>
			</ul>
			<p>&copy; <?php echo date("Y");?> Ali Abbasi.</p>
		</div>
	</footer>
</body>

</html>