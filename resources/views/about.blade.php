@auth()
    <!-- Секция: О нас -->
    <section id="about" class="about section py-5">
        <div class="container">
            <div class="row gy-4 items-center">
                <div class="col-lg-6 order-1 order-lg-2" data-aos="fade-up" data-aos-delay="100">
                    {{--                    <img src="assets/img/about.jpg" class="img-fluid rounded-xl shadow-md" alt="{{ __('main.about_us') }}">--}}
                </div>

                <div class="col-lg-6 order-2 order-lg-1 content" data-aos="fade-up" data-aos-delay="200">
                    <h3 class="text-2xl font-semibold mb-4">{{ __('main.about_heading') }}</h3>
                    <p class="italic text-gray-700 mb-4">
                        {{ __('main.about_description') }}
                    </p>
                    <ul class="list-disc pl-5 text-gray-700 space-y-2">
                        <li>{{ __('main.feature_1') }}</li>
                        <li>{{ __('main.feature_2') }}</li>
                        <li>{{ __('main.feature_3') }}</li>
                    </ul>
                    <p class="mt-3 text-muted">
                        <a href="{{ route('teacher.form') }}">Хотите преподавать у нас? -></a>
                    </p>

                </div>
            </div>
        </div>
    </section>
@endauth
