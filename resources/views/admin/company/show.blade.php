<x-app-layout>
    <x-slot name="navigation">
        <div class="flex items-center">
            <div class="flex-col items-center my-auto">
                <img src="{{ asset($company->logo) }}" alt="Avatar" class="mr-4 w-12 h-12 min-w-[48px] rounded-full">
            </div>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                {{ $company->name }}
            </h2>
        </div>
    </x-slot>

    <x-slot name="header">
        <div class="flex items-center space-x-2">
            <h2 class="font-semibold text-lg text-gray-800">
                {{ __("Dashboard:") }}
            </h2>
        </div>
    </x-slot>
    <div class="w-full p-3 space-y-3 sm:space-y-0 sm:flex sm:space-x-3">
        <div class="w-full sm:w-1/3 space-y-3">
            <div class="w-full bg-white p-6 rounded-lg shadow-md">
                <h2 class="text-lg font-semibold mb-4">
                    {{ __('Clients') }}
                </h2>
                <p class="text-3xl font-bold text-indigo-500">{{ $clientsCount }}</p>
            </div>
            <div class="w-full bg-white p-6 rounded-lg shadow-md">
                <h2 class="text-lg font-semibold mb-4">
                    {{ __('Booking statistics') }}
                </h2>
                <ul class="list-inside space-y-2">
                    @foreach ($bookingStats as $service => $count)
                        <li class="flex items-center">
                            <span class="text-gray-600">{{ $service }}:</span>
                            <span class="ml-2 font-semibold text-indigo-600">{{ $count }}</span>
                        </li>
                    @endforeach
                </ul>
            </div>
        </div>
        
        <div class="w-full sm:w-2/3 bg-white p-6 rounded-lg shadow-md">
            <h2 class="text-lg font-semibold">
                {{ __('Sales per month') }}
            </h2>
            <canvas id="salesChart" class="w-full"></canvas>
        </div>
    </div>

    @push('library')
        <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    @endpush
    @push('scripts')
        <script>
            var ctx = document.getElementById('salesChart').getContext('2d');
            var salesData = {!! json_encode($salesData) !!};

            var salesChart = new Chart(ctx, {
                type: 'bar',
                data: {
                    labels: salesData.labels,
                    datasets: [{
                        label: 'Продажи',
                        data: salesData.values,
                        backgroundColor: 'rgba(75, 192, 192, 0.2)',
                        borderColor: 'rgba(75, 192, 192, 1)',
                        borderWidth: 1
                    }]
                },
                options: {
                    scales: {
                        y: {
                            beginAtZero: true
                        }
                    }
                }
            });
        </script>
    @endpush

</x-app-layout>