@section('card')
{{--    <div class="row">--}}
{{--        @foreach($courses as $course)--}}
{{--            <div class="col-md-4">--}}
{{--                <div class="card mb-4">--}}
{{--                    <img src="{{ asset('storage/' . $course->image) }}" class="card-img-top" alt="Курс">--}}
{{--                    <div class="card-body">--}}
{{--                        <h5 class="card-title">{{ $course->title }}</h5>--}}
{{--                        <p class="card-text">{{ $course->description }}</p>--}}
{{--                        <a href="{{ route('teacher.courses.show', $course->id) }}" class="btn btn-primary">Подробнее</a>--}}
{{--                    </div>--}}
{{--                </div>--}}
{{--            </div>--}}
{{--        @endforeach--}}
{{--    </div>--}}
<style>
    .course-img {
        width: 300px;
        height: 300px; /* можешь менять высоту по вкусу */
        object-fit: cover;
        margin-left: 50px;
        margin-top: 20px;
        border-top-left-radius: 5px;
        border-top-right-radius: 5px;
    }
</style>
    <!-- Courses Section -->
    <section id="courses" class="courses section">

        <!-- Section Title -->
        <div class="container section-title" data-aos="fade-up">
            <h2>Courses</h2>
            <p>Popular Courses</p>
        </div><!-- End Section Title -->
        <div class="container">
            <div class="row">
                @foreach($courses as $course)
                    <div class="col-lg-4 col-md-6 mb-4 d-flex align-items-stretch">
                        <div class="course-item shadow-sm rounded w-100 d-flex flex-column">
                            <img src="{{ asset('storage/' . $course->image) }}"
                                 class="img-fluid course-img"
                                 alt="Изображение курса">

                            <div class="course-content p-3 flex-grow-1 d-flex flex-column justify-content-between">
                                <div>
                                    <div class="d-flex justify-content-between align-items-center mb-3">
                                        <p class="category mb-0 text-muted">{{ $course->category->name }}</p>
                                        <p class="price mb-0 text-success fw-bold">{{ $course->price }} ₸</p>
                                    </div>
                                    <h5 class="mb-2"><a href="{{ route('teacher.courses.show', $course->id) }}" class="text-decoration-none">{{ $course->title }}</a></h5>
                                    <p class="description mb-3">{{ Str::limit($course->description, 100) }}</p>
                                </div>
                                <div class="trainer d-flex justify-content-between align-items-center mt-auto">
                                    <div class="trainer-profile d-flex align-items-center">
                                        <img src="{{ asset('layout/assets/img/trainers/trainer-1-2.jpg') }}" class="img-fluid rounded-circle" width="40" alt="">
                                        <a href="#" class="trainer-link ms-2">Antonio</a>
                                    </div>
                                    <div class="trainer-rank d-flex align-items-center">
                                        <i class="bi bi-person user-icon"></i>&nbsp;50
                                        &nbsp;&nbsp;
                                        <i class="bi bi-heart heart-icon"></i>&nbsp;65
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>

    </section><!-- /Courses Section -->
@endsection

