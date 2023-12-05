<div x-data="{}">
    <x-modal name="AppointmentModal">
        <x-slot name="header">
            <a wire:key="{{$appointment?->date->format('Y-m-d')}}" wire:click="toDateEventsModal({{ json_encode(['dateStr' => $appointment?->date->format('Y-m-d') ?? now()->format('Y-m-d')]) }})" class="font-semibold text-base text-white grid hover:bg-gray-200 hover:text-gray-600 aspect-square w-8 rounded-full content-center text-center h-min">
                <i class="fa-solid fa-arrow-left"></i>
            </a>
            <h1 class="font-bold  text-white w-full text-center">
                Appointment: 
            </h1>
            <a x-on:click="$dispatch('close')" class="font-semibold text-xl text-white grid hover:bg-gray-200 hover:text-gray-600 aspect-square w-8 rounded-full content-center text-center h-min">
                <i class="fa-solid fa-xmark"></i>
            </a>
        </x-slot>
        <div class="sm:flex w-full space-y-3 sm:space-y-0">
            <div class="sm:w-1/3 w-full p-2 space-y-3">
                <h1 class="font-bold text-black">Client:</h1>
                <div class="rounded-lg border shadow-md p-2 space-y-4 h-min">
                    <div class="sm:flex items-center sm:space-x-3 justify-between">
                        
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
                        <div class="flex items-center space-x-3 ">
                            <div class="w-1/4 bg-cover bg-no-repeat aspect-square rounded-full h-min" style="background-image: url({{asset($client->avatar ?? $client->telegram_chat->photo ?? '/storage/img/public/preview.jpg' )}})"></div>
                            <div class="w-3/4 overflow-hidden">
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
                            <div class="text-lg">
                                <i class="fa-solid {{$isClientFormOpen ? 'fa-circle-xmark' : 'fa-pen-to-square'}}" wire:click="$toggle('isClientFormOpen')"></i>
                            </div>
                        </div>
                    @endif
                    @if(!$client OR $isClientFormOpen)
                        <div class="space-y-4">
                            <div class="w-full space-y-4">
                                <div class="w-full" >
                                    <x-form.label for="first_name" value="{{ __('Name:') }}"/>
                                    <x-form.input wire:key="client-{{ rand(16000, 16999) }}" id="first_name" wire:model="first_name" type="text" class="w-full"  required/>
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
            </div>
            <div class="sm:w-2/3 w-full p-2 space-y-3">
                <h1 class="font-bold text-black">Information about appointment:</h1>
                <div class="rounded-lg border shadow-md p-2 space-y-4">
                    <div class="w-full overflow-auto" wire:key="status-{{ $appointment?->id * $appointment?->date->getTimestamp() * rand(6000,6999) }}">
                        <div class="flex space-x-2 items-center">
                            <div class="w-full">
                                <x-form.radio id="new" wire:model.live="status" name="status" class="hidden peer/new" value="new"/>
                                <x-form.label for="new" class="w-full border border-blue-500 rounded-lg p-3 peer-checked/new:bg-blue-500 peer-checked/new:text-white hover:bg-blue-100 text-center whitespace-nowrap cursor-pointer">
                                    {{ __('New')}}
                                </x-form.label>
                            </div>
                            <div class="w-full">
                                <x-form.radio id="done" wire:model.live="status" name="status" class="hidden peer/done" value="done"/>
                                <x-form.label for="done" class="w-full border border-green-500 rounded-lg p-3 peer-checked/done:bg-green-500 peer-checked/done:text-white hover:bg-green-100 text-center whitespace-nowrap cursor-pointer">
                                    {{ __('Done')}}
                                </x-form.label>
                            </div>
                            <div class="w-full">
                                <x-form.radio id="canceled" wire:model.live="status" name="status" class="hidden peer/canceled" value="canceled"/>
                                <x-form.label for="canceled" class="w-full border border-red-500 rounded-lg p-3 peer-checked/canceled:bg-red-500 peer-checked/canceled:text-white hover:bg-red-100 text-center whitespace-nowrap cursor-pointer">
                                    {{ __('Canceled')}}
                                </x-form.label>
                            </div>
                            <div class="w-full">
                                <x-form.radio id="no_done" wire:model.live="status" name="status" class="hidden peer/no_done" value="no_done"/>
                                <x-form.label for="no_done" class="w-full border border-red-500 rounded-lg p-3 peer-checked/no_done:bg-red-500 peer-checked/no_done:text-white hover:bg-red-100 text-center whitespace-nowrap cursor-pointer">
                                    {{ __('Do done')}}
                                </x-form.label>
                            </div>
                        </div>
                        <x-input-error :messages="$errors->get('status')" class="mt-2" />
                    </div>
                    <div class="sm:flex items-center sm:space-x-3 justify-between">
                        <div class="w-full flex space-x-2 sm:py-0">
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
                    <div class="w-full space-y-6">
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
            
                        <div class="w-full">
                            <x-input-label value="{{ __('Sub services:') }}"/>
                            <div wire:key="service-{{ $appointment?->id * $appointment?->date->getTimestamp() * rand(8000,8999) }}" class="w-full border rounded-lg p-2" >
                                @foreach ($company->sub_services as $service)
                                    <div class="flex space-x-2 items-center py-3">
                                        <x-form.label for="{{ $service->slug }}" class="w-full ">
                                            <div class="flex justify-between w-full items-center">
                                                <span>
                                                    {{ $service->name }} ({{$service->price}})
                                                </span>
                                                <x-form.checkbox id="{{ $service->slug }}" wire:model.live="sub_services" :value="$service->id"/>
                                            </div>
                                        </x-form.label>
                                    </div>
                                    @if(!$loop->last) <hr> @endif
                                @endforeach
                            </div>
                        </div>

                        <div class="whitespace-nowrap w-full justify-end text-right">
                            <span class="font-bold">
                                Total price: {{ $total_price }}
                            </span>
                        </div>
                        <hr>
            
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
            
                        <div class="w-full flex space-x-6">
                            @if ($status == 'done')
                                <div class="w-full">
                                    <x-input-label for="price" value="{{ __('Taken price:') }}"/>
                                    <x-form.input id="price" name="price" class="w-full" type="number" value="{{ $appointment?->price }}" required/>
                                    <x-input-error :messages="$errors->get('price')" class="mt-2" />
                                </div>
                            @endif
                        </div>
            
                        <div wire:key="{{ $appointment?->id * $appointment?->date->getTimestamp() * rand(7000,7999) }}" class="w-full" x-data="{ show: {{ $appointment?->comment == null ? 'false' : 'true' }} }">
                            <div class="flex items-center space-x-2" x-on:click="show= ! show">
                                <x-input-label for="comment" value="{{ __('Comment:') }}"/>
                                <p class="text-xl text-blue-600 cursor-pointer" x-text="show ? '-' : '+'" ></p>
                            </div>
                            <div :class="show ? 'block' : 'hidden'">
                                <x-form.textarea  id="comment" wire:model.live="comment" class="w-full"/>
                                <x-input-error :messages="$errors->get('comment')" class="mt-2" />
                            </div>
                        </div>
            
                        
                    </div>
                </div>
            </div>
        </div>
        {{-- CLIENT --}}
            
        {{-- CLIENT --}}

        {{-- APPOINTMENT --}}
        
            
        {{-- APPOINTMENT --}}
        <x-slot name="footer">
            <x-buttons.primary wire:click="save">
                {{ __('Save') }}
            </x-buttons.primary>
        </x-slot>
    </x-modal>
</div>
