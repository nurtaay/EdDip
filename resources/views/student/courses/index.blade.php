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
                <div class="col-lg-4 col-md-6 d-flex align-items-stretch" data-aos="zoom-in" data-aos-delay="100">
                    <div class="course-item">
                        <img src="{{ asset('storage/' . $course->image) }}" class="img-fluid" alt="...">
                        <div class="course-content">
                            <div class="d-flex justify-content-between align-items-center mb-3">
                                <p class="category">Web Development</p>
                                <p class="price">$169</p>
                            </div>

                            <h3><a href="course-details.html">{{ $course->title }}</a></h3>
                            <p class="description">{{ $course->description }}</p>
                            <div class="trainer d-flex justify-content-between align-items-center">
                                <div class="trainer-profile d-flex align-items-center">
                                    <img src="assets/img/trainers/trainer-1-2.jpg" class="img-fluid" alt="">
                                    <a href="" class="trainer-link">Antonio</a>
                                </div>
                                <div class="trainer-rank d-flex align-items-center">
                                    <i class="bi bi-person user-icon"></i>&nbsp;50
                                    &nbsp;&nbsp;
                                    <i class="bi bi-heart heart-icon"></i>&nbsp;65
                                </div>
                            </div>
                        </div>
                    </div>
                </div><!-- End Course Item-->
                @endforeach
            </div>
        </div>
    </section><!-- /Courses Section -->
@endsection

