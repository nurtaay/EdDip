@extends('layouts.app')

@section('content')
    <div class="container py-5">

        <!-- Заголовок -->
        <div class="mb-5">
            <h2 class="fw-bold">{{ $assignment->title ?? __('assignment.title') }}</h2>
            <p class="text-muted fs-5">{{ $assignment->description }}</p>
        </div>

        <!-- Секция с отправками -->
        <div class="bg-white p-4 rounded shadow-sm">
            <div class="d-flex justify-content-between align-items-center mb-3">
                <h4 class="mb-0">📥 {{ __('assignment.submissions_title') }}</h4>
                <span class="text-muted small">{{ $submissions->count() }} {{ Str::plural(__('assignment.record'), $submissions->count()) }}</span>
            </div>

            @if($submissions->count())
                <div class="table-responsive">
                    <table class="table table-hover align-middle">
                        <thead class="table-light">
                        <tr>
                            <th>{{ __('assignment.student') }}</th>
                            <th>{{ __('assignment.files') }}</th>
                            <th>{{ __('assignment.status') }}</th>
                            <th>{{ __('assignment.grade') }}</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($submissions as $submission)
                            <tr>
                                <td>{{ $submission->student->name }}</td>

                                <td>
                                    @foreach(json_decode($submission->files, true) ?? [] as $file)
                                        <a href="{{ asset('storage/' . $file) }}" target="_blank" class="d-block text-decoration-none">
                                            📄 {{ basename($file) }}
                                        </a>
                                    @endforeach
                                </td>

                                <td>
                                    @if($submission->created_at > $assignment->deadline)
                                        <span class="badge bg-danger">{{ __('assignment.late') }}</span>
                                    @else
                                        <span class="badge bg-success">{{ __('assignment.on_time') }}</span>
                                    @endif
                                    <div class="text-muted small mt-1">{{ $submission->created_at->format('d.m.Y H:i') }}</div>
                                </td>

                                <td>
                                    <form action="{{ route('assignment.grade', $submission->id) }}" method="POST" class="d-flex flex-column gap-2">
                                        @csrf
                                        <input type="number" name="grade" value="{{ $submission->grade }}" class="form-control form-control-sm" min="0" max="100" placeholder="{{ __('assignment.points') }}">

                                        <textarea name="comment" class="form-control form-control-sm" rows="2" placeholder="{{ __('assignment.comment') }}">{{ $submission->comment }}</textarea>

                                        <button class="btn btn-sm btn-success">💾 {{ __('assignment.save') }}</button>
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
            @else
                <div class="alert alert-info mb-0 text-center">
                    {{ __('assignment.no_submissions') }}
                </div>
            @endif
        </div>
    </div>
@endsection
