<div>
    <x-modal name="AppointmentModal">
        <x-slot name="header">
            <x-a-buttons.back wire:key="{{ $appointmentForm->date }}" wire:click="openModal('DateEventsModal', {{ json_encode(['dateStr' => $appointmentForm->date ?? now()->format('Y-m-d')]) }})" class="text-white hover:bg-gray-200 hover:text-gray-600"/>
            <h1 class="font-bold  text-white w-full text-center">
                Appointment: 
            </h1>
            <x-a-buttons.close x-on:click="$dispatch('close-all-modal')"/>
        </x-slot>

        @dump($appointmentForm->service_id)

        <form class="sm:flex w-full space-y-3 sm:space-y-0" >
            {{-- CLIENT --}}
                <div class="sm:w-1/3 w-full p-2 space-y-3">
                    <h1 class="font-bold text-black">Client:</h1>
                    <div class="space-y-4 h-min">
                        <x-form.select wire:key="appointment-client-{{$appointmentForm->client_id}}" id="client" wire:model.live="appointmentForm.client_id" class="w-full" >
                            <option value="">New client</option>
                            @forelse ($company->clients as $client_item)
                                <option value="{{ $client_item->id }}">{{ $client_item->first_name }} {{ $client_item->last_name }}</option>
                            @empty
                                
                            @endforelse
                        </x-form.select>
                        <livewire:client :company="$company" client_id="{{ $appointmentForm->client_id }}" />
                    </div>
                </div>
            {{-- CLIENT --}}

            {{-- APPOINTMENT --}}
                <div class="sm:w-2/3 w-full p-2 space-y-3 {{$formDisabled ? 'opacity-25' : ''}}" wire:key="appointment-{{$appointmentForm->key}}">
                    <h1 class="font-bold text-black">Information about appointment:</h1>
                    <div class="space-y-4">

                        <div class="w-full overflow-auto shadow-md p-2 space-y-4 bg-white rounded-md">
                            <div class="flex space-x-2 items-center" wire:key="appointment-status-{{$appointmentForm->key}}">
                                <div class="w-full">
                                    <x-form.radio id="new" wire:model.live="appointmentForm.status" name="status" class="hidden peer/new" value="new" :disabled="$formDisabled"/>
                                    <x-form.label for="new" class="w-full border border-blue-500 rounded-lg p-3 peer-checked/new:bg-blue-500 peer-checked/new:text-white hover:bg-blue-100 text-center whitespace-nowrap cursor-pointer">
                                        {{ __('New')}}
                                    </x-form.label>
                                </div>
                                <div class="w-full">
                                    <x-form.radio id="done" wire:model.live="appointmentForm.status" name="status" class="hidden peer/done" value="done" :disabled="$formDisabled"/>
                                    <x-form.label for="done" class="w-full border border-green-500 rounded-lg p-3 peer-checked/done:bg-green-500 peer-checked/done:text-white hover:bg-green-100 text-center whitespace-nowrap cursor-pointer">
                                        {{ __('Done')}}
                                    </x-form.label>
                                </div>
                                <div class="w-full">
                                    <x-form.radio id="canceled" wire:model.live="appointmentForm.status" name="status" class="hidden peer/canceled" value="canceled" :disabled="$formDisabled"/>
                                    <x-form.label for="canceled" class="w-full border border-red-500 rounded-lg p-3 peer-checked/canceled:bg-red-500 peer-checked/canceled:text-white hover:bg-red-100 text-center whitespace-nowrap cursor-pointer">
                                        {{ __('Canceled')}}
                                    </x-form.label>
                                </div>
                                <div class="w-full">
                                    <x-form.radio id="no_done" wire:model.live="appointmentForm.status" name="status" class="hidden peer/no_done" value="no_done" :disabled="$formDisabled"/>
                                    <x-form.label for="no_done" class="w-full border border-red-500 rounded-lg p-3 peer-checked/no_done:bg-red-500 peer-checked/no_done:text-white hover:bg-red-100 text-center whitespace-nowrap cursor-pointer">
                                        {{ __('No done')}}
                                    </x-form.label>
                                </div>
                            </div>
                            <x-form.error :messages="$errors->get('appointmentForm.status')" class="mt-2" />
                        </div>

                        <div class="sm:flex items-center sm:space-y-0 sm:space-x-3 justify-between shadow-md p-2 space-y-4 bg-white rounded-md">
                            <div class="w-full flex space-x-2">
                                <x-form.select wire:key="appointment-employee-{{ $appointmentForm->key }}" id="employee" wire:model.live="appointmentForm.employee_id" class="w-full" required :disabled="$formDisabled">
                                    <option value="">Choose employee</option>
                                    @forelse ($company->employees()->role('employee')->get() as $employee_item)
                                        <option value="{{ $employee_item->id }}">{{ $employee_item->first_name }} {{ $employee_item->last_name }}</option>
                                    @empty
                                        
                                    @endforelse
                                </x-form.select>
                                <x-form.error :messages="$errors->get('appointmentForm.employee')" class="mt-2" />
                            </div>
                            <div>
                                <x-form.input wire:key="appointment-date-{{ $appointmentForm?->key }}" id="date" wire:model.live="appointmentForm.date" type="date" class="w-full" :disabled="$formDisabled"/>
                                <x-form.error :messages="$errors->get('appointmentForm.date')" class="mt-2" />
                            </div>
                        </div>

                        @if ($employee)
                            <div class="w-full shadow-md p-2 space-y-4 bg-white rounded-md">
                                <div class="w-full" >
                                    <x-form.label for="service" value="{{ __('Service:') }}"/>
                                    <x-form.select wire:key="appointment-service-{{ $appointmentForm?->key }}" wire:model.live="appointmentForm.service_id" wire:change="$set('appointmentForm.term', '')" class="w-full" :disabled="$formDisabled">
                                        <option value="">Choose service</option>
                                        @if($employee?->services)
                                            @forelse ($employee?->services as $service_index => $service_item)
                                                <option wire:key="appointment-service-{{ $service_index }}-{{ $appointmentForm?->key}}" @disabled(!$service_item->active)  value="{{ $service_item->id }}">{{ $service_item->name }} ({{ $service_item->price }})</option>
                                            @empty
                                                
                                            @endforelse
                                        @endif
                                    </x-form.select>
                                    <x-form.error :messages="$errors->get('appointmentForm.service')" class="mt-2" />
                                </div>

                                @if ($employee AND $appointmentForm->service_id AND $appointmentForm->date) 
                                    <div class="w-full" wire:key="appointment-term-{{ $appointmentForm->key }}">
                                        <x-form.label for="term" value="{{ __('Term:') }}"/>
                                        <x-form.input dropdown="termDropdown" id="term" wire:model.live="appointmentForm.term" type="time" class="w-full" required :disabled="$formDisabled">
                                            @foreach ($schedules as $schedule_index => $schedule_item)
                                                <button wire:key="appointment-term-{{ $schedule_index }}-{{ $appointmentForm->key }}" class="p-2 w-full hover:bg-gray-200 text-left dropdown-option" type="button" @click="termDropdown = false" wire:click="$set('appointmentForm.term', {{ json_encode($schedule_item->term?->format('H:i')) }})" >
                                                    {{ $schedule_item->term?->format('H:i') }}
                                                </button>
                                            @endforeach
                                        </x-form.input>
                                        <x-form.error :messages="$errors->get('appointmentForm.term')" class="mt-2" />
                                    </div>
                                @endif
                    
                                @if ($company->sub_services->isNotEmpty())
                                    <div class="w-full" wire:key="appointment-sub-services-{{ $appointmentForm->key }}">
                                        <x-form.label value="{{ __('Sub services:') }}"/>
                                        <div class="w-full border rounded-lg p-2" >
                                            @foreach ($company->sub_services as $sub_service_item)
                                                <div class="flex space-x-2 items-center py-3">
                                                    <x-form.label for="{{ $sub_service_item->slug }}" class="w-full ">
                                                        <div class="flex justify-between w-full items-center">
                                                            <span>
                                                                {{ $sub_service_item->name }} ({{ $sub_service_item->price }})
                                                            </span>
                                                            <x-form.checkbox wire:key="appointment-sub-services-{{ $sub_service_item->id }}" id="{{ $sub_service_item->slug }}" wire:model.live="appointmentForm.sub_services" :value="$sub_service_item->id"  :disabled="$formDisabled"/>
                                                        </div>
                                                    </x-form.label>
                                                </div>
                                                @if(!$loop->last) <hr> @endif
                                            @endforeach
                                        </div>
                                    </div>
                                @endif
                                
                            </div>
                        @endif
                        <div class="whitespace-nowrap w-full justify-end text-right">
                            <span class="font-bold">
                                Total price: {{ $total_price?->amount }} {{ $total_price?->currency }}
                            </span>
                        </div>
                        <div class="shadow-md p-2 space-y-4 bg-white rounded-md">
                            @if ($appointmentForm->status == 'done')
                                <x-form.label for="price" value="{{ __('Taken price:') }}"/>
                                <div class="flex w-full space-x-2">
                                    <div wire:key="appointment-price-{{ $appointmentForm?->key }}" class="w-full">
                                        <x-form.input id="price" wire:model.live="appointmentForm.price" class="w-full" type="number" required :disabled="$formDisabled"/>
                                        <x-form.error :messages="$errors->get('appointmentForm.price')" class="mt-2"/>
                                    </div>
                                    <div wire:key="appointment-currency-{{ $appointmentForm?->key }}" class="w-full">
                                        <x-form.select id="currency" class="w-full" wire:model.live="appointmentForm.currency">
                                            <option value="">Select currency</option>
                                            <option value="CZK">CZK</option>
                                            <option value="EUR">EUR</option>
                                            <option value="USD">USD</option>
                                        </x-form.select>
                                        <x-form.error :messages="$errors->get('appointmentForm.currency')" class="mt-2"/>
                                    </div>
                                </div>
                            @endif
                
                            <div  class="w-full" x-data="{ show: false }">
                                <div class="flex items-center space-x-2" x-on:click="show= ! show">
                                    <x-form.label for="comment" value="{{ __('Comment:') }}"/>
                                    <p class="text-xl text-blue-600 cursor-pointer" x-text="show ? '-' : '+'" ></p>
                                </div>
                                <div wire:key="appointment-comment-{{ $appointmentForm?->key }}" :class="show ? 'block' : 'hidden'">
                                    <x-form.textarea id="comment" wire:model.live="appointmentForm.comment" class="w-full" :disabled="$formDisabled"/>
                                    <x-form.error :messages="$errors->get('appointmentForm.comment')" class="mt-2" />
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            {{-- APPOINTMENT --}}
        </form>

        <x-slot name="footer">
            @if (!$formDisabled)
                <x-buttons.primary wire:click="save" :disabled="$formDisabled OR !$employee OR !$appointmentForm->service_id OR !$appointmentForm->date OR !$appointmentForm->term">
                    {{ __('Save') }}
                </x-buttons.primary>
            @endif
        </x-slot>
    </x-modal>
</div>
