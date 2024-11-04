@extends('layouts.app')

@section('content')
    <div class="container">
        <h1>Edit Submission</h1>

        @if (session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif

        @if (session('error'))
            <div class="alert alert-danger">
                {{ session('error') }}
            </div>
        @endif

        <form action="{{ route('submissions.update', $submission->id) }}" method="POST">
            @csrf
            @method('put')

            <div class="mb-3">
                <label for="link_tugas" class="form-label">Link to Task</label>
                <input type="url" class="form-control" id="link_tugas" name="link_tugas"
                    value="{{ old('link_tugas', $submission->link_tugas) }}" required>
                @error('link_tugas')
                    <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>

            <div class="mb-3">
                <label for="komentar" class="form-label">Comments</label>
                <textarea class="form-control" id="komentar" name="komentar" rows="3">{{ old('komentar', $submission->komentar) }}</textarea>
                @error('komentar')
                    <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>

            <button type="submit" class="btn btn-primary">Update Submission</button>
            <a href="{{ route('assignments.index') }}" class="btn btn-secondary">Cancel</a>
        </form>
    </div>
@endsection
