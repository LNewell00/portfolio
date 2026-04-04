<?php
use model\UserDAO;



session_start();
if (!isset($_SESSION['user'])) {
    header('Location: /index.php?msg=restricted');
    exit;
}

include("../model/UserDAO.php");

$userDAO = new UserDAO();
$message = "";

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['action'])) {
        if ($_POST['action'] === 'add') {
            $connection = $userDAO->getConnection();
            if ($connection) {
                $stmt = $connection->prepare("INSERT INTO users (username, firstname, lastname, password, lastmodified) VALUES (?, ?, ?, ?, NOW())");
                $stmt->execute([
                    $_POST['username'],
                    $_POST['firstname'],
                    $_POST['lastname'],
                    password_hash($_POST['password'], PASSWORD_DEFAULT)
                ]);
                // Redirect instead of rendering
                header('Location: ' . $_SERVER['PHP_SELF'] . '?msg=added');
                exit;
            } else {
                header('Location: ' . $_SERVER['PHP_SELF'] . '?msg=failed');
                exit;
            }
        } elseif ($_POST['action'] === 'auth') {
            $user = $userDAO->authenticateUser($_POST['username'], $_POST['password']);
            $result = $user ? 'authenticated' : 'authfailed';
            header('Location: ' . $_SERVER['PHP_SELF'] . '?msg=' . $result);
            exit;
        }
    }
}

// Read message from query string
$messages = [
    'added'         => 'User added successfully!',
    'failed'        => 'DB connection failed.',
    'authenticated' => 'Authentication successful!',
    'authfailed'    => 'Authentication failed.',
];
$message = isset($_GET['msg']) ? ($messages[$_GET['msg']] ?? '') : '';

?>
<!DOCTYPE html>
<html>
<head>
    <title>Test Page</title>
</head>
<body>

    <?php if ($message): ?>
        <p><strong><?= htmlspecialchars($message) ?></strong></p>
    <?php endif; ?>

    <h2>Add User</h2>
    <form method="POST">
        <input type="hidden" name="action" value="add">
        <input type="text" name="username" placeholder="Username" required><br><br>
        <input type="text" name="firstname" placeholder="First Name"><br><br>
        <input type="text" name="lastname" placeholder="Last Name"><br><br>
        <input type="password" name="password" placeholder="Password" required><br><br>
        <button type="submit">Add User</button>
    </form>

    <h2>Authenticate User</h2>
    <form method="POST">
        <input type="hidden" name="action" value="auth">
        <input type="text" name="username" placeholder="Username" required><br><br>
        <input type="password" name="password" placeholder="Password" required><br><br>
        <button type="submit">Authenticate</button>
    </form>
</body>
</html>