<?php
function startSession() {
    if (session_status() === PHP_SESSION_NONE) {
        session_start();
    }
}

function destroySession() {
    session_start();
    session_unset();
    session_destroy();
}
