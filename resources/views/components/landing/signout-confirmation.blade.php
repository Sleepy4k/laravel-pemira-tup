<div id="logout-modal" class="relative z-50 hidden" aria-labelledby="modal-title" role="dialog" aria-modal="true">
    <div id="logout-modal-backdrop"
        class="fixed inset-0 bg-gray-900/60 backdrop-blur-md transition-opacity duration-300 ease-out opacity-0">
    </div>

    <div class="fixed inset-0 z-10 w-screen overflow-y-auto">
        <div class="flex min-h-full items-center justify-center p-4 text-center sm:p-0">
            <div id="logout-modal-panel"
                class="relative transform overflow-hidden rounded-3xl bg-white text-left shadow-2xl transition-all duration-300 ease-out w-full max-w-sm sm:max-w-lg border border-gray-100 opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95 mx-auto">
                <div
                    class="absolute top-0 left-0 w-full h-32 bg-gradient-to-br from-brand-primary/10 to-brand-secondary/10 -z-10">
                </div>
                <button type="button" id="close-modal-x"
                    class="absolute top-4 right-4 text-gray-400 hover:text-gray-600 transition-colors cursor-pointer">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                        stroke="currentColor" class="w-6 h-6">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </button>

                <div class="px-6 pt-8 pb-6 sm:p-8">
                    <div class="flex flex-col items-center text-center">
                        <div class="relative mb-5">
                            <div class="absolute inset-0 bg-brand-primary/20 rounded-full blur-xl"></div>
                            <div
                                class="relative flex h-20 w-20 items-center justify-center rounded-full bg-gradient-to-br from-brand-light to-white shadow-lg border border-gray-100">
                                <svg class="h-10 w-10 text-brand-primary" fill="none" viewBox="0 0 24 24"
                                    stroke-width="1.5" stroke="currentColor" aria-hidden="true">
                                    <path stroke-linecap="round" stroke-linejoin="round"
                                        d="M4.26 10.147a60.436 60.436 0 00-.491 6.347A48.627 48.627 0 0112 20.904a48.627 48.627 0 018.232-4.41 60.46 60.46 0 00-.491-6.347m-15.482 0a50.57 50.57 0 00-2.658-.813A59.905 59.905 0 0112 3.493a59.902 59.902 0 0110.499 5.221 69.17 69.17 0 00-2.658.814m-15.482 0A50.697 50.697 0 0112 13.489a50.702 50.702 0 017.74-3.342M6.75 15a.75.75 0 100-1.5.75.75 0 000 1.5zm0 0v-3.675A55.378 55.378 0 0112 8.443m-7.007 11.55A5.981 5.981 0 006.75 15.75v-1.5" />
                                </svg>
                            </div>
                        </div>

                        <h3 class="text-2xl font-bold leading-tight text-gray-900 mb-2" id="modal-title">
                            Apakah Kamu Yakin Ingin Keluar?
                        </h3>

                        <p class="text-sm text-gray-500 leading-relaxed max-w-sm mx-auto">
                            Kamu akan diminta untuk masuk kembali melalui SSO untuk mengakses akunmu.
                            Dengan melanjutkan, kamu akan keluar dari sesi saat ini.
                        </p>
                    </div>
                </div>

                <div
                    class="bg-gray-50/50 px-6 py-4 sm:px-8 sm:flex sm:flex-row-reverse sm:gap-3 border-t border-gray-100">
                    <button type="button" id="proceed-logout-btn"
                        class="inline-flex w-full justify-center items-center gap-2 rounded-xl bg-primary-600 px-5 py-3 text-sm font-semibold text-white shadow-lg shadow-primary-600/30 hover:bg-primary-700 hover:shadow-primary-700/30 hover:-translate-y-0.5 transition-all duration-200 sm:w-auto cursor-pointer">
                        <span>Ya, Keluar!</span>
                        <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"
                            aria-hidden="true">
                            <path stroke-linecap="round" stroke-linejoin="round"
                                d="M15.75 9V5.25A2.25 2.25 0 0013.5 3h-6a2.25 2.25 0 00-2.25 2.25v13.5A2.25 2.25 0 007.5 21h6a2.25 2.25 0 002.25-2.25V15m3 0l3-3m0 0l-3-3m3 3H9" />
                        </svg>
                    </button>
                    <button type="button" id="close-modal-btn"
                        class="mt-3 inline-flex w-full justify-center rounded-xl bg-white px-5 py-3 text-sm font-semibold text-gray-700 shadow-sm ring-1 ring-inset ring-gray-200 hover:bg-gray-50 hover:text-gray-900 transition-all duration-200 sm:mt-0 sm:w-auto cursor-pointer">
                        Batal
                    </button>
                </div>
            </div>
        </div>
    </div>
</div>
