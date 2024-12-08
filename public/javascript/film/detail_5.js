// Button watch trailer
const button_watch_trailer = document.getElementById('watch-trailer-button');
button_watch_trailer.addEventListener("click", function openTrailer() {
    let trailerUrl = button_watch_trailer.dataset.trailerUrl;
    document.getElementById('trailer').src = trailerUrl;
    document.getElementById('trailerPopup').style.display = 'block';
});

window.onclick = function (event) {
    var modal = document.getElementById('trailerPopup');
    if (event.target === modal) {
        document.getElementById('trailerPopup').style.display = 'none';
        document.getElementById('trailer').src = "";
    }
}

// Button form review
const button_form_review = document.getElementById("form-review-button");
button_form_review.addEventListener("click", function formReview() {
    let divReviewFilm = document.getElementById('reviewFilm');

    // Menampilkan form dengan display flex
    divReviewFilm.style.display = 'flex';
    divReviewFilm.scrollIntoView({
        behavior: 'smooth',
        block: 'center'
    });

    setTimeout(() => {
        divReviewFilm.style.opacity = 1;
        divReviewFilm.style.transform = 'translateY(0)';
    }, 30);
});

// Button to post review
const button_post_review = document.getElementById("post_review_button");
button_post_review.addEventListener("click", async function generateReview(event) {
    event.preventDefault(); // Prevent form submission

    const inputUserId = document.getElementById('inputHiddenUserId').value;
    const inputjumlahTiketUser = document.getElementById('inputHiddenUserTiket').value;
    const inputUser = document.getElementById('inputUser').value;
    const inputFilmId = document.getElementById('inputHiddenFilmId').value;
    const inputRating = parseFloat(document.getElementById('rating').value);
    const inputKomentar = document.getElementById('komentar').value;
    const inputTanggal = document.getElementById('inputHiddenDate').value;

    //validasi apakah user sudah login atau belum 
    if (!inputUserId) {
        Swal.fire({
            title: 'Anda Belum Login!',
            text: 'Silahkan Register / Login untuk bisa membeli tiket.',
            icon: 'warning',
            confirmButtonText: 'OK',
            willClose: () => {
                window.location.href = "http://localhost/project-ads-athena/public/user/login/"; 
            }
        });
        return;
    }

    // validasi apakah sudah beli tiket atau belum
    if (inputjumlahTiketUser == 0) {
        Swal.fire({
            title: 'Anda Belum Menonton Film Ini!',
            text: 'Silahkan tonon terlebih dahulu baru memebri ulasan.',
            icon: 'warning',
            confirmButtonText: 'OK',
        });
        return;
    }

    // Validasi input
    if (!inputUser || !inputRating || !inputKomentar) {
        Swal.fire({
            title: 'Input Tidak Lengkap!',
            text: 'Semua kolom harus diisi sebelum melanjutkan.',
            icon: 'error',
            confirmButtonText: 'OK'
        });
        return;
    }

    // Validasi rating (harus antara 0 dan 10)
    if (inputRating < 0 || inputRating > 10) {
        Swal.fire({
            title: 'Invalid Rating!',
            text: 'Rating harus antara 0 dan 10',
            icon: 'error',
            confirmButtonText: 'OK'
        }).then(() => {
            document.getElementById('rating').value = '';
        });
        return;
    }

    // fetch ke ulasan untuk mengirim data
    const formData = new FormData();
    formData.append('userId', inputUserId);
    formData.append('filmId', inputFilmId);
    formData.append('rating', inputRating);
    formData.append('komentar', inputKomentar);
    formData.append('datePostReview', inputTanggal);

    // Send the data via fetch to the PHP controller
    try {
        const response = await fetch("http://localhost/project-ads-athena/public/ulasan/insertUlasan", {
            method: "POST",
            body: formData,
        });

        if (response.ok) {
            Swal.fire({
                icon: "info",
                title: "Ulasan Anda berhasil terinput",
                text: "Terima kasih atas tanggapan Anda",
            });
        } else {
            alert("Terjadi kesalahan saat menyimpan ulasan.");
        }
    } catch (e) {
        alert("Terjadi kesalahan saat input ke database ulasan.");
    }

    // Menambahkan review ke listReview
    const listReview = document.getElementById('listReview');
    const lines = listReview.getElementsByClassName('line');
    let lastLine = lines[lines.length - 1];
    let countReviewItem = lastLine ? lastLine.getElementsByClassName('reviewItem').length : 0;

    // Membuat baris baru jika sudah ada 2 review
    if (countReviewItem >= 2 || lines.length === 0) {
        const divLine = document.createElement('div');
        divLine.className = 'line';
        listReview.appendChild(divLine);
        lastLine = divLine;
    }

    const reviewItemHTML = `
        <div class="reviewItem">
            <div class="itemHeader">
                <span style="font-size: 1.2em;">⭐</span>
                <p>${inputRating}/10</p>
            </div>
            <div class="itemKomentar">
                <p>"${inputKomentar}"</p>
            </div>
            <div class="itemFooter">
                <p style="font-style: italic;">Posted By ${inputUser}</p>
            </div>
        </div>
    `;

    lastLine.innerHTML += reviewItemHTML;

    const newReviewItem = lastLine.querySelector('.reviewItem:last-child');
    setTimeout(() => {
        newReviewItem.classList.add('show');
    }, 30);

    // Reset form setelah diposting
    document.getElementById('reviewForm').reset();

    // Menyembunyikan form ulasan setelah diposting
    document.getElementById('reviewFilm').style.display = 'none';
    document.getElementById('reviewFilm').style.opacity = 0;
    document.getElementById('reviewFilm').style.transform = 'translateY(-10px)';
});


document.addEventListener("DOMContentLoaded", function () {
    const listReview = document.getElementById('listReview');
    const dataUlasan = JSON.parse(listReview.dataset.review);
    console.log(dataUlasan);

    if (dataUlasan.length > 0) {
        dataUlasan.forEach((review, index) => {
            const lines = listReview.getElementsByClassName('line');
            let lastLine = lines[lines.length - 1];
            let countReviewItem = lastLine ? lastLine.getElementsByClassName('reviewItem').length : 0;

            if (countReviewItem >= 2 || lines.length === 0) {
                const divLine = document.createElement('div');
                divLine.className = 'line';
                listReview.appendChild(divLine);
                lastLine = divLine;
            }

            const reviewItem = document.createElement('div');
            reviewItem.classList.add('reviewItem');

            reviewItem.innerHTML = `
                <div class="itemHeader">
                    <span style="font-size: 1.2em;">⭐</span>
                    <p>${review.rating}/10</p>
                </div>
                <div class="itemKomentar">
                    <p>"${review.komentar}"</p>
                </div>
                <div class="itemFooter">
                    <p style="font-style: italic;">Posted By ${review.username}</p>
                </div>
            `;

            lastLine.appendChild(reviewItem);

            setTimeout(() => {
                reviewItem.classList.add('show');
            }, 30);
        });
    }
});


const button_get_ticket = document.getElementById('get-ticket-button');
const dataJadwal = JSON.parse(button_get_ticket.dataset.jadwal);
const dataFilm = JSON.parse(button_get_ticket.dataset.film);
const dataUserId = button_get_ticket.dataset.userId;

const popup = document.getElementById('selectTicketPopup');
const select = popup.querySelector('#selectTicket');

button_get_ticket.addEventListener("click", function listJadwal() {
    button_get_ticket.disabled = true;
    button_get_ticket.style.cursor = 'not-allowed';

    dataJadwal.forEach((jadwal) => {
        let formListJadwal = document.createElement("form");
        formListJadwal.className = 'listJadwal';
        formListJadwal.innerHTML = `
            <div class="headerJadwal">
                <p class="dateJadwal">${jadwal.tanggal}</p>
                <p class="hargaJadwal">Rp ${dataFilm.harga}</p>
            </div>
            <div class="jamJadwal">
                <button name="jamButton" class="jamButton" 
                        type="button" 
                        data-film-id="${dataFilm.film_id}" 
                        data-jadwal-id="${jadwal.jadwal_id}" 
                        data-pukul="${jadwal.pukul}">
                        ${jadwal.pukul}
                </button>
            </div>
        `;

        document.getElementById('posterFilm').appendChild(formListJadwal);
        formListJadwal.style.display = 'flex';
        formListJadwal.scrollIntoView({ behavior: 'smooth', block: 'start' });

        setTimeout(() => {
            formListJadwal.style.opacity = 1;
            formListJadwal.style.transform = 'translateY(0)';
        }, 30);

        const jamButton = formListJadwal.querySelector('.jamButton');
        jamButton.addEventListener("click", function selectTicket() {
            if (!dataUserId) {
                Swal.fire({
                    title: 'Anda Belum Login!',
                    text: 'Silahkan Register / Login untuk bisa membeli tiket.',
                    icon: 'warning',
                    confirmButtonText: 'OK',
                });
                return;
            }

            popup.style.display = 'block';

            // Set film_id dan jadwal_id pada hidden input
            const filmId = jamButton.getAttribute('data-film-id');
            const jadwalId = jamButton.getAttribute('data-jadwal-id');
            popup.querySelector('input[name="inputHiddenFilmId"]').value = filmId;
            popup.querySelector('input[name="inputHiddenJadwalId"]').value = jadwalId;

            const btnCancel = popup.querySelector('#btn-ticket-cancel');
            btnCancel.addEventListener("click", function closeSelectTicket() {
                select.value = "placeholder";
                popup.style.display = 'none';
            });

            const btnContinue = popup.querySelector('#btn-ticket-number');
            btnContinue.replaceWith(btnContinue.cloneNode(true));
            const newBtnContinue = popup.querySelector('#btn-ticket-number');

            newBtnContinue.addEventListener("click", function (event) {
                event.preventDefault(); // Mencegah pengiriman form otomatis

                const numberOfTickets = select.value;

                if (numberOfTickets === "placeholder" || numberOfTickets === "") {
                    Swal.fire({
                        title: 'Jumlah Tiket Belum Dipilih!',
                        text: 'Silakan pilih jumlah tiket sebelum melanjutkan.',
                        icon: 'error',
                        confirmButtonText: 'OK'
                    });
                    return;
                }

                Swal.fire({
                    title: `Anda memilih ${numberOfTickets} tiket`,
                    text: 'Silakan pilih bangku dan baris kursi',
                    icon: 'info',
                    confirmButtonText: 'OK'
                }).then(() => {
                    popup.querySelector('form').submit();
                    select.value = "placeholder";
                });
            });
        });
    });
});
















