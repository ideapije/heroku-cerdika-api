@extends('layouts.bootstrap')

@push('styles')
<link href="https://cdn.jsdelivr.net/npm/fullcalendar@5.10.1/main.min.css" rel="stylesheet" />
<link href="https://cdn.jsdelivr.net/npm/@fortawesome/fontawesome-free@5.13.1/css/all.css" rel="stylesheet" />
<style>
    html,
    body {
        margin: 0;
        padding: 0;
        font-family: Arial, Helvetica Neue, Helvetica, sans-serif;
        font-size: 14px;
    }

    .fc .fc-daygrid-day.fc-day-today {
        background-color: #fff176 !important;
    }
    .fc .fc-toolbar {        
        line-height: 45px;
    }
</style>
@endpush

@section('content')
<div class="container">
    <div class="row">
        <div class="col">
            <div id="calendar"></div>
        </div>
    </div>
</div>
@endsection


@push('scripts')
<script src="https://cdn.jsdelivr.net/npm/fullcalendar@5.10.1/main.min.js"></script>
<script>
    document.addEventListener('DOMContentLoaded', function() {
        let calendarEl = document.getElementById('calendar');
        let calendar = new FullCalendar.Calendar(calendarEl, {
            timeZone: 'Asia/Jakarta',
            themeSystem: 'bootstrap',
            headerToolbar: {
                left: 'prev,next today',
                center: 'title',
                right: 'dayGridMonth,timeGridWeek,timeGridDay,listMonth'
            },
            weekNumbers: true,
            dayMaxEvents: true, // allow "more" link when too many events
            events: '<?= route("api.cerdika.calendar.index", $member) ?>'
        });
        calendar.render();
    });
    // add the responsive classes after page initialization
    window.onload = function () {
        $('.fc-toolbar.fc-header-toolbar').addClass('row col-lg-12');
    };
    // add the responsive classes when navigating with calendar buttons
    $(document).on('click', '.fc-button', function(e) {
        $('.fc-toolbar.fc-header-toolbar').addClass('row col-lg-12');
    });
</script>
@endpush