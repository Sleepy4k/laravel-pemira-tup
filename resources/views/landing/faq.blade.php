<x-layout.landing title="Frequently Asked Questions (FAQ)">
    @pushOnce('vites')
        @vite(['resources/js/addon/faq-landing-page.js'])
    @endPushOnce

    <section class="max-w-7xl mx-auto mt-4 px-6 md:px-12">
        <h1 class="text-4xl md:text-5xl font-bold text-primary-600 mb-3 text-center">Frequently Asked Questions (FAQ)
        </h1>
        <div class="place-items-center bg-tertiary-400 h-[4px] w-full lg:w-3/4 mx-auto my-4 md:my-9"></div>

        <div class="space-y-4 md:space-y-6">
            @forelse ($faqs as $faq)
                <div class="border border-primary-100 rounded-xl shadow-xl overflow-hidden group faq-item">
                    <button
                        class="w-full flex justify-between items-center px-6 py-4 md:py-5 text-left faq-question bg-white hover:bg-primary-50 transition-colors focus:outline-none cursor-pointer">
                        <span
                            class="text-lg md:text-xl font-semibold text-primary-800 group-hover:text-primary-600 transition-colors">{{ $faq->question }}</span>
                        <box-icon name='chevron-down'
                            class="fill-primary-600 group-hover:fill-primary-800 transition-transform duration-300 rotate-180"></box-icon>
                    </button>
                    <div class="faq-answer max-h-0 overflow-hidden px-6 transition-all duration-300 bg-primary-50/30">
                        <p class="py-4 md:py-5 text-gray-600 leading-relaxed text-justify border-t border-primary-100">
                            {{ $faq->answer }}
                        </p>
                    </div>
                </div>
            @empty
                <div class="border border-primary-100 rounded-xl shadow-xl overflow-hidden p-6 md:p-8 bg-primary-50">
                    <p class="text-gray-600 text-center text-lg">Belum ada pertanyaan yang sering diajukan.</p>
                </div>
            @endforelse
        </div>
    </section>
</x-layout.landing>
