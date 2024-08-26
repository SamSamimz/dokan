<div>
    <div class="col-12 grid-margin stretch-card">
        <div class="card">
            <div class="card-body">
                <div class="d-flex align-items-center justify-content-between">
                    <h4 class="card-title">{{ __('message.all categories') }}</h4>
                    <div>
                        <input wire:model.live='search' type="search" class="form-control shadow-sm" placeholder="{{ __('message.search') }}">
                    </div>
                    <button class="btn btn-facebook" wire:click.prevent="$dispatch('open-modal')">{{ __('message.add categories') }}</button>
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
                                <th>{{ __('message.name') }}</th>
                                <th>{{ __('message.email') }}</th>
                                <th>{{ __('message.address') }}</th>
                                <th>{{ __('message.phone') }}</th>
                                <th>{{ __('message.action') }}</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($customers as $index => $customer)
                            <tr class="{{ strtolower($search) == strtolower($customer->name) ? 'bg-warning' : null }}">
                                <td>{{ ++$index }}</td>
                                <td>{{ $customer->name }}</td>
                                <td>{{ $customer->email }}</td>
                                <td>{{ $customer->address }}</td>
                                <td>{{ $customer->phone }}</td>
                                <td>
                                    <button wire:click='editCustomer({{ $customer }})' class="btn btn-facebook">{{ __('message.edit') }}</button>
                                    <button  wire:click='deleteCustomer({{ $customer }})' class="btn btn-google">{{ __('message.delete') }}</button>
                                </td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="5" class="text-center">{{ __('message.no data') }}.</td>
                            </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
                </div>
            <div class="px-md-4">{{ $customers->links('livewire::bootstrap') }}</div>
        </div>
    </div>
    <!-- Modal -->
    <div wire:ignore.self class="modal fade" id="customerModal" data-backdrop="static" data-keyboard="false"
        tabindex="-1" aria-labelledby="customerModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="customerModalLabel">{{ __('message.add customer') }}</h5>
                    <button type="button" class="close" wire:click.prevent="$dispatch('close-modal')">
                        <span>&times;</span>
                    </button>
                </div>
                <form wire:submit.prevent='addCustomer()' class="forms-sample">
                    <div class="modal-body">
                        <div>
                            <div class="form-group">
                                <label for="name">{{ __('message.name') }} :</label>
                                <input wire:model.defer='name' type="text" class="form-control" id="name"
                                    autocomplete="off" placeholder="{{ __('message.categoryname') }}" />
                                @error('name')
                                <p class="text-danger">{{ $message }}</p>
                                @enderror
                            </div>

                            <div class="form-group">
                                <label for="email">{{ __('message.email') }} :</label>
                                <input wire:model.defer='email' type="text" class="form-control" id="email"
                                    autocomplete="off" placeholder="{{ __('message.email') }}" />
                                @error('email')
                                <p class="text-danger">{{ $message }}</p>
                                @enderror
                            </div>

                            <div class="form-group">
                                <label for="address">{{ __('message.address') }} :</label>
                                <input wire:model.defer='address' type="text" class="form-control" id="address"
                                    autocomplete="off" placeholder="{{ __('message.address') }}" />
                                @error('address')
                                <p class="text-danger">{{ $message }}</p>
                                @enderror
                            </div>

                            <div class="form-group">
                                <label for="phone">{{ __('message.phone') }} :</label>
                                <input wire:model.defer='phone' type="text" class="form-control" id="phone"
                                    autocomplete="off" placeholder="{{ __('message.phone') }}" />
                                @error('phone')
                                <p class="text-danger">{{ $message }}</p>
                                @enderror
                            </div>

                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" wire:click.prevent="$dispatch('close-modal')">{{ __('message.close') }}</button>
                        <button type="submit" class="btn btn-primary">{{ __('message.submit') }}</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    @push('scripts')
    <script>
        document.addEventListener('livewire:init', () => {
        Livewire.on('open-modal', (event) => {
            $('#customerModal').modal('show');
        });
        Livewire.on('close-modal', (event) => {
            $('#customerModal').modal('hide');
        });
    });
    </script>
    @endpush
</div>