<div x-data="{ hasChanged: true }" class="space-y-6">
    @if (isset($client_data['id']))
        <div class="space-y-6">
            <div class="flex items-center space-x-3 bg-white p-2 rounded-lg shadow-md">
                <div class="w-1/4 bg-cover bg-no-repeat aspect-square rounded-full h-min" style="background-image: url({{ asset($client_data['avatar']) }})"></div>
                <div class="w-3/4 overflow-hidden">
                    <a href="{{ route('admin.company.client.show', [$company, $client_data['id']]) }}" class="w-full text-md font-medium text-gray-900 hover:underline">
                        {{ $client_data['first_name'] ?? null }} {{ $client_data['last_name'] ?? null }}
                    </a>
                    <p class="text-sm text-gray-500">
                        {{ $client_data['email'] ?? null }}
                    </p>
                    <p class="text-sm text-gray-500">
                        {{ $client_data['phone'] ?? null }}
                    </p>
                </div>
                <div class="text-lg">
                    <i class="fa-solid {{$isClientFormOpen ? 'fa-circle-xmark' : 'fa-pen-to-square'}}" wire:click="toggleClientForm" x-on:click="hasChanged = true"></i>
                </div>
            </div>
            
            @if (!$isClientFormOpen)
                @if (!empty($client_data['social_media']) OR $client->telegram_chat)
                    <div class="flex w-full justify-start space-x-3 bg-white p-2 rounded-lg shadow-md items-center">
                        <h1 class="text-sm text-gray-500">
                            Social media:
                        </h1>
                        @if (!empty($client_data['social_media']['instagram']))
                            <a href="https://instagram.com/{{ str_replace('@', '', $client_data['social_media']['instagram']) }}" class="flex items-center space-x-1 text-2xl" target="_blank">
                                <i class="fa-brands fa-instagram text-pink-700"></i>
                            </a>
                        @endif
                        @if (!empty($client_data['social_media']['facebook']))
                            <a href="{{ $client_data['social_media']['facebook'] }}" class="flex items-center space-x-1 text-2xl" target="_blank">
                                <i class="fa-brands fa-facebook text-blue-700"></i>
                            </a>
                        @endif
                        @if (!empty($client_data['social_media']['telegram']) OR $client->telegram_chat)
                            <a href="{{ $client->telegram_chat->contact ?? "https://t.me/{$client_data['social_media']['telegram']}" }}" class="flex items-center space-x-1 text-2xl" target="_blank">
                                <i class="fa-brands fa-telegram text-blue-500"></i>
                            </a>
                        @endif
                    </div>
                @endif
                @if (isset($client_data['comment']))
                    <div class="space-y-3 bg-white p-2 rounded-lg shadow-md">
                        <p class="text-sm text-gray-500">
                            {{ $client_data['comment'] }}
                        </p>
                    </div>
                @endif
            @endif
        </div>
    @endif

    @if(!isset($client_data['id']) OR $isClientFormOpen)
        <form wire:submit="save" class="space-y-4" >
            <div class="bg-white p-2 rounded-lg space-y-4 shadow-md">
                <div class="w-full space-y-4">
                    <div class="w-full" wire:key="client-first_name-{{$client_id}}">
                        <x-form.label for="first_name" value="{{ __('Name:') }}"/>
                        <x-form.input id="first_name" wire:model="client_data.first_name" type="text" class="w-full" required x-on:change="hasChanged = false"/>
                    </div>
        
                    <div class="w-full" wire:key="client-last_name-{{$client_id}}">
                        <x-form.label for="last_name" value="{{ __('Surname:') }}"/>
                        <x-form.input id="last_name" wire:model="client_data.last_name" type="text" class="w-full" x-on:change="hasChanged = false"/>
                    </div>
                </div>
                <div class="w-full" wire:key="client-email-{{$client_id}}">
                    <x-form.label for="email" value="{{ __('Email:') }}"/>
                    <x-form.input id="email" wire:model="client_data.email" type="email" class="w-full" x-on:change="hasChanged = false"/>
                </div>
                <div class="w-full" wire:key="client-phone-{{$client_id}}">
                    <x-form.label for="phone" value="{{ __('Phone:') }}"/>
                    <x-form.input id="phone" wire:model="client_data.phone" type="text" class="w-full" x-on:change="hasChanged = false"/>
                </div>
            </div>
            
            <div class="bg-white p-2 rounded-lg shadow-md">
                <div class="w-full" wire:key="client-comment-{{$client_id}}">
                    <x-form.label for="comment" value="{{ __('Comment:') }}"/>
                    <x-form.textarea id="comment" wire:model="client_data.comment" class="w-full" x-on:change="hasChanged = false"/>
                </div>
            </div>
            
            <div class="bg-white p-2 rounded-lg space-y-4 shadow-md">
                <div class="w-full" wire:key="client-instagram-{{$client_id}}">
                    <x-form.label for="instagram" class="">
                        <span>
                            <i class="fa-brands fa-instagram text-pink-700"></i>
                            {{ __('Instagram:')}}
                        </span>
                        <x-form.input id="instagram" wire:model.live="client_data.social_media.instagram" type="text" class="w-full" x-on:change="hasChanged = false" placeholder="username"/>
                    </x-form.label>
                </div>
                <div class="w-full" wire:key="client-facebook-{{$client_id}}">
                    <x-form.label for="facebook" class="">
                        <span>
                            <i class="fa-brands fa-facebook text-blue-700"></i>
                            {{ __('Facebook:')}}
                        </span>
                        <x-form.input id="facebook" wire:model="client_data.social_media.facebook" type="text" class="w-full" x-on:change="hasChanged = false" placeholder="link"/>
                    </x-form.label>
                </div>
                <div class="w-full" wire:key="client-telegram-{{$client_id}}">
                    <x-form.label for="telegram" class="">
                        <span>
                            <i class="fa-brands fa-telegram text-blue-500"></i>
                            {{ __('Telegram:')}}
                        </span>
                        <x-form.input id="telegram" wire:model="client_data.social_media.telegram" type="text" class="w-full" x-on:change="hasChanged = false" placeholder="username"/>
                    </x-form.label>
                </div>
            </div>
            
            <x-buttons.primary x-bind:disabled="hasChanged" >
                {{ __('Save') }}
            </x-buttons.primary>
        </form>
    @endif
</div>

