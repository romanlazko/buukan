<div x-data={}>
    <div wire:ignore id='calendar' class="text-[10px] sm:text-base rounded-lg"></div>

    <livewire:event.create-event-modal :employee="$employee"/>
    <livewire:event.date-events-modal :employee="$employee"/>
    <livewire:event.edit-event-modal :employee="$employee"/>
    <livewire:appointment-modal :company="$company"/>

    <script>
        document.addEventListener('livewire:navigated', function() {
            var calendarEl = document.getElementById('calendar');
            var calendar = new FullCalendar.Calendar(calendarEl, {
                eventSources: @json(['events' => $events]),
                height: 'auto',
                initialView: 'dayGridMonth',
                headerToolbar: {
                    left: 'title',
                    right: 'prev,next',
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
                    $(info.el).find('.fc-event-main')
                        .append(
                            $("<div>", {
                                "class": "overflow-hidden fc-event-main-div pl-1"
                            })
                        );

                    if (info.event.extendedProps.type == 'appointment') {
                        $(info.el).find('.fc-event-main-div')
                            .append(
                                $("<div>", {
                                    "class": "text-white font-bold",
                                    "html": info.event.extendedProps.client.first_name+" "+info.event.extendedProps.client.last_name
                                })
                            );
                    }
                    $(info.el).find('.fc-event-main-div')
                        .append(
                            $("<div>", {
                                "html": info.event.extendedProps.service.name,
                                "class": "text-gray-100 font-light"
                            })
                        );
                },
                dateClick: function (info) {
                    console.log(info);
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

            $('.fc-view-harness').addClass('overflow-auto rounded-lg bg-white');
            $('.fc-dayGridMonth-view').addClass('min-w-[850px] md:min-w-full rounded-lg');
            $('.fc-header-toolbar').css({"margin-bottom":"0.5rem"}).addClass('flex sticky top-0 z-10 bg-white shadow-lg p-2 border rounded-lg');
            
            
            calendar.updateSize();

            @this.on('resetEvents', (events) => {
                removeEvents = calendar.getEventSources();

                removeEvents.forEach(event => {
                    event.remove();
                });
                
                calendar.addEventSource( events[0] );
                calendar.updateSize();
            });
        });
    </script>
</div>
