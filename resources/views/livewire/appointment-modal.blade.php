<div>
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
        <div class="py-2 px-6 bg-blue-700 sm:flex items-center sm:space-x-3 justify-between">
            <div class="w-full flex space-x-2 py-2 sm:py-0">
                <x-form.select id="client" name="client" class="appointmentModalFormClient w-full">
                    <option value="">New client</option>
                    @forelse ($employee->company->clients as $client)
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

        {{-- <div class="py-2 px-6 bg-blue-700 sm:flex items-center sm:space-x-3 justify-between">
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
        </div> --}}
        <x-slot name="footer">
            <x-buttons.primary wire:click="store">
                {{ __('Create') }}
            </x-buttons.primary>
        </x-slot>
    </x-modal>
</div>
