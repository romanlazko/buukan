
<x-app-layout>
    <x-slot name="header">
        <div class="sm:flex items-center sm:space-x-3 w-max">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight w-full text-center flex whitespace-nowrap items-center">
                <a class="text-gray-600 hidden lg:grid hover:bg-gray-200 aspect-square mr-5 w-8 rounded-full content-center" href="{{ route('admin.company.employee.show', [$company, $employee]) }}">
                    {{ __('←') }}
                </a>
                <p>
                    {{ $employee->first_name }} {{ $employee->last_name }}
                </p>
            </h2>
            <x-buttons.secondary id="editScheduleButton" class="whitespace-nowrap">
                {{ __("Edit schedule") }}
            </x-buttons.secondary>
        </div>
        <x-header.menu>
            <x-header.link :href="route('admin.company.employee.show', [$company, $employee])" :active="request()->routeIs('admin.company.employee.show')">
                {{ __('Card') }}
            </x-header.link>
            <x-header.link href="{{ route('admin.company.employee.schedule.index', [$company, $employee]) }}" :active="request()->routeIs('admin.company.employee.schedule.index')">
                {{ __("Callendar") }}
            </x-header.link>
            <x-header.link href="{{ route('admin.company.employee.schedule.example', [$company, $employee]) }}" :active="request()->routeIs('admin.company.employee.schedule.example')">
                {{ __("Example Callendar") }}
            </x-header.link>
            <x-header.link class="float-right" x-data="" x-on:click.prevent="$dispatch('open-modal', 'appointmentModal')">
                <i class="fa-solid fa-circle-plus mr-1 text-indigo-700"></i>
                {{ __("Add appointment") }}
            </x-header.link>
        </x-header.menu>
    </x-slot>
        
    <script src='https://cdn.jsdelivr.net/npm/fullcalendar@6.1.8/index.global.min.js'></script>
    
    {{-- <x-modal name="editEventModal">
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
                            <option value="">Any service</option>
                            @forelse ($employee->services as $service)
                                <option value="{{ $service->id }}">{{ $service->name }} ({{ $service->price }})</option>
                            @empty
                                
                            @endforelse
                        </x-form.select>
                    </div>

                    <div class="w-full">
                        <x-input-label for="editEventActive" value="{{ __('Status') }}"/>
                        <x-form.select id="editEventActive" name="active" class="w-full">
                            <option value="1">Active</option>
                            <option value="0">Disable</option>
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
    </x-modal> --}}

    {{-- <x-modal name="appointmentModal" id="appointmentModal" show="{{(session('errors')) ? true:false}}">
        <div class="w-full">
            <form method="post" class="" id="appointmentModalForm">
                @csrf
                @method('POST')

                <div class="py-2 px-6 bg-blue-700 sm:flex items-center sm:space-x-3 justify-between">
                    <h1 class="w-full font-bold text-white">Client:</h1>
                    <div class="w-full flex space-x-2 py-2 sm:py-0">
                        <x-form.select id="client" name="client" class="appointmentModalFormClient w-full">
                            <option value="">New client</option>
                            @forelse ($company->clients as $client)
                                <option @selected( old('client', request()->client) == $client->id) value="{{ $client->id }}">{{ $client->first_name }} {{ $client->last_name }}</option>
                            @empty
                                
                            @endforelse
                        </x-form.select>
                    </div>
                </div>

                <div class="p-6 space-y-6">
                    <div class="w-full flex space-x-4">
                        <div class="w-full" >
                            <x-input-label for="first_name" value="{{ __('Name:') }}"/>
                            <x-text-input id="first_name" name="first_name" type="text" class="w-full appointmentModalFormClientFirstName" value="{{ old('first_name') }}" required/>
                        </div>

                        <div class="w-full" >
                            <x-input-label for="last_name" value="{{ __('Surname:') }}"/>
                            <x-text-input id="last_name" name="last_name" type="text" class="w-full appointmentModalFormClientLastName" value="{{ old('last_name') }}"/>
                        </div>
                    </div>

                    <div class="w-full" >
                        <x-input-label for="email" value="{{ __('Email:') }}"/>
                        <x-text-input id="email" name="email" type="email" class="w-full appointmentModalFormClientEmail" value="{{ old('email') }}"/>
                    </div>

                    <div class="w-full" >
                        <x-input-label for="phone" value="{{ __('Phone:') }}"/>
                        <x-text-input id="phone" name="phone" type="text" class="w-full appointmentModalFormClientPhone" value="{{ old('phone') }}"/>
                    </div>

                    <div class="w-full" >
                        <button class="text-yellow-700 hover:underline socialMediaButton" type="button">+ social media</button>
                    </div>
                    

                    <div class="socialMediaBlock hidden">
                        <div class="space-y-6">
                            <div class="w-full" >
                                <x-input-label for="instagram" value="{{ __('Instagram:') }}"/>
                                <x-text-input id="instagram" name="instagram" type="text" class="w-full" value="{{ old('instagram') }}" placeholder="link or @nickname"/>
                            </div>

                            <div class="w-full" >
                                <x-input-label for="telegram" value="{{ __('Telegram:') }}"/>
                                <x-text-input id="telegram" name="telegram" type="text" class="w-full" value="{{ old('telegram') }}" placeholder="link or @nickname"/>
                            </div>

                            <div class="w-full" >
                                <x-input-label for="facebook" value="{{ __('Facebook:') }}"/>
                                <x-text-input id="facebook" name="facebook" type="text" class="w-full" value="{{ old('facebook') }}" placeholder="link or @nickname"/>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="py-2 px-6 bg-blue-700 sm:flex items-center sm:space-x-3 justify-between">
                    <h1 class="w-full font-bold text-white">Appointment:</h1>
                    <div class="w-full flex space-x-2 py-2 sm:py-0">
                        <x-form.select id="employee" name="employee" class="w-full appointmentModalFormEmployee" required>
                            <option value="">Choose employee</option>
                            @forelse ($company->employees as $company_employee)
                                <option  value="{{ $company_employee->id }}">{{ $company_employee->user->first_name }} {{ $company_employee->user->last_name }}</option>
                            @empty
                                
                            @endforelse
                        </x-form.select>
                        <x-text-input id="date" name="date" type="date" class="w-full appointmentModalFormDate" value="{{ old('date', request('date', now()->format('Y-m-d'))) }}"/>
                    </div>
                </div>
                <div class="w-full space-y-6 p-6">
                    <div class="w-full" >
                        <x-input-label for="service" value="{{ __('Service:') }}"/>
                        <x-form.select id="service" name="service" class="w-full appointmentModalFormService appointmentSelector" required>
                        </x-form.select>
                    </div>

                    <div class="w-full" >
                        @foreach ($company->sub_services as $service)
                            <div class="flex space-x-2 items-center py-3">
                                <x-form.label for="{{ $service->slug }}" class="w-full ">
                                    <div class="flex justify-between w-full items-center">
                                        <span>
                                            {{ $service->name }} ({{$service->price}})
                                        </span>
                                        <x-form.checkbox id="{{ $service->slug }}" name="sub_services[]" :value="$service->id" type="checkbox" class="appointmentModalFormSubService"/>
                                    </div>
                                </x-form.label>
                            </div>
                            @if(!$loop->last) <hr> @endif
                        @endforeach
                    </div>

                    <div class="w-full">
                        <x-input-label for="term" value="{{ __('Term:') }}"/>
                        <x-form.input dropdown="termDropdown" id="term" name="term" type="time" class="w-full appointmentModalFormTerm" value="{{ old('term', now()->format('H:i')) }}" required/>
                        <x-input-error :messages="$errors->get('term')" class="mt-2" />
                    </div>

                    <div class="w-full">
                        <x-input-label for="price" value="{{ __('Price:') }}"/>
                        <x-form.input id="price" name="price" class="w-full appointmentModalFormPrice" type="number"/>
                        <x-input-error :messages="$errors->get('price')" class="mt-2" />
                    </div>

                    <div class="w-full">
                        <x-input-label for="comment" value="{{ __('Comment:') }}"/>
                        <x-form.textarea id="comment" name="comment" class="w-full appointmentModalFormComment"/>
                        <x-input-error :messages="$errors->get('comment')" class="mt-2" />
                    </div>

                    <div class="w-full">
                        <x-input-label for="status" value="{{ __('Status:') }}"/>
                        <x-form.select id="status" name="status" class="w-full appointmentModalFormStatus">
                            <option value="new">New appointment</option>
                            <option value="canceled">Canceled appointment</option>
                            <option value="done">Done appointment</option>
                            <option value="no_done">No done appointment</option>
                        </x-form.select>
                        <x-input-error :messages="$errors->get('comment')" class="mt-2" />
                    </div>
                </div>
                <hr>
                <div class="flex justify-end w-full p-6">
                    <x-secondary-button x-on:click="$dispatch('close')">
                        {{ __('Close') }}
                    </x-secondary-button>
        
                    <x-primary-button class="ml-3" type="submit" >
                        {{ __('Save') }}
                    </x-primary-button>
                </div>
            </form>
        </div>
    </x-modal> --}}

    {{-- <x-modal name="createEventModal">
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
    </x-modal> --}}

    <div class="w-full py-6 bg-white">
        <livewire:calendar :employee="$employee">
    </div>
</x-app-layout>