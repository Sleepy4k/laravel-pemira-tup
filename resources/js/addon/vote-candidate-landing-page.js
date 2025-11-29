document.addEventListener("DOMContentLoaded", function () {
    const candidateCVBtns = document.querySelectorAll("#view-resume-btn");
    const closeResumeBtn = document.getElementById("close-resume-btn");
    const viewResumeContainer = document.getElementById(
        "view-resume-container"
    );
    const embedContainer = document.getElementById("resume-embed");

    if (closeResumeBtn && viewResumeContainer && embedContainer) {
        closeResumeBtn.addEventListener("click", function () {
            viewResumeContainer.classList.add("hidden");
            embedContainer.innerHTML = "";
        });

        candidateCVBtns.forEach(function (btn) {
            btn.addEventListener("click", function () {
                const resumeUrl = this.getAttribute("data-resume-url");
                if (resumeUrl) {
                    viewResumeContainer.classList.remove("hidden");
                    var fs = new FileReader();
                    fetch(resumeUrl)
                        .then((response) => response.blob())
                        .then((blob) => {
                            fs.readAsDataURL(blob);
                            fs.onload = function () {
                                const base64data = fs.result;
                                embedContainer.innerHTML = `<iframe src="${base64data}" class="w-full h-full border-0"></iframe>`;
                            };
                        });
                }
            });
        });
    }

    function showNotification(message, type = "info") {
        if (typeof window.Toast !== "undefined") {
            Toast.fire({
                icon: type,
                title: message,
            });
        } else {
            alert(message);
        }
    }

    function handlePilihKandidat(url, userId, candidateId) {
        axios({
            method: "post",
            url: url,
            data: {
                user_id: userId,
                candidate_id: candidateId,
            },
            headers: {
                "Content-Type": "application/json",
                Accept: "application/json",
            },
        })
            .then(function (response) {
                if (response.data.success) {
                    showNotification("Kandidat berhasil dipilih!", "success");
                    setTimeout(function () {
                        window.location.href = response.data.redirect_url;
                    }, 1500);
                } else {
                    showNotification(response.data.message || "Terjadi kesalahan saat memilih kandidat. Jika masalah berlanjut, silakan hubungi admin.", "error");
                }
            })
            .catch(function (error) {
                const message = error.response && error.response.data && error.response.data.message
                    ? error.response.data.message
                    : error.message;
                showNotification(message || "Terjadi kesalahan saat memilih kandidat. Jika masalah berlanjut, silakan hubungi admin.", "error");
            });
    }

    // handle vote button clicks
    const voteButtons = document.querySelectorAll("#select-candidate-btn");
    voteButtons.forEach(function (btn) {
        btn.addEventListener("click", function () {
            const userId = this.getAttribute("data-user-id");
            const candidateId = this.getAttribute("data-candidate-id");
            const voteUrl = this.getAttribute("data-vote-url");
            if (userId && voteUrl && candidateId) {
                if (typeof window.Swal === "undefined") {
                    if (confirm("Apakah Anda yakin memilih kandidat ini?")) {
                        handlePilihKandidat(voteUrl, userId, candidateId);
                    }
                } else {
                    Swal.fire({
                        title: "Apakah Anda yakin?",
                        text: "Anda tidak dapat mengubah pilihan setelah dikonfirmasi.",
                        icon: "question",
                        showCancelButton: true,
                        confirmButtonColor: "#d33",
                        cancelButtonColor: "#6c757d",
                        confirmButtonText: "Ya, pilih!",
                        cancelButtonText: "Batal",
                    }).then((result) => {
                        if (result.isConfirmed) {
                            handlePilihKandidat(voteUrl, userId, candidateId);
                        }
                    });
                }
            }
        });
    });
});
