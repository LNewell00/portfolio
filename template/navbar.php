<?php
// In navbar.php, detect current page:
$current = basename($_SERVER['PHP_SELF']);

?>
<!-- NAVBAR -->
<nav>
    <a class="nav-brand" href="#">LN</a>

    <ul class="nav-links">
        <li class="<?= $current === 'index.php' ? 'active' : '' ?>">
            <a href="/index.php">Home</a>
        </li>
        <li class="<?= $current === 'sql.php' ? 'active' : '' ?>">
            <a href="/php/sql.php">SQL Statement</a>
        </li>
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
    <a href="/index.php">Home</a>
    <a href="/php/sql.php">SQL Statement</a>
    <a href="#">Sign Up</a>
    <a href="#">Login</a>
</div>