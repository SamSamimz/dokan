<div>
   <div class="col-12 grid-margin stretch-card">
       <div class="card">
           <div class="card-body">
               <div class="d-flex align-items-center justify-content-between">
                   <h4 class="card-title">{{ __('message.all product') }}</h4>
                   <div>
                       <input wire:model.live='search' type="search" class="form-control shadow-sm" placeholder="{{ __('message.search') }}">
                   </div>
                   <div>
                     <select class="form-control" wire:model.live='search_by_category'>
                      <option value="">All Product</option>
                      @foreach ($categories as $category)
                          <option value="{{ $category->id }}">{{ $category->name }}</option>
                      @endforeach
                     </select>
                 </div>
                   <button class="btn btn-facebook" wire:click='openModal()'>{{ __('message.add product') }}</button>
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
                               <th>{{ __('message.category') }}</th>
                               <th>{{ __('message.price') }}</th>
                               <th>{{ __('message.companyname') }}</th>
                               <th>{{ __('message.stock_quantity') }}</th>
                               <th>{{ __('message.status') }}</th>
                               <th>{{ __('message.action') }}</th>
                           </tr>
                       </thead>
                       <tbody>
                           @forelse ($products as $index => $product)
                           <tr class="{{ strtolower($search) == strtolower($product->name) ? 'bg-warning' : null }}">
                               <td>{{ ++$index }}</td>
                               <td>{{ $product->name }}</td>
                               <td>{{ $product->category->name }}</td>
                               <td>{{ $product->price }}</td>
                               <td>{{ @$product->company_name }}</td>
                               <td>{{ $product->stock_quantity }}</td>
                               <td>
                                   <label
                                       class="badge badge-{{$product->status == 'active' ? 'success' : 'danger' }}">{{ $product->status }}</label>
                               </td>
                               <td>
                                   <button wire:click='editProduct({{ $product }})' class="btn btn-facebook">{{ __('message.edit') }}</button>
                                   <button  wire:click='deleteProduct({{ $product }})' class="btn btn-google">{{ __('message.delete') }}</button>
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
           <div class="px-md-4">{{ $products->links('livewire::bootstrap') }}</div>
       </div>
   </div>
   <!-- Modal -->
   <div wire:ignore.self class="modal fade" id="productModal" data-backdrop="static" data-keyboard="false"
       tabindex="-1" aria-labelledby="productModalLabel" aria-hidden="true">
       <div class="modal-dialog">
           <div class="modal-content">
               <div class="modal-header">
                   <h5 class="modal-title" id="productModalLabel">{{ __('message.add product') }}</h5>
                   <button type="button" class="close" wire:click='closeModal()'>
                       <span>&times;</span>
                   </button>
               </div>
               <form wire:submit.prevent='addProduct()' class="forms-sample">
                   <div class="modal-body">
                       <div>
                           <div class="form-group">
                               <label for="name">{{ __('message.name') }} :</label>
                               <input wire:model='name' type="text" class="form-control" id="name"
                                   autocomplete="off" placeholder="{{ __('message.productname') }}" />
                               @error('name')
                               <p class="text-danger">{{ $message }}</p>
                               @enderror
                           </div>

                           <div class="form-group">
                               <label for="category_id">{{ __('message.category') }} :</label>
                               <select wire:model='category_id'  id="category_id" class="form-control">
                                 <option value="" disabled selected>{{ __('message.select category') }}</option>
                                 @foreach ($categories as $category)
                                 <option value="{{$category->id}}">{{ $category->name }}</option>
                                 @endforeach
                               </select>
                               @error('category_id')
                               <p class="text-danger">{{ $message }}</p>
                               @enderror
                           </div>

                           <div class="form-group">
                              <label for="price">{{ __('message.price') }} :</label>
                                 <input wire:model='price' type="text" class="form-control" id="price"
                                 autocomplete="off" placeholder="{{ __(0.00) }}" />
                              @error('price')
                              <p class="text-danger">{{ $message }}</p>
                              @enderror
                          </div>

                           <div class="form-group">
                              <label for="compan_yname">{{ __('message.companyname') }} :</label>
                                 <input wire:model='company_name' type="text" class="form-control" id="company_name"
                                 autocomplete="off" placeholder="{{ __('message.companyname') }}" />
                              @error('company_name')
                              <p class="text-danger">{{ $message }}</p>
                              @enderror
                          </div>

                           <div class="form-group">
                              <label for="sotck_quantity">{{ __('message.stock_quantity') }} :</label>
                                 <input wire:model='stock_quantity' type="text" class="form-control" id="sotck_quantity"
                                 autocomplete="off" placeholder="{{ __(1) }}" />
                              @error('stock_quantity')
                              <p class="text-danger">{{ $message }}</p>
                              @enderror
                          </div>

                           <div class="form-group">
                               <label for="description">{{ __('message.description') }} (optional) :</label>
                               <textarea wire:model='description' name="description" id="description"
                                   class="form-control" placeholder="{{ __('message.descriptionname') }}"></textarea>
                           </div>

                           <div class="form-group">
                               <label class="form-check-label" for="status">{{ __('message.status') }} : </label>
                               <input wire:model='status' type="checkbox" class="form-check" id="status">
                           </div>

                       </div>
                   </div>
                   <div class="modal-footer">
                       <button type="button" class="btn btn-secondary" wire:click='closeModal()'>{{ __('message.close') }}</button>
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
           $('#productModal').modal('show');
       });
       Livewire.on('close-modal', (event) => {
           $('#productModal').modal('hide');
       });
   });
   </script>
   @endpush
</div>