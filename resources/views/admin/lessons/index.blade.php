@extends('layouts.admin')

@section('content')
    <div class="container">
        <h1 class="mb-4">{{ __('admin.lessons') }}</h1>

        {{-- Блок уведомлений --}}
        @if(session('success'))
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                {{ session('success') }}
            </div>
        @endif

        @if(session('error'))
            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                {{ session('error') }}
            </div>
        @endif


        <div class="table-responsive">
            <table class="table table-striped align-middle">
                <thead>
                <tr>
                    <th>#</th>
                    <th>{{ __('admin.title') }}</th>
                    <th>{{ __('admin.content') }}</th>
                    <th>{{ __('admin.course') }}</th>
                    <th>{{ __('admin.video') }}</th>
                    <th>{{ __('admin.actions') }}</th>
                </tr>
                </thead>
                <tbody>
                @foreach($lessons as $lesson)
                    <tr>
                        <td>{{ $lesson->id }}</td>
                        <td>{{ $lesson->title }}</td>
                        <td>{{ \Illuminate\Support\Str::limit($lesson->content, 50) }}</td>
                        <td>{{ $lesson->course->title ?? 'N/A' }}</td>
                        <td>
                            @if($lesson->video)
                                <a href="{{ asset('storage/' . $lesson->video) }}" target="_blank">{{ __('admin.watch_video') }}</a>
                            @else
                                N/A
                            @endif
                        </td>
                        <td>
                            <form action="{{ route('admin.lessons.destroy', $lesson->id) }}" method="POST" class="d-inline">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Are you sure you want to delete this lesson?')">{{ __('admin.delete') }}</button>
                            </form>
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>
    </div>
@endsection
