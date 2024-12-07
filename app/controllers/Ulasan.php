<?php

class Ulasan extends Controller {

    public function insertUlasan() {
        // Receive data from the POST request
        $data['user_id'] = $_POST['userId'];  // user ID
        $data['film_id'] = $_POST['filmId'];  // film ID
        $data['rating'] = $_POST['rating'];   // rating value
        $data['komentar'] = $_POST['komentar']; // review/comment
        $data['tanggal'] = $_POST['datePostReview']; // date of review

        // Call the model's method to insert the review into the database
        $this->model('Ulasan_model')->tambahUlasan($data);
    }
}
