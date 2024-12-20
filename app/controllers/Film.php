<?php
// controller film
class Film extends Controller
{
    public function index()
    {
        $data['file'] = 'film/film_3';
        $data['title'] = 'Katalog - Bioskop Athena';
        $data['semuaFilm'] = $this->model('Film_model')->getAllFilmManual();
        $this->view('film/index', $data);
    }

    public function detail($idFilm)
    {
        $data['dataDetailFilm'] = $this->model('Film_model')->getSpesificFilm((int)$idFilm);
        $data['dataJadwalFilm'] = $this->model('Jadwal_model')->getFilmSchedule((int)$idFilm);
        $data['dataUlasanFilm'] = $this->model('Ulasan_model')->getSpesificReview((int)$idFilm);
        $data['file'] = 'film/detail_3';
        $data['title'] = $data['dataDetailFilm']['judul'] . " - Bioskop Athena";
        $this->view('film/detail', $data);
    }

    public function detailFilm($idFilm)
    {
        $data['dataDetailFilm'] = $this->model('Film_model')->getSpesificFilm((int)$idFilm);
        $data['title'] = $data['dataDetailFilm']['judul'] . " - Bioskop Athena";
        $this->view('admin/detail_film', $data);
    }

    public function updateFilm($idFilm, $dataTambahan = [])
    {
        $data['dataDetailFilm'] = $this->model('Film_model')->getSpesificFilm((int)$idFilm);
        $data['title'] = "Update " . $data['dataDetailFilm']['judul'] . " - Bioskop Athena";

        if (!empty($dataTambahan)) {
            $data = array_merge($data, $dataTambahan);
        }

        $this->view('admin/update_film', $data);
    }

    public function tambahFilm($data = [])
    {
        $data['title'] = 'Tambah Film - Bioskop Athena';
        $this->view('admin/insert_film', $data);
    }


    public function tambahDataFilm()
    {
        $data['judul'] = $_POST['inputJudul'];
        $data['kategori_id'] = $_POST['inputKategori'];
        $data['director'] = $_POST['inputDirector'];
        $data['genre'] = $_POST['inputGenre'];
        $data['cast'] = $_POST['inputCast'];
        $data['trailer'] = $_POST['inputURL'];
        $data['duration'] = $_POST['inputDuration'];
        $data['harga'] = $_POST['inputHarga'];
        $data['realese'] = $_POST['inputRealese'];
        $data['synopsis'] = $_POST['inputSynopsis'];

        if (strpos($data['trailer'], "youtube.com/embed/") !== false) {
            $data['url_trailer'] = $data['trailer'];
        } else {
            parse_str(parse_url($data['trailer'], PHP_URL_QUERY), $query);
            $video_id = $query['v'];
            $data['url_trailer'] = "https://www.youtube.com/embed/" . $video_id;
        }

        $namaFile = $_FILES['inputGambar']['name'];
        $ukuranFile = $_FILES['inputGambar']['size'];
        $error = $_FILES['inputGambar']['error'];
        $tmpName = $_FILES['inputGambar']['tmp_name'];

        // cek apakah ada file atau tidak
        if ($error == 4) {
            $data['error-tambah'] = "Anda tidak upload poste film";
            return $this->tambahFilm($data);
        }

        // cek adapakh yang diupload adalah file dengan ekstensi gambar
        $ekstensiGambarValid = ['jpg', 'jpeg', 'png'];
        $ekstensiGambar = explode('.', $namaFile);
        $ekstensiGambar = strtolower(end($ekstensiGambar));

        if (!in_array($ekstensiGambar, $ekstensiGambarValid)) {
            $data['error-tambah'] = "File yang Anda upload bukan gambar.";
            return $this->tambahFilm($data);
        }

        //cek ukuran file
        if ($ukuranFile > 10000000) {
            $data['error-tambah'] = "File yang Anda upload terlalu besar.";
            return $this->tambahFilm($data);
        }

        // lolos pengecekan
        $namaFileBaru = preg_replace('/[^a-z0-9]/', '', strtolower($data['judul']));
        $namaFileBaru .= '.' . $ekstensiGambar;

        move_uploaded_file($tmpName, $_SERVER['DOCUMENT_ROOT'] . "/project-ads-athena/public/img/film/" . $namaFileBaru);
        $data['inputGambar'] = $namaFileBaru;

        // insert data 
        $affectedRow = $this->model('Film_model')->tambahDataFilm($data);

        if ($affectedRow > 0) {
            $data['success-tambah'] = "Data Film berhasil ditambahkan";
            return $this->tambahFilm($data);
        } else {
            $data['error-tambah'] = "Data Film gagal ditambahkan";
            return $this->tambahFilm($data);
        }
    }

    public function updateDataFilm()
    {
        $data['film_id'] = $_POST['inputId'];
        $data['kategori_id'] = $_POST['inputKategori'];
        $data['judul'] = $_POST['inputJudul'];
        $data['director'] = $_POST['inputDirector'];
        $data['duration'] = $_POST['inputDuration'];
        $data['genre'] = $_POST['inputGenre'];
        $data['realese'] = $_POST['inputRealese'];
        $data['cast'] = $_POST['inputCast'];
        $data['harga'] = $_POST['inputHarga'];
        $data['synopsis'] = $_POST['inputSynopsis'];
        $data['trailer'] = $_POST['inputURL'];
        $data['gambarLama'] = $_POST['inputGambarLama'];

        // Cek embed URL YouTube
        if (strpos($data['trailer'], "youtube.com/embed/") !== false) {
            $data['url_trailer'] = $data['trailer'];
        } else {
            parse_str(parse_url($data['trailer'], PHP_URL_QUERY), $query);
            $video_id = $query['v'];
            $data['url_trailer'] = "https://www.youtube.com/embed/" . $video_id;
        }

        // Proses upload gambar
        if ($_FILES['inputGambar']['error'] == 4) {
            $data['inputGambar'] = $data['gambarLama'];
        } else {
            $namaFile = $_FILES['inputGambar']['name'];
            $ukuranFile = $_FILES['inputGambar']['size'];
            $tmpName = $_FILES['inputGambar']['tmp_name'];

            $ekstensiGambarValid = ['jpg', 'jpeg', 'png'];
            $ekstensiGambar = explode('.', $namaFile);
            $ekstensiGambar = strtolower(end($ekstensiGambar));

            if (!in_array($ekstensiGambar, $ekstensiGambarValid)) {
                $data['error-upload'] = "File yang Anda upload bukan gambar.";
                return $this->updateFilm($data['film_id'], $data);
            }

            if ($ukuranFile > 10000000) {
                $data['error-upload'] = "File yang Anda upload terlalu besar.";
                return $this->updateFilm($data['film_id'], $data);
            }

            $namaFileBaru = preg_replace('/[^a-z0-9]/', '', strtolower($data['judul']));
            $namaFileBaru .= '.' . $ekstensiGambar;

            move_uploaded_file($tmpName, $_SERVER['DOCUMENT_ROOT'] . "/project-ads-athena/public/img/film/" . $namaFileBaru);
            $data['inputGambar'] = $namaFileBaru;
        }

        // Update data di database
        $affectedRow = $this->model('Film_model')->updateDataFilm($data);

        if ($affectedRow > 0) {
            $data['success-upload'] = "Anda berhasil mengubah data film.";
        } else {
            $data['success-upload'] = "Tidak ada data yang berubah.";
        }

        // Panggil fungsi updateFilm langsung untuk menampilkan view
        $this->updateFilm($data['film_id'], $data);
    }

    public function hapusFilm($idFilm){
        $this->model('Film_model')->hapusDataFilm($idFilm);
        $data['success-hapus-film'] = "Data film berhasil ";
        $data['semuaFilm'] = $this->model('Film_model')->getAllFilmManual();
        $data['title'] = "Kelola - Bioskop Athena";
        return $this->view('admin/kelola', $data);
    }
}
