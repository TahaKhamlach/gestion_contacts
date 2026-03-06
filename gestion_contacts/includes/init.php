<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
require_once __DIR__ . "/../config/database.php";

function set_flash($type, $message) {
    $_SESSION["flash"] = ["type" => $type, "message" => $message];
}
function get_flash() {
    if (!isset($_SESSION["flash"])) return null;
    $f = $_SESSION["flash"];
    unset($_SESSION["flash"]);
    return $f;
}