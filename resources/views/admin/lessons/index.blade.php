@extends('layouts.admin')

@section('content')
    <div class="container">
        <h1 class="mb-4">Lessons</h1>

        @if(session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif

        <div class="table-responsive">
            <table class="table table-striped align-middle">
                <thead>
                <tr>
                    <th>#</th>
                    <th>Title</th>
                    <th>Content</th>
                    <th>Course</th>
                    <th>Video</th>
                    <th>Actions</th>
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
                                <a href="{{ $lesson->video }}" target="_blank">Watch Video</a>
                            @else
                                N/A
                            @endif
                        </td>
                        <td>
                            <form action="{{ route('admin.lessons.destroy', $lesson->id) }}" method="POST" class="d-inline">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Are you sure you want to delete this lesson?')">Delete</button>
                            </form>
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>
    </div>
@endsection
