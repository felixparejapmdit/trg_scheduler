<link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" />
    
<x-app-layout>
    
    <x-slot name="header">
        <div class="flex justify-between items-center my-8">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                {{ __('Verse of the Week Management') }}
            </h2>
            <div>
            <a href="{{ route('dashboard') }}" class="btn btn-secondary">Back</a>
                
        <button class="btn btn-primary" data-toggle="modal" data-target="#createVerseModal"><i class="fas fa-plus"></i> Verse</button>
            </div>
        </div>
    </x-slot>

    <div class="container mt-5">
        
        @if (session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif
        
        <table class="table table-bordered mt-3">
            <thead>
                <tr>
                    <th>#</th>
                    <th style="width:15%; display:none;">Date</th>
                    <th style="width:8%;">Week #</th>
                    <th>Verse</th>
                    <th>Content</th>
                    <th class="text-center" style="width:15%;">Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($verses as $verse)
                    <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td style="display:none;">{{ \Carbon\Carbon::parse($verse->date)->format('Y-m-d') }}</td>
                        <td>{{ $verse->weeknumber }}</td>
                        <td><strong>{{ $verse->verse }}</strong></td>
                        <td><i>"{{ $verse->content }}"</i></td>
                        <td class="text-center">
                        <button class="btn btn-secondary btn-sm" data-toggle="modal" data-target="#editVerseModal{{ $verse->id }}"><i class="fas fa-edit"></i></button>
                    <form action="{{ route('verseoftheweek.destroy', $verse->id) }}" method="POST" style="display:inline-block;">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-secondary btn-sm"><i class="fas fa-trash-alt"></i></button>
                    </form>
                        </td>
                    </tr>
                    <!-- Edit Modal -->
                    <div class="modal fade" id="editVerseModal{{ $verse->id }}" tabindex="-1" role="dialog" aria-labelledby="editVerseModalLabel{{ $verse->id }}" aria-hidden="true">
                        <div class="modal-dialog" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="editVerseModalLabel{{ $verse->id }}">Edit Verse of the Week</h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <form action="{{ route('verseoftheweek.update', $verse->id) }}" method="POST">
                                    @csrf
                                    @method('PUT')
                                    <div class="modal-body">
                                        <div class="form-group">
                                            <label for="verse">Verse</label>
                                            <input type="text" class="form-control" id="verse" name="verse" value="{{ $verse->verse }}" required>
                                        </div>
                                        <div class="form-group">
                                            <label for="content">Content</label>
                                            <textarea class="form-control" id="content" name="content" rows="4" required>{{ $verse->content }}</textarea>
                                        </div>
                                        <div class="form-group">
    <label for="weeknumber">Week Number</label>
    <select class="form-control" id="weeknumber" name="weeknumber" required>
        @php
            $current_week = date('W'); // get the current week number
            $start_week = max(0, $current_week - 4); // get the start week number
            for ($i = $start_week; $i <= $current_week; $i++) {
                $selected = ($i == $verse->weeknumber) ? 'selected' : '';
                echo "<option value='$i' $selected>$i</option>";
            }
            for ($i = $current_week + 1; $i <= 52; $i++) {
                $selected = ($i == $verse->weeknumber) ? 'selected' : '';
                echo "<option value='$i' $selected>$i</option>";
            }
        @endphp
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
                @endforeach
            </tbody>
        </table>
        {{ $verses->links() }}
    </div>

    <!-- Create Modal -->
<div class="modal fade" id="createVerseModal" tabindex="-1" role="dialog" aria-labelledby="createVerseModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="createVerseModalLabel">Add New Verse of the Week</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="{{ route('verseoftheweek.store') }}" method="POST">
                @csrf
                <div class="modal-body">
                    <div class="form-group">
                        <label for="verse">Verse</label>
                        <input type="text" class="form-control" id="verse" name="verse" required>
                    </div>
                    <div class="form-group">
                        <label for="content">Content</label>
                        <textarea class="form-control" id="content" name="content" rows="4" required></textarea>
                    </div>
<div class="form-group">
    <label for="weeknumber">Week Number</label>
    <select class="form-control" id="weeknumber" name="weeknumber" required>
        @php
            $current_week = date('W'); // get the current week number
            $start_week = max(0, $current_week - 4); // get the start week number
            for ($i = $start_week; $i <= $current_week; $i++) {
                $selected = ($i == $verse->weeknumber) ? 'selected' : '';
                echo "<option value='$i' $selected>$i</option>";
            }
            for ($i = $current_week + 1; $i <= 52; $i++) {
                $selected = ($i == $verse->weeknumber) ? 'selected' : '';
                echo "<option value='$i' $selected>$i</option>";
            }
        @endphp
    </select>
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




    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.2/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</x-app-layout>