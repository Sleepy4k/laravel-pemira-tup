<x-layout.landing title="Suaramu, Revolusinya!">
    @pushOnce('vites')
        @vite(['resources/js/addon/home-landing-page.js'])
    @endPushOnce

    <header-meta data-success="{{ session('success') }}" data-error="{{ session('error') }}"></header-meta>

    <section class="flex flex-col items-center">
        <img alt="Artwork Pemira {{ date('Y') }}" loading="lazy" width="309" height="308" class="bg-radial-primary"
            src="{{ asset('images/telkom.webp') }}" style="color: transparent;" id="artwork-pemira" />
        <h1 class="text-4xl md:text-5xl font-bold text-primary-600 mb-3 mt-6">Selamat Datang!</h1>
        <div class="place-items-center bg-tertiary-400 h-[4px] w-full lg:w-3/4 my-4 md:my-9" id="separator-line"></div>
        <p class="text-xl md:text-2xl font-bold text-gray-800 max-w-2xl leading-relaxed text-center">
            Pemilihan Raya Ikatan Keluarga Mahasiswa Universitas Telkom Purwokerto
            {{ date('Y') }}
        </p>
    </section>

    <section class="max-w-7xl mx-auto mt-24">
        <div
            class="bg-white border-[3px] border-primary-600 rounded-[40px] p-8 md:p-12 flex flex-col-reverse md:flex-row items-center gap-10 shadow-lg relative overflow-hidden">

            <div class="flex-1 z-10 w-full">
                <h3 class="text-3xl font-bold text-primary-600 mb-6">Apa itu Pemira?</h3>
                <p class="text-gray-700 leading-relaxed text-lg text-justify w-full">
                    PEMIRA (Pemilihan Raya) adalah proses demokrasi yang diselenggarakan oleh Ikatan Keluarga
                    Mahasiswa Universitas Telkom Purwokerto untuk memilih perwakilan mahasiswa yang akan
                    memimpin organisasi kemahasiswaan yaitu DPM (Dewan Perwakilan Mahasiswa) maupun BEM
                    (Badan Eksekutif Mahasiswa). Melalui PEMIRA, mahasiswa memiliki kesempatan untuk menyalurkan
                    suara mereka dalam menentukan arah dan kebijakan organisasi, serta memilih calon-calon yang
                    dianggap mampu membawa perubahan positif bagi keluarga mahasiswa.
                </p>
            </div>

            <div class="flex-1 flex justify-center md:justify-end z-10">
                <img src="{{ $appLogo }}" alt="Ilustrasi Kotak Suara" class="w-64 md:w-80 h-auto object-contain" id="ballot-box" />
            </div>
        </div>
    </section>
</x-layout.landing>
