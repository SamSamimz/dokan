<div>
    <div class="col-12 grid-margin stretch-card">
        <div class="card">
            <div class="card-body">
                <div class="d-flex align-items-center justify-content-between">
                    <h4 class="card-title">{{ __('message.all sales') }}</h4>
                    <div>
                        <select wire:model.live='filter_date' id="filter_time" class="form-control">
                            <option value="todays">{{ __('message.todays') }}</option>
                            <option value="week">{{ __('message.week') }}</option>
                            <option value="month">{{ __('message.month') }}</option>
                            <option value="">{{ __('message.all sales') }}</option>
                        </select>
                    </div>
                    <button class="btn btn-facebook" wire:click='openModal()'>{{ __('message.add sales') }}</button>
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
                                <th>{{ __('message.customer') }}</th>
                                <th>{{ __('message.quantity') }}</th>
                                <th>{{ __('message.total_price') }}</th>
                                <th>{{ __('message.payed_amount') }}</th>
                                <th>{{ __('message.due_amount') }}</th>
                                <th>{{ __('message.created_at') }}</th>
                                <th>{{ __('message.due_date') }}</th>
                                <th>{{ __('message.action') }}</th>
                            </tr>
                        </thead>
                        <tbody>
                            @php
                            $sells_amount = 0;
                            $total_payed_amount = 0;
                            $total_due_amount = 0;
                            @endphp
                            @forelse ($sales as $index => $sale)
                            <tr>
                                <td>{{ ++$index }}</td>
                                <td>{{ $sale->product->name }}</td>
                                <td>{{ $sale->customer->name }}</td>
                                <td>{{ $sale->product_quantity }}</td>
                                <td>{{ $sale->total_price }}</td>
                                <td>{{ $sale->payed_amount }}</td>
                                <td>{{ $sale->due_amount }}</td>
                                <td>{{ $sale->created_at->diffForHumans() }}</td>
                                <td>{{ $sale->due_date }}</td>
                                <td>
                                    {{-- <button wire:click='editCategory({{ $sale }})' class="btn btn-facebook">{{
                                    __('message.edit') }}</button> --}}
                                    <button wire:click='deleteSale({{ $sale }})'
                                        class="btn btn-google">{{ __('message.delete') }}</button>
                                </td>
                            </tr>
                            @php
                            $sells_amount += $sale->total_price;
                            $total_payed_amount += $sale->payed_amount;
                            $total_due_amount += $sale->due_amount;
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
            <div class="px-md-4">{{ $sales->links() }}</div>
            <div class="px-4 py-2 d-flex align-items-center justify-content-between">
                <h4>{{ __('message.total_sale') }} : {{ $sales->count() }}</h4>
                <h4>{{ __('message.sale_amount') }} : {{ $sells_amount. ' ' . __('message.tk')}} </h4>
                <h4>{{ __('message.total_payed_amount') }} : {{ $total_payed_amount. ' ' . __('message.tk') }} </h4>
                <h4>{{ __('message.total_due') }} : {{ $total_due_amount. ' ' . __('message.tk') }} </h4>
            </div>
        </div>
    </div>
    <!-- Modal -->
    <div wire:ignore.self class="modal fade" id="saleModal" data-backdrop="static" data-keyboard="false" tabindex="-1"
        aria-labelledby="saleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="saleModalLabel">{{ __('message.add sales') }}</h5>
                    <button type="button" class="close" wire:click='closeModal()'>
                        <span>&times;</span>
                    </button>
                </div>
                <form wire:submit.prevent='addSale()' class="forms-sample">
                    <div class="modal-body">
                        <div>
                            <div class="form-group">
                                <label for="customer_id">{{ __('message.customer') }} :</label>
                                <select wire:model='customer_id' id="customer_id" class="form-control">
                                    <option value="">Select Customer</option>
                                    @foreach ($customers as $customer)
                                    <option value="{{ $customer->id }}">{{ $customer->name }}</option>
                                    @endforeach
                                </select>
                                @error('customer_id')
                                <p class="text-danger">{{ $message }}</p>
                                @enderror
                            </div>

                            <div class="form-group">
                                <label for="product_id">{{ __('message.productname') }} :</label>
                                <select wire:model.live='product_id' id="product_id" class="form-control">
                                    <option value="">Select product</option>
                                    @foreach ($products as $product)
                                    <option value="{{ $product->id }}">{{ $product->name }}</option>
                                    @endforeach
                                </select>
                                @error('product_id')
                                <p class="text-danger">{{ $message }}</p>
                                @enderror
                            </div>

                            <div class="form-group">
                                <label for="quantity">{{ __('message.quantity') }} :</label>
                                <input wire:model.live='product_quantity' type="number" id="quantity"
                                    class="form-control">
                                @error('product_quantity')
                                <p class="text-danger">{{ $message }}</p>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label for="total_price">{{ __('message.total_price') }} :</label>
                                <input wire:model.live='total_price' type="number" id="total_price"
                                    class="form-control">
                                @error('total_price')
                                <p class="text-danger">{{ $message }}</p>
                                @enderror
                            </div>

                            <div class="form-group">
                                <label for="payed_amount">{{ __('message.payed_amount') }} :</label>
                                <input wire:model.live='payed_amount' type="number" id="payed_amount"
                                    class="form-control">
                            </div>
                            @error('payed_amount')
                            <p class="text-danger">{{ $message }}</p>
                            @enderror
                            <div class="form-group">
                                <label for="due_amount">{{ __('message.due_amount') }} :</label>
                                <input wire:model='due_amount' type="number" id="due_amount" class="form-control"
                                    readonly>
                            </div>
                            @error('due_amount')
                            <p class="text-danger">{{ $message }}</p>
                            @enderror
                            <div class="form-group">
                                <label for="due_date">{{ __('message.due_date') }} :</label>
                                <input wire:model='due_date' type="date" id="due_date" class="form-control">
                            </div>
                            @error('due_date')
                            <p class="text-danger">{{ $message }}</p>
                            @enderror

                            {{-- <div class="form-group">
                                <label class="form-check-label" for="status">{{ __('message.status') }} : </label>
                            <input wire:model='status' type="checkbox" class="form-check" id="status">
                        </div> --}}

                    </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary"
                    wire:click='closeModal()'>{{ __('message.close') }}</button>
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
            $('#saleModal').modal('show');
        });
        Livewire.on('close-modal', (event) => {
            $('#saleModal').modal('hide');
        });
    });
</script>
@endpush
</div>