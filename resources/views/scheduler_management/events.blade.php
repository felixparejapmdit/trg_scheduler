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
                {{ __('Events Management') }}
            </h2>
            <div>
            <a href="{{ route('dashboard') }}" class="btn btn-secondary">Back</a>
                
        <button class="btn btn-primary" data-toggle="modal" data-target="#addEventModal"><i class="fas fa-plus"></i> Event</button>
            </div>
        </div>
    </x-slot>
    <div class="container">
        @if ($message = Session::get('success'))
            <div class="alert alert-success">
                <p>{{ $message }}</p>
            </div>
        @endif
        {{ $events->links() }}
        <table class="table table-bordered mt-3">
            <tr>
                <th class="text-center">#</th>
                <th>Event Type</th>
                <th>Event DateTime</th>
                <th>Title</th>
                <th>Description</th>
                <th>Incharge</th>
                <th style="display:none;">Prepared By</th>
                <th style="display:none;">Status</th>
                <th style="display:none;">Priority</th>
                <th style="display:none;">Recurring</th>
                <th class="text-center">Actions</th>
            </tr>
            @foreach ($events as $event)
                <tr class="priority-{{ $event->priority }}">
                    <td class="text-center" style="width: 5%;">{{ $loop->iteration }}</td>
                    <td>{{ $event->event_type }}</td>
                    <td>{{ date('Y-m-d g:i A', strtotime($event->event_datetime)) }}</td>
                    <td>{{ $event->title }}</td>
                    <td>{{ $event->description }}</td>
                    <td>{{ $event->incharge }}</td>
                    <td style="display:none;">{{ $event->prepared_by }}</td>
                    <td style="display:none;">{{ $event->status }}</td>
                    <td style="display:none;">{{ ucfirst($event->priority) }}</td>
                    <td style="display:none;">{{ ucfirst($event->recurring) }}</td>
                    <td class="text-center">
                        <button class="btn btn-secondary btn-sm" data-toggle="modal" data-target="#editEventModal{{ $event->id }}"><i class="fas fa-edit"></i></button>
                        <button class="btn btn-secondary btn-sm" data-toggle="modal" data-target="#deleteEventModal{{ $event->id }}"><i class="fas fa-trash-alt"></i></button>
                    </td>
                </tr>

                <!-- Edit Modal -->
                <div class="modal fade" id="editEventModal{{ $event->id }}" tabindex="-1" role="dialog" aria-labelledby="editEventModalLabel{{ $event->id }}" aria-hidden="true">
                    <div class="modal-dialog" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="editEventModalLabel{{ $event->id }}">Edit Event</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <form action="{{ route('events.update', $event->id) }}" method="POST">
                                @csrf
                                @method('PUT')
                                <div class="modal-body">
                                    <div class="form-group">
                                        <label for="event_type">Event Type</label>
                                        <select name="event_type" class="form-control">
                                            <option value="Meeting" {{ $event->event_type == 'Meeting' ? 'selected' : '' }}>Meeting</option>
                                            <option value="Birthday & Anniversary" {{ $event->event_type == 'Birthday & Anniversary' ? 'selected' : '' }}>Birthday & Anniversary</option>
                                            <option value="Non-Office" {{ $event->event_type == 'Non-Office' ? 'selected' : '' }}>Non-Office</option>
                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <label for="event_datetime">Event DateTime</label>
                                        <input type="datetime-local" name="event_datetime" class="form-control" value="{{ date('Y-m-d\TH:i', strtotime($event->event_datetime)) }}">
                                    </div>
                                    <div class="form-group">
                                        <label for="title">Title</label>
                                        <input type="text" name="title" class="form-control" value="{{ $event->title }}">
                                    </div>
                                    <div class="form-group">
                                        <label for="description">Description</label>
                                        <textarea name="description" class="form-control">{{ $event->description }}</textarea>
                                    </div>
                                    <div class="form-group">
                                        <label for="incharge">Incharge</label>
                                        <input type="text" name="incharge" class="form-control" value="{{ $event->incharge }}">
                                    </div>
                                    <div class="form-group" style="display:none;">
                                        <label for="prepared_by">Prepared By</label>
                                        <input type="number" name="prepared_by" class="form-control" value="{{ $event->prepared_by }}">
                                    </div>
                                    <div class="form-group" style="display:none;">
                                        <label for="status">Status</label>
                                        <select name="status" class="form-control">
                                            <option value="active" {{ $event->status == 'active' ? 'selected' : '' }}>Active</option>
                                            <option value="completed" {{ $event->status == 'completed' ? 'selected' : '' }}>Completed</option>
                                            <option value="cancelled" {{ $event->status == 'cancelled' ? 'selected' : '' }}>Cancelled</option>
                                        </select>
                                    </div>
                                    <div class="form-group" style="display:none;">
                                        <label for="priority">Priority</label>
                                        <select name="priority" class="form-control">
                                            <option value="low" {{ $event->priority == 'low' ? 'selected' : '' }}>Low</option>
                                            <option value="medium" {{ $event->priority == 'medium' ? 'selected' : '' }}>Medium</option>
                                            <option value="high" {{ $event->priority == 'high' ? 'selected' : '' }}>High</option>
                                        </select>
                                    </div>
                                    <div class="form-group" style="display:none;">
                                        <label for="recurring">Recurring</label>
                                        <select name="recurring" class="form-control">
                                            <option value="none" {{ $event->recurring == 'none' ? 'selected' : '' }}>None</option>
                                            <option value="daily" {{ $event->recurring == 'daily' ? 'selected' : '' }}>Daily</option>
                                            <option value="weekly" {{ $event->recurring == 'weekly' ? 'selected' : '' }}>Weekly</option>
                                            <option value="monthly" {{ $event->recurring == 'monthly' ? 'selected' : '' }}>Monthly</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                    <button type="submit" class="btn btn-primary">Update Event</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>

                <!-- Delete Modal -->
                <div class="modal fade" id="deleteEventModal{{ $event->id }}" tabindex="-1" role="dialog" aria-labelledby="deleteEventModalLabel{{ $event->id }}" aria-hidden="true">
                    <div class="modal-dialog" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="deleteEventModalLabel{{ $event->id }}">Delete Event</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <form action="{{ route('events.destroy', $event->id) }}" method="POST">
                                @csrf
                                @method('DELETE')
                                <div class="modal-body">
                                    Are you sure you want to delete this event?
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                    <button type="submit" class="btn btn-danger">Delete Event</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            @endforeach
        </table>
        {{ $events->links() }}
    </div>

    <!-- Add Event Modal -->
    <div class="modal fade" id="addEventModal" tabindex="-1" role="dialog" aria-labelledby="addEventModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="addEventModalLabel">Add Event</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form action="{{ route('events.store') }}" method="POST">
                    @csrf
                    <div class="modal-body">
                    <div class="form-group">
                        <label for="event_type">Event Type</label>
                        <select name="event_type" class="form-control" id="event_type">
                            <option value="Meeting">Meeting</option>
                            <option value="Birthday & Anniversary">Birthday & Anniversary</option>
                            <option value="Non-Office">Non-Office</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="event_datetime">Event DateTime</label>
                        <input type="datetime-local" name="event_datetime" class="form-control" id="event_datetime">
                    </div>

                    <script>
                        document.getElementById('event_type').addEventListener('change', function() {
                            if (this.value === 'Birthday & Anniversary') {
                                document.getElementById('event_datetime').type = 'date';
                            } else {
                                document.getElementById('event_datetime').type = 'datetime-local';
                            }
                        });
                    </script>
                        <div class="form-group">
                            <label for="title">Title</label>
                            <input type="text" name="title" class="form-control">
                        </div>
                        <div class="form-group">
                            <label for="description">Description</label>
                            <textarea name="description" class="form-control"></textarea>
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
                        <div class="form-group" style="display:none;">
                            <label for="recurring">Recurring</label>
                            <select name="recurring" class="form-control">
                                <option value="none">None</option>
                                <option value="daily">Daily</option>
                                <option value="weekly">Weekly</option>
                                <option value="monthly">Monthly</option>
                            </select>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">Add Event</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.2/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</x-app-layout>