<!DOCTYPE html>
<html>
<head>
    <title>Scheduler Application</title>
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;700&display=swap" rel="stylesheet">
    <!-- Include jQuery -->
<!-- Include jQuery -->
<script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
<!-- Include Popper.js -->
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.2/dist/umd/popper.min.js"></script>
<!-- Include Bootstrap JS -->
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>



    
    <style>

        /* Scoped Bootstrap styles */
@import url('https://fonts.googleapis.com/css2?family=Roboto:wght@400;700&display=swap');
@import url('https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css');
@import url('https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css');

    body {
    margin: 0;
    font-family: 'Roboto', sans-serif;
    background-color: #F8F9FA;
}
.container {
    display: flex;
    width: 100%;
    height: 100vh;
    overflow: hidden;
}
.column {
    flex: 1;
    padding: 20px;
    border-right: 1px solid #ccc;
    overflow-y: auto;
    transition: background-color 0.3s ease;
}
.column:last-child {
    border-right: none;
}
.column h2 {
    font-size: 28px;
    color: #333;
    margin-bottom: 20px;
}
.column ul {
    list-style: none;
    padding: 0;
    columns: 1;
}
.column ul li {
    background: #fff;
    margin-bottom: 15px;
    padding: 5px;
    border-radius: 8px;
    box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
    transition: transform 0.3s ease, box-shadow 0.3s ease;
    font-size: 18px;
}
.column ul li:hover {
    transform: translateY(-5px);
    box-shadow: 0 4px 15px rgba(0, 0, 0, 0.2);
}
.column ul li strong {
    color: #007BFF;
}
.column ul li em {
    color: #555;
    font-style: italic;
}
.day-section {
    margin-bottom: 20px;
    width: 50%;
    float: left;
}
.weekend-section {
    margin-bottom: 20px;
    width: 50%;
    float: right;
}
.day-title {
    font-size: 22px;
    font-weight: bold;
    margin-bottom: 10px;
}
.reminders-column {
    position: relative;
    flex: 1;
    padding: 20px;
    border-right: 1px solid #ccc;
    display: flex;
    flex-direction: column;
}
.reminders-column .reminder-list {
    flex: 1;
    overflow-y: auto;
}
.reminders-column .reminder-list ul {
    list-style: none;
    padding: 0;
    margin: 0;
}
.reminders-column .verse-of-the-week {
    height: 20%;
    display: flex;
    flex-direction: column;
    justify-content: flex-end;
}
.reminders-column .verse-of-the-week h3 {
    margin-top: 0;
    font-size: 22px;
    color: #333;
}
.reminders-column .verse-of-the-week ul {
    list-style: none;
    padding: 0;
    margin: 10px 0;
}
.reminders-column .verse-of-the-week ul li {
    font-style: italic;
    color: #555;
    position: relative;
    padding-left: 20px;
    font-size: 18px;
}
.reminders-column .verse-of-the-week ul li:before {
    content: '“';
    position: absolute;
    left: 0;
    font-size: 1.5em;
    line-height: 1em;
}
.reminders-column .verse-of-the-week ul li:after {
    content: '”';
    position: absolute;
    right: 0;
    font-size: 1.5em;
    line-height: 1em;
}

/* Media query for multi-column layout */
@media (min-height: 800px) {
    .events-section ul {
        columns: 2;
        column-gap: 20px;
    }
    .events-section ul li {
        break-inside: avoid;
    }
}
</style>

</head>
<body>
    <div class="container">

    <div class="column reminders-column">
    <h2>Reminders</h2>
    <ul class="reminder-list">
        @foreach($reminders as $reminder)
            <li>
                {{ \Carbon\Carbon::parse($reminder->reminder_datetime)->format('F j, Y') }} 
                <em>{{ \Carbon\Carbon::parse($reminder->reminder_datetime)->format('g:iA') }}</em> - {{ $reminder->reminder }}<br>
            </li>
        @endforeach
    </ul>
    <div class="verse-of-the-week">
        <h3>Verse of the Week</h3>
        <ul>
            <li>{{ $verseOfTheWeek }}</li>
        </ul>
    </div>
</div>

<div class="column">
    <h2>Events</h2>
    <div class="events-section">
        <h3>Meeting</h3>
        <ul>
            @foreach($events as $event)
                @if($event->event_type == 'Meeting')
                    <li>
                        {{ \Carbon\Carbon::parse($event->event_datetime)->format('F j, Y') }} 
                        <em>{{ \Carbon\Carbon::parse($event->event_datetime)->format('g:iA') }}</em> - {{ $event->title }}<br>
                    </li>
                @endif
            @endforeach
            @if(!($events->where('event_type', 'Meeting')->count() > 0))
                <li><center><i style="color:red;">No entries for Meeting.</i></center></li>
            @endif
        </ul>
    </div>
    <div class="events-section">
        <h3>Birthdays and Anniversaries</h3>
        <ul>
            @foreach($events as $event)
                @if($event->event_type == 'Birthday & Anniversary')
                    <li>
                        {{ \Carbon\Carbon::parse($event->event_datetime)->format('F j, Y') }} 
                        <em>{{ \Carbon\Carbon::parse($event->event_datetime)->format('g:iA') }}</em> - {{ $event->title }}<br>
                    </li>
                @endif
            @endforeach
            @if(!($events->where('event_type', 'Birthday & Anniversary')->count() > 0))
                <li><center><i style="color:red;">No entries for Birthdays and Anniversaries.</i></center></li>
            @endif
        </ul>
    </div>
    <div class="events-section">
        <h3>Non-Office</h3>
        <ul>
            @foreach($events as $event)
                @if($event->event_type == 'Non-Office')
                    <li>
                        {{ \Carbon\Carbon::parse($event->event_datetime)->format('F j, Y') }} 
                        <em>{{ \Carbon\Carbon::parse($event->event_datetime)->format('g:iA') }}</em> - {{ $event->title }}<br>
                    </li>
                @endif
            @endforeach
            @if(!($events->where('event_type', 'Non-Office')->count() > 0))
                <li><center><i style="color:red;">No entries for Non-Office.</i></center></li>
            @endif
        </ul>
    </div>
    
<!-- Modal Structure -->
<div class="modal fade" id="eventsModal" tabindex="-1" role="dialog" aria-labelledby="eventsModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="eventsModalLabel">Events</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body" id="modal-body">
                <!-- AJAX response will be injected here -->
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>

</div>


<script>
$(document).ready(function() {
    $('.events-section h3').dblclick(function() {
   
        let eventType = $(this).text();
      
        $('#eventsModalLabel').text(eventType);  // Set the modal title
      
        $.ajax({
            url: '{{ route("events.filter") }}',
            method: 'GET',
            data: { event_type: eventType },
            success: function(data) {
               
                $('#modal-body').html(data);  // Inject the response data into the modal body
                $('#eventsModal').modal('show');  // Show the modal
            }
        });
    });

    // Event handler for checkboxes
    $(document).on('change', '.event-checkbox', function() {
        let eventId = $(this).data('event-id');
        let status = $(this).is(':checked') ? 'active' : 'inactive';

        // Make an AJAX call to update the event status
        $.ajax({
            url: '{{ route("events.updateStatus") }}',
            method: 'POST',
            data: {
                _token: '{{ csrf_token() }}',
                event_id: eventId,
                status: status
            },
            success: function(response) {
                console.log('Status updated successfully.');
            }
        });
    });
});
</script>



        <div class="column">
            
            <h2>Suguan</h2>
            <div class="day-section mr-2">
                <div class="day-title">Midweek</div>
                <ul>
                    <li>
                        <strong>Wednesday:</strong><br>
                        @foreach($suguan_midweek['Wednesday'] as $suguan)
                        <b>{{ $suguan->name }}</b>, <i>{{ \Carbon\Carbon::parse($suguan->suguan_datetime)->format('g:iA') }}</i> {{ $suguan->lokal }}, {{ getAcronym($suguan->district) }} <br>{{ $suguan->gampanin }}<br>
                        @endforeach
                    </li>
                    <li>
                        <strong>Thursday:</strong><br>
                        @foreach($suguan_midweek['Thursday'] as $suguan)
                        <b>{{ $suguan->name }}</b>, <i>{{ \Carbon\Carbon::parse($suguan->suguan_datetime)->format('g:iA') }}</i> {{ $suguan->lokal }}, {{ getAcronym($suguan->district) }} <br>{{ $suguan->gampanin }}<br>
                        @endforeach
                    </li>
                </ul>
            </div>
            <div class="weekend-section">
                <div class="day-title">Weekend</div>
                <ul>
                    <li>
                        <strong>Saturday:</strong><br>
                        @foreach($suguan_weekend['Saturday'] as $suguan)
                        <b>{{ $suguan->name }}</b>, <i>{{ \Carbon\Carbon::parse($suguan->suguan_datetime)->format('g:iA') }}</i> {{ $suguan->lokal }}, {{ getAcronym($suguan->district) }} <br>{{ $suguan->gampanin }}<br>
                        @endforeach
                    </li>
                    <li>
                        <strong>Sunday:</strong><br>
                        @foreach($suguan_weekend['Sunday'] as $suguan)
                        <b>{{ $suguan->name }}</b>, <i>{{ \Carbon\Carbon::parse($suguan->suguan_datetime)->format('g:iA') }}</i> {{ $suguan->lokal }}, {{ getAcronym($suguan->district) }} <br>{{ $suguan->gampanin }}<br>
                        @endforeach
                    </li>
                </ul>
            </div>
        </div>
    </div>

    
</body>
</html>
