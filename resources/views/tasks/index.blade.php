<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Task Manager</title>
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
</head>
<body>
    <div class="container">
        <h1>Task Manager</h1>
        <input type="text" id="task-title" placeholder="Enter task">
        <button id="add-task">Add Task</button>
        <ul id="task-list">
            @foreach($tasks as $task)
                <li data-id="{{ $task->id }}">
                    <input type="checkbox" class="mark-complete" {{ $task->completed ? 'checked' : '' }}>
                    <span>{{ $task->title }}</span>
                    <button class="delete-task">Delete</button>
                </li>
            @endforeach
        </ul>
        <button id="show-all-tasks">Show All Tasks</button>
    </div>

    <script>
        $(document).ready(function() {
            $('#add-task').click(function() {
                let title = $('#task-title').val();

                $.ajax({
                    url: '{{ route('tasks.store') }}',
                    type: 'POST',
                    data: {
                        _token: $('meta[name="csrf-token"]').attr('content'),
                        title: title
                    },
                    success: function(task) {
                        $('#task-list').append(`
                            <li data-id="${task.id}">
                                <input type="checkbox" class="mark-complete">
                                <span>${task.title}</span>
                                <button class="delete-task">Delete</button>
                            </li>
                        `);
                        $('#task-title').val('');
                    }
                });
            });

            $(document).on('click', '.delete-task', function() {
                if (!confirm('Are you sure to delete this task?')) return;

                let li = $(this).closest('li');
                let id = li.data('id');

                $.ajax({
                    url: `/tasks/${id}`,
                    type: 'DELETE',
                    data: {
                        _token: $('meta[name="csrf-token"]').attr('content')
                    },
                    success: function() {
                        li.remove();
                    }
                });
            });

            $(document).on('change', '.mark-complete', function() {
                let li = $(this).closest('li');
                let id = li.data('id');
                let completed = $(this).is(':checked');

                $.ajax({
                    url: `/tasks/${id}`,
                    type: 'PUT',
                    data: {
                        _token: $('meta[name="csrf-token"]').attr('content'),
                        completed: completed
                    },
                    success: function() {
                        li.toggleClass('completed', completed);
                    }
                });
            });

            $('#show-all-tasks').click(function() {
                $.ajax({
                    url: '{{ route('tasks.index') }}',
                    type: 'GET',
                    success: function(tasks) {
                        $('#task-list').empty();
                        tasks.forEach(task => {
                            $('#task-list').append(`
                                <li data-id="${task.id}">
                                    <input type="checkbox" class="mark-complete" ${task.completed ? 'checked' : ''}>
                                    <span>${task.title}</span>
                                    <button class="delete-task">Delete</button>
                                </li>
                            `);
                        });
                    }
                });
            });
        });
    </script>
</body>
</html>
