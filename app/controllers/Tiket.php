<?php

class Tiket extends Controller
{
    public function ticketing()
    {
        if (
            isset($_POST['inputHiddenUser']) &&
            isset($_POST['inputHiddenFilmId']) &&
            isset($_POST['inputHiddenJadwalId']) &&
            isset($_POST['numberOfTicket'])
        ) {
            $data['file'] = "tiket/auto_ticketing";
            $data['title'] = "Auto Ticketing - Bioskop Athena";
            $data['dataUserTiket'] = $this->model('User_model')->getUserById($_POST['inputHiddenUser']);
            $data['dataFilmTiketId'] = $this->model('Film_model')->getSpesificFilm($_POST['inputHiddenFilmId']);
            $data['dataJadwalTiketId'] = $this->model('Jadwal_model')->getSpecificSchedule($_POST['inputHiddenJadwalId']);
            $data['dataJumlahTiketBeli'] = $_POST['numberOfTicket'];

            // Mengambil data kursi yang sudah dipesan
            $occupiedSeats = $this->model('Tiket_model')->getOccupiedSeatsByJadwalId($_POST['inputHiddenJadwalId']);
            $data['listbangkuTerisi'] = implode(', ', array_column($occupiedSeats, 'seat'));

            // halaman ketika memilih tiket lwat detail film sehingga tidak perlu input data film manual
            // cukup input pilih bangku
            $this->view('tiket/auto_ticketing', $data);
        } else {
            // Jika data tidak lengkap
            // pilih film manual mulai dari kategori, jadwal, judul, ukul dan jumlah film 
            // secara manual lewat form 
            $data['file'] = "tiket/manual_ticketing";
            $data['title'] = "Manual Ticketing - Bioskop Athena";

            $this->view('tiket/manual_ticketing', $data);
        }
    }
}
