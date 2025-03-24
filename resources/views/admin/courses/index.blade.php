@extends('layouts.admin')

@section('content')
    <div class="container">
        <h1 class="mb-4">Courses</h1>
        <div class="table-responsive">
            <table class="table table-striped align-middle">
                <thead>
                <tr>
                    <th scope="col">#</th>
                    <th scope="col">Title</th>
                    <th scope="col">Description</th>
                    <th scope="col">Teacher</th>
                    <th scope="col">Image</th>
                    <th scope="col">Status</th>
                    <th scope="col">Actions</th>
                </tr>
                </thead>
                <tbody>
                @foreach($courses as $course)
                    <tr>
                        <th scope="row">{{ $course->id }}</th>
                        <td>{{ $course->title }}</td>
                        <td>{{ \Illuminate\Support\Str::limit($course->description, 50) }}</td>
                        <td>{{ $course->user->name ?? 'N/A' }}</td>
                        <td>
                            @if($course->image)
                                <img src="{{ asset('storage/' . $course->image) }}" alt="{{ $course->title }}" class="img-thumbnail" style="max-width: 100px;">
                            @else
                                N/A
                            @endif
                        </td>
                        <td>{{ $course->status }}</td>
                        <td>
                            <a href="{{ route('admin.courses.show', $course->id) }}" class="btn btn-info btn-sm">View</a>
                            <a href="{{ route('admin.courses.edit', $course->id) }}" class="btn btn-warning btn-sm">Edit</a>
                            <form action="{{ route('admin.courses.destroy', $course->id) }}" method="POST" class="d-inline">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Are you sure you want to delete this course?')">Delete</button>
                            </form>
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>
    </div>
@endsection
