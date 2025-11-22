<?php
class Database {
    private $file;
    private $data;

    public function __construct($file = 'database.json') {
        $this->file = $file;
        $this->load();
    }

    private function load() {
        if (file_exists($this->file)) {
            $this->data = json_decode(file_get_contents($this->file), true);
        } else {
            $this->data = [
                'testimonials' => [],
                'news' => [],
                'events' => [],
                'photos' => [],
                'dates' => [],
                'page_content' => []
            ];
            $this->save();
        }
    }

    private function save() {
        file_put_contents($this->file, json_encode($this->data, JSON_PRETTY_PRINT));
    }

    // Testimonials
    public function getTestimonials() {
        return $this->data['testimonials'];
    }

    public function addTestimonial($testimonial) {
        $testimonial['id'] = count($this->data['testimonials']) + 1;
        $testimonial['created_at'] = date('c');
        $this->data['testimonials'][] = $testimonial;
        $this->save();
        return $testimonial;
    }

    // News
    public function getNews() {
        return $this->data['news'];
    }

    public function addNews($news) {
        $news['id'] = count($this->data['news']) + 1;
        $news['created_at'] = date('c');
        $this->data['news'][] = $news;
        $this->save();
        return $news;
    }

    // Events
    public function getEvents() {
        return $this->data['events'];
    }

    public function addEvent($event) {
        $event['id'] = count($this->data['events']) + 1;
        $event['created_at'] = date('c');
        $this->data['events'][] = $event;
        $this->save();
        return $event;
    }

    // Photos
    public function getPhotos() {
        return $this->data['photos'];
    }

    public function addPhoto($filename) {
        $photo = [
            'id' => count($this->data['photos']) + 1,
            'filename' => $filename,
            'created_at' => date('c')
        ];
        $this->data['photos'][] = $photo;
        $this->save();
        return $photo;
    }

    // Dates
    public function getDates() {
        return $this->data['dates'];
    }

    public function addDate($date, $description) {
        $dateEntry = [
            'id' => count($this->data['dates']) + 1,
            'date' => $date,
            'description' => $description,
            'created_at' => date('c')
        ];
        $this->data['dates'][] = $dateEntry;
        $this->save();
        return $dateEntry;
    }

    // Page Content
    public function getPageContent($key) {
        return $this->data['page_content'][$key] ?? null;
    }

    public function updatePageContent($key, $title, $content) {
        $this->data['page_content'][$key] = [
            'title' => $title,
            'content' => $content
        ];
        $this->save();
        return $this->data['page_content'][$key];
    }
}
?>