<?php

// ── STEP 1: START THE SESSION ──────────────────────────────────────────────
// PHP sessions let us store data that persists across page loads for a user.
// $_SESSION is like a temporary locker for that user — we'll use it to
// remember who is logged in. Must be called before any output.
session_start();

// ── STEP 2: LOAD THE DATABASE CLASS ───────────────────────────────────────
// UserDAO.php contains our UserDAO class which handles all DB operations.
// $_SERVER['DOCUMENT_ROOT'] gives us the absolute path to /app so the
// include works regardless of which folder this file is called from.
include($_SERVER['DOCUMENT_ROOT'] . '/model/UserDAO.php');

// Bring the UserDAO class into scope so we don't have to type
// "model\UserDAO" every time we use it.
use model\UserDAO;

// ── STEP 3: ONLY RUN THIS LOGIC ON FORM SUBMISSION ────────────────────────
// This file is the ACTION target of the login form, so it will only ever
// receive POST requests. If someone navigates here directly in their browser
// (a GET request) we do nothing and let it fall through to exit at the bottom.
if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    // ── STEP 4: GRAB AND SANITIZE FORM INPUT ──────────────────────────────
    // $_POST holds the values submitted by the form.
    // trim() strips leading/trailing whitespace from the username so
    // "  logan  " is treated the same as "logan".
    // The ?? '' is a null-coalescing operator — if the key doesn't exist
    // in $_POST (e.g. someone tampered with the form), default to empty string
    // instead of throwing an error.
    $username = trim($_POST['username'] ?? '');
    $password = $_POST['password'] ?? '';

    // ── STEP 5: VALIDATE THAT BOTH FIELDS ARE FILLED IN ───────────────────
    // We won't even hit the database if the user left something blank.
    // An empty string is falsy in PHP, so "if ($username && $password)"
    // is true only when both have actual content.
    if ($username && $password) {

        // ── STEP 6: TRY TO FIND THE USER IN THE DATABASE ──────────────────
        // Instantiate our UserDAO and call authenticateUser().
        // That method looks up the username, then uses password_verify()
        // to check the submitted password against the stored hash.
        // It returns the user row as an array if successful, or null if not.
        $userDAO = new UserDAO();
        $user = $userDAO->authenticateUser($username, $password);

        // ── STEP 7A: LOGIN SUCCEEDED ───────────────────────────────────────
        // $user is an associative array like ['username' => 'logan', ...]
        // We store the username in $_SESSION so every other page can check
        // if someone is logged in just by looking at $_SESSION['user'].
        if ($user) {
            $_SESSION['user'] = $user['username'];

            // Redirect back to whatever page opened the login modal.
            // HTTP_REFERER is the URL the user came from (e.g. /index.php).
            // If it's not set for some reason, we fall back to /index.php.
            // The ?msg=loggedin lets the page know to show a success message.
            header('Location: ' . ($_SERVER['HTTP_REFERER'] ?? '/index.php') . '?msg=loggedin');

            // ── STEP 7B: LOGIN FAILED (wrong password or user doesn't exist) ───
            // authenticateUser() returned null, so credentials were wrong.
            // Redirect back with ?msg=loginfailed so the modal can show an error.
        } else {
            header('Location: ' . ($_SERVER['HTTP_REFERER'] ?? '/index.php') . '?msg=loginfailed');
        }

        // ── STEP 8: VALIDATION FAILED (blank fields) ──────────────────────────
        // Username or password was empty. Redirect back with ?msg=invalid
        // so the modal can tell the user to fill everything in.
    } else {
        header('Location: ' . ($_SERVER['HTTP_REFERER'] ?? '/index.php') . '?msg=invalid');
    }

    // ── STEP 9: STOP EXECUTION ────────────────────────────────────────────
    // After a header() redirect you MUST call exit, otherwise PHP will
    // keep running the rest of the script even though the browser is
    // already being sent somewhere else. This is a common bug.
    exit;
}

// If we got here it was a GET request — nothing to do.
// This file has no HTML so the browser just sees a blank page,
// which is fine because it should only ever be POSTed to.