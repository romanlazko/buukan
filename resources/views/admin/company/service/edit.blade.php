
<x-app-layout>
    <x-slot name="header">
        <div class="sm:flex items-center sm:space-x-3 w-max text-center">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                {{ __('Edit service:') }}
            </h2>
            <x-badge customColor="{{ $service->color }}">
                {{ $service->name ?? null }}
            </x-badge>
        </div>
        <x-header.menu>
            <x-header.link :href="route('admin.company.service.index', $company)" :active="request()->routeIs('admin.company.service.index')">
                {{ __('← Back') }}
            </x-header.link>
        </x-header.menu>
    </x-slot>

    <div class="w-full space-y-6 m-auto max-w-2xl">
        <form method="POST" action="{{ route('admin.company.service.update', [$company, $service]) }}" enctype='multipart/form-data'>
            @csrf
            @method('PATCH')
            <div class="space-y-6">
                <x-white-block>
                    <div class="space-y-4 sm:flex sm:space-x-4 sm:space-y-0">
                        <div class="">
                            <x-form.file id="img" name="img" type="file" class="hidden"/>
                            <x-form.label for="img" class="flex w-[9rem] aspect-square items-center overflow-hidden border relative">
                                <img id="photoPreview" src="{{ asset($service->img ?? null) }}" class="w-full">
                            </x-form.label>
                        </div>
                        <div class="space-y-4 w-full">
                            <div>
                                <x-form.label for="name" :value="__('Name:')" />
                                <x-form.input id="name" name="name" type="text" class="mt-1 block w-full" :value="old('name', $service->name)" required autocomplete="name" />
                                <x-form.error class="mt-2" :messages="$errors->get('name')" />
                            </div>
                            <div>
                                <x-form.label for="color" :value="__('Color:')" />
                                <x-form.color id="color" name="color" :value="old('color', $service->color)"/>
                                <x-form.error class="mt-2" :messages="$errors->get('color')" />
                            </div>
                        </div>
                    </div>
                </x-white-block>

                <x-white-block>
                    <div>
                        <x-form.label for="description" :value="__('Description:')" />
                        <x-form.textarea id="description" name="description" class="mt-1 block w-full" :value="old('description', $service->description)" />
                        <x-form.error class="mt-2" :messages="$errors->get('name')" />
                    </div>
                </x-white-block>

                <x-white-block>
                    <div>
                        <x-form.label for="price" :value="__('Price:')" />
                            <x-form.input id="price" name="price" type="number" class="mt-1 block w-full" :value="old('price', $service->price)"/>
                            <x-form.error class="mt-2" :messages="$errors->get('price')" />
                    </div>
                </x-white-block>
                
                <div class="flex justify-end">
                    <x-buttons.primary>{{ __('Save') }}</x-buttons.primary>
                </div>
            </div>
        </form>
    </div>
    @section('script')
        <script type="module">

            $(document).ready(function() {
                $('#img').change(function() {
                    $('#photoPreview').attr('src', '');

                    if (this.files && this.files[0]) {
                        var reader = new FileReader();

                        reader.onload = function (e) {
                            $('#photoPreview').attr('src', e.target.result);
                        };

                        reader.readAsDataURL(this.files[0]);
                    } 
                    
                });
            });
        </script>
    @endsection
</x-app-layout>
