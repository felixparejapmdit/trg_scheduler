<!DOCTYPE html>
<html>
<head>
    <title>Reminders Management</title>
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;700&display=swap" rel="stylesheet">
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            font-family: 'Roboto', sans-serif;
            background-color: #f4f4f9;
            margin: 0;
            padding: 20px;
        }
        .container {
            margin-top: 50px;
        }
        .modal-header, .modal-footer {
            background-color: #007BFF;
            color: white;
        }
        .modal-footer button {
            color: white;
        }
        .priority-low {
            background-color: #d4edda;
        }
        .priority-medium {
            background-color: #fff3cd;
        }
        .priority-high {
            background-color: #f8d7da;
        }
    </style>
</head>
<body>
    <div class="container">
        <h2>Reminders Management</h2>
        <button class="btn btn-primary mb-3" data-toggle="modal" data-target="#addReminderModal">Add Reminder</button>

        @if ($message = Session::get('success'))
            <div class="alert alert-success">
                <p>{{ $message }}</p>
            </div>
        @endif

        <table class="table table-bordered">
            <tr>
                <th>ID</th>
                <th>Reminder DateTime</th>
                <th>Reminder</th>
                <th>Week Number</th>
                <th>Verse of the Week</th>
                <th>Incharge</th>
                <th>Prepared By</th>
                <th>Status</th>
                <th>Priority</th>
                <th>Actions</th>
            </tr>
            @foreach ($reminders as $reminder)
                <tr class="priority-{{ $reminder->priority }}">
                    <td>{{ $reminder->id }}</td>
                    <td>{{ $reminder->reminder_datetime }}</td>
                    <td>{{ $reminder->reminder }}</td>
                    <td>{{ $reminder->week_number }}</td>
                    <td>{{ $reminder->verse_of_the_week }}</td>
                    <td>{{ $reminder->incharge }}</td>
                    <td>{{ $reminder->prepared_by }}</td>
                    <td>{{ $reminder->status }}</td>
                    <td>{{ ucfirst($reminder->priority) }}</td>
                    <td>
                        <button class="btn btn-info btn-sm" data-toggle="modal" data-target="#editReminderModal{{ $reminder->id }}">Edit</button>
                        <button class="btn btn-danger btn-sm" data-toggle="modal" data-target="#deleteReminderModal{{ $reminder->id }}">Delete</button>
                    </td>
                </tr>

                <!-- Edit Modal -->
                <div class="modal fade" id="editReminderModal{{ $reminder->id }}" tabindex="-1" role="dialog" aria-labelledby="editReminderModalLabel{{ $reminder->id }}" aria-hidden="true">
                    <div class="modal-dialog" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="editReminderModalLabel{{ $reminder->id }}">Edit Reminder</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <form action="{{ route('reminders.update', $reminder->id) }}" method="POST">
                                @csrf
                                @method('PUT')
                                <div class="modal-body">
                                    <div class="form-group">
                                        <label for="reminder_datetime">Reminder DateTime</label>
                                        <input type="datetime-local" name="reminder_datetime" class="form-control" value="{{ $reminder->reminder_datetime->format('Y-m-d\TH:i') }}">
                                    </div>
                                    <div class="form-group">
                                        <label for="reminder">Reminder</label>
                                        <textarea name="reminder" class="form-control">{{ $reminder->reminder }}</textarea>
                                    </div>
                                    <div class="form-group">
                                        <label for="week_number">Week Number</label>
                                        <input type="number" name="week_number" class="form-control" value="{{ $reminder->week_number }}">
                                    </div>
                                    <div class="form-group">
                                        <label for="verse_of_the_week">Verse of the Week</label>
                                        <textarea name="verse_of_the_week" class="form-control">{{ $reminder->verse_of_the_week }}</textarea>
                                    </div>
                                    <div class="form-group">
                                        <label for="incharge">Incharge</label>
                                        <input type="text" name="incharge" class="form-control" value="{{ $reminder->incharge }}">
                                    </div>
                                    <div class="form-group">
                                        <label for="prepared_by">Prepared By</label>
                                        <input type="number" name="prepared_by" class="form-control" value="{{ $reminder->prepared_by }}">
                                    </div>
                                    <div class="form-group">
                                        <label for="status">Status</label>
                                        <select name="status" class="form-control">
                                            <option value="active" {{ $reminder->status == 'active' ? 'selected' : '' }}>Active</option>
                                            <option value="completed" {{ $reminder->status == 'completed' ? 'selected' : '' }}>Completed</option>
                                            <option value="cancelled" {{ $reminder->status == 'cancelled' ? 'selected' : '' }}>Cancelled</option>
                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <label for="priority">Priority</label>
                                        <select name="priority" class="form-control">
                                            <option value="low" {{ $reminder->priority == 'low' ? 'selected' : '' }}>Low</option>
                                            <option value="medium" {{ $reminder->priority == 'medium' ? 'selected' : '' }}>Medium</option>
                                            <option value="high" {{ $reminder->priority == 'high' ? 'selected' : '' }}>High</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                    <button type="submit" class="btn btn-primary">Save changes</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>

                <!-- Delete Modal -->
                <div class="modal fade" id="deleteReminderModal{{ $reminder->id }}" tabindex="-1" role="dialog" aria-labelledby="deleteReminderModalLabel{{ $reminder->id }}" aria-hidden="true">
                    <div class="modal-dialog" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="deleteReminderModalLabel{{ $reminder->id }}">Delete Reminder</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <form action="{{ route('reminders.destroy', $reminder->id) }}" method="POST">
                                @csrf
                                @method('DELETE')
                                <div class="modal-body">
                                    <p>Are you sure you want to delete this reminder?</p>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                    <button type="submit" class="btn btn-danger">Delete</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            @endforeach
        </table>
    </div>

    <!-- Add Modal -->
    <div class="modal fade" id="addReminderModal" tabindex="-1" role="dialog" aria-labelledby="addReminderModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="addReminderModalLabel">Add Reminder</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form action="{{ route('reminders.store') }}" method="POST">
                    @csrf
                    <div class="modal-body">
                        <div class="form-group">
                            <label for="reminder_datetime">Reminder DateTime</label>
                            <input type="datetime-local" name="reminder_datetime" class="form-control">
                        </div>
                        <div class="form-group">
                            <label for="reminder">Reminder</label>
                            <textarea name="reminder" class="form-control"></textarea>
                        </div>
                        <div class="form-group">
                            <label for="week_number">Week Number</label>
                            <input type="number" name="week_number" class="form-control">
                        </div>
                        <div class="form-group">
                            <label for="verse_of_the_week">Verse of the Week</label>
                            <textarea name="verse_of_the_week" class="form-control"></textarea>
                        </div>
                        <div class="form-group">
                            <label for="incharge">Incharge</label>
                            <input type="text" name="incharge" class="form-control">
                        </div>
                        <div class="form-group">
                            <label for="prepared_by">Prepared By</label>
                            <input type="number" name="prepared_by" class="form-control">
                        </div>
                        <div class="form-group">
                            <label for="status">Status</label>
                            <select name="status" class="form-control">
                                <option value="active">Active</option>
                                <option value="completed">Completed</option>
                                <option value="cancelled">Cancelled</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="priority">Priority</label>
                            <select name="priority" class="form-control">
                                <option value="low">Low</option>
                                <option value="medium" selected>Medium</option>
                                <option value="high">High</option>
                            </select>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">Add Reminder</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.2/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>
