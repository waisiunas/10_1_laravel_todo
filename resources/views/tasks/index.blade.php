@extends('layout.main')

@section('content')
    <div class="container-fluid p-0">

        <h1>Tasks</h1>

        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-body">

                        @include('partials.flash-messages')

                        <h2 class="text-center">Add Task</h2>
                        <div class="text-danger" id="error-task">
                        </div>
                        <div class="text-success" id="success-task">
                        </div>
                        <form action="{{ route('task.create') }}" method="POST" class="row g-2">
                            @csrf
                            <div class="col-10">
                                <input type="text" class="form-control @error('task') is-invalid @enderror"
                                    name="task" placeholder="Input your Task">
                                @error('task')
                                    <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="col-2">
                                <input type="submit" class="btn btn-primary" name="submit" value="Add Task">
                            </div>
                        </form>
                        <hr>
                        <h3>Tasks</h3>
                        @if (count($tasks) > 0)
                            <div id="tasks-container">
                                @error('task_edit')
                                    <div class="alert alert-danger alert-dismissible fade show" role="alert">
                                        {{ $message }}
                                        <button type="button" class="btn-close" data-bs-dismiss="alert"
                                            aria-label="Close"></button>
                                    </div>
                                @enderror
                                @foreach ($tasks as $task)
                                    <form action="{{ route('task.edit', $task) }}" method="POST">
                                        @csrf
                                        <div class="row mb-2">
                                            <div class="col-md-9 col-10">
                                                <input type="text" class="form-control" name="task_edit"
                                                    value="{{ $task->task }}" placeholder="Please enter the task!">

                                            </div>
                                            <div class="col">
                                                <input type="submit" class="btn btn-info" name="submit" value="Edit">
                                            </div>
                                            <div class="col">
                                                <a href="{{ route('task.delete', $task) }}" class="btn btn-danger">Delete</a>
                                            </div>
                                        </div>
                                    </form>
                                @endforeach

                            </div>
                        @else
                            <div class="alert alert-danger">No task found!</div>
                        @endif

                    </div>
                </div>
            </div>
        </div>

    </div>
@endsection
