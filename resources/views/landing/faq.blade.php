<x-layout.landing title="Frequently Asked Questions (FAQ)">
    @pushOnce('vites')
        @vite(['resources/js/addon/faq-landing-page.js'])
    @endPushOnce

    <section class="max-w-7xl mx-auto mt-4 px-6 md:px-12">
        <h1 class="text-4xl md:text-5xl font-bold text-primary-600 mb-3 text-center">Frequently Asked Questions (FAQ)
        </h1>
        <div class="place-items-center bg-tertiary-400 h-[4px] w-full lg:w-3/4 mx-auto my-4 md:my-9" id="separator-line">
        </div>

        <div class="space-y-4 md:space-y-6 max-w-4xl mx-auto">
            @forelse ($faqs as $faq)
                <div
                    class="border border-gray-200 rounded-2xl shadow-sm hover:shadow-md transition-shadow duration-300 overflow-hidden group faq-item bg-white">
                    <button
                        class="w-full flex justify-between items-center px-6 py-5 text-left faq-question bg-white hover:bg-gray-200 transition-colors focus:outline-none cursor-pointer select-none">
                        <span
                            class="text-lg font-semibold text-gray-800 group-hover:text-primary-600 transition-colors pr-4">{{ $faq->question }}</span>
                        <div
                            class="flex-shrink-0 w-8 h-8 rounded-full bg-primary-50 flex items-center justify-center group-hover:bg-primary-100 transition-colors">
                            <box-icon name='chevron-down'
                                class="fill-primary-600 transition-transform duration-300 transform group-[.active]:rotate-180 rotate-0"></box-icon>
                        </div>
                    </button>
                    <div
                        class="faq-answer max-h-0 overflow-hidden transition-all duration-300 ease-in-out bg-gray-50/50">
                        <div class="px-6 pb-6 pt-2">
                            <p class="text-gray-600 leading-relaxed text-justify">
                                {{ $faq->answer }}
                            </p>
                        </div>
                    </div>
                </div>
            @empty
                <div
                    class="flex flex-col items-center justify-center py-12 px-4 text-center bg-gray-50 rounded-2xl border border-dashed border-gray-300">
                    <box-icon name='help-circle' size='lg' class="fill-gray-400 mb-3"></box-icon>
                    <h3 class="text-lg font-medium text-gray-900">Belum ada FAQ</h3>
                    <p class="text-gray-500 mt-1">Saat ini belum ada pertanyaan yang sering diajukan.</p>
                </div>
            @endforelse
        </div>
    </section>
</x-layout.landing>
