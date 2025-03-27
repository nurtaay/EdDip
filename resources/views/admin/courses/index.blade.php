@extends('layouts.admin')

@section('content')
    <div class="container py-4">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h2 class="fw-bold mb-0">📚 Список курсов</h2>
        </div>

        <div class="table-responsive shadow-sm rounded bg-white p-3">
            <table class="table table-hover align-middle mb-0">
                <thead class="table-light">
                <tr>
                    <th>#</th>
                    <th>Название</th>
                    <th>Описание</th>
                    <th>Преподаватель</th>
                    <th>Изображение</th>
                    <th>Статус</th>
                    <th class="text-center">Действия</th>
                </tr>
                </thead>
                <tbody>
                @forelse($courses as $course)
                    <tr>
                        <td>{{ $course->id }}</td>
                        <td class="fw-semibold">{{ $course->title }}</td>
                        <td>{{ Str::limit(strip_tags($course->description), 60) }}</td>
                        <td>{{ $course->user->name ?? '—' }}</td>
                        <td>
                            @if($course->image)
                                <img src="{{ asset('storage/' . $course->image) }}" class="img-fluid rounded" style="max-width: 80px;" alt="Course Image">
                            @else
                                <span class="text-muted">Нет</span>
                            @endif
                        </td>
                        <td>
                            @if($course->status === 'approved')
                                <span class="badge bg-success">Подтверждён</span>
                            @elseif($course->status === 'pending')
                                <span class="badge bg-warning text-dark">Ожидает</span>
                            @else
                                <span class="badge bg-secondary">{{ ucfirst($course->status) }}</span>
                            @endif
                        </td>
                        <td class="text-center">
                            <a href="{{ route('admin.courses.show', $course->id) }}" class="btn btn-sm btn-outline-primary me-1">
                                👁️
                            </a>
                            <form action="{{ route('admin.courses.destroy', $course->id) }}" method="POST" class="d-inline"
                                  onsubmit="return confirm('Удалить курс навсегда?');">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-sm btn-outline-danger">
                                    🗑️
                                </button>
                            </form>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="7" class="text-center text-muted py-4">Курсы не найдены.</td>
                    </tr>
                @endforelse
                </tbody>
            </table>
        </div>
    </div>
@endsection
