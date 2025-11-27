import axios from "axios";
import Swal from "sweetalert2/dist/sweetalert2";
import "sweetalert2/src/sweetalert2.scss";

window.axios = axios;
window.axios.defaults.headers.common["X-Requested-With"] = "XMLHttpRequest";
window.axios.defaults.withCredentials = true;

const token =
    document.head
        .querySelector('meta[property="csrf-token"]')
        ?.getAttribute("content") || null;
if (token) {
    window.axios.defaults.headers.common["X-CSRF-TOKEN"] = token;
}

window.Swal = Swal;
window.Swal.mixin({
    customClass: {
        confirmButton: "btn-primary mx-2",
        cancelButton: "btn-secondary mx-2",
    },
    buttonsStyling: false,
});

window.Toast = Swal.mixin({
    toast: true,
    position: "top-end",
    showConfirmButton: false,
    timer: 3000,
    timerProgressBar: true,
    customClass: {
        popup: "bg-gray-800 text-white rounded-md shadow-lg",
    },
});

document.addEventListener("DOMContentLoaded", function () {
    const voteBtns = document.querySelectorAll("#vote-candidate");

    voteBtns.forEach(function (btn) {
        btn.addEventListener("click", function (e) {
            e.preventDefault();

            btn.disabled = true;
            btn.innerHTML =
                "<box-icon name='loader-circle' color='#ffffff'></box-icon><span>Memproses...</span>";

            Swal.fire({
                title: "Konfirmasi Vote",
                text: "Apakah Anda yakin ingin memilih kandidat ini? Tindakan ini tidak dapat diubah.",
                icon: "warning",
                showCancelButton: true,
                confirmButtonText: "Ya, pilih kandidat ini",
                cancelButtonText: "Batal",
            })
                .then((result) => {
                    if (result.isConfirmed) {
                        const candidateId =
                            btn.getAttribute("data-candidate-id");
                        const voteUrl =
                            btn.getAttribute("data-vote-url") || "/vote/cast";

                        btn.disabled = true;
                        btn.innerText = "Memproses...";

                        window.axios
                            .post(voteUrl, { candidate_id: candidateId })
                            .then(function (response) {
                                if (response.data.status === "success") {
                                    Toast.fire({
                                        icon: "success",
                                        title: "Vote berhasil dikirim!",
                                    });
                                    setTimeout(function () {
                                        window.location.href =
                                            response.data.redirect_url;
                                    }, 1500);
                                } else {
                                    Toast.fire({
                                        icon: "error",
                                        title: response.data.message,
                                    });
                                }
                            })
                            .catch(function (error) {
                                const message =
                                    error.response?.data?.message ||
                                    "Terjadi kesalahan tak terduga.";
                                Toast.fire({
                                    icon: "error",
                                    title: message,
                                });
                            });
                    }
                })
                .finally(function () {
                    btn.disabled = false;
                    btn.innerHTML =
                        "<box-icon name='check-circle' type='solid' color='#ffffff'></box-icon><span>Pilih Kandidat Ini</span>";
                });
        });
    });
});
