@section('card')
    <style>
        .course-img {
            width: 100%;
            height: 220px;
            object-fit: cover;
            border-top-left-radius: 12px;
            border-top-right-radius: 12px;
        }

        .course-item {
            background: #ffffff;
            border: 1px solid #e0e0e0;
            border-radius: 12px;
            transition: transform 0.3s ease, box-shadow 0.3s ease;
        }

        .course-item:hover {
            transform: translateY(-5px);
            box-shadow: 0 10px 20px rgba(0, 0, 0, 0.08);
        }

        .category {
            font-size: 0.9rem;
            color: #6c757d;
        }

        .price {
            font-weight: 600;
            color: #10b981;
        }

        .course-content h5 a {
            color: #1f2937;
            transition: color 0.3s;
        }

        .course-content h5 a:hover {
            color: #2563eb;
            text-decoration: underline;
        }

        .section-title h2 {
            font-size: 2rem;
            font-weight: 700;
            color: #1f2937;
        }

        .section-title p {
            font-size: 1rem;
            color: #6b7280;
        }
    </style>

    <section id="courses" class="courses section py-5 bg-gray-50">
        <!-- Заголовок секции -->
        <div class="container section-title text-center mb-5" data-aos="fade-up">
            <h2>{{ __('main.our_courses') }}</h2>
            <p>{{ __('main.popular_courses') }}</p>
        </div>

        <div class="container">
            <div class="row">
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
                                    <p class="description text-muted mb-3">{{ Str::limit($course->description, 100) }}</p>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </section>
@endsection
