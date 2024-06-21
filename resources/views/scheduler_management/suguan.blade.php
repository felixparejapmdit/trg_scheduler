<!DOCTYPE html>
<html>
<head>
    <title>Suguan Management</title>
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
    </style>
</head>
<body>
    <div class="container">
        <h2>Suguan Management</h2>
        <button class="btn btn-primary mb-3" data-toggle="modal" data-target="#addSuguanModal">Add Suguan</button>

        @if ($message = Session::get('success'))
            <div class="alert alert-success">
                <p>{{ $message }}</p>
            </div>
        @endif

        <table class="table table-bordered">
            <tr>
                <th>ID</th>
                <th>Name</th>
                <th>Lokal</th>
                <th>District</th>
                <th>Suguan DateTime</th>
                <th>Gampanin</th>
                <th>Prepared By</th>
                <th>Comments</th>
                <th>Actions</th>
            </tr>
            @foreach ($suguan as $item)
                <tr>
                    <td>{{ $item->id }}</td>
                    <td>{{ $item->name }}</td>
                    <td>{{ $item->lokal }}</td>
                    <td>{{ $item->district }}</td>
                    <td>{{ $item->suguan_datetime }}</td>
                    <td>{{ $item->gampanin }}</td>
                    <td>{{ $item->prepared_by }}</td>
                    <td>{{ $item->comments }}</td>
                    <td>
                        <button class="btn btn-info btn-sm" data-toggle="modal" data-target="#editSuguanModal{{ $item->id }}">Edit</button>
                        <button class="btn btn-danger btn-sm" data-toggle="modal" data-target="#deleteSuguanModal{{ $item->id }}">Delete</button>
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
                                        <input type="text" name="name" class="form-control" value="{{ $item->name }}">
                                    </div>
                                    <div class="form-group">
                                        <label for="lokal">Lokal</label>
                                        <input type="text" name="lokal" class="form-control" value="{{ $item->lokal }}">
                                    </div>
                                    <div class="form-group">
                                    <label for="district">District</label>
                                    <select name="district" class="form-control" id="district">
    <option value="">Select District</option>
    <option value="CN" >Caloocan North</option>
    <option value="CAVA" >Camanava</option>
    <option value="CEN" >CENTRAL</option>
    <option value="MAK" >Makati</option>
    <option value="MAY" >MAYNILA</option>
    <option value="MME" >Metro Manila East</option>
    <option value="MMS" >Metro Manila South</option>
    <option value="QC" >QUEZON CITY</option>
</select>

<script>
    document.addEventListener("DOMContentLoaded", function() {
        var district = document.getElementById("district");
        district.value = "{{ $item->district }}";
    });
</script>
                                </div>
                                    <div class="form-group">
                                        <label for="suguan_datetime">Suguan DateTime</label>
                                        <input type="datetime-local" name="suguan_datetime" class="form-control" value="{{ date('Y-m-d\TH:i', strtotime($item->suguan_datetime)) }}">
                                    </div>
                                    <div class="form-group">
                                        <label for="gampanin">Gampanin</label>
                                        <input type="text" name="gampanin" class="form-control" value="{{ $item->gampanin }}">
                                    </div>
                                    <div class="form-group">
                                        <label for="prepared_by">Prepared By</label>
                                        <input type="number" name="prepared_by" class="form-control" value="{{ $item->prepared_by }}">
                                    </div>
                                    <div class="form-group">
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
            @endforeach
        </table>
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
    <option value="CN" {{ $item->district == 'CN'? 'elected' : '' }}>Caloocan North</option>
    <option value="CAVA" {{ $item->district == 'CAVA'? 'elected' : '' }}>Camanava</option>
    <option value="CEN" {{ $item->district == 'CEN'? 'elected' : '' }}>CENTRAL</option>
    <option value="MAK" {{ $item->district == 'MAK'? 'elected' : '' }}>Makati</option>
    <option value="MAY" {{ $item->district == 'MAY'? 'elected' : '' }}>MAYNILA</option>
    <option value="MME" {{ $item->district == 'MME'? 'elected' : '' }}>Metro Manila East</option>
    <option value="MMS" {{ $item->district == 'MMS'? 'elected' : '' }}>Metro Manila South</option>
    <option value="QC" {{ $item->district == 'QC'? 'elected' : '' }}>QUEZON CITY</option>
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
                        <div class="form-group">
                            <label for="prepared_by">Prepared By</label>
                            <input type="number" name="prepared_by" class="form-control">
                        </div>
                        <div class="form-group">
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
</body>
</html>
