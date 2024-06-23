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
                {{ __('Suguan Management') }}
            </h2>
            <div>
            <a href="{{ route('dashboard') }}" class="btn btn-secondary">Back</a>
                
        <button class="btn btn-primary" data-toggle="modal" data-target="#addSuguanModal"><i class="fas fa-plus"></i> Suguan</button>
            </div>
        </div>
    </x-slot>
    <div class="container">

        @if ($message = Session::get('success'))
            <div class="alert alert-success">
                <p>{{ $message }}</p>
            </div>
        @endif
        {{ $suguan->links() }}
         <table class="table table-bordered mt-3">
        <tr>
            <th class="text-center" >#</th>
            <th>Name</th>
            <th>Lokal</th>
            <th>District</th>
            <th>Suguan DateTime</th>
            <th>Day</th>
            <th>Gampanin</th>
            <th style="display:none;">Prepared By</th>
            <th style="display:none;">Comments</th>
            <th class="text-center" >Actions</th>
        </tr>
        @forelse ($suguan as $item)
        @if($item)
            <tr>
                <td class="text-center" style="width: 5%;">{{ $loop->iteration }}</td>
                <td>{{ $item->name }}</td>
                <td>{{ $item->lokal }}</td>
                <td>{{ $item->district }}</td>
                <td>{{ date('Y-m-d g:i A', strtotime($item->suguan_datetime)) }}</td>
                <td>{{ date('l', strtotime($item->suguan_datetime)) }}</td>
                <td>{{ $item->gampanin }}</td>
                <td style="display:none;">{{ $item->prepared_by }}</td>
                <td style="display:none;">{{ $item->comments }}</td>
                <td class="text-center" >
                    <button class="btn btn-secondary btn-sm" data-toggle="modal" data-target="#editSuguanModal{{ $item->id }}"><i class="fas fa-edit"></i></button>
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
            <input type="text" name="name" class="form-control" value="{{ $item->name }}" required>
        </div>
        <div class="form-group">
            <label for="lokal">Lokal</label>
            <input type="text" name="lokal" class="form-control" value="{{ $item->lokal }}" required>
        </div>
        <div class="form-group">
            <label for="edit_district">District</label>
            <select name="edit_district" class="form-control" required>
                <option value="">Select District</option>
                <option value="CN" {{ $item->district == 'CN' ? 'selected' : '' }}>Caloocan North</option>
                <option value="CAVA" {{ $item->district == 'CAVA' ? 'selected' : '' }}>Camanava</option>
                <option value="CEN" {{ $item->district == 'CEN' ? 'selected' : '' }}>CENTRAL</option>
                <option value="MAK" {{ $item->district == 'MAK' ? 'selected' : '' }}>Makati</option>
                <option value="MAY" {{ $item->district == 'MAY' ? 'selected' : '' }}>MAYNILA</option>
                <option value="MME" {{ $item->district == 'MME' ? 'selected' : '' }}>Metro Manila East</option>
                <option value="MMS" {{ $item->district == 'MMS' ? 'selected' : '' }}>Metro Manila South</option>
                <option value="QC" {{ $item->district == 'QC' ? 'selected' : '' }}>QUEZON CITY</option>
            </select>
        </div>
        <div class="form-group">
            <label for="suguan_datetime">Suguan DateTime</label>
            <input type="datetime-local" name="suguan_datetime" class="form-control" value="{{ date('Y-m-d\TH:i', strtotime($item->suguan_datetime)) }}" required>
        </div>
        <div class="form-group">
            <label for="gampanin">Gampanin</label>
            <input type="text" name="gampanin" class="form-control" value="{{ $item->gampanin }}" required>
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
                        <div class="form-group">
                            <label for="name">Name</label>
                            <input type="text" name="name" class="form-control">
                        </div>
                        <div class="form-group">
                            <label for="lokal">Lokal</label>
                            <input type="text" name="lokal" class="form-control">
                        </div>
                        <div class="form-group">
    <label for="district">District</label>
    <select name="district" class="form-control">
    <option value="">Select District</option>
    <option value="CN">Caloocan North</option>
    <option value="CAVA">Camanava</option>
    <option value="CEN">CENTRAL</option>
    <option value="MAK">Makati</option>
    <option value="MAY">MAYNILA</option>
    <option value="MME">Metro Manila East</option>
    <option value="MMS">Metro Manila South</option>
    <option value="QC">QUEZON CITY</option>
</select>
</div>
                        <div class="form-group">
                            <label for="suguan_datetime">Suguan DateTime</label>
                            <input type="datetime-local" name="suguan_datetime" class="form-control">
                        </div>
                        <div class="form-group">
                            <label for="gampanin">Gampanin</label>
                            <input type="text" name="gampanin" class="form-control">
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

    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.2/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</x-app-layout>