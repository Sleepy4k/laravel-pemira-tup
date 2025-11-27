<footer>
    <div class="footer-decorative-top"></div>
    <div class="footer-container">
        <div class="footer-content">
            <div class="footer-brand">
                <div class="footer-logos">
                    <div class="footer-logo-item footer-logo-1">
                        <img src="{{ asset('images/si.png') }}" alt="HIMASI Logo" loading="lazy" />
                    </div>
                    <div class="footer-logo-item footer-logo-2">
                        <img src="{{ $logo }}" alt="PEMIRA Logo" loading="lazy" />
                    </div>
                </div>
                <div class="footer-brand-name">PEMIRA HMSI 2025</div>
                <p class="footer-tagline">
                    Sistem Pemilihan Raya yang transparan, demokratis, dan modern untuk memilih pemimpin masa depan
                    Himpunan Mahasiswa Sistem Informasi.
                </p>
            </div>

            <div class="footer-column" id="footer-links-section">
                <h3>Informasi</h3>
                <ul class="footer-links">
                    <li><a href="{{ route('landing') }}">Beranda</a></li>
                    <li><a href="{{ route('about') }}">Tentang</a></li>
                    <li><a href="{{ route('timeline') }}">Timeline</a></li>
                    <li><a href="{{ route('candidates') }}">Kandidat</a></li>
                </ul>
            </div>

            <div class="footer-column footer-social-section">
                <h3>Kontak Kami</h3>
                <div class="footer-contact">
                    <div class="contact-item">
                        <div class="contact-icon">
                            <box-icon name='envelope' color='#16a085'></box-icon>
                        </div>
                        <div class="contact-text">
                            <a href="mailto:pemirahmsi@gmail.com">pemirahmsi@gmail.com</a>
                        </div>
                    </div>
                    <div class="contact-item">
                        <div class="contact-icon">
                            <box-icon name='phone' color='#16a085'></box-icon>
                        </div>
                        <div class="contact-text">
                            <a href="https://wa.me/6281225254962">+62 812-2525-4962</a>
                        </div>
                    </div>
                    <div class="contact-item">
                        <div class="contact-icon">
                            <box-icon name='instagram' type="logo" color='#16a085'></box-icon>
                        </div>
                        <div class="contact-text">
                            <a href="https://instagram.com/pemirahmsi.tup" target="_blank" rel="noopener">@pemirahmssi.tup</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="footer-bottom">
            <div class="footer-copyright">
                © {{ date('Y') }} PEMIRA HMSI. All rights reserved.
            </div>
        </div>
    </div>
</footer>

<button class="back-to-top" id="backToTop" aria-label="Kembali ke atas">
    <box-icon name='chevron-up'></box-icon>
</button>
