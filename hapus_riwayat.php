<?php
require 'functions.php';

if (!isset($_SESSION["user_id"])) {
    header("Location: login.php");
    exit;
}

if (isset($_GET["id"])) {
    hapusAktivitas($_GET["id"]);
}

header("Location: riwayat.php");
exit;