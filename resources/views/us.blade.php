<!-- Counts Section -->
<section id="counts" class="section counts light-background">
    <div class="container" data-aos="fade-up" data-aos-delay="100">
        <div class="row gy-4">

            <div class="col-lg-4 col-md-6">
                <div class="stats-item text-center w-100 h-100">
                    <span data-purecounter-start="0" data-purecounter-end="{{ $studentsCount }}" data-purecounter-duration="1" class="purecounter"></span>
                    <p>{{ __('main.students') }}</p>
                </div>
            </div>

            <div class="col-lg-4 col-md-6">
                <div class="stats-item text-center w-100 h-100">
                    <span data-purecounter-start="0" data-purecounter-end="{{ $coursesCount }}" data-purecounter-duration="1" class="purecounter"></span>
                    <p>{{ __('main.courses') }}</p>
                </div>
            </div>

            <div class="col-lg-4 col-md-6">
                <div class="stats-item text-center w-100 h-100">
                    <span data-purecounter-start="0" data-purecounter-end="{{ $teachersCount }}" data-purecounter-duration="1" class="purecounter"></span>
                    <p>{{ __('main.teachers') }}</p>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- /Counts Section -->

<!-- Why Us Section -->
<section id="why-us" class="section py-5 bg-gradient-to-b from-white to-blue-50">
    <div class="container">
        <div class="row gy-4">

            <div class="col-lg-4" data-aos="fade-up" data-aos-delay="100">
                <div class="bg-gradient-to-br from-blue-100 to-blue-200 text-gray-800 rounded-xl shadow-md p-4 h-100 d-flex flex-column justify-content-between">
                    <h3 class="text-xl font-semibold mb-3">{{ __('main.why_us_heading') }}</h3>
                    <p class="text-sm">
                        {{ __('main.why_us_desc') }}
                    </p>
                    <div class="text-center mt-auto">
                        <a href="#" class="inline-block mt-4 text-blue-900 hover:underline font-medium">{{ __('main.learn_more') }} →</a>
                    </div>
                </div>
            </div>

            <div class="col-lg-8 d-flex align-items-stretch">
                <div class="row gy-4 w-100" data-aos="fade-up" data-aos-delay="200">

                    <div class="col-xl-4">
                        <div class="rounded-xl shadow bg-white border-l-4 border-blue-400 p-4 text-center h-100 hover:shadow-md transition">
                            <h4 class="text-lg font-semibold text-blue-800 mb-2">{{ __('main.feature_1_title') }}</h4>
                            <p class="text-sm text-gray-700">{{ __('main.feature_1_desc') }}</p>
                        </div>
                    </div>

                    <div class="col-xl-4">
                        <div class="rounded-xl shadow bg-white border-l-4 border-green-400 p-4 text-center h-100 hover:shadow-md transition">
                            <h4 class="text-lg font-semibold text-green-800 mb-2">{{ __('main.feature_2_title') }}</h4>
                            <p class="text-sm text-gray-700">{{ __('main.feature_2_desc') }}</p>
                        </div>
                    </div>

                    <div class="col-xl-4">
                        <div class="rounded-xl shadow bg-white border-l-4 border-purple-400 p-4 text-center h-100 hover:shadow-md transition">
                            <h4 class="text-lg font-semibold text-purple-800 mb-2">{{ __('main.feature_3_title') }}</h4>
                            <p class="text-sm text-gray-700">{{ __('main.feature_3_desc') }}</p>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>
</section>
<!-- /Why Us Section -->
