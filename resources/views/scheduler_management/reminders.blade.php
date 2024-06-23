
<link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;700&display=swap" rel="stylesheet">
<link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" />
   
<x-app-layout>
<style>
        body {
            font-family: 'Roboto', sans-serif;
            background-color: #f4f4f9;
            margin: 0;
        }
        .container {
            margin-top: 50px;
        }
        .modal-header, .modal-footer {
            background-color: #EEEEEE;
            color: gray;
        }
        .modal-footer button {
            color: white;
        }
        /* .priority-low {
            background-color: #d4edda;
        }
        .priority-medium {
            background-color: #fff3cd;
        }
        .priority-high {
            background-color: #f8d7da;
        } */
    </style>

    <x-slot name="header">
        <div class="flex justify-between items-center my-8">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                {{ __('Reminders Management') }}
            </h2>
            <div>
            <a href="{{ route('dashboard') }}" class="btn btn-secondary">Back</a>
                
        <button class="btn btn-primary" data-toggle="modal" data-target="#addReminderModal"><i class="fas fa-plus"></i> Reminder</button>
            </div>
        </div>
    </x-slot>

    <div class="container">

        @if ($message = Session::get('success'))
            <div class="alert alert-success">
                <p>{{ $message }}</p>
            </div>
        @endif
        {{ $reminders->links() }}
        <table class="table table-bordered mt-3">
            <tr>
                <th class="text-center">#</th>
                <th style="width:20%;">DateTime</th>
                <th style="width:35%;">Reminder</th>
                <th style="display:none;">Week Number</th>
                <th style="display:none;">Verse of the Week</th>
                <th style="width:20%;">Incharge</th>
                <th style="display:none;">Prepared By</th>
                <th style="display:none;">Status</th>
                <th style="display:none;">Priority</th>
                <th style="width:10%;" class="text-center">Actions</th>
            </tr>
            @foreach ($reminders as $reminder)
                <tr class="priority-{{ $reminder->priority }}">
                    <td class="text-center" style="width: 5%;">{{ $loop->iteration }}</td>
                    <td>{{ $reminder->reminder_datetime->format('Y-m-d g:i A') }}</td>
                    <td>{{ $reminder->reminder }}</td>
                    <td style="display:none;">{{ $reminder->week_number }}</td>
                    <td style="display:none;">{{ $reminder->verse_of_the_week }}</td>
                    <td>{{ $reminder->incharge }}</td>
                    <td style="display:none;">{{ $reminder->prepared_by }}</td>
                    <td style="display:none;">{{ $reminder->status }}</td>
                    <td style="display:none;">{{ ucfirst($reminder->priority) }}</td>
                    <td style="width:10%;" class="text-center">
                        <button class="btn btn-secondary btn-sm" data-toggle="modal" data-target="#editReminderModal{{ $reminder->id }}"><i class="fas fa-edit"></i></button>
                        <button class="btn btn-secondary btn-sm" data-toggle="modal" data-target="#deleteReminderModal{{ $reminder->id }}"><i class="fas fa-trash-alt"></i></button>
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
                                    <div class="form-group" style="display:none;">
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
                                    <div class="form-group" style="display:none;">
                                        <label for="prepared_by">Prepared By</label>
                                        <input type="number" name="prepared_by" class="form-control" value="{{ $reminder->prepared_by }}">
                                    </div>
                                    <div class="form-group" style="display:none;">
                                        <label for="status">Status</label>
                                        <select name="status" class="form-control">
                                            <option value="active" {{ $reminder->status == 'active' ? 'selected' : '' }}>Active</option>
                                            <option value="completed" {{ $reminder->status == 'completed' ? 'selected' : '' }}>Completed</option>
                                            <option value="cancelled" {{ $reminder->status == 'cancelled' ? 'selected' : '' }}>Cancelled</option>
                                        </select>
                                    </div>
                                    <div class="form-group" style="display:none;">
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
        {{ $reminders->links() }}
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
                        <div class="form-group" style="display:none;">
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
                        <div class="form-group" style="display:none;">
                            <label for="prepared_by">Prepared By</label>
                            <input type="number" name="prepared_by" class="form-control">
                        </div>
                        <div class="form-group" style="display:none;">
                            <label for="status">Status</label>
                            <select name="status" class="form-control">
                                <option value="active">Active</option>
                                <option value="completed">Completed</option>
                                <option value="cancelled">Cancelled</option>
                            </select>
                        </div>
                        <div class="form-group" style="display:none;">
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
    </x-app-layout>