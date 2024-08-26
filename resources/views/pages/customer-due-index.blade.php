<div>
    <div class="col-12 grid-margin stretch-card">
        <div class="card">
            <div class="card-body">
                <div class="d-flex align-items-center justify-content-between">
                    <h4 class="card-title">{{ __('message.customer_due') }}</h4>
                </div>
                </p>
                @session('success')
                <div class="alert alert-success">{{ session('success') }}</div>
                @endsession
                <div class="table-responsive">
                    <table class="table">
                        <thead>
                            <tr>
                                <th>{{ __('message.no') }}.</th>
                                <th>{{ __('message.customer') }}</th>
                                <th>{{ __('message.total_due') }}</th>
                                <th>{{ __('message.last_due_date') }}</th>
                                <th>{{ __('message.action') }}</th>
                            </tr>
                        </thead>
                        <tbody>
                            @php
                            $total_due = 0;
                            @endphp
                            @forelse ($customers as $index => $customer)
                            <tr>
                                <td>{{ ++$index }}</td>
                                <td> {{ $customer->name }} </td>
                                <td> {{ $customer->dues()->sum('amount'). ' '. __('message.tk') }} </td>
                                <td> {{ \Carbon\Carbon::parse($customer->dues()->latest()->first()->created_at)->format('d M, Y h:i A') }}
                                </td>
                                <td>
                                    <a href="" class="btn btn-primary">View List</a>
                                    <button wire:click='deleteSale({{ $customer }})'
                                        class="btn btn-google">{{ __('message.delete') }}</button>
                                </td>
                            </tr>
                            @php
                            $total_due += $customer->dues()->sum('amount');
                            @endphp
                            @empty
                            <tr>
                                <td colspan="5" class="text-center">{{ __('message.no data') }}.</td>
                            </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
            <div class="px-md-4">{{ $customers->links('livewire::bootstrap') }}
            </div>
            <div class="px-4 py-2">
                <h4>{{ __('message.total_due') }} : {{ $total_due . ' ' . __('message.tk') }}</h4>
            </div>
        </div>
    </div>
</div>