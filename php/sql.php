<?php
$host = getenv('DB_HOST');
$db   = getenv('DB_NAME');
$user = getenv('DB_USER');
$pass = getenv('DB_PASSWORD');
$dsn = "pgsql:host=$host;port=5432;dbname=$db";
try {
    $pdo = new PDO($dsn, $user, $pass, [
            PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION
    ]);
} catch (PDOException $e) {
    die($e->getMessage());
}
$stmt = $pdo->query("SELECT current_database()");
$row = $stmt->fetch();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
    <title>SQL Statement</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-sRIl4kxILFvY47J16cr9ZwB07vP4J8+LH7qKQnuqkuIAvNWLzeN8tE5YBujZqJLB" crossorigin="anonymous">
    <link rel="stylesheet" href="../css/styles.css" />
</head>
<body>

<!-- NAVBAR -->
<nav>
    <a class="nav-brand" href="#">LN</a>

    <ul class="nav-links">
        <li><a href="../index.php">Home</a></li>
        <li class="active"><a href="php/sql.php">SQL Statement</a></li>
    </ul>

    <ul class="nav-right">
        <li><a href="#" data-bs-toggle="modal" data-bs-target="#SignUp">&#128100; Sign Up</a></li>
        <li><a href="#" data-bs-toggle="modal" data-bs-target="#Login">&#128274; Login</a></li>
    </ul>

    <button class="nav-toggle" id="navToggle" aria-label="Toggle menu">
        <span></span>
        <span></span>
        <span></span>
    </button>
</nav>

<div id="SignUp" class="modal fade" role="dialog">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Sign Up!</h4>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>

            <div class="modal-body">
                <p>I haven't added this feature yet! Hoping to eventually add a way to demo my database!</p>
            </div>
        </div>
    </div>
</div>
<div id="Login" class="modal fade" role="dialog">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Login!</h4>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>

            <div class="modal-body">
                <p>I haven't added this feature yet! Hoping to eventually add a way to demo my database!</p>
            </div>
        </div>
    </div>
</div>

<!-- MOBILE MENU -->
<div class="nav-mobile" id="navMobile">
    <a href="#">Home</a>
    <a href="#">SQL Statement</a>
    <a href="#">Sign Up</a>
    <a href="#">Login</a>
</div>

<main class="centered">
    <h1>PostgreSQL</h1>
    <section>
        <h3>Why Postgres?</h3>
        <p>The reason I chose Postgres was partly because this is the DB I studied in school.
            I learned how to create a sharded cluster and learned to use my first SQL statement with Postgres.
            <b>As for the why?</b></p>
        <p>Postgres offers a few things I think is beneficial for me to learn.</p>
        <ul>
            <li>Defining my own data types</li>
            <li>Building Custom Functions</li>
            <li>Scalable</li>
            <li>Open Source (Cause free tools are the best tools while you're in college 😉)</li>
        </ul>
    </section>
    <section>
        <h3>SQL Statement</h3>

    </section>
</main>

</body>
</html>