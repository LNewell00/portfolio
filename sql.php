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
    <link rel="stylesheet" href="styles.css" />
    <style>
        body {
            justify-content: flex-start;
        }
        nav {
            position: static;
            width: 100%;
            background: #0f0f0f;
            border-bottom: 1px solid #222;
            padding: 0.75rem 2rem;
            display: flex;
            align-items: center;
            justify-content: space-between;
        }
        main {
            flex: 1;
            display: flex;
            flex-direction: column;
            align-items: center;
            padding: 2rem;
            width: 100%;
        }
    </style
</head>
<body>

<nav>
    <a href="index.php">← Back</a>
    <span>Connected to <?php echo $row[0]; ?></span>
</nav>

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