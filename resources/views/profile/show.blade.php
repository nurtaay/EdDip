@extends('layouts.app')

@section('title', __('profile.my_profile'))

@section('content')
    <div class="container mt-5">

        <!-- 🔝 Шапка профиля -->
        <div class="rounded bg-light position-relative mb-5" style="overflow: hidden;">
            <div class="bg-success" style="height: 150px;"></div>
            <div class="d-flex align-items-end p-4 pt-0">
                <img src="{{ $user->image ? asset('storage/' . $user->image) : asset('default-avatar.png') }}"
                     class="rounded-circle border border-white"
                     width="120" height="120"
                     style="margin-top: -60px; object-fit: cover;">
                <div class="ms-4">
                    <h3 class="fw-bold mb-0">{{ $user->name }}</h3>
                    <p class="text-muted mb-0">{{ $user->email }}</p>
                </div>
            </div>
        </div>

        <div class="p-4 shadow-sm rounded bg-white mb-4">

            @if($user->isTeacher())
                {{-- Биография как отдельный блок --}}
                @if($user->bio)
                    <div class="bg-light rounded p-3 mb-4">
                        <h6 class="text-muted fw-semibold mb-2">{{__('profile.biography')}}</h6>
                        <p class="mb-0">{{ $user->bio }}</p>
                    </div>
                @endif

                {{-- Таблица-информация в две колонки --}}
                <div class="row">
                    <div class="col-md-6 mb-3">
                        <span class="text-muted">{{__('profile.specialization')}}:</span><br>
                        <span class="fw-semibold">{{ $user->specialization ?? '—' }}</span>
                    </div>
                    <div class="col-md-6 mb-3">
                        <span class="text-muted">{{__('profile.experience')}}:</span><br>
                        <span class="fw-semibold">{{ $user->experience_years ? $user->experience_years . ' лет' : '—' }}</span>
                    </div>
                    <div class="col-md-6 mb-3">
                        <span class="text-muted">{{__('profile.education')}}:</span><br>
                        <span class="fw-semibold">{{ $user->education ?? '—' }}</span>
                    </div>
                    <div class="col-md-6 mb-3">
                        <span class="text-muted">{{__('profile.languages')}}:</span><br>
                        <span class="fw-semibold">{{ $user->languages ?? '—' }}</span>
                    </div>
                    <div class="col-12 mb-3">
                        <span class="text-muted">{{__('profile.certificates')}}:</span><br>
                        <span class="fw-semibold">{{ $user->certificates ?? '—' }}</span>
                    </div>
                </div>

                {{-- Ссылки --}}
                <div class="row">
                    @if($user->linkedin_url)
                        <div class="col-md-6 mb-2">
                            <span class="text-muted">{{__('profile.linkedin')}}:</span><br>
                            <a href="{{ $user->linkedin_url }}" target="_blank" class="text-decoration-underline text-primary">{{ $user->linkedin_url }}</a>
                        </div>
                    @endif
                    @if($user->website_url)
                        <div class="col-md-6 mb-2">
                            <span class="text-muted">{{__('profile.website')}}:</span><br>
                            <a href="{{ $user->website_url }}" target="_blank" class="text-decoration-underline text-primary">{{ $user->website_url }}</a>
                        </div>
                    @endif
                    @if($user->video_intro_url)
                        <div class="col-md-6 mb-2">
                            <span class="text-muted">{{__('profile.video_intro')}}:</span><br>
                            <a href="{{ $user->video_intro_url }}" target="_blank" class="btn btn-sm btn-outline-secondary mt-1">Смотреть видео</a>
                        </div>
                    @endif
                </div>
            @endif
        </div>


        <!-- ✏️ Форма редактирования -->
                @if(auth()->id() === $user->id)
                    <div class="p-4 shadow-sm rounded bg-white">
                        <h4 class="fw-semibold mb-3">{{__('profile.edit_profile')}}</h4>
                        <form method="POST" action="{{ route('profile.update') }}" enctype="multipart/form-data">
                            @csrf
                            <div class="mb-3">
                                <label class="form-label">{{__('profile.name')}}</label>
                                <input type="text" name="name" value="{{ old('name', $user->name) }}" class="form-control">
                            </div>
                            <div class="mb-3">
                                <label class="form-label">{{__('profile.email')}}</label>
                                <input type="email" name="email" value="{{ old('email', $user->email) }}" class="form-control">
                            </div>

                            @if($user->isTeacher())
                                <div class="row">
                                    <div class="col-md-6 mb-3">
                                        <label class="form-label">{{__('profile.name')}}</label>
                                        <input type="text" name="name" value="{{ old('name', $user->name) }}" class="form-control">
                                    </div>
                                    <div class="col-md-6 mb-3">
                                        <label class="form-label">{{__('profile.email')}}</label>
                                        <input type="email" name="email" value="{{ old('email', $user->email) }}" class="form-control">
                                    </div>

                                    <div class="col-md-6 mb-3">
                                        <label class="form-label">{{__('profile.experience')}}</label>
                                        <input type="number" name="experience_years" class="form-control" value="{{ old('experience_years', $user->experience_years) }}">
                                    </div>
                                    <div class="col-md-6 mb-3">
                                        <label class="form-label">{{__('profile.languages')}}</label>
                                        <input type="text" name="languages" class="form-control" value="{{ old('languages', $user->languages) }}">
                                    </div>

                                    <div class="col-md-6 mb-3">
                                        <label class="form-label">{{__('profile.education')}}</label>
                                        <input type="text" name="education" class="form-control" value="{{ old('education', $user->education) }}">
                                    </div>
                                    <div class="col-md-6 mb-3">
                                        <label class="form-label">{{__('profile.specialization')}}</label>
                                        <input type="text" name="specialization" class="form-control" value="{{ old('specialization', $user->specialization) }}">
                                    </div>

                                    <div class="col-12 mb-3">
                                        <label class="form-label">{{__('profile.biography')}}</label>
                                        <textarea name="bio" class="form-control" rows="4">{{ old('bio', $user->bio) }}</textarea>
                                    </div>

                                    <div class="col-md-4 mb-3">
                                        <label class="form-label">{{__('profile.linkedin')}}</label>
                                        <input type="url" name="linkedin_url" class="form-control" value="{{ old('linkedin_url', $user->linkedin_url) }}">
                                    </div>
                                    <div class="col-md-4 mb-3">
                                        <label class="form-label">{{__('profile.website')}}</label>
                                        <input type="url" name="website_url" class="form-control" value="{{ old('website_url', $user->website_url) }}">
                                    </div>
                                    <div class="col-md-4 mb-3">
                                        <label class="form-label">{{__('profile.video_intro')}}</label>
                                        <input type="url" name="video_intro_url" class="form-control" value="{{ old('video_intro_url', $user->video_intro_url) }}">
                                    </div>

                                    <div class="col-12 mb-3">
                                        <label class="form-label">{{__('profile.certificates')}}</label>
                                        <textarea name="certificates" class="form-control" rows="3">{{ old('certificates', $user->certificates) }}</textarea>
                                    </div>
                                </div>
                            @endif

                            <div class="mb-3">
                                <label class="form-label">{{__('profile.avatar')}}</label>
                                <input type="file" name="image" class="form-control">
                            </div>

                            <button class="btn btn-success w-100">{{__('profile.edit_profile')}}</button>
                        </form>
                    </div>
                @endif
            </div>

            <!-- 📊 Навыки или другие блоки -->
            <div class="col-lg-4" style="margin-left: 100px; margin-top: 50px">

                <div class="p-4 shadow-sm rounded bg-white">
                    <h5 class="fw-semibold mb-3">{{__('profile.new_password')}}</h5>
                    <form method="POST" action="{{ route('profile.password') }}">
                        @csrf
                        <div class="mb-3">
                            <label class="form-label">{{__('profile.current_password')}}</label>
                            <input type="password" name="current_password" class="form-control">
                        </div>
                        <div class="mb-3">
                            <label class="form-label">{{__('profile.new_password')}}</label>
                            <input type="password" name="new_password" class="form-control">
                        </div>
                        <div class="mb-3">
                            <label class="form-label">{{__('profile.confirm_password')}}</label>
                            <input type="password" name="new_password_confirmation" class="form-control">
                        </div>
                        <button class="btn btn-warning w-100">{{__('profile.edit_profile')}}</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
