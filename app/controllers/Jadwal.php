<?php

class Jadwal extends Controller
{
    public function detailJadwal($idFilm)
    {
        $data['dataDetailJadwal'] = $this->model('Jadwal_model')->getSpesificJadwal((int)$idFilm);
        $data['dataDetailFilm'] = $this->model('Film_model')->getSpesificFilm((int)$idFilm);
        $data['title'] = "Jadwal " . $data['dataDetailFilm']['judul'] . " - Bioskop Athena";
        $this->view('admin/detail_jadwal', $data);
    }

    public function tambahJadwal($idFilm, $dataTambahan = [])
    {
        $data['title'] = 'Tambah Jadwal - Bioskop Athena';
        $data['film_id'] = $idFilm;
        $data['dataDetailFilmJadwal'] = $this->model('Film_model')->getSpesificFilm($idFilm);

        if (!empty($dataTambahan)) {
            $data = array_merge($data, $dataTambahan);
        }

        $this->view('admin/insert_jadwal', $data);
    }

    public function updateJadwal($idJadwal, $dataTambahan = [])
    {
        $data['title'] = 'Update Jadwal - Bioskop Athena';
        $data['dataDetailJadwal'] = $this->model('Jadwal_model')->getSpesififcJadwalVanila((int)$idJadwal);
        $data['dataDetailFilmJadwal'] = $this->model('Film_model')->getSpesificFilm((int)$data['dataDetailJadwal']['film_id']);

        if (!empty($dataTambahan)) {
            $data = array_merge($data, $dataTambahan);
        }

        $this->view('admin/update_jadwal', $data);
    }

    public function listJadwal(){
        $data['title'] = 'List Jadwal - Bioskop Athena';
        $data ['dataListJadwal'] = $this->model('Jadwal_model')->getAllJadwal();
        $this->view('admin/list_jadwal', $data);
    }

    public function updateDataJadwal(){
        $data['jadwal_id'] = $_POST['inputJadwalId'];
        $data['film_id'] = $_POST['inputFilmId'];
        $data['tanggal'] = $_POST['inputTanggal'];
        $data['hari'] = $_POST['inputHari'];
        $data['pukul'] = $_POST['inputPukul'];
        $data['studio_id'] = $_POST['inputStudio'];
        $data['kapasitas_studio'] = $_POST['inputKapasitas'];

        // cek apakah jika update nabrak dengaan jadwal lain
        $rowCount = $this->model('Jadwal_model')->cekjadwal($data['hari'], $data['pukul'], $data['studio_id']);

        if ($rowCount > 0) {
            $data['error-update'] = "Gagal update jadwal sudah terisi film lain!";
            return $this->updateJadwal($data['jadwal_id'], $data);
        } else {

            // update data
            $affectedRow = $this->model('jadwal_model')->updateDataJadwal($data);
            if($affectedRow > 0){
                $data['success-update'] = "Anda berhasil mengubah data jadwal";
            } else {
                $data['success-update'] = "Tidak ada data yang berubah.";
            }
            return $this->updateJadwal($data['jadwal_id'], $data);
        }
    }

    public function tambahDataJadwal(){
        $data['film_id'] = $_POST['inputFilmId'];
        $data['studio_id'] = $_POST['inputStudio'];
        $data['tanggal'] = $_POST['inputTanggal'];
        $data['pukul'] = $_POST['inputPukul'];
        $data['hari'] = $_POST['inputHari'];
        $data['kapasitas_studio'] = $_POST['inputKapasitas'];

        $rowCount = $this->model('Jadwal_model')->cekjadwal($data['hari'], $data['pukul'], $data['studio_id']);
        if ($rowCount > 0) {
            $data['error-tambah'] = "Gagal insert jadwal sudah terisi film lain!";
            return $this->tambahJadwal($data['film_id'], $data);
        } else {
            // insert data
            $affectedRow = $this->model('jadwal_model')->tambahDataJadwal($data);
            if($affectedRow > 0){
                $data['success-tambah'] = "Tambah data jadwal film berhasil";
                return $this->tambahJadwal($data['film_id'], $data);
            }
        }
    }  
    
    public function hapusDataJadwal($idJadwal){
        $affectedRow = $this->model('jadwal_model')->hapusDataJadwal($idJadwal);
        if($affectedRow > 0){
            $data['success-hapus-jadwal'] = "Anda berhasil menghapus jadwal";
            $data['semuaFilm'] = $this->model('Film_model')->getAllFilmManual();
            return $this->view('admin/kelola', $data);
        }
    }
}
