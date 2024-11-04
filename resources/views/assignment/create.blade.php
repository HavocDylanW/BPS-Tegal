@extends('layouts.app')

@section('content')
    <div class="container">
        <h1>Create New Assignment</h1>

        <form action="{{ route('assignments.store') }}" method="POST">
            @csrf

            <div class="form-group">
                <label for="title">Assignment Title</label>
                <input type="text" class="form-control" name="title" required>
            </div>

            <div class="form-group">
                <label for="description">Description</label>
                <textarea class="form-control" name="description" required></textarea>
            </div>

            <div class="form-group">
                <label for="tgl_mulai">Start Date</label>
                <input type="date" class="form-control" name="tgl_mulai" required>
            </div>

            <div class="form-group">
                <label for="tgl_selesai">End Date</label>
                <input type="date" class="form-control" name="tgl_selesai" required>
            </div>

            <div class="form-group">
                <label for="link_doc">Document Link</label>
                <input type="url" class="form-control" name="link_doc" required>
            </div>

            <div class="form-group">
                <label for="team_id">Assign to Team</label>
                <select class="form-control" name="team_id" required>
                    @foreach ($teams as $team)
                        <option value="{{ $team->id }}">{{ $team->name }}</option>
                    @endforeach
                </select>
            </div>

            <button type="submit" class="btn btn-primary mt-3">Create Assignment</button>
        </form>
    </div>
@endsection
