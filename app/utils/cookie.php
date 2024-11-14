<?php
function setRememberMeCookie($userId) {
    setcookie("remember_me", $userId, time() + (86400 * 30), "/");
}

function clearRememberMeCookie() {
    setcookie("remember_me", "", time() - 3600, "/");
}
