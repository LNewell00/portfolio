<?php
    if (session_status() === PHP_SESSION_NONE) {
        session_start();
    }

    // In navbar.php, detect current page:
    $current = basename($_SERVER['PHP_SELF']);

?>

<style>
    /* ══════════════════════════════
       NAVBAR — base
    ══════════════════════════════ */
    nav {
        position: fixed;
        top: 0;
        left: 0;
        width: 100%;
        height: 56px;
        background: #141414;
        border-bottom: 1px solid #222;
        display: flex;
        align-items: center;
        justify-content: space-between;
        padding: 0 2rem;
        z-index: 1000;
    }

    .nav-brand {
        font-family: 'DM Mono', monospace;
        font-size: 0.95rem;
        color: #4f8ef7;
        text-decoration: none;
        letter-spacing: 0.03em;
    }

    /* ══════════════════════════════
       NAV LINKS (center)
    ══════════════════════════════ */
    .nav-links {
        display: flex;
        align-items: center;
        gap: 0.25rem;
        list-style: none;
        margin: 0;
        padding: 0;
    }

    .nav-links a {
        color: #aaa;
        text-decoration: none;
        font-size: 0.875rem;
        padding: 0.4rem 0.75rem;
        border-radius: 4px;
        transition: color 0.2s, background 0.2s;
    }

    .nav-links a:hover,
    .nav-links li.active a {
        color: #fff;
        background: #1e1e1e;
    }

    /* ══════════════════════════════
       NAV RIGHT (buttons/auth)
    ══════════════════════════════ */
    .nav-right {
        display: flex;
        align-items: center;
        gap: 0.5rem;
        list-style: none;
        margin: 0;
        padding: 0;
    }

    .nav-right > li > a {
        color: #aaa;
        text-decoration: none;
        font-size: 0.875rem;
        padding: 0.4rem 0.85rem;
        border-radius: 4px;
        border: 1px solid #2a2a2a;
        transition: color 0.2s, border-color 0.2s;
        display: flex;
        align-items: center;
        gap: 0.4rem;
    }

    .nav-right > li > a:hover {
        color: #fff;
        border-color: #4f8ef7;
    }

    /* ══════════════════════════════
       DROPDOWN MENU
    ══════════════════════════════ */
    .nav-right .dropdown-menu {
        background: #1a1a1a;
        border: 1px solid #2a2a2a;
        border-radius: 6px;
        min-width: 160px;
        padding: 0.25rem 0;
    }

    .nav-right .dropdown-item {
        color: #aaa;
        font-size: 0.875rem;
        padding: 0.5rem 0.85rem;
        border: none;
        border-bottom: none;
        border-radius: 0;
        display: block;
        background: transparent;
        transition: color 0.2s, background 0.2s;
    }

    .nav-right .dropdown-item:hover {
        color: #fff;
        background: #252525;
    }

    /* ══════════════════════════════
       HAMBURGER
    ══════════════════════════════ */
    .nav-toggle {
        display: none;
        flex-direction: column;
        gap: 5px;
        cursor: pointer;
        background: none;
        border: none;
        padding: 4px;
    }

    .nav-toggle span {
        display: block;
        width: 22px;
        height: 2px;
        background: #aaa;
        border-radius: 2px;
        transition: background 0.2s;
    }

    .nav-toggle:hover span { background: #fff; }

    /* ══════════════════════════════
       MOBILE MENU
    ══════════════════════════════ */
    .nav-mobile {
        display: none;
        position: fixed;
        top: 56px;
        left: 0;
        width: 100%;
        background: #141414;
        border-bottom: 1px solid #222;
        padding: 1rem 2rem;
        flex-direction: column;
        gap: 0.5rem;
        z-index: 999;
    }

    .nav-mobile a {
        color: #aaa;
        text-decoration: none;
        font-size: 0.9rem;
        padding: 0.5rem 0;
        border-bottom: 1px solid #1e1e1e;
        transition: color 0.2s;
    }

    .nav-mobile a:hover { color: #fff; }

    /* ══════════════════════════════
       RESPONSIVE
    ══════════════════════════════ */
    @media (max-width: 640px) {
        .nav-links, .nav-right { display: none; }
        .nav-toggle { display: flex; }
    }
</style>

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
        <?php if (isset($_SESSION['user'])): ?>

            <li class="dropdown">
                <a class="nav-right-user" data-bs-toggle="dropdown" href="#" >
                    👤 <?= htmlspecialchars($_SESSION['user']) ?> ▾
                </a>
                <ul class="dropdown-menu">
                    <li><a class="dropdown-item" href="#" data-bs-toggle="modal" data-bs-target="#Settings">Settings</a></li>
                    <li><a class="dropdown-item" href="/php/admin.php">Admin Page</a></li>
                </ul>
            </li>

            <li><a href="/model/logout.php">🔓 Logout</a></li>
        <?php else: ?>
            <li><a href="#" data-bs-toggle="modal" data-bs-target="#SignUp">&#128100; Sign Up</a></li>
            <li><a href="#" data-bs-toggle="modal" data-bs-target="#Login">&#128274; Login</a></li>
        <?php endif; ?>
    </ul>

<!--    Collapsable menu  -->
    <button class="nav-toggle" id="navToggle" aria-label="Toggle menu">
        <span></span>
        <span></span>
    </button>
</nav>

<!--import signup button / modal-->
<?php include __DIR__ . '/signupModal.php'; ?>

<!--import login button / modal-->
<?php include __DIR__ . '/loginModal.php'; ?>

<!--import Settings button / modal-->
<?php include __DIR__ . '/settingsModal.php'; ?>

<div class="nav-mobile" id="navMobile">
    <a href="/index.php">Home</a>
    <a href="/php/sql.php">SQL Statement</a>
    <a href="#" data-bs-toggle="modal" data-bs-target="#SignUp" class="nav-modal-trigger">&#128100; Sign Up</a>
    <a href="#" data-bs-toggle="modal" data-bs-target="#Login" class="nav-modal-trigger">&#128274; Login</a>
</div>

<!-- All this script does is close the nav bar for the mobile menu when you click on signup or login.-->
<script>
    document.querySelectorAll('.nav-modal-trigger').forEach(link => {
        link.addEventListener('click', () => {
            document.getElementById('navMobile').classList.remove('open');
        });
    });
</script>