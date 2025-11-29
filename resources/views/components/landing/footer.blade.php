<footer class="relative bg-gradient-to-br from-tertiary-700 to-tertiary-900 text-white py-8 px-6 md:px-12 overflow-hidden">
    <div class="absolute top-0 left-0 w-full h-1 bg-gradient-to-r from-transparent via-white/20 to-transparent"></div>
    <div class="absolute -top-24 -right-24 w-48 h-48 bg-white/5 rounded-full blur-3xl"></div>
    <div class="absolute -bottom-24 -left-24 w-48 h-48 bg-brand-purple/20 rounded-full blur-3xl"></div>

    <div class="relative max-w-7xl mx-auto flex flex-col md:flex-row justify-between items-center gap-6">
        <div class="text-center md:text-left space-y-1">
            <p class="text-sm font-medium tracking-wide text-white/90">
                Copyright © {{ date('Y') }} <span class="font-bold text-white">{{ $appName }}</span>.
            </p>
            <p class="text-xs text-white/60">All rights reserved.</p>
        </div>

        <div class="flex items-center gap-4">
            <a href="https://www.instagram.com/pemira.tup" target="_blank" rel="noopener noreferrer"
                class="group h-10 w-10 bg-white/10 backdrop-blur-sm border border-white/20 rounded-full flex items-center justify-center hover:bg-white hover:scale-110 hover:shadow-lg hover:shadow-purple-500/20 transition-all duration-300">
                <box-icon name="instagram" type="logo" class="fill-white group-hover:fill-tertiary-700 transition-colors duration-300"></box-icon>
            </a>
            <a href="mailto:panitiapemira@ittelkom-pwt.ac.id" target="_blank" rel="noopener noreferrer"
                class="group h-10 w-10 bg-white/10 backdrop-blur-sm border border-white/20 rounded-full flex items-center justify-center hover:bg-white hover:scale-110 hover:shadow-lg hover:shadow-purple-500/20 transition-all duration-300">
                <box-icon name="envelope" class="fill-white group-hover:fill-tertiary-700 transition-colors duration-300"></box-icon>
            </a>
            <a href="https://wa.me/6281387768990" target="_blank" rel="noopener noreferrer"
                class="group h-10 w-10 bg-white/10 backdrop-blur-sm border border-white/20 rounded-full flex items-center justify-center hover:bg-white hover:scale-110 hover:shadow-lg hover:shadow-purple-500/20 transition-all duration-300">
                <box-icon name="whatsapp" type="logo" class="fill-white group-hover:fill-tertiary-700 transition-colors duration-300"></box-icon>
            </a>
        </div>
    </div>
</footer>

<button class="fixed bottom-8 right-6 z-100 h-12 w-12 bg-tertiary-600/80 backdrop-blur-md text-white rounded-full shadow-lg flex items-center justify-center translate-y-4 transition-all duration-300 hover:bg-tertiary-500 hover:-translate-y-1 hover:shadow-xl cursor-pointer"
    id="backToTop"
    aria-label="Kembali ke atas">
    <box-icon name='chevron-up' color="white"></box-icon>
</button>
