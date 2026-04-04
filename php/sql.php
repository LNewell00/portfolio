<?php

session_start();
if (!isset($_SESSION['user'])) {
    header('Location: /index.php?msg=restricted');
    exit;
}

$host = getenv('DB_HOST');
$db   = getenv('DB_NAME');
$user = getenv('DB_USER');
$pass = getenv('DB_PASSWORD');
$port = getenv('DB_PORT');
$dsn  = "pgsql:host=$host;port=$port;dbname=$db";

try {
    $pdo = new PDO($dsn, $user, $pass, [
            PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION
    ]);
} catch (PDOException $e) {
    die("<pre>Connection failed: " . htmlspecialchars($e->getMessage()) . "</pre>");
}

// Handle form submission
// Define max lengths (match your DB column sizes)
const MAX_NAME_LENGTH = 50;
const MAX_LOCATION_LENGTH = 100;

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $first    = trim($_POST['first_name']);
    $last     = trim($_POST['last_name']);
    $location = trim($_POST['location']);

    $errors = [];

    if ($first === '') {
        $errors[] = "First name is required.";
    } elseif (mb_strlen($first) > MAX_NAME_LENGTH) {
        $errors[] = "First name must be " . MAX_NAME_LENGTH . " characters or fewer.";
    }

    if ($last === '') {
        $errors[] = "Last name is required.";
    } elseif (mb_strlen($last) > MAX_NAME_LENGTH) {
        $errors[] = "Last name must be " . MAX_NAME_LENGTH . " characters or fewer.";
    }

    if ($location === '') {
        $errors[] = "Location is required.";
    } elseif (mb_strlen($location) > MAX_LOCATION_LENGTH) {
        $errors[] = "Location must be " . MAX_LOCATION_LENGTH . " characters or fewer.";
    }

    if (empty($errors)) {
        try {
            $stmt = $pdo->prepare(
                    "INSERT INTO VISITOR (\"FirstName\", \"LastName\", \"Location\") VALUES (:first, :last, :location)"
            );
            $stmt->execute([':first' => $first, ':last' => $last, ':location' => $location]);
            header('Location: ' . $_SERVER['PHP_SELF']);
            exit;
        } catch (PDOException $e) {
            die("<pre>Insert failed: " . htmlspecialchars($e->getMessage()) . "</pre>");
        }
    }
}

// Fetch all visitors
try {
    $visitors = $pdo->query('SELECT "FirstName", "LastName", "Location" FROM VISITOR')->fetchAll(PDO::FETCH_ASSOC);
} catch (PDOException $e) {
    die("<pre>Query failed: " . htmlspecialchars($e->getMessage()) . "</pre>");
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
    <title>SQL Statement</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-sRIl4kxILFvY47J16cr9ZwB07vP4J8+LH7qKQnuqkuIAvNWLzeN8tE5YBujZqJLB" crossorigin="anonymous">
    <link rel="stylesheet" href="/css/styles.css" />
</head>
<body>

<?php include __DIR__ . '/../template/navbar.php'; ?>

<div class="content header-block">
    <h1>PostgreSQL</h1>
</div>
<div class="content">
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
</div>
<div class="content">
    <h3>SQL Statements</h3>

    <?php if (!empty($errors)): ?>
        <div class="alert alert-danger">
            <ul class="mb-0">
                <?php foreach ($errors as $error): ?>
                    <li><?= htmlspecialchars($error) ?></li>
                <?php endforeach; ?>
            </ul>
        </div>
    <?php endif; ?>

    <div class="sqlStatement">
        <form method="POST" class="visitor-form">
            <div class="form-group">
                <label for="first_name">First Name</label>
                <input type="text" id="first_name" name="first_name" maxlength="50" placeholder="John" required>
            </div>
            <div class="form-group">
                <label for="last_name">Last Name</label>
                <input type="text" id="last_name" name="last_name" maxlength="50" placeholder="Doe" required>
            </div>
            <div class="form-group">
                <label for="location">Where are you from?</label>
                <input type="text" id="location" name="location" maxlength="100" placeholder="State / Country" required>
            </div>
            <button type="submit">Submit</button>
        </form>

        <table class="table table-dark">
            <thead>
            <tr>
                <th>First Name</th>
                <th>Last Name</th>
                <th>State/Country</th>
            </tr>
            </thead>
            <tbody>
            <?php foreach ($visitors as $row): ?>
                <tr>
                    <td><?= htmlspecialchars($row['FirstName']) ?></td>
                    <td><?= htmlspecialchars($row['LastName']) ?></td>
                    <td><?= htmlspecialchars($row['Location']) ?></td>
                </tr>
            <?php endforeach; ?>
            </tbody>
        </table>
    </div>
    <div class="sqlStatement">
    </div>
</div>



<script>
    const toggle = document.getElementById('navToggle');
    const mobile = document.getElementById('navMobile');
    toggle.addEventListener('click', () => mobile.classList.toggle('open'));
</script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js" integrity="sha384-FKyoEForCGlyvwx9Hj09JcYn3nv7wiPVlz7YYwJrWVcXK/BmnVDxM+D2scQbITxI" crossorigin="anonymous"></script>

</body>
</html>