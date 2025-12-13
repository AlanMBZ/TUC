<?php
session_start();

if (!isset($_SESSION['rol']) || $_SESSION['rol'] != 1) {
    header("Location: login.php");
    exit;
}
?>
<h1>Panel del Conductor</h1>
