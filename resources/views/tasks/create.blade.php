@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="card">

            <div class="card-header">
                <h3>Task Create</h3>
            </div>
            <div class="card-body">
                <form action="{{ route('tasks.store') }}" method="POST">
                    @csrf

                    <div class="mb-3">
                      <label for="title" class="form-label">Title</label>
                      <input type="text" class="form-control" id="title" name="title" required>
                    </div>

                    <div class="mb-3">
                      <label for="description" class="form-label">Description</label>
                      <textarea class="form-control" id="description" name="description" rows="3" required></textarea>
                    </div>

                    <div class="mb-3">
                      <label for="deadline" class="form-label">Deadline</label>
                      <input type="date" class="form-control" id="deadline" name="deadline" required>
                    </div>

                    <button type="submit" class="btn btn-primary">Create Task</button>
                  </form>
            </div>

        </div>


    </div>
@endsection
