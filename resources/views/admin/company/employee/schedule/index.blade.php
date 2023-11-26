
<x-app-layout>
    <x-slot name="header">
        <div class="sm:flex items-center sm:space-x-3 w-max text-center">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight w-full text-center">
                {{ $employee->user->first_name}} {{ $employee->user->last_name}}:
            </h2>
            <x-buttons.secondary id="editScheduleButton" class="whitespace-nowrap">
                {{ __("Edit schedule") }}
            </x-buttons.secondary>
        </div>
        <x-header.menu>
            <x-header.link class="float-right" onclick="showAppointmentModal()">
                {{ __("✚ Add appointment") }}
            </x-header.link>
        </x-header.menu>
    </x-slot>
        
    <script src='https://cdn.jsdelivr.net/npm/fullcalendar@6.1.8/index.global.min.js'></script>
    
    <x-modal name="editEventModal">
        <div class="relative">

            <div class="py-2 px-6 bg-blue-700 flex items-center space-x-3  justify-between">
                <h1 class="font-bold  text-white">
                    Edit schedule:
                </h1>
            </div>
            <form method="post" id="editEventModalForm" >
                @csrf
                @method('patch')

                <div class="space-y-6 p-6">
                    <div class="w-full">
                        <x-input-label for="editEventDate" value="{{ __('Date') }}"/>
                        <x-text-input id="editEventDate" name="date" type="date" class="w-full"/>
                    </div>
    
                    <div class="w-full">
                        <x-input-label for="editEventTerm" value="{{ __('Term') }}"/>
                        <x-text-input id="editEventTerm" name="term" type="time" class="w-full"/>
                    </div>

                    <div class="w-full">
                        <x-input-label for="editEventService" value="{{ __('Service') }}"/>
                        <x-form.select id="editEventService" name="service" class="w-full">
                            @forelse ($employee->services as $service)
                                <option value="{{ $service->id }}">{{ $service->name }} ({{ $service->price }})</option>
                            @empty
                                
                            @endforelse
                        </x-form.select>
                    </div>

                    <div class="w-full">
                        <x-input-label for="editEventStatus" value="{{ __('Status') }}"/>
                        <x-form.select id="editEventStatus" name="status" class="w-full">
                            <option value="active">Active</option>
                            <option value="disable">Disable</option>
                        </x-form.select>
                    </div>
                </div>
            </form>

            <hr>

            <div class="flex justify-between w-full p-6">
                <x-buttons.delete id="deleteEventModalForm">
                    {{ __('Delete') }}
                </x-buttons.delete>
                <div>
                    <x-secondary-button x-on:click="$dispatch('close')">
                        {{ __('Close') }}
                    </x-secondary-button>
        
                    <x-primary-button class="ml-3" onclick="$('#editEventModalForm').submit()">
                        {{ __('Update') }}
                    </x-primary-button>
                </div>
            </div>
        </div>
    </x-modal>

    <x-modal.appointment-modal :company="$company"/>

    <x-modal name="createEventModal">
        <div class="relative">
            <form method="post" action="{{ route('admin.company.employee.schedule.store', [$company, $employee]) }}" class="" id="createEventModalForm">
                @csrf
                <div class="py-2 px-6 bg-blue-700 flex items-center space-x-3  justify-between">
                    <h1 class="font-bold  text-white">
                        Create new schedule:
                    </h1>
                </div>
                
                <div class="w-full space-y-6 p-6">
                    <div class="w-full flex space-x-2">
                        <div class="w-full">
                            <x-input-label for="start_date" value="{{ __('From:') }}"/>
                            <x-text-input id="start_date" name="start_date" type="date" class="w-full" value="{{ old('start_date', now()->format('Y-m-d')) }}"/>
                        </div>
                        <div class="w-full">
                            <x-input-label for="end_date" value="{{ __('To:') }}"/>
                            <x-text-input id="end_date" name="end_date" type="date" class="w-full" value="{{ old('end_date', now()->format('Y-m-d')) }}"/>
                        </div>
                    </div>
                    <div class="w-full">
                        <x-input-label for="editEventService" value="{{ __('Service') }}"/>
                        <x-form.select id="editEventService" name="service" class="w-full">
                            <option value="">Any service</option>
                            @forelse ($employee->services as $service)
                                <option value="{{ $service->id }}">{{ $service->name }} ({{ $service->price }})</option>
                            @empty
                                
                            @endforelse
                        </x-form.select>
                    </div>
                    <div class="w-full">
                        <x-input-label for="term" value="{{ __('Term:') }}"/>
                        <div class="flex space-x-2">
                            <x-form.area>
                                <select id="hours" name="hours" class="border-none rounded-l-md shadow-sm">
                                    <option value="0">00</option>
                                    <option value="1">01</option>
                                    <option value="2">02</option>
                                    <option value="3">03</option>
                                    <option value="4">04</option>
                                    <option value="5">05</option>
                                    <option value="6">06</option>
                                    <option value="7">07</option>
                                    <option value="8">08</option>
                                    <option value="9">09</option>
                                    <option value="10">10</option>
                                    <option value="11">11</option>
                                    <option value="12">12</option>
                                    <option value="13">13</option>
                                    <option value="14">14</option>
                                    <option value="15">15</option>
                                    <option value="16">16</option>
                                    <option value="17">17</option>
                                    <option value="18">18</option>
                                    <option value="19">19</option>
                                    <option value="20">20</option>
                                    <option value="21">21</option>
                                    <option value="22">22</option>
                                    <option value="23">23</option>
                                </select>
                                <select id="minutes" name="minutes" class="border-none rounded-r-md shadow-sm">
                                    <option value="00">00</option>
                                    <option value="01">01</option>
                                    <option value="02">02</option>
                                    <option value="03">03</option>
                                    <option value="04">04</option>
                                    <option value="05">05</option>
                                    <option value="06">06</option>
                                    <option value="07">07</option>
                                    <option value="08">08</option>
                                    <option value="09">09</option>
                                    <option value="10">10</option>
                                    <option value="11">11</option>
                                    <option value="12">12</option>
                                    <option value="13">13</option>
                                    <option value="14">14</option>
                                    <option value="15">15</option>
                                    <option value="16">16</option>
                                    <option value="17">17</option>
                                    <option value="18">18</option>
                                    <option value="19">19</option>
                                    <option value="20">20</option>
                                    <option value="21">21</option>
                                    <option value="22">22</option>
                                    <option value="23">23</option>
                                    <option value="24">24</option>
                                    <option value="25">25</option>
                                    <option value="26">26</option>
                                    <option value="27">27</option>
                                    <option value="28">28</option>
                                    <option value="29">29</option>
                                    <option value="30">30</option>
                                    <option value="31">31</option>
                                    <option value="32">32</option>
                                    <option value="33">33</option>
                                    <option value="34">34</option>
                                    <option value="35">35</option>
                                    <option value="36">36</option>
                                    <option value="37">37</option>
                                    <option value="38">38</option>
                                    <option value="39">39</option>
                                    <option value="40">40</option>
                                    <option value="41">41</option>
                                    <option value="42">42</option>
                                    <option value="43">43</option>
                                    <option value="44">44</option>
                                    <option value="45">45</option>
                                    <option value="46">46</option>
                                    <option value="47">47</option>
                                    <option value="48">48</option>
                                    <option value="49">49</option>
                                    <option value="50">50</option>
                                    <option value="51">51</option>
                                    <option value="52">52</option>
                                    <option value="53">53</option>
                                    <option value="54">54</option>
                                    <option value="55">55</option>
                                    <option value="56">56</option>
                                    <option value="57">57</option>
                                    <option value="58">58</option>
                                    <option value="59">59</option>
                                </select>
                            </x-form.area>
                        </div>
                        <x-input-error :messages="$errors->get('term')" class="mt-2" />
                    </div>
                </div>
            </form>

            <hr>

            <div class="flex justify-end w-full p-6">
                <x-buttons.secondary x-on:click="$dispatch('close')">
                    {{ __('Close') }}
                </x-buttons.secondary>
    
                <x-buttons.primary class="ml-3" onclick="$('#createEventModalForm').submit()">
                    {{ __('Create') }}
                </x-buttons.primary>
            </div>
        </div>
    </x-modal>

    <button id="editEventModalButton" class="hidden" x-data="" x-on:click.prevent="$dispatch('open-modal', 'editEventModal')"></button>
    <button id="createEventModalButton" class="hidden" x-data="" x-on:click.prevent="$dispatch('open-modal', 'createEventModal')"></button>

    <div class="w-full py-6 ">
        <x-white-block>
            <div id='calendar' class="text-[10px] sm:text-base"></div>
        </x-white-block>
    </div>

    {{-- @yield('appointment-script') --}}
    {{-- @stack('scripts') --}}
        
    @push('scripts')
        <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.29.1/moment.min.js"></script>
        <script>
            document.addEventListener('DOMContentLoaded', function() {
                var editMode = false;

                $('#editScheduleButton').click(toggleEditScheduleMod);

                function toggleEditScheduleMod() {
                    editMode = !editMode;
                    $('#editScheduleButton').toggleClass("bg-blue-400 text-white hover:bg-blue-300 animate-bounce");
                    $('.schedule').toggleClass('hover:border-yellow-500 border-none animate-pulse sm:hover:border-4 hover:border my-6 hover:animate-none editable-event');
                }

                function resetEditScheduleMod() {
                    if (editMode) {
                        editMode = false;
                        $('#editScheduleButton').removeClass("bg-blue-500 text-white hover:bg-blue-600 animate-bounce");
                        $('.schedule').addClass('border-none').removeClass('hover:border-yellow-500 animate-pulse sm:hover:border-4 hover:border my-6 hover:animate-none editable-event');
                    }
                }
                
                function openEditEventModal(event) {
                    $('#editEventModalButton').click();

                    $("#editEventModalForm").attr('action', "{{ route('admin.company.employee.schedule.update', [$company, $employee, '']) }}/"+event.id);
                    
                    const term = event.extendedProps.term;
                    const date = event.extendedProps.date;

                    $("#editEventTerm").attr('value', term);
                    $("#editEventDate").attr('value', date);

                    $('#deleteEventModalForm').attr('action', "{{ route('admin.company.employee.schedule.destroy', [$company, $employee, '']) }}/"+event.id);
                }
                var events = @json($events);
                var calendarEl = document.getElementById('calendar');
                var calendar = new FullCalendar.Calendar(calendarEl, {
                    height: 'auto',
                    initialView: 'dayGridMonth',
                    headerToolbar: {
                        left: 'title',
                        right: 'prev,next'
                    },
                    titleFormat: { year: 'numeric', month: 'short' }, 
                    dayHeaderFormat: { weekday: 'short', omitCommas: true }, 
                    eventTimeFormat: {
                        hour: '2-digit',
                        minute: '2-digit',
                        hour12: false
                    },
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
                    eventDisplay: 'block',
                    events: events,
                    defaultRangeSeparator: '-',
                    showNonCurrentDates: false,
                    fixedWeekCount: false,
                    eventClick: function (eventClickInfo) {
                        if ($(eventClickInfo.el).hasClass('editable-event')) {
                            openEditEventModal(eventClickInfo.event);
                        }else {
                            resetEditScheduleMod();
                            showAppointmentModal(eventClickInfo.event.extendedProps);
                        }
                    },
                    firstDay: 1,
                    dayMaxEventRows: true, 
                    selectable: true,
                    dateClick: function (info) {
                        resetEditScheduleMod();

                        $('#createEventModalButton').click();

                        var start_date = $('#start_date').attr('value', info.dateStr);
                        var end_date = $('#end_date').attr('value', '');
                    },
                    select: function (info) {
                        resetEditScheduleMod();
                        var startDate = moment(info.start);
                        var endDate = moment(info.end).add(-1, 'days');
                        var currentDate = startDate;

                        $('#createEventModalButton').click();


                        var start_date = $('#start_date');
                        var end_date = $('#end_date');

                        start_date.attr('value', info.startStr);

                        var inputDate = new Date(info.endStr);

                        inputDate.setDate(inputDate.getDate() - 1);

                        var year = inputDate.getFullYear();
                        var month = String(inputDate.getMonth() + 1).padStart(2, '0');
                        var day = String(inputDate.getDate()).padStart(2, '0');

                        var formattedDate = year + '-' + month + '-' + day;

                        end_date.attr('value', formattedDate);
                    },
                });
                calendar.render();
                $('.fc-view-harness').addClass('overflow-auto');
                // $('.fc-dayGridMonth-view').addClass('min-w-[850px] sm:min-w-[1240px] 2xl:min-w-full');
                
                calendar.updateSize();

                $(document).ready(function () {
                    const blockWidth = $(".fc-view-harness").width(); 
                    let scale = blockWidth; // начальный масштаб
                    const scaleStep = 10; // шаг масштабирования
                    let isDragging = false;
                    let startScale;

                    // Обработчик события колесика мыши
                    $(".fc-view-harness").on("wheel", function (e) {
                        e.preventDefault();

                        // Определение направления прокрутки
                        const delta = e.originalEvent.deltaY;
                        if (delta > 0) {
                            // Прокрутка вниз - уменьшение масштаба
                            scale -= scaleStep;
                        } else {
                            // Прокрутка вверх - увеличение масштаба
                            scale += scaleStep;
                        }

                        // Ограничение масштаба
                        scale = Math.max(blockWidth, Math.min(scale, 850));

                        // Применение масштаба к элементу
                        $(".fc-dayGridMonth-view").css("width", scale+"px");
                        calendar.updateSize();
                    });

                    $(".fc-view-harness").on("touchstart", function (e) {
                        isDragging = true;
                        startScale = scale;
                    });

                    // Обработчик события перемещения при касании
                    $(".fc-view-harness").on("touchmove", function (e) {
                        if (isDragging) {
                            e.preventDefault();

                            // Определение направления перемещения
                            const touch = e.originalEvent.touches[0];
                            const delta = touch.clientX - touch.pageX;

                            if (delta > 0) {
                                // Движение вправо - увеличение масштаба
                                scale += scaleStep;
                            } else {
                                // Движение влево - уменьшение масштаба
                                scale -= scaleStep;
                            }

                            // Ограничение масштаба
                            scale = Math.max(blockWidth, Math.min(scale, 850));

                            // Применение масштаба к элементу
                            $(".fc-dayGridMonth-view").css("width", scale + "px");
                            calendar.updateSize();
                        }
                    });

                    // Обработчик события завершения касания
                    $(".fc-view-harness").on("touchend", function (e) {
                        isDragging = false;
                    });
                    
                });
            });
        </script>
    @endpush
</x-app-layout>