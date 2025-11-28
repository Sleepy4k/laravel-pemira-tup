<footer class="bg-tertiary-600 text-white py-4 px-6 md:px-12">
    <div class="max-w-7xl mx-auto flex flex-col md:flex-row justify-between items-center gap-4">
        <div class="text-sm font-medium text-center md:text-left">
            Copyright © {{ date('Y') }} {{ $appName }}. All rights reserved.
        </div>

        <div class="flex items-center gap-4">
            <a href="https://www.instagram.com/pemira.tup" target="_blank" rel="noopener noreferrer"
                class="h-10 w-10 border-2 border-white rounded-full flex items-center justify-center hover:bg-white hover:text-brand-purple transition-all">
                <box-icon name="instagram" type="logo" color="#000000ff"></box-icon>
            </a>
            <a href="mailto:panitiapemira@ittelkom-pwt.ac.id" target="_blank" rel="noopener noreferrer"
                class="h-10 w-10 border-2 border-white rounded-full flex items-center justify-center hover:bg-white hover:text-brand-purple transition-all">
                <box-icon name="envelope" color='#000000ff'></box-icon>
            </a>
            <a href="https://wa.me/6281387768990" target="_blank" rel="noopener noreferrer"
                class="h-10 w-10 border-2 border-white rounded-full flex items-center justify-center hover:bg-white hover:text-brand-purple transition-all">
                <box-icon name="whatsapp" type="logo" color='#000000ff'></box-icon>
            </a>
        </div>
    </div>
</footer>

<button class="back-to-top" id="backToTop" aria-label="Kembali ke atas">
    <box-icon name='chevron-up'></box-icon>
</button>
