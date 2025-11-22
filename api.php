<?php
require_once 'Database.php';
$db = new Database();

header('Content-Type: application/json');

$action = $_GET['action'] ?? '';

switch ($action) {
    case 'testimonials':
        echo json_encode($db->getTestimonials());
        break;
    case 'news':
        echo json_encode($db->getNews());
        break;
    case 'events':
        echo json_encode($db->getEvents());
        break;
    case 'photos':
        $photos = $db->getPhotos();
        echo json_encode(array_column($photos, 'filename'));
        break;
    case 'dates':
        echo json_encode($db->getDates());
        break;
    default:
        echo json_encode(['error' => 'Invalid action']);
}
?>