<x-layout.landing title="Tentang PEMIRA {{ date('Y') }}">
    @pushOnce('vites')
        @vite(['resources/js/lib/boxicons.js', 'resources/css/addon/about.css'])
    @endPushOnce

    <section class="about-section">
        <div class="about-container">
            <div class="hero-about">
                <div class="hero-badge">
                    <box-icon name='info-circle' color='#1abc9c'></box-icon>
                    Tentang PEMIRA 2025
                </div>
                <h1>Membangun Demokrasi<br>yang Berkualitas</h1>
                <p>Melalui keterbukaan informasi dan partisipasi aktif, kita wujudkan pemilihan yang transparan,
                    objektif, dan bermakna</p>
            </div>

            <div class="theme-section">
                <div class="section-icon">
                    <box-icon name='bulb' type="solid" color='#ffffff'></box-icon>
                </div>
                <h2>Tema PEMIRA 2025</h2>
                <div class="theme-title">"Information Empowers Democracy"</div>
                <div class="theme-subtitle">→ Informasi yang kuat melahirkan demokrasi yang berkualitas</div>

                <div class="theme-description">
                    <p>Tema ini menekankan bahwa demokrasi yang baik dimulai dari keterbukaan dan kekuatan informasi.
                        Tema ini mencerminkan semangat untuk menciptakan proses pemilihan yang transparan, melibatkan
                        seluruh anggota, dan tetap menjaga integritas.</p>
                </div>

                <div class="highlight-box">
                    <h3><i class='bx bxs-check-circle'></i> Makna Tema</h3>
                    <p>Ketika informasi mengenai calon, visi-misi, serta cara pelaksanaan pemilihan disampaikan secara
                        terbuka kepada seluruh mahasiswa, maka mahasiswa menjadi pemilih yang berpikir jernih dan
                        memilih dengan rasional, bukan hanya ikut-ikutan. Proses demokrasi menjadi lebih sehat,
                        objektif, dan bermakna, dan hasil pemilihan pun akan menghasilkan seorang pemimpin yang
                        benar-benar didukung dan dipilih secara sadar.</p>
                </div>
            </div>

            <div class="jargon-section">
                <div class="section-icon">
                    <box-icon name='megaphone' type="solid" color='#ffffff'></box-icon>

                </div>
                <h2>Jargon PEMIRA 2025</h2>
                <div class="jargon-main">"Informed Minds, Empowered Votes!"</div>
                <div class="jargon-translation">→ Menekankan bahwa pemilih yang punya informasi akan membuat demokrasi
                    yang kuat</div>

                <div class="theme-description">
                    <p>Jargon ini menunjukkan betapa kuatnya mahasiswa HMSI sebagai pemilih yang bijak, penuh kesadaran,
                        dan memiliki kemampuan. Setiap suara bukan hanya angka tapi suara perubahan, suara kesadaran,
                        dan suara tanggung jawab.</p>
                </div>

                <div class="jargon-breakdown">
                    <div class="jargon-card">
                        <h3>"Informed Minds"</h3>
                        <p>Artinya setiap mahasiswa memiliki pengetahuan dan pemahaman sebelum memilih. Mereka tahu
                            siapa calon yang layak, serta apa visi yang mereka usung. Pemilih yang cerdas adalah pemilih
                            yang membuat keputusan berdasarkan informasi, bukan sekadar mengikuti arus.</p>
                    </div>

                    <div class="jargon-card">
                        <h3>"Empowered Votes!"</h3>
                        <p>Menjelaskan betapa kuatnya setiap suara mahasiswa yang sadar dan berani dalam menentukan masa
                            depan HMSI dengan yakin. Suara yang diberdayakan adalah suara yang bermakna, yang lahir dari
                            kesadaran penuh dan tanggung jawab.</p>
                    </div>
                </div>
            </div>

            <div class="movement-section">
                <div class="section-icon">
                    <box-icon name='hand' type="solid" color='#ffffff'></box-icon>

                </div>
                <h2>Gerakan PEMIRA 2025</h2>
                <p style="text-align: center; color: #5a6c7d; font-size: 18px; margin-top: 15px; margin-bottom: 20px;">
                    Wujudkan semangat PEMIRA melalui gerakan yang bermakna</p>

                <div class="movements-grid">
                    <div class="movement-card">
                        <div class="movement-icon">
                            <box-icon name='brain' type="solid" color='#ffffff'></box-icon>
                        </div>
                        <div class="movement-phrase">"Informed Minds"</div>
                        <div class="movement-action">
                            <strong>Gerakan:</strong><br>
                            Letakkan tangan kanan di pelipis (seperti orang berpikir) sebagai simbol bahwa kita adalah
                            pemilih yang cerdas, yang berpikir dengan jernih sebelum mengambil keputusan.
                        </div>
                    </div>

                    <div class="movement-card">
                        <div class="movement-icon">
                            <box-icon name='trophy' type="solid" color='#ffffff'></box-icon>
                        </div>
                        <div class="movement-phrase">"Empowered Votes!"</div>
                        <div class="movement-action">
                            <strong>Gerakan:</strong><br>
                            Semua angkat tangan kanan (jari telunjuk) ke atas sambil menatap ke depan dengan ekspresi
                            yakin. Ini melambangkan kekuatan suara kita yang penuh percaya diri dalam menentukan masa
                            depan.
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</x-layout.landing>
