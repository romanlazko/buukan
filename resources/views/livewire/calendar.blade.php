<div x-data={}>
    {{-- <livewire:appointment-component :employee="$employee"> --}}
    {{-- @livewire('schedule-modal', ['employee' => $employee]) --}}
    <div wire:ignore id='calendar' class="text-[10px] sm:text-base"></div>

    <livewire:create-event-modal :employee="$employee"/>
    <livewire:date-events-modal :employee="$employee"/>
    <livewire:edit-event-modal :employee="$employee"/>
    <livewire:appointment-modal :employee="$employee" :company="$company"/>
    

    <script>
        document.addEventListener('livewire:navigated', function() {
            var calendarEl = document.getElementById('calendar');
            var calendar = new FullCalendar.Calendar(calendarEl, {
                height: 'auto',
                initialView: 'dayGridMonth',
                headerToolbar: {
                    left: 'title',
                    right: 'prev,next'
                },
                selectMinDistance: 1,
                titleFormat: { year: 'numeric', month: 'short', day: 'numeric' }, 
                dayHeaderFormat: { weekday: 'short', omitCommas: true }, 
                eventTimeFormat: {
                    hour: '2-digit',
                    minute: '2-digit',
                    hour12: false
                }, 
                eventDisplay: 'block',
                defaultRangeSeparator: '-',
                showNonCurrentDates: false,
                fixedWeekCount: false,
                firstDay: 1,
                dayMaxEventRows: true, 
                selectable: true,
                eventDidMount: function (info) {
                    $(info.el).find('.fc-event-time').addClass('items-center flex').append(
                        $("<span>", {
                            "class": "p-0 ml-1 border rounded-md border-gray-200 px-1",
                            "html": info.event.extendedProps.service.name
                        })
                    );
                    $(info.el).find('.fc-event-main')
                        .append(
                            $("<div>", {
                                "class": "overflow-hidden fc-event-main-div"
                            })
                        );

                    if (info.event.extendedProps.type == 'appointment') {
                        $(info.el).find('.fc-event-main-div').append(
                            $("<div>", {
                                "html": info.event.extendedProps.client.first_name+" "+info.event.extendedProps.client.last_name
                            })
                        );
                    }
                },
                dateClick: function (info) {
                    @this.openModal('DateEventsModal', info);
                },
                select: function (info) {
                    @this.openModal('CreateEventModal', info);
                },
                eventClick: function (eventClickInfo) {
                    @this.openModal('AppointmentModal', eventClickInfo.event.extendedProps);
                },
            });
            calendar.render();

            calendar.addEventSource( @json($events) );

            $('.fc-view-harness').addClass('overflow-auto');
            $('.fc-dayGridMonth-view').addClass('min-w-[850px] md:min-w-full');
            
            calendar.updateSize();

            @this.on('resetEvents', (events) => {
                removeEvents = calendar.getEventSources();

                removeEvents.forEach(event => {
                    event.remove();
                });
                
                calendar.addEventSource( events[0] );
            });
        });
    </script>
</div>