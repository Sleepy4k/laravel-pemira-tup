<x-layout.landing title="Timeline {{ date('Y') }}">
    @pushOnce('vites')
        @vite(['resources/js/lib/boxicons.js', 'resources/css/addon/timeline.css', 'resources/js/addon/timeline-landing-page.js'])
    @endPushOnce

    <header data-current-date="{{ $currentDate }}"></header>

    <section class="timeline-section">
        <div class="timeline-container">
            <h2 class="timeline-header">Timeline PEMIRA 2025</h2>
            <p class="timeline-subtitle">Ikuti setiap tahapan penting dalam perjalanan demokrasi kita</p>

            <div class="timeline">
                @foreach ($timelines as $timeline)
                    <div class="timeline-item" data-start="{{ $timeline->start_date }}"
                        data-end="{{ $timeline->end_date }}">
                        <div class="timeline-dot">
                            <div class="dot-inner"></div>
                        </div>
                        <div class="timeline-content">
                            <div class="timeline-date">{{ $timeline->range }}</div>
                            <div class="timeline-badge">
                                @if ($timeline->icon)
                                    <box-icon name="{{ $timeline->icon }}" color="#0b515c" size="xs"></box-icon>
                                @endif
                                {{ $timeline->name }}
                            </div>
                            <p>{{ $timeline->description }}</p>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </section>
</x-layout.landing>
