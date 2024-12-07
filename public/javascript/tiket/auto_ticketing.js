document.addEventListener("DOMContentLoaded", () => {
    // Elemen-elemen dan inisialisasi
    const jumlahTiket = parseInt(document.getElementById("bookTickets").textContent, 10);
    const selectedSeats = [];
    const seatButtons = document.querySelectorAll(".seatButton");
    const seatsDisplay = document.getElementById("bookSeats");
    const currentSelectedTicket = document.getElementById("numberOfSelectedSeats");
    const confirmButton = document.getElementById("confirmBook");
    const cancelButton = document.getElementById("cancelBook");
    const form = document.querySelector(".bookingInfo");
    const inputSelectedSeats = document.createElement("input");
    const userId = document.getElementById("userId").value;
    const userUsername = document.getElementById("userUsername").value;
    const filmId = document.getElementById("filmId").value;
    const filmJudul = document.getElementById("filmJudul").value;
    const jadwalId = document.getElementById("jadwalId").value;

    // Tambahkan input hidden ke form untuk mengirimkan data kursi yang dipilih
    inputSelectedSeats.type = "hidden";
    inputSelectedSeats.name = "selectedSeats";
    form.appendChild(inputSelectedSeats);

    // Ambil data kursi yang sudah terisi
    const occupiedSeats = JSON.parse(document.getElementById("seatData").dataset.occupiedSeats);

    // Tandai kursi yang sudah terisi sebagai tidak tersedia
    seatButtons.forEach((button) => {
        const seatId = button.id;
        if (occupiedSeats.includes(seatId)) {
            button.querySelector("path").setAttribute("fill", "#E3E3E3"); // Warna abu-abu untuk kursi terisi
            button.disabled = true; // Nonaktifkan tombol untuk kursi terisi
        }
    });

    // Event listener untuk pemilihan kursi
    seatButtons.forEach((button) => {
        button.addEventListener("click", () => {
            const seatId = button.id;

            if (selectedSeats.includes(seatId)) {
                // Batalkan pilihan kursi
                selectedSeats.splice(selectedSeats.indexOf(seatId), 1);
                button.querySelector("path").setAttribute("fill", "#FFD43B"); // Warna kuning untuk kursi tersedia
            } else if (selectedSeats.length < jumlahTiket) {
                // Pilih kursi jika belum melebihi jumlah tiket
                selectedSeats.push(seatId);
                button.querySelector("path").setAttribute("fill", "#25EF61"); // Warna hijau untuk kursi yang dipilih
            }

            // Perbarui tampilan kursi yang dipilih
            seatsDisplay.textContent = selectedSeats.join(", ");
            currentSelectedTicket.textContent = selectedSeats.length;
            inputSelectedSeats.value = selectedSeats.join(", "); // Perbarui nilai input hidden
        });
    });

    // Event untuk konfirmasi pemesanan
    confirmButton.addEventListener("click", async (e) => {
        e.preventDefault(); // Cegah pengiriman form terlebih dahulu

        if (selectedSeats.length === 0) {
            Swal.fire({
                icon: "warning",
                title: "Tidak Ada Kursi Dipilih",
                text: "Silakan pilih minimal satu kursi sebelum mengkonfirmasi pemesanan.",
            });
            return;
        }

        if (selectedSeats.length !== jumlahTiket) {
            Swal.fire({
                icon: "info",
                title: "Pemilihan Belum Lengkap",
                text: `Anda perlu memilih ${jumlahTiket} kursi untuk melanjutkan.`,
            });
            return;
        }

        // Ambil data total payment
        const totalHarga = document.getElementById('infoHarga').dataset.hargaFilm;

        // Format totalHarga menjadi IDR
        const formattedHarga = new Intl.NumberFormat('id-ID', {
            style: 'currency',
            currency: 'IDR',
        }).format(totalHarga);

        // SweetAlert untuk input email dan telepon
        const { value: formValues } = await Swal.fire({
            title: "Masukkan Detail Pemesan",
            html: `
                <label for="email">Email:</label>
                <input id="email" type="email" class="swal2-input" placeholder="Masukkan email">
                <label for="phone">Telepon:</label>
                <input id="phone" type="tel" class="swal2-input" placeholder="Masukkan nomor telepon">
            `,
            showCancelButton: true,
            confirmButtonText: "Submit",
            cancelButtonText: "Cancel",
            preConfirm: () => {
                const email = document.getElementById('email').value;
                const phone = document.getElementById('phone').value;

                if (!email || !phone) {
                    Swal.showValidationMessage("Email dan nomor telepon wajib diisi!");
                } else {
                    return { email, phone };
                }
            }
        });

        // Jika pengguna membatalkan input
        if (!formValues) return;

        const { email, phone } = formValues;

        // SweetAlert untuk konfirmasi pemesanan
        Swal.fire({
            title: "Konfirmasi Pemesanan",
            text: `Anda memesan ${jumlahTiket} tiket dengan detail kursi : ${selectedSeats.join(", ")} sejumlah ${formattedHarga}. Lanjutkan?`,
            icon: "question",
            showCancelButton: true,
            confirmButtonText: "Ya, konfirmasi",
            cancelButtonText: "Tidak, batalkan",
        }).then(async (result) => {
            if (result.isConfirmed) {
                try {
                    const response = await fetch("http://localhost/project-ads-athena/app/libraries/MidtransConfig.php", {
                        method: 'POST',
                        headers: {
                            'Content-Type': 'application/json',
                        },
                        body: JSON.stringify({
                            user_id: userId,
                            username: userUsername,
                            film_id: filmId,
                            judul_film: filmJudul,
                            jumlah_tiket: jumlahTiket,
                            detail_kursi: selectedSeats,
                            total_harga: totalHarga,
                            email: email,
                            phone: phone,
                        }),
                    });

                    const data = await response.json();
                    if (response.ok) {
                        // alert(`Token berhasil didapatkan: ${data.snap_token}`);
                        window.snap.pay(data.snap_token, {
                            onSuccess: async function (result) {

                                // Cek apakah transaction_status adalah 'settlement'
                                if (result.transaction_status === "settlement") {
                                    try {
                                        // Persiapkan data yang akan dikirim ke controller
                                        const payload = {
                                            user_id: userId,                // ID pengguna
                                            jadwal_id: jadwalId,           // ID jadwal
                                            order_id: result.order_id,     // Order ID dari Midtrans
                                            detail_kursi: selectedSeats,   // Kursi yang dipilih
                                        };

                                        console.log(result); // Debugging result
                                        console.log(payload); // Debugging payload

                                        // Kirim data ke controller Midtrans
                                        const response = await fetch("http://localhost/project-ads-athena/public/midtrans/insertTiket", {
                                            method: "POST",
                                            headers: {
                                                "Content-Type": "application/json",
                                            },
                                            body: JSON.stringify(payload),
                                        });

                                        if (response.ok) {
                                            Swal.fire({
                                                icon: "info",
                                                title: "Transaksi Anda berhasil",
                                                text: "Terima kasih silahkan menonton",
                                                willClose: () => {
                                                    window.location.href = "http://localhost/project-ads-athena/public/film/"; 
                                                }
                                            });
                                            return;
                                        } else {
                                            alert("Terjadi kesalahan saat menyimpan tiket.");
                                        }
                                    } catch (error) {
                                        alert("Terjadi kesalahan saat memproses transaksi.");
                                    }
                                }
                            },
                        });
                    } else {
                        console.log(`Error: ${data.error}`);
                    }
                } catch (e) {
                    console.log(`Error: ${e.message}`);
                }
            } else {
                return;
            }
        });
    });

    // Event untuk membatalkan pemesanan
    cancelButton.addEventListener("click", (e) => {
        e.preventDefault();
        if (selectedSeats.length > 0) {
            Swal.fire({
                title: "Batalkan Pemesanan",
                text: "Apakah Anda yakin ingin membatalkan pemesanan Anda?",
                icon: "question",
                showCancelButton: true,
                confirmButtonText: "Ya, batalkan",
                cancelButtonText: "Tidak, lanjutkan",
            }).then((result) => {
                if (result.isConfirmed) {
                    selectedSeats.forEach((seatId) => {
                        const seatButton = document.getElementById(seatId);
                        seatButton.querySelector("path").setAttribute("fill", "#FFD43B");
                    });
                    selectedSeats.length = 0;
                    seatsDisplay.textContent = "";
                    currentSelectedTicket.textContent = "0";
                    inputSelectedSeats.value = "";

                    Swal.fire({
                        icon: "success",
                        title: "Pemesanan Dibatalkan",
                        text: "Pilihan kursi Anda telah direset.",
                    });
                }
            });
        } else {
            window.location.href = `http://localhost/project-ads-athena/public/film/detail/${filmId}/`
        }
    });
});
