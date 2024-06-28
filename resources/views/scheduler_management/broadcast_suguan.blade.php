<link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;700&display=swap" rel="stylesheet">
<link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" />
   
<x-app-layout>
    <style>
        body {
            font-family: 'Roboto', sans-serif;
            background-color: #ffffff;
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
    </style>
    <x-slot name="header">
        <div class="flex justify-between items-center my-8">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                {{ __('Broadcast Suguan Management') }}
            </h2>
            <div>
                <a href="{{ route('dashboard') }}" class="btn btn-secondary">Back</a>
                <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#createBroadcastSuguanModal">
                    Add New Entry
                </button>
             
            </div>
        </div>
    </x-slot>
    <div class="container">

        @if(session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif

        <div class="row">
    <div class="col-8 text-left">
        <form action="{{ route('broadcast_suguan.export_xlsx') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <button type="submit" class="btn btn-success">Export to XLSX</button>
            <button type="button" class="btn btn-info" data-toggle="modal" data-target="#importBroadcastSuguanModal">
                <i class="fas fa-arrow-left"></i> Import from CSV
            </button>
        </form>
    </div>
    <div class="col-4 text-right">
        <button class="btn btn-primary" id="prev-week">
            <i class="fas fa-chevron-left"></i>
        </button>
        <span id="current-week">Week {{ $currentWeek }}</span>
        <button class="btn btn-primary" id="next-week">
            <i class="fas fa-chevron-right"></i>
        </button>
    </div>
</div>
<script>
    document.addEventListener('DOMContentLoaded', function() {
        const currentWeekSpan = document.getElementById('current-week');
        const prevWeekButton = document.getElementById('prev-week');
        const nextWeekButton = document.getElementById('next-week');

        // Helper function to get the week number from a Date object
        Date.prototype.getWeek = function(){
            var onejan = new Date(this.getFullYear(), 0, 1);
            return Math.ceil((((this - onejan) / 86400000) + onejan.getDay() + 1) / 7);
        }

        let currentWeek = new Date().getWeek();

        function updateWeek(newWeek) {
            currentWeek = newWeek;
            currentWeekSpan.textContent = `Week ${currentWeek}`;
            loadBroadcastSuguanForWeek(currentWeek);
        }

        prevWeekButton.addEventListener('click', () => {
            updateWeek(currentWeek - 1);
        });

        nextWeekButton.addEventListener('click', () => {
            updateWeek(currentWeek + 1);
        });

        updateWeek(currentWeek);

        function loadBroadcastSuguanForWeek(week) {
    axios.get(`/api/broadcast-suguan/${week}`)
   .then(response => {
        const tableBody = document.querySelector('table tbody');
        tableBody.innerHTML = '';
        
        if (response.data.length === 0) {
            const noRecordRow = document.createElement('tr');
            noRecordRow.innerHTML = `
                <td colspan="6" class="text-center color-red">No Record Found</td>`;
            tableBody.appendChild(noRecordRow);
        } else {
            response.data.forEach(entry => {
                const date = new Date(entry.date);
                const day = date.toLocaleDateString('en-US', { weekday: 'long' }); // Get the day of the week from the date
                const time = date.toLocaleTimeString('en-US', { hour: '2-digit', minute: '2-digit' }); // Get the time from the date in 12-hour format
                const row = document.createElement('tr');
                row.innerHTML = `
                    <td>${entry.date}</td>
                    <td>${day}</td>
                    <td>${time}</td>
                    <td>${entry.name}</td>
                    <td>${entry.tobebroadcast}</td>
                    <td>
                        <button class="btn btn-secondary" data-toggle="modal" data-target="#editBroadcastSuguanModal${entry.id}"><i class="fas fa-edit"></i></button>
                        <button class="btn btn-secondary" data-toggle="modal" data-target="#deleteBroadcastSuguanModal${entry.id}"><i class="fas fa-trash-alt"></i></button>
                    </td>
                `;
                tableBody.appendChild(row);
            });
        }
    })
   .catch(error => {
        console.error('Error fetching broadcast suguan data:', error);
    });
}
    });
</script>


        <table class="table mt-3">
            <thead>
                <tr>
                    <th>Date</th>
                    <th>Day</th>
                    <th>Time</th>
                    <th>Name</th>
                    <th>To be Broadcast</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach($broadcastSuguan as $entry)
                    <tr>
                        <td>{{ Carbon\Carbon::parse($entry->date)->format('F j, Y') }}</td>
                        <td>{{ Carbon\Carbon::parse($entry->date)->format('l') }}</td>
                        <td>{{ Carbon\Carbon::parse($entry->date)->format('h:i A') }}</td>
                        <td>{{ $entry->name }}</td>
                        <td>{{ $entry->tobebroadcast }}</td>
                        <td>
                            <button class="btn btn-secondary" data-toggle="modal" data-target="#editBroadcastSuguanModal{{ $entry->id }}"><i class="fas fa-edit"></i></button>
                            <button class="btn btn-secondary" data-toggle="modal" data-target="#deleteBroadcastSuguanModal{{ $entry->id }}"><i class="fas fa-trash-alt"></i></button>
                        </td>
                    </tr>

                    <!-- Edit Modal -->
                    <div class="modal fade" id="editBroadcastSuguanModal{{ $entry->id }}" tabindex="-1" role="dialog" aria-labelledby="editBroadcastSuguanModalLabel{{ $entry->id }}" aria-hidden="true">
                        <div class="modal-dialog" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="editBroadcastSuguanModalLabel{{ $entry->id }}">Edit Entry</h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <form action="{{ route('broadcast_suguan.update', $entry->id) }}" method="POST">
                                    @csrf
                                    @method('PUT')
                                    <div class="modal-body">
                                        <div class="form-group">
                                            <label for="date">Date</label>
                                            <input type="datetime-local" class="form-control" id="date" name="date" value="{{ $entry->date }}" required>
                                        </div>
                                        <div class="form-group">
                                            <label for="name">Name</label>
                                            <input type="text" class="form-control" id="name" name="name" value="{{ $entry->name }}" required>
                                        </div>
                                        <div class="form-group">
                                            <label for="tobebroadcast">To be Broadcast</label>
                                            <input type="text" class="form-control" id="tobebroadcast" name="tobebroadcast" value="{{ $entry->tobebroadcast }}" required>
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
                    <div class="modal fade" id="deleteBroadcastSuguanModal{{ $entry->id }}" tabindex="-1" role="dialog" aria-labelledby="deleteBroadcastSuguanModalLabel{{ $entry->id }}" aria-hidden="true">
                        <div class="modal-dialog" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="deleteBroadcastSuguanModalLabel{{ $entry->id }}">Delete Entry</h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <form action="{{ route('broadcast_suguan.destroy', $entry->id) }}" method="POST">
                                    @csrf
                                    @method('DELETE')
                                    <div class="modal-body">
                                        <p>Are you sure you want to delete this entry?</p>
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
            </tbody>
        </table>

        <!-- Create Modal -->
        <div class="modal fade" id="createBroadcastSuguanModal" tabindex="-1" role="dialog" aria-labelledby="createBroadcastSuguanModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="createBroadcastSuguanModalLabel">Add New Entry</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <form action="{{ route('broadcast_suguan.store') }}" method="POST">
                        @csrf
                        <div class="modal-body">
                            <div class="form-group">
                                <label for="date">Date</label>
                                <input type="datetime-local" class="form-control" id="date" name="date" required>
                            </div>
                            <div class="form-group">
                                <label for="name">Name</label>
                                <input type="text" class="form-control" id="name" name="name" required>
                            </div>
                            <div class="form-group">
                                <label for="tobebroadcast">To be Broadcast</label>
                                <input type="text" class="form-control" id="tobebroadcast" name="tobebroadcast" required>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                            <button type="submit" class="btn btn-primary">Save</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>

        <!-- Import Modal -->
        <div class="modal fade" id="importBroadcastSuguanModal" tabindex="-1" role="dialog" aria-labelledby="importBroadcastSuguanModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="importBroadcastSuguanModalLabel">Import Entries</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <form action="{{ route('broadcast_suguan.import') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="modal-body">
                            <div class="form-group">
                                <label for="file">Choose CSV File</label>
                                <input type="file" class="form-control-file" id="file" name="import_file">
                                
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                            <button type="submit" class="btn btn-primary">Import</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.2/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</x-app-layout>
