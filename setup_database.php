<?php
// Create SQLite database
$db = new SQLite3('foundation.db');

// Create tables
$db->exec("
    CREATE TABLE IF NOT EXISTS testimonials (
        id INTEGER PRIMARY KEY AUTOINCREMENT,
        text TEXT NOT NULL,
        photo TEXT,
        video TEXT,
        caption TEXT,
        created_at DATETIME DEFAULT CURRENT_TIMESTAMP
    )
");

$db->exec("
    CREATE TABLE IF NOT EXISTS news (
        id INTEGER PRIMARY KEY AUTOINCREMENT,
        title TEXT NOT NULL,
        date TEXT NOT NULL,
        summary TEXT,
        link TEXT,
        created_at DATETIME DEFAULT CURRENT_TIMESTAMP
    )
");

$db->exec("
    CREATE TABLE IF NOT EXISTS events (
        id INTEGER PRIMARY KEY AUTOINCREMENT,
        title TEXT NOT NULL,
        date TEXT NOT NULL,
        description TEXT,
        link TEXT,
        created_at DATETIME DEFAULT CURRENT_TIMESTAMP
    )
");

$db->exec("
    CREATE TABLE IF NOT EXISTS photos (
        id INTEGER PRIMARY KEY AUTOINCREMENT,
        filename TEXT NOT NULL,
        created_at DATETIME DEFAULT CURRENT_TIMESTAMP
    )
");

$db->exec("
    CREATE TABLE IF NOT EXISTS dates (
        id INTEGER PRIMARY KEY AUTOINCREMENT,
        date TEXT NOT NULL,
        description TEXT NOT NULL,
        created_at DATETIME DEFAULT CURRENT_TIMESTAMP
    )
");

$db->exec("
    CREATE TABLE IF NOT EXISTS page_content (
        id INTEGER PRIMARY KEY AUTOINCREMENT,
        page_key TEXT UNIQUE NOT NULL,
        title TEXT NOT NULL,
        content TEXT NOT NULL,
        updated_at DATETIME DEFAULT CURRENT_TIMESTAMP
    )
");

// Migrate existing JSON data
migrateJsonData($db);

echo "Database setup complete!";

function migrateJsonData($db) {
    // Migrate testimonials
    if (file_exists('data/testimonials.json')) {
        $testimonials = json_decode(file_get_contents('data/testimonials.json'), true);
        foreach ($testimonials as $testimonial) {
            $stmt = $db->prepare("INSERT OR IGNORE INTO testimonials (text, photo, video, caption) VALUES (?, ?, ?, ?)");
            $stmt->bindValue(1, $testimonial['text'] ?? '', SQLITE3_TEXT);
            $stmt->bindValue(2, $testimonial['photo'] ?? '', SQLITE3_TEXT);
            $stmt->bindValue(3, $testimonial['video'] ?? '', SQLITE3_TEXT);
            $stmt->bindValue(4, $testimonial['caption'] ?? '', SQLITE3_TEXT);
            $stmt->execute();
        }
    }

    // Migrate news
    if (file_exists('data/news.json')) {
        $news = json_decode(file_get_contents('data/news.json'), true);
        foreach ($news as $item) {
            $stmt = $db->prepare("INSERT OR IGNORE INTO news (title, date, summary, link) VALUES (?, ?, ?, ?)");
            $stmt->bindValue(1, $item['title'] ?? '', SQLITE3_TEXT);
            $stmt->bindValue(2, $item['date'] ?? '', SQLITE3_TEXT);
            $stmt->bindValue(3, $item['summary'] ?? '', SQLITE3_TEXT);
            $stmt->bindValue(4, $item['link'] ?? '', SQLITE3_TEXT);
            $stmt->execute();
        }
    }

    // Migrate events
    if (file_exists('data/events.json')) {
        $events = json_decode(file_get_contents('data/events.json'), true);
        foreach ($events as $event) {
            $stmt = $db->prepare("INSERT OR IGNORE INTO events (title, date, description, link) VALUES (?, ?, ?, ?)");
            $stmt->bindValue(1, $event['title'] ?? '', SQLITE3_TEXT);
            $stmt->bindValue(2, $event['date'] ?? '', SQLITE3_TEXT);
            $stmt->bindValue(3, $event['description'] ?? '', SQLITE3_TEXT);
            $stmt->bindValue(4, $event['link'] ?? '', SQLITE3_TEXT);
            $stmt->execute();
        }
    }

    // Migrate photos
    if (file_exists('data/photos.json')) {
        $photos = json_decode(file_get_contents('data/photos.json'), true);
        foreach ($photos as $photo) {
            $stmt = $db->prepare("INSERT OR IGNORE INTO photos (filename) VALUES (?)");
            $stmt->bindValue(1, $photo, SQLITE3_TEXT);
            $stmt->execute();
        }
    }

    // Migrate dates
    if (file_exists('data/dates.json')) {
        $dates = json_decode(file_get_contents('data/dates.json'), true);
        foreach ($dates as $date) {
            $stmt = $db->prepare("INSERT OR IGNORE INTO dates (date, description) VALUES (?, ?)");
            $stmt->bindValue(1, $date['date'] ?? '', SQLITE3_TEXT);
            $stmt->bindValue(2, $date['description'] ?? '', SQLITE3_TEXT);
            $stmt->execute();
        }
    }

    // Migrate page content
    if (file_exists('data/page-content.json')) {
        $pages = json_decode(file_get_contents('data/page-content.json'), true);
        foreach ($pages as $key => $page) {
            $stmt = $db->prepare("INSERT OR IGNORE INTO page_content (page_key, title, content) VALUES (?, ?, ?)");
            $stmt->bindValue(1, $key, SQLITE3_TEXT);
            $stmt->bindValue(2, $page['title'] ?? '', SQLITE3_TEXT);
            $stmt->bindValue(3, $page['content'] ?? '', SQLITE3_TEXT);
            $stmt->execute();
        }
    }
}
?>