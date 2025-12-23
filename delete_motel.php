<?php
session_start();
require_once __DIR__ . '/config.php';

if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}

$user_id = $_SESSION['user_id'];

$id = isset($_GET['id']) ? (int)$_GET['id'] : 0;
if ($id <= 0) {
    header("Location: my_rooms.php");
    exit();
}

$stmt = $conn->prepare("SELECT images FROM MOTEL WHERE ID = ? AND user_id = ?");
$stmt->bind_param('ii', $id, $user_id);
$stmt->execute();
$result = $stmt->get_result();
$motel = $result->fetch_assoc();
$stmt->close();

if (!$motel) {
    header("Location: my_rooms.php");
    exit();
}

if (!empty($motel['images'])) {
    $image_path = __DIR__ . '/image/' . $motel['images'];
    if (file_exists($image_path)) {
        @unlink($image_path);
    }
}

$stmt = $conn->prepare("DELETE FROM MOTEL WHERE ID = ? AND user_id = ?");
$stmt->bind_param('ii', $id, $user_id);
$stmt->execute();
$stmt->close();

header("Location: my_rooms.php?msg=deleted");
exit();

