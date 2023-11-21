<div class="space-y-6">
    <h1 class="p-4 text-white bg-gray-800 rounded-lg sticky top-1 text-2xl font-bold shadow">
        Choose employee:
    </h1>
    <div class="w-full space-y-6">
        @forelse ($web_app->company->employees as $employee)
        <div class="flex items-center space-x-2 employee @foreach($employee->services as $service) {{$service->slug}} @endforeach">
    
            <input type="radio" name="employee" id="{{ $employee->user->first_name }}" class="peer/{{ $employee->user->first_name }}" value="{{ $employee->id }}">
    
            <x-form.label for="{{ $employee->user->first_name }}" class="w-full bg-white border-2 rounded-lg p-4 sm:p-8 peer-checked/{{ $employee->user->first_name }}:border-blue-500" employee_id="{{ $employee->id }}">
                <div class="flex justify-between items-center">
                    <div class="flex items-center">
                        <div class="flex-col items-center my-auto">
                            <img src="{{ $employee->photo ?? null }}" alt="Avatar" class="mr-4 w-12 h-12 min-w-[48px] rounded-full">
                        </div>
                        <div class="flex-col justify-center">
                            <div>
                                <a href="" class="w-full text-md font-medium text-gray-900">
                                    {{ $employee->user->first_name ?? null }} {{ $employee->user->last_name ?? null }}
                                </a>
                            </div>
                            <div>
                                <a class="w-full text-sm font-light" href="">
                                    {{ $employee->description ?? null }}
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </x-form.label>
        </div>
        @empty
            
        @endforelse
    </div>
</div>



