<div x-data="{}">
    <x-modal name="AppointmentModal">
        <x-slot name="header">
            <a wire:key="{{$appointment?->date->format('Y-m-d')}}" wire:click="toDateEventsModal({{ json_encode(['dateStr' => $appointment?->date->format('Y-m-d')]) }})" class="font-semibold text-base text-white grid hover:bg-gray-200 hover:text-gray-600 aspect-square w-8 rounded-full content-center text-center h-min">
                <i class="fa-solid fa-arrow-left"></i>
            </a>
            <h1 class="font-bold  text-white w-full text-center">
                Appointment: 
            </h1>
            <a x-on:click="$dispatch('close')" class="font-semibold text-xl text-white grid hover:bg-gray-200 hover:text-gray-600 aspect-square w-8 rounded-full content-center text-center h-min">
                <i class="fa-solid fa-xmark"></i>
            </a>
        </x-slot>
        {{-- CLIENT --}}
            <div class="CLIENT">
                <div class="py-2 px-3 bg-blue-700 sm:flex items-center sm:space-x-3 justify-between">
                    <div class="w-full flex space-x-2 py-2 sm:py-0">
                        <x-form.select wire:key="{{ $appointment?->id * $appointment?->date->getTimestamp() * rand(1000,1999) }}" id="client" wire:model.live="clientId" class="w-full">
                            <option value="">New client</option>
                            @forelse ($company->clients as $item)
                                <option @selected($clientId == $item->id) value="{{ $item->id }}">{{ $item->first_name }} {{ $item->last_name }}</option>
                            @empty
                                
                            @endforelse
                        </x-form.select>
                    </div>
                </div>
            
                @if ($client)
                    <div class="flex items-center p-2 shadow-lg m-2 rounded-lg space-x-3 border">
                        <div class="w-20 bg-cover bg-no-repeat aspect-square rounded-full h-min" style="background-image: url({{asset($client->avatar ?? $client->telegram_chat->photo ?? '/storage/img/public/preview.jpg' )}})"></div>
                        <div class="">
                            <p class="w-full text-md font-medium text-gray-900">
                                {{ $client->first_name }} {{ $client->last_name }}
                            </p>
                            <p class="text-sm text-gray-500">
                                {{ $client->email }}
                            </p>
                            <p class="text-sm text-gray-500">
                                {{ $client->phone }}
                            </p>
                        </div>
                    </div>
                @else
                    <div class="p-3 space-y-6">
                        <div class="w-full space-y-6 sm:space-y-0 sm:flex sm:space-x-4">
                            <div class="w-full" >
                                <x-form.label for="first_name" value="{{ __('Name:') }}"/>
                                <x-form.input id="first_name" wire:model="first_name" type="text" class="w-full" value="{{ $client?->first_name }}" required/>
                            </div>
            
                            <div class="w-full" >
                                <x-form.label for="last_name" value="{{ __('Surname:') }}"/>
                                <x-form.input id="last_name" wire:model="last_name" type="text" class="w-full" value="{{ $client?->last_name }}"/>
                            </div>
                        </div>
            
                        <div class="w-full" >
                            <x-form.label for="email" value="{{ __('Email:') }}"/>
                            <x-form.input id="email" wire:model="email" type="email" class="w-full" value="{{ $client?->email }}"/>
                        </div>
            
                        <div class="w-full" >
                            <x-form.label for="phone" value="{{ __('Phone:') }}"/>
                            <x-form.input id="phone" wire:model="phone" type="text" class="w-full" value="{{ $client?->phone }}"/>
                        </div>
                    </div>
                    
                @endif
            </div>
        {{-- CLIENT --}}

        {{-- APPOINTMENT --}}
            <div class="py-2 px-6 bg-blue-700 sm:flex items-center sm:space-x-3 justify-between">
                <h1 class="w-full font-bold text-white">Appointment:</h1>
                <div class="w-full flex space-x-2 py-2 sm:py-0">
                    <x-form.select wire:key="{{ rand(2000,2999) }}" id="employee" wire:model.live="employeeId" class="w-full" required>
                        <option value="">Choose employee</option>
                        @if ($employee)
                            <option value="{{ $employee->id }}">{{ $employee->first_name }} {{ $employee->last_name }}</option>
                        @else
                            @forelse ($company->employees as $item)
                                <option @selected($employee->id == $item->id) wire:key="{{$item->slug}}" value="{{ $item->id }}">{{ $item->first_name }} {{ $item->last_name }}</option>
                            @empty
                                
                            @endforelse
                        @endif
                        
                    </x-form.select>
                    <x-text-input id="date" wire:model.live="date" type="date" class="w-full" wire:key="{{$date}}" value="{{ $date }}"/>
                </div>
            </div>
            <div class="w-full space-y-6 p-3">
                <div class="w-full">
                    <x-input-label for="service" value="{{ __('Service:') }}"/>
                    <x-form.select wire:key="service-{{ $appointment?->id * $appointment?->date->getTimestamp() * rand(3000,3999) }}" wire:change="setTerm('')" id="service" wire:model.live="serviceId" class="w-full">
                        <option value="">Choose service</option>
                        @forelse ($employee->services as $service_item)
                            <option wire:key="{{ $service_item?->id * $appointment?->date->getTimestamp() }}" value="{{ $service_item->id }}">{{ $service_item->name }} ({{ $service_item->price }})</option>
                        @empty
                            
                        @endforelse
                    </x-form.select>
                </div>
    
                {{-- <div class="w-full border rounded-lg p-2" >
                    @foreach ($company->sub_services as $service)
                        <div class="flex space-x-2 items-center py-3">
                            <x-form.label for="{{ $service->slug }}" class="w-full ">
                                <div class="flex justify-between w-full items-center">
                                    <span>
                                        {{ $service->name }} ({{$service->price}})
                                    </span>
                                    <x-form.checkbox id="{{ $service->slug }}" wire:model.live="subServices[]" :value="$service->id" type="checkbox"/>
                                </div>
                            </x-form.label>
                        </div>
                        @if(!$loop->last) <hr> @endif
                    @endforeach
                </div> --}}
    
                <div class="w-full">
                    <x-input-label for="term" value="{{ __('Term:') }}"/>
                    <x-form.input wire:key="{{ $appointment?->id * $appointment?->date->getTimestamp() * rand(4000,4999) }}" dropdown="termDropdown" id="term" wire:model.live="term" type="time" class="w-full" required value="{{ $term }}">
                        @foreach ($schedules as $schedule_item)
                            <button wire:key="{{ $schedule_item?->id * $schedule_item?->term->getTimestamp() * rand(5000,5999) }}" class="p-2 w-full hover:bg-gray-200 text-left dropdown-option" type="button" @click="termDropdown = false" value="{{ $schedule_item->term?->format('H:s') }}" wire:click="setTerm({{json_encode($schedule_item->term?->format('H:s'))}})">
                                {{ $schedule_item->term?->format('H:s') }}
                            </button>
                        @endforeach
                    </x-form.input>
                    <x-input-error :messages="$errors->get('term')" class="mt-2" />
                </div>
    
                <div class="w-full">
                    <x-input-label for="price" value="{{ __('Price:') }}"/>
                    <x-form.input id="price" name="price" class="w-full" type="number" value="{{ $appointment?->price }}"/>
                    <x-input-error :messages="$errors->get('price')" class="mt-2" />
                </div>
    
                <div class="w-full">
                    <x-input-label for="comment" value="{{ __('Comment:') }}"/>
                    <x-form.textarea id="comment" name="comment" class="w-full" value="{{ $appointment?->comment }}"/>
                    <x-input-error :messages="$errors->get('comment')" class="mt-2" />
                </div>
    
                <div class="w-full">
                    <x-input-label for="status" value="{{ __('Status:') }}"/>
                    <x-form.select wire:key="status-{{ $appointment?->id * $appointment?->date->getTimestamp() * rand(6000,6999) }}" id="status" wire:model.live="status" class="w-full">
                        <option value="new">New appointment</option>
                        <option value="canceled">Canceled appointment</option>
                        <option value="done">Done appointment</option>
                        <option value="no_done">No done appointment</option>
                    </x-form.select>
                    <x-input-error :messages="$errors->get('status')" class="mt-2" />
                </div>
            </div>
        {{-- APPOINTMENT --}}
        <x-slot name="footer">
            <x-buttons.primary wire:click="save">
                {{ __('Save') }}
            </x-buttons.primary>
        </x-slot>
    </x-modal>
</div>
