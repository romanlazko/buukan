<div>
    <x-modal name="CreateEventModal">
        <x-slot name="header">
            <a wire:key="{{$start_date}}" wire:click="toDateEventsModal({{ json_encode(['dateStr' => $start_date]) }})" class="font-semibold text-base text-white grid hover:bg-gray-200 hover:text-gray-600 aspect-square w-8 rounded-full content-center text-center h-min">
                <i class="fa-solid fa-arrow-left"></i>
            </a>
            <h1 class="font-bold  text-white w-full text-center">
                Create new schedule: {{ $start_date }}
            </h1>
            <a x-on:click="$dispatch('close')" class="font-semibold text-xl text-white grid hover:bg-gray-200 hover:text-gray-600 aspect-square w-8 rounded-full content-center text-center h-min">
                <i class="fa-solid fa-xmark"></i>
            </a>
        </x-slot>

        <form class="w-full space-y-6 p-2">
            <div class="w-full flex space-x-2 p-2 bg-white rounded-md shadow-sm">
                <div class="w-full">
                    <x-input-label for="start_date" value="{{ __('From:') }}"/>
                    <x-text-input wire:key="start_date-{{ rand(10000, 10999) }}" id="start_date" type="date" class="w-full" wire:model.live="start_date"/>
                </div>
                <div class="w-full">
                    <x-input-label for="end_date" value="{{ __('To:') }}"/>
                    <x-text-input wire:key="end_date-{{ rand(10000, 10999) }}" id="end_date" type="date" class="w-full" wire:model.live="end_date"/>
                </div>
            </div>
            <div class="w-full p-2 bg-white rounded-md shadow-sm">
                <x-input-label for="term" value="{{ __('Term:') }}"/>
                <div class="flex space-x-2">
                    <x-form.area>
                        <select wire:key="hours-{{ rand(12000, 12999) }}" id="hours" wire:model.live="hours" class="border-none rounded-l-md shadow-sm">
                            <option selected value="00">00</option>
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
                        </select>
                        <select wire:key="minutes-{{ rand(13000, 13999) }}" id="minutes" wire:model.live="minutes" class="border-none rounded-r-md shadow-sm">
                            <option selected value="00">00</option>
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
            <div class="w-full p-2 bg-white rounded-md shadow-sm">
                <x-input-label for="service" value="{{ __('Service') }}"/>
                <x-form.select wire:key="service-{{ rand(11000, 11999) }}" id="service" wire:model.live="service_id" class="w-full">
                    <option value="">Any service</option>
                    @forelse ($employee->services as $service_item)
                        <option value="{{ $service_item->id }}">{{ $service_item->name }} ({{ $service_item->price }})</option>
                    @empty
                        
                    @endforelse
                </x-form.select>
            </div>
        </form>

        <x-slot name="footer">
            <x-buttons.primary wire:click="store">
                {{ __('Create') }}
            </x-buttons.primary>
        </x-slot>
    </x-modal>
</div>
