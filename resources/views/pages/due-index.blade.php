<div>
    <div class="col-12 grid-margin stretch-card">
        <div class="card">
            <div class="card-body">
                <div class="d-flex align-items-center justify-content-between">
                    <h4 class="card-title">{{ __('message.all sales') }}</h4>
                    <div>
                        <select wire:model.live='filter_due' id="filter_time" class="form-control">
                            <option value="todays" selected>{{ __('message.todays') }}</option>
                            <option value="week">{{ __('message.week') }}</option>
                            <option value="month">{{ __('message.month') }}</option>
                            <option value="">{{ __('message.due') }}</option>
                        </select>
                    </div>
                    {{-- <button class="btn btn-facebook" wire:click='openModal()'>{{ __('message.add sales') }}</button>
                    --}}
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
                                <th>{{ __('message.product') }}</th>
                                <th>{{ __('message.customer') }}</th>
                                <th>{{ __('message.due') }}</th>
                                <th>{{ __('message.date') }}</th>
                                <th>{{ __('message.action') }}</th>
                            </tr>
                        </thead>
                        <tbody>
                            @php
                            $total_due = 0;
                            $total_due_amount = 0;
                            @endphp
                            @forelse ($dues as $index => $due)
                            <tr>
                                <td>{{ ++$index }}</td>
                                <td>{{ $due->sale->product->name }}</td>
                                <td>{{ $due->customer->name }}</td>
                                <td>{{ $due->amount }}</td>
                                <td>
                                    <span>{{ $due->created_at->diffForHumans()}}</span>
                                    <br>
                                    <span class="text-secondary">({{ $due->created_at->format('Y-m-d') }})</span>
                                </td>
                                </td>
                                <td>
                                    <button wire:click='deleteSale({{ $due }})'
                                        class="btn btn-google">{{ __('message.delete') }}</button>
                                </td>
                            </tr>
                            @php
                            $total_due_amount += $due->sale->due_amount;
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
            <div class="px-md-4">{{ $dues->links('livewire::bootstrap') }}</div>
            <div class="px-4 py-2 d-flex align-items-center justify-content-between">
                <h4>{{__('message.total_due')}} : {{ $total_due_amount . ' ' . __('message.tk') }}</h4>
            </div>
        </div>
    </div>
</div>