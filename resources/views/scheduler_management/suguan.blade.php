<link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;700&display=swap" rel="stylesheet">
<link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" />
   
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
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
                {{ __('Suguan Management') }}
            </h2>
            <div>
            <a href="{{ route('dashboard') }}" class="btn btn-secondary">Back</a>
                
        <button class="btn btn-primary" data-toggle="modal" data-target="#addSuguanModal"><i class="fas fa-plus"></i> Suguan</button>
        <button class="btn btn-primary hidden" data-toggle="modal" data-target="#importModal"><i class="fas fa-file-import"></i> Import</button>
            </div>
        </div>
    </x-slot>
    <div class="container">

        @if ($message = Session::get('success'))
            <div class="alert alert-success">
                <p>{{ $message }}</p>
            </div>
        @endif
<!-- <div class="row">
    <div class="col-4 text-left">
        <button class="btn btn-primary" id="prev-week">
            <i class="fas fa-chevron-left"></i>
        </button>
        <span id="current-week">Week </span>
        <button class="btn btn-primary" id="next-week">
            <i class="fas fa-chevron-right"></i>
        </button>
    </div>
</div> -->


<!-- Import Modal -->
<div class="modal fade" id="importModal" tabindex="-1" role="dialog" aria-labelledby="importModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="importModalLabel">Import Locale Congregations</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="{{ route('locale-congregations.import') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="modal-body">
                    <div class="form-group">
                        <label for="file">Upload Excel File</label>
                        <input type="file" name="file" class="form-control" required>
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
<script>
    document.addEventListener('DOMContentLoaded', function() {
        const currentWeekSpan = document.getElementById('current-week');
        const prevWeekButton = document.getElementById('prev-week');
        const nextWeekButton = document.getElementById('next-week');

        // Helper function to get the week number from a Date object
        Date.prototype.getWeek = function() {
            var onejan = new Date(this.getFullYear(), 0, 1);
            return Math.ceil((((this - onejan) / 86400000) + onejan.getDay() + 1) / 7);
        };

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
                            <td colspan="6" class="text-center text-danger">No Record Found</td>`;
                        tableBody.appendChild(noRecordRow);
                    } else {
                        response.data.forEach(entry => {
                            const date = new Date(entry.date);
                            const day = date.toLocaleDateString('en-US', { weekday: 'long' }); //Get the day of the week from the date
                            const time = date.toLocaleTimeString('en-US', { hour: '2-digit', minute: '2-digit' }); //Get the time from the date in 12-hour format
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
{{ $suguan->links() }}
<table class="table table-bordered mt-3">
    <tr>
        <th class="text-center">#</th>
        <th>Name</th>
        <th>Lokal</th>
        <th>District</th>
        <th>Suguan DateTime</th>
        <th>Day</th>
        <th>Gampanin</th>
        <th style="display:none;">Prepared By</th>
        <th style="display:none;">Comments</th>
        <th class="text-center">Actions</th>
    </tr>
    @forelse ($suguan as $item)
    @if($item)
        <tr>
            <td class="text-center" style="width: 5%;">{{ $loop->iteration }}</td>
            <td>{{ $item->name }}</td>
            <td>{{ $item->lokal->name }}</td>
            <td>{{ $item->district->name }}</td>
            <td>{{ date('Y-m-d g:i A', strtotime($item->suguan_datetime)) }}</td>
            <td>{{ date('l', strtotime($item->suguan_datetime)) }}</td>
            <td>{{ $item->gampanin }}</td>
            <td style="display:none;">{{ $item->prepared_by }}</td>
            <td style="display:none;">{{ $item->comments }}</td>
            <td class="text-center">
                <button class="btn btn-secondary btn-sm" data-toggle="modal" data-target="#editSuguanModal{{ $item->id }}" data-district-id="{{ $item->district }}" data-lokal-id="{{ $item->lokal }}"><i class="fas fa-edit"></i></button>
                <button class="btn btn-secondary btn-sm" data-toggle="modal" data-target="#deleteSuguanModal{{ $item->id }}"><i class="fas fa-trash-alt"></i></button>
            </td>
        </tr>

        <!-- Edit Modal -->
        <div class="modal fade" id="editSuguanModal{{ $item->id }}" tabindex="-1" role="dialog" aria-labelledby="editSuguanModalLabel{{ $item->id }}" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="editSuguanModalLabel{{ $item->id }}">Edit Suguan</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <form action="{{ route('suguan.update', $item->id) }}" method="POST">
                        @csrf
                        @method('PUT')
                        <div class="modal-body">
                            <div class="form-group">
                                <label for="name">Name</label>
                                <input disabled type="text" name="name" class="form-control" value="{{ $item->name }}" required>
                            </div>


                            
                            <div class="form-group">
    <label for="edit_district{{ $item->id }}">District</label>
    <select name="district_id" id="edit_district{{ $item->id }}" class="form-control edit-district">
        <option value="">Select District</option>
        @foreach($districts as $district)
            <option value="{{ $district->id }}" {{ $item->district_id == $district->id ? 'selected' : '' }}>{{ $district->name }}</option>
        @endforeach
    </select>
</div>

<div class="form-group">
    <label for="edit_lokal{{ $item->id }}">Lokal</label>
    <select name="lokal_id" class="form-control edit-lokal" id="edit_lokal{{ $item->id }}" required>
        <option value="">Select Lokal</option>
        @foreach($lokals as $lokal)
            <option value="{{ $lokal->id }}" {{ $item->lokal_id == $lokal->id ? 'selected' : '' }}>{{ $lokal->name }}</option>
        @endforeach
    </select>
</div>


                            <div class="form-group">
                                <label for="suguan_datetime">Suguan DateTime</label>
                                <input type="datetime-local" name="suguan_datetime" class="form-control" value="{{ date('Y-m-d\TH:i', strtotime($item->suguan_datetime)) }}" required>
                            </div>
                            <div class="form-group">
                                <label for="gampanin">Gampanin</label>
                                <select name="gampanin" class="form-control" required>
                                    <option value="">Select Gampanin</option>
                                    <option value="Kasama sa Tribuna" {{ $item->gampanin == 'Kasama sa Tribuna' ? 'selected' : '' }}>Kasama sa Tribuna</option>
                                    <option value="Reserba SL" {{ $item->gampanin == 'Reserba SL' ? 'selected' : '' }}>Reserba SL</option>
                                    <option value="Sugo SL" {{ $item->gampanin == 'Sugo SL' ? 'selected' : '' }}>Sugo SL</option>
                                    <option value="Reserba 2" {{ $item->gampanin == 'Reserba 2' ? 'selected' : '' }}>Reserba 2</option>
                                    <option value="Reserba 1" {{ $item->gampanin == 'Reserba 1' ? 'selected' : '' }}>Reserba 1</option>
                                    <option value="Sugo 2" {{ $item->gampanin == 'Sugo 2' ? 'selected' : '' }}>Sugo 2</option>
                                    <option value="Sugo 1" {{ $item->gampanin == 'Sugo 1' ? 'selected' : '' }}>Sugo 1</option>
                                    <option value="Sugo" {{ $item->gampanin == 'Sugo' ? 'selected' : '' }}>Sugo</option>
                                    <option value="Reserba" {{ $item->gampanin == 'Reserba' ? 'selected' : '' }}>Reserba</option>
                                </select>
                            </div>
                            <div class="form-group" style="display:none;">
                                <label for="prepared_by">Prepared By</label>
                                <input type="number" name="prepared_by" class="form-control" value="{{ $item->prepared_by }}">
                            </div>
                            <div class="form-group" style="display:none;">
                                <label for="comments">Comments</label>
                                <textarea name="comments" class="form-control">{{ $item->comments }}</textarea>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                            <button type="submit" class="btn btn-primary">Update Suguan</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>

        <!-- Delete Modal -->
        <div class="modal fade" id="deleteSuguanModal{{ $item->id }}" tabindex="-1" role="dialog" aria-labelledby="deleteSuguanModalLabel{{ $item->id }}" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="deleteSuguanModalLabel{{ $item->id }}">Delete Suguan</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <form action="{{ route('suguan.destroy', $item->id) }}" method="POST">
                        @csrf
                        @method('DELETE')
                        <div class="modal-body">
                            Are you sure you want to delete this Suguan?
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                            <button type="submit" class="btn btn-danger">Delete Suguan</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    @endif
    @empty
        <tr>
            <td colspan="9">No records found.</td>
        </tr>
    @endforelse
</table>
{{ $suguan->links() }}

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
$(document).ready(function() {
    // When an edit button is clicked
    $(document).on('click', '[data-toggle="modal"][data-target^="#editSuguanModal"]', function(event) {
        var button = $(event.currentTarget);
        var districtId = button.data('district-id');
        var lokalId = button.data('lokal-id');
        var modalId = button.data('target');
        
        var $modal = $(modalId);
        var $districtSelect = $modal.find('.edit-district');
        var $lokalSelect = $modal.find('.edit-lokal');
        console.log(districtSelect);
        $districtSelect.val(districtId).trigger('change');

        // Wait for the ajax call to complete before setting the lokal value
        $districtSelect.on('change', function() {
            setTimeout(function() {
                $lokalSelect.val(lokalId);
            }, 500);
        });
    });

    // When the district dropdown changes
    $('.edit-district').on('change', function() {
        var districtId = $(this).val();
        var $lokalSelect = $(this).closest('.modal').find('.edit-lokal');

        $.ajax({
            type: 'GET',
                url: 'suguan/getLokals/' + districtId,
            success: function(data) {
                $lokalSelect.empty();
                $lokalSelect.append('<option value="">Select Lokal</option>');
                $.each(data, function(index, lokal) {
                    $lokalSelect.append('<option value="' + lokal.id + '">' + lokal.name + '</option>');
                });
            }
        });
    });
});
</script>

</div>


    <!-- Add Suguan Modal -->
    <div class="modal fade" id="addSuguanModal" tabindex="-1" role="dialog" aria-labelledby="addSuguanModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="addSuguanModalLabel">Add Suguan</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form action="{{ route('suguan.store') }}" method="POST">
                    @csrf
                    <div class="modal-body">
                        <!-- <div class="form-group">
                            <label for="name">Name</label>
                            <input type="text" name="name" class="form-control">
                        </div> -->
   
<div class="form-group">
    <label for="name">Name</label>
    <select name="name" id="name" class="form-control">
        <option value="">Select Name</option>
    </select>
</div>



                        <div class="form-group">
    <label for="district">District</label>
    <select name="district_id" id="district" class="form-control">
        <option value="">Select District</option>
        @foreach($districts as $district)
            <option value="{{ $district->id }}">{{ $district->name }}</option>
        @endforeach
    </select>
</div>

<div class="form-group">
    <label for="lokal">Lokal</label>
    <select name="lokal_id" id="lokal" class="form-control" required>
        <option value="">Select Lokal</option>
    </select>
</div>


<script>
$(document).ready(function() {
    $('#district').change(function() {
        var districtId = $(this).val();
        if (districtId) {
            $.ajax({
                url: 'suguan/getLokals/' + districtId,
                type: 'GET',
                success: function(data) {
                    $('#lokal').empty().append('<option value="">Select Lokal</option>');
                    $.each(data, function(index, lokal) {
    $('#lokal').append('<option value="' + lokal.id + '">' + lokal.name + '</option>');
});
                },
                error: function(xhr, status, error) {
                    console.error('Error fetching lokals:', error);
                }
            });
        } else {
            $('#lokal').empty().append('<option value="">Select Lokal</option>');
        }
    });
});
</script>



                        <div class="form-group">
                            <label for="suguan_datetime">Suguan DateTime</label>
                            <input type="datetime-local" name="suguan_datetime" class="form-control">
                        </div>
                 <div class="form-group">
                 <label for="gampanin">Gampanin</label>
        <select name="gampanin" class="form-control" required>
            <option value="">Select Gampanin</option>
            <option value="Kasama sa Tribuna">Kasama sa Tribuna</option>
            <option value="Reserba SL">Reserba SL</option>
            <option value="Sugo SL">Sugo SL</option>
            <option value="Reserba 2">Reserba 2</option>
            <option value="Reserba 1">Reserba 1</option>
            <option value="Sugo 2">Sugo 2</option>
            <option value="Sugo 1">Sugo 1</option>
            <option value="Sugo">Sugo</option>
            <option value="Reserba">Reserba</option>
        </select>
</div>
                        <div class="form-group" style="display:none;">
                            <label for="prepared_by">Prepared By</label>
                            <input type="number" name="prepared_by" class="form-control">
                        </div>
                        <div class="form-group" style="display:none;">
                            <label for="comments">Comments</label>
                            <textarea name="comments" class="form-control"></textarea>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">Add Suguan</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        // API URL
        //const apiUrl = 'http://172.18.162.82/api/manggagawas';
        const apiUrl = 'http://192.168.1.87:8082/api/manggagawas';

        // Fetch data from the API
        fetch(apiUrl)
            .then(response => response.json())
            .then(data => {
                // Get the dropdown element
                const nameDropdown = document.getElementById('name');

                // Populate the dropdown with data
                data.forEach(item => {
                    const fullName = `${item.firstname} ${item.secondname ? item.secondname + ' ' : ''}${item.lastname}`;
                    const option = document.createElement('option');
                    option.value = fullName;
                    option.textContent = fullName;
                    nameDropdown.appendChild(option);
                });
            })
            .catch(error => {
                console.error('Error fetching data:', error);
            });
    });
</script>


    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.2/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</x-app-layout>