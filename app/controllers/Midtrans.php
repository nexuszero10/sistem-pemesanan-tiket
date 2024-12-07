<?php

class Midtrans extends Controller {

    public function insertTiket() {
        // Ambil data dari request JSON
        $data = json_decode(file_get_contents('php://input'), true);

        if (!$data) {
            echo json_encode(['error' => 'Data tidak valid']);
            return;
        }

        foreach ($data['detail_kursi'] as $kursi) {
            $baris_kursi = substr($kursi, 0, 1);  // Ambil huruf kursi (baris)
            $nomor_kursi = substr($kursi, 1);    // Ambil nomor kursi

            $tiketData = [
                'user_id' => $data['user_id'],
                'jadwal_id' => $data['jadwal_id'],
                'baris_kursi' => $baris_kursi,
                'nomor_kursi' => $nomor_kursi,
                'status_tiket' => 'success',
                'order_id' => $data['order_id'],
            ];

            // Panggil model untuk memasukkan data tiket
            $this->model('Tiket_model')->tambahDataTiket($tiketData);
        }
        // Kirimkan respons sukses
        echo json_encode(['message' => 'Tiket berhasil disimpan']);
    }
}

