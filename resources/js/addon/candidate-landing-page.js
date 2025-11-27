document.addEventListener('DOMContentLoaded', function() {
    const observer = new IntersectionObserver((entries) => {
        entries.forEach((entry) => {
            if (entry.isIntersecting) {
                entry.target.style.opacity = 1;
                entry.target.style.transform = 'translateY(0)';
            }
        });
    }, { threshold: 0.1 });

    if (observer) {
        const candidates = document.querySelectorAll('.candidate-card');
        if (candidates.length) {
            candidates.forEach((candidate) => {
                candidate.style.opacity = 0;
                candidate.style.transform = 'translateY(30px)';
                candidate.style.transition = 'all 0.6s ease-out';
                observer.observe(candidate);
            });
        }
    }

    function displayEmbedPDFinModal(url) {
        const modal = document.getElementById('pdf-modal');
        const modalContent = modal.querySelector('#pdf-modal-content');

        modalContent.innerHTML = `
            <span class="close-button" id="close-pdf-modal">&times;</span>
            <object data="${url}" width="100%" height="100%">
                <p class="pdf-error-message">Something went wrong while loading the PDF file. You can <a href="${url}" target="_blank" rel="noopener">click here to download the PDF file</a>.</p>
            </object>
        `;
        modal.classList.add('active');

        const closeButton = document.getElementById('close-pdf-modal');
        closeButton.addEventListener('click', function() {
            modal.classList.remove('active');
            modalContent.innerHTML = '';
        });

        window.addEventListener('click', function(event) {
            if (event.target === modal) {
                modal.classList.remove('active');
                modalContent.innerHTML = '';
            }
        });
    }

    const resumeButtons = document.querySelectorAll('button[id^="download-resume-"]');
    resumeButtons.forEach((button) => {
        button.addEventListener('click', function() {
            const url = this.getAttribute('data-url');
            if (url) {
                displayEmbedPDFinModal(url);
            }
        });
    });

    const attachmentButtons = document.querySelectorAll('button[id^="download-attachment-"]');
    attachmentButtons.forEach((button) => {
        button.addEventListener('click', function() {
            const url = this.getAttribute('data-url');
            if (url) {
                displayEmbedPDFinModal(url);
            }
        });
    });

    const reloadPageBtn = document.getElementById('reload-page-btn');
    if (reloadPageBtn) {
        reloadPageBtn.addEventListener('click', function() {
            location.reload();
        });
    }
});
