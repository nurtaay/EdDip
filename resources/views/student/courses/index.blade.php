@section('card')
    <style>
        .filter-section form {
            background: var(--surface-color);
            border: 1px solid color-mix(in srgb, var(--default-color), transparent 80%);
            border-radius: 16px;
            padding: 24px;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.02);
        }
        .filter-section .form-label {
            font-weight: 600;
            font-size: 0.95rem;
            color: var(--default-color);
            margin-bottom: 4px;
        }

        .filter-section input,
        .filter-section select {
            background-color: var(--surface-color);
            color: var(--default-color);
            border: 1px solid color-mix(in srgb, var(--default-color), transparent 70%);
            border-radius: 10px;
            padding: 10px 14px;
            font-size: 0.9rem;
            width: 230px;
            transition: all 0.2s ease-in-out;
        }
        .filter-section input:focus,
        .filter-section select:focus {
            border-color: var(--accent-color);
            box-shadow: 0 0 0 3px color-mix(in srgb, var(--accent-color), transparent 75%);
            outline: none;
        }
        .filter-section .btn-apply {
            background-color: var(--accent-color);
            color: var(--contrast-color);
            border: none;
            padding: 10px 20px;
            border-radius: 10px;
            font-size: 0.95rem;
            transition: background-color 0.3s ease;
        }

        .filter-section .btn-apply:hover {
            background-color: color-mix(in srgb, var(--accent-color), transparent 15%);
        }

        .filter-section .btn-reset {
            background-color: transparent;
            color: var(--default-color);
            border: 1px solid color-mix(in srgb, var(--default-color), transparent 60%);
            padding: 10px 20px;
            border-radius: 10px;
            font-size: 0.95rem;
            transition: all 0.3s ease;
        }

        .filter-section .btn-reset:hover {
            background-color: color-mix(in srgb, var(--default-color), transparent 92%);
            border-color: var(--default-color);
        }
        .filter-section input::placeholder {
            color: color-mix(in srgb, var(--default-color), transparent 50%);
        }
        .course-img {
            width: 100%;
            height: 220px;
            object-fit: cover;
            border-top-left-radius: 12px;
            border-top-right-radius: 12px;
        }

        .course-item {
            background: var(--surface-color);
            border: 1px solid color-mix(in srgb, var(--default-color), transparent 80%);
            border-radius: 12px;
            transition: transform 0.3s ease, box-shadow 0.3s ease;
        }

        .course-item:hover {
            transform: translateY(-5px);
            box-shadow: 0 10px 20px rgba(0, 0, 0, 0.08);
        }

        .category {
            font-size: 0.9rem;
            color: color-mix(in srgb, var(--default-color), transparent 40%);
        }

        .price {
            font-weight: 600;
            color: #10b981; /* допустимо оставить, как акцент */
        }

        .course-content h5 a {
            color: var(--heading-color);
            transition: color 0.3s;
        }

        .course-content h5 a:hover {
            color: var(--accent-color);
            text-decoration: underline;
        }

        .section-title h2 {
            font-size: 2rem;
            font-weight: 700;
            color: var(--heading-color);
        }

        .section-title p {
            font-size: 1rem;
            color: color-mix(in srgb, var(--default-color), transparent 40%);
        }

        .filter-section {
            margin-bottom: 30px;
        }

        .filter-section select,
        .filter-section input {
            margin-right: 10px;
        }
        .description {
            color: color-mix(in srgb, var(--default-color), transparent 40%);
        }

    </style>

    <section id="courses" class="courses section py-5">

        <!-- Заголовок секции -->
        <div class="container section-title text-center mb-5" data-aos="fade-up">
            <h2>{{ __('main.our_courses') }}</h2>
            <p>{{ __('main.popular_courses') }}</p>
        </div>

        <div class="container">

            <!-- 🔍 Поиск и фильтрация -->
            <div class="filter-section mb-4" data-aos="fade-up">
                <form method="GET" action="{{ route('home') }}#courses" class="d-flex flex-wrap align-items-end">
                    <div class="me-2 mb-2">
                        <label for="search" class="form-label">{{ __('main.search') }}</label>
                        <input type="text" name="search" id="search" class="form-control  theme-input"
                               value="{{ request('search') }}" placeholder="{{ __('main.search_placeholder') }}">
                    </div>

                    <div class="me-2 mb-2">
                        <label for="min_price" class="form-label">{{ __('main.min_price') }}</label>
                        <input type="number" name="min_price" id="min_price" class="form-control theme-input"
                               value="{{ request('min_price') }}" placeholder="0">
                    </div>

                    <div class="me-2 mb-2">
                        <label for="max_price" class="form-label">{{ __('main.max_price') }}</label>
                        <input type="number" name="max_price" id="max_price" class="form-control theme-input"
                               value="{{ request('max_price') }}" placeholder="999999">
                    </div>

                    <div class="me-2 mb-2">
                        <label for="sort_by" class="form-label">{{ __('main.sort_by') }}</label>
                        <select name="sort_by" id="sort_by" class="form-select">
                            <option value="">{{ __('main.choose_sort') }}</option>
                            <option value="newest" {{ request('sort_by') == 'newest' ? 'selected' : '' }}>
                                {{ __('main.newest') }}
                            </option>
                            <option value="oldest" {{ request('sort_by') == 'oldest' ? 'selected' : '' }}>
                                {{ __('main.oldest') }}
                            </option>
                        </select>
                    </div>

                    <div class="mb-2 me-2">
                        <button type="submit" class="btn-apply">
                            {{ __('main.apply_filters') }}
                        </button>
                    </div>

                    @if(request()->hasAny(['search', 'min_price', 'max_price', 'sort_by']))
                        <a href="{{ route('home') }}" class="btn-reset">
                            {{ __('main.reset_filters') }}
                        </a>
                    @endif
                </form>
            </div>

            <!-- Курсы -->
            <div class="row">
                @if($courses->count())
                    @foreach($courses as $course)
                        <div class="col-lg-4 col-md-6 mb-4 d-flex align-items-stretch">
                            <div class="course-item w-100 d-flex flex-column">
                                <img src="{{ asset('storage/' . $course->image) }}"
                                     class="course-img"
                                     alt="{{ __('main.course_image') }}">

                                <div class="course-content p-4 flex-grow-1 d-flex flex-column justify-content-between">
                                    <div>
                                        <div class="d-flex justify-content-between align-items-center mb-2">
                                            <p class="category mb-0">{{ $course->category->name }}</p>
                                            <p class="price mb-0">{{ $course->price }} ₸</p>
                                        </div>
                                        <h5 class="mb-2">
                                            <a href="{{ route('student.courses.show', $course->id) }}">
                                                {{ $course->title }}
                                            </a>
                                        </h5>
                                        <p class="description description mb-3">{{ Str::limit($course->description, 100) }}</p>

                                        @if($course->reviews->count())
                                            <div class="text-warning small mb-2">
                                                @php $avg = round($course->reviews->avg('rating'), 1); @endphp
                                                @for ($i = 1; $i <= 5; $i++)
                                                    <span>{{ $i <= $avg ? '★' : '☆' }}</span>
                                                @endfor
                                                <span class="description ms-1">({{ $avg }}/5)</span>
                                            </div>
                                        @else
                                            <div class="description small mb-2">Пока нет отзывов</div>
                                        @endif


                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach
                @else
                    <div class="col-12">
                        <div class="alert alert-warning text-center" role="alert">
                            {{ __('main.no_courses_found') }}
                        </div>
                    </div>
                @endif
            </div>
        </div>
    </section>

    @auth
        <section class="container-fluid my-5">
            <div class="row justify-content-center">
                <div class="col-md-8 col-lg-6">
                    <div class="card rounded-4 border-0 theme-card">
                    <div class="card-body p-4">
                            <h2 class="h4 mb-4 text-center">{{ __('main.contact_us') }}</h2>

                            @if(session('success'))
                                <div class="alert alert-success">
                                    {{ session('success') }}
                                </div>
                            @endif

                            <form action="{{ route('contact.store') }}" method="POST" novalidate>
                                @csrf

                                <div class="mb-3">
                                    <input type="text" name="name" class="form-control rounded-3 theme-input"
                                           placeholder="{{ __('main.your_name') }}"
                                           value="{{ old('name', auth()->user()->name) }}" required>
                                </div>

                                <div class="mb-3">
                                    <input type="email" name="email" class="form-control rounded-3 theme-input"
                                           placeholder="{{ __('main.your_email') }}"
                                           value="{{ old('email', auth()->user()->email) }}" required readonly>
                                </div>

                                <div class="mb-3">
                                    <input type="text" name="subject" class="form-control rounded-3 theme-input"
                                           placeholder="{{ __('main.subject') }}"
                                           value="{{ old('subject') }}" required>
                                </div>

                                <div class="mb-3">
                            <textarea name="message" class="form-control rounded-3 theme-input" rows="4"
                                      placeholder="{{ __('main.your_message') }}" required>{{ old('message') }}</textarea>
                                </div>

                                <button type="submit" class="btn btn-primary w-100 py-2 rounded-3">
                                    {{ __('main.send_message') }}
                                </button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    @endauth


@endsection
