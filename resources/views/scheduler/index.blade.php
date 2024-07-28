<!DOCTYPE html>
<html>
<head>
    <title>Scheduler Application</title>
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;700&display=swap" rel="stylesheet">
    <!-- Include jQuery -->
    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
    <!-- Include Popper.js -->
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.2/dist/umd/popper.min.js"></script>
    <!-- Include Bootstrap JS -->
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <!-- Include Font Awesome CSS -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.1/css/all.min.css">
    
    <style>

    /* Modern and Minimalistic Color Palette */
    :root {
        --primary-color: #EEEEEE;
        --secondary-color: #6C757D;
        --accent-color: #226aa0;
        --background-color: #F7F7F7  ;
        --text-color: #2C3E50;
        --border-color: #D5DBDB;
        --shadow-color: rgba(0, 0, 0, 0.1);
    }

        body {
        margin: 0;
        font-family: 'Roboto', sans-serif;
        background: linear-gradient(to bottom, #5eb8d3 30%, #4975b4 150%);
        color: var(--text-color);
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
        border-left: 1px solid var(--border-color);
        border-right: 1px solid var(--border-color);
        overflow-y: auto;
        transition: background-color 0.3s ease;
    }
    .column:last-child {
        border-right: none;
    }
    .column h2 {
        font-size: 28px;
        color: var(--primary-color);
        border-radius: 8px;
        background-color: var(--accent-color);
        margin-top: 0px;
        margin-bottom: 6px;
        text-align: center;
    }
    .column h3 {
        font-size: 18px;
        color: var(--primary-color);
        border-radius: 8px;
        background-color: var(--accent-color);
        margin-top: 0px;
        text-align: center;
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
        font-size: 1vw;
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
        width: 49%;
        float: left;
    }
    .weekend-section {
        margin-bottom: 20px;
        width: 49%;
        float: right;
    }
    .day-title {
        font-size: 18px;
        font-weight: bold;
        margin-bottom: 10px;
        color: var(--primary-color);
        border-radius: 8px;
        background-color: var(--accent-color);
        text-align: center;
    }
    .reminders-column {
        position: relative;
        flex: 1;
        padding: 20px;
        border-right: 1px solid #ccc;
        display: flex;
        flex-direction: column;
    }
    .reminders-column.reminder-list {
        flex: 1;
        overflow-y: auto;
    }
.reminders-column.reminder-list ul {
    list-style: square; /* or disc, or circle, depending on the bullet style you want */
    padding: 0;
    margin: 0;
}
    .reminders-column .verse-of-the-week {
        height: 20%;
        display: flex;
        flex-direction: column;
        justify-content: flex-start;
        margin-bottom: 12px;
    }
    .reminders-column .verse-of-the-week h3 {
        margin-top: 0;
        margin-bottom: 6px;
        font-size: 22px;
        color: var(--primary-color);
        background-color: var(--accent-color);
        text-align: center;
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
        font-size: 1vw;
    }
    .reminders-column .verse-of-the-week ul li:before {
        position: absolute;
        left: 0;
        font-size: 1.5em;
        line-height: 1em;
    }
    .reminders-column .verse-of-the-week ul li:after {
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

    <div class="container mt-0">
    
<div class="column reminders-column">
    

    <div class="verse-of-the-week">
    <h2>Verse of the Week</h2>
        @if ($verseOfTheWeek)
            <ul>
                <li><i>"{{ $verseOfTheWeek->content }}"</i><br><br>
                    <strong>{{ $verseOfTheWeek->verse }}</strong>
                </li>
            </ul>
        @else
            <p>No verse available for this week.</p>
        @endif
    </div>
    <h2>Reminders</h2>
<ul class="reminder-list">
    @foreach($reminders as $reminder)
        <li>
            <span style="font-size: 22px;">&#8227;</span> {{ $reminder->reminder }}<br>
        </li>
    @endforeach
</ul>

<!-- <h2>Broadcast Suguan</h2>
<ul class="broadcast-list">
    @foreach($broadcastSuguan as $broadcast)
        <li>
        {{ \Carbon\Carbon::parse($broadcast->date)->format('m-d') }}, {{ $broadcast->name }},{{ $broadcast->tobebroadcast }}
        </li>
    @endforeach
</ul> -->
</div>

<div class="column">
    <h2>Events</h2>
    <div class="events-section">
        <h3>Meeting</h3>
        <ul>
            @foreach($events as $event)
            @if($event->event_type == 'Meeting')
                <li>
                    {{ \Carbon\Carbon::parse($event->event_datetime)->format('m-d') }} 
                    <em>{{ \Carbon\Carbon::parse($event->event_datetime)->format('gA') }}</em> - {{ $event->title }}<br>
                </li>
            @endif
            @endforeach
            @if(!($events->where('event_type', 'Meeting')->count() > 0))
                <li><center><i style="color:#D5DBDB;">No entries for Meeting.</i></center></li>
            @endif
        </ul>
    </div>
    <div class="events-section">
        <h3>Birthdays and Anniversaries</h3>
        <ul>
            @foreach($events as $event)
            @if($event->event_type == 'Birthday & Anniversary')
    <li>
        {{ \Carbon\Carbon::parse($event->event_datetime)->format('m-d') }}  - {{ $event->title }}<br>
    </li>
@endif
            @endforeach
            @if(!($events->where('event_type', 'Birthday & Anniversary')->count() > 0))
                <li><center><i style="color:#D5DBDB;">No entries for Birthdays and Anniversaries.</i></center></li>
            @endif
        </ul>
    </div>
    <div class="events-section">
        <h3>Non-Office</h3>
        <ul>
            @foreach($events as $event)
                @if($event->event_type == 'Non-Office')
                    <li>
                        {{ \Carbon\Carbon::parse($event->event_datetime)->format('m-d') }} - 
                        <em>{{ \Carbon\Carbon::parse($event->event_datetime)->format('gA') }}</em> - {{ $event->title }}<br>
                    </li>
                @endif
            @endforeach
            @if(!($events->where('event_type', 'Non-Office')->count() > 0))
                <li><center><i style="color:#D5DBDB;">No entries for Non-Office.</i></center></li>
            @endif
        </ul>
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
    <h2>WS Suguan</h2>
    <div class="day-section mr-2">
        <div class="day-title">Midweek</div>
        <ul>
            <li>
                <strong>Wednesday:</strong><br>
                @foreach($suguan_midweek['Wednesday'] as $suguan)
                <b>{{ implode('', array_map(function($word) { return substr($word, 0, 1); }, explode(' ', $suguan->name))) }}</b>, <i style="color: #226aa0;font-weight:bold;">{{ \Carbon\Carbon::parse($suguan->suguan_datetime)->format('gA') }}</i> {{ $suguan->lokal->name }} <br> 
                @endforeach
            </li>
            <li>
                <strong>Thursday:</strong><br>
                @foreach($suguan_midweek['Thursday'] as $suguan)
                <b>{{ implode('', array_map(function($word) { return substr($word, 0, 1); }, explode(' ', $suguan->name))) }}</b>, <i style="color: #226aa0;font-weight:bold;">{{ \Carbon\Carbon::parse($suguan->suguan_datetime)->format('gA') }}</i> {{ $suguan->lokal->name }} <br> 
                @endforeach
            </li>
        </ul>
    </div>
    <div class="weekend-section">
        <div class="day-title">Weekend</div>
        <ul>
            <li>
                <strong>Friday:</strong><br>
                @foreach($suguan_weekend['Friday'] as $suguan)
                <b>{{ implode('', array_map(function($word) { return substr($word, 0, 1); }, explode(' ', $suguan->name))) }}</b>, <i style="color: #226aa0;font-weight:bold;">{{ \Carbon\Carbon::parse($suguan->suguan_datetime)->format('gA') }}</i> {{ $suguan->lokal->name }} <br> 
                @endforeach
            </li>
            <li>
                <strong>Saturday:</strong><br>
                @foreach($suguan_weekend['Saturday'] as $suguan)
                <b>{{ implode('', array_map(function($word) { return substr($word, 0, 1); }, explode(' ', $suguan->name))) }}</b>, <i style="color: #226aa0;font-weight:bold;">{{ \Carbon\Carbon::parse($suguan->suguan_datetime)->format('gA') }}</i> {{ $suguan->lokal->name }} <br> 
                @endforeach
            </li>
            <li>
                <strong>Sunday:</strong><br>
                @foreach($suguan_weekend['Sunday'] as $suguan)
                <b>{{ implode('', array_map(function($word) { return substr($word, 0, 1); }, explode(' ', $suguan->name))) }}</b>, <i style="color: #226aa0;font-weight:bold;">{{ \Carbon\Carbon::parse($suguan->suguan_datetime)->format('gA') }}</i> {{ $suguan->lokal->name }} <br> 
                @endforeach
            </li>
        </ul>
    </div>
</div>


   
<!-- Back to Dashboard Icon -->
<div class="fixed-icon">
    <a href="{{ route('dashboard') }}" class="toggle-icon">
        <i class="fas fa-chevron-right toggle-chevron"></i>
        <span class="tooltip-text">Back</span>
    </a>
</div>

    </div>

<style>
.fixed-icon {
  display: block; /* or inline-block, depending on your layout */
}
.hidden {
  display: none;
}
    .fixed-icon {
        position: fixed;
        left: 0;
        top: 45%;
        transform: translateY(-50%);
        background-color: #007bff;
        padding: 10px;
        border-radius: 0 5px 5px 0;
        z-index: 1000;
        transition: all 0.3s;
        width:15px;
    }

    .fixed-icon .toggle-icon {
        color: white;
        text-decoration: none;
        display: flex;
        align-items: center;
    }

    .fixed-icon .tooltip-text {
        visibility: hidden;
        opacity: 0;
        margin-left: 10px;
        transition: visibility 0s, opacity 0.3s linear;
    }

    .fixed-icon:hover {
        padding-left: 15px;
        width:60px;
    }
    .fixed-icon:hover .toggle-chevron {
    font-family: "Font Awesome 5 Free";
    font-weight: 900;
}

.fixed-icon:hover .toggle-chevron:before {
    content: "\f053"; /* fa-chevron-left */
}
    .fixed-icon:hover .tooltip-text {
        visibility: visible;
        opacity: 1;
    }
</style>

<script src="https://kit.fontawesome.com/a076d05399.js"></script>
<script>
    document.addEventListener('DOMContentLoaded', function() {
// Add event listeners for fullscreen change
document.addEventListener('webkitfullscreenchange', function() {
  toggleFixedIcon();
});
document.addEventListener('mozfullscreenchange', function() {
  toggleFixedIcon();
});

// Function to toggle fixed icon visibility
function toggleFixedIcon() {
  if (document.webkitIsFullScreen || document.mozFullScreen) {
    // Hide fixed icon when entering fullscreen
    document.querySelectorAll('.fixed-icon').forEach(function(icon) {
      icon.classList.add('hidden');
    });
  } else {
    // Show fixed icon when exiting fullscreen
    document.querySelectorAll('.fixed-icon').forEach(function(icon) {
      icon.classList.remove('hidden');
    });
  }
}
    });
</script>
<!-- HTML remains the same -->
<div class="footer" style="width: 100%; height: 60px; background-color: #3386c5; display: flex; justify-content: space-between; align-items: center; position: fixed; bottom: 0; left: 0;">
  <img src="{{ asset('images/TRG Logo.png') }}" alt="Scheduler Logo" style="width:200px; height:90px; max-width: 30%; max-height: 90px;">
  <div id="current-datetime" style="margin-right:22px; font-size:1.5vw;color:#cdd2d6;"></div>
</div>

<!-- Add this CSS -->
<style>
  /* Make the body and html elements take up the full height of the screen */
  body, html {
    height: 100%;
    margin: 0;
  }

  /* Make the footer fixed at the bottom of the screen */
  .footer {
    position: fixed;
    bottom: 0;
    left: 0;
    width: 100%;
    height: 60px;
    background-color: #3386c5;
    display: flex;
    justify-content: space-between;
    align-items: center;
    z-index: 1; /* Add a z-index to ensure the footer is on top of other elements */
  }

  /* Make the logo and datetime responsive */
  .footer img {
    max-width: 30%;
    max-height: 90px;
    height: auto;
    margin: 0 20px;
  }

  .footer #current-datetime {
    font-size: 1.5vw;
    margin-right: 22px;
    color: #cdd2d6;
  }

  /* Add media queries to adjust the footer for different screen sizes */
  @media only screen and (max-width: 768px) {
    .footer {
      height: 40px;
    }
    .footer img {
      max-width: 20%;
      max-height: 40px;
    }
    .footer #current-datetime {
      font-size: 1.2vw;
    }
  }

  @media only screen and (max-width: 480px) {
    .footer {
      height: 30px;
    }
    .footer img {
      max-width: 15%;
      max-height: 30px;
    }
    .footer #current-datetime {
      font-size: 1vw;
    }
  }
</style>

<!-- JavaScript remains the same -->
<script>
  function updateDateTime() {
    const currentDateTime = document.getElementById('current-datetime');
    const now = new Date();
    const monthNames = ["January", "February", "March", "April", "May", "June", "July", "August", "September", "October", "November", "December"];
    const month = monthNames[now.getMonth()];
    const day = now.getDate();
    const year = now.getFullYear();
    const timeString = now.toLocaleTimeString();
    currentDateTime.innerHTML = `${month} ${day}, ${year} <span style="font-weight: bold; color: #ffffff">${timeString}</span>`;
  }

  setInterval(updateDateTime, 1000); // update every 1 second
</script>
</body>
</html>
        