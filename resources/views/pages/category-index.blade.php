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
                                <th>{{ __('message.description') }}</th>
                                <th>{{ __('message.status') }}</th>
                                <th>{{ __('message.action') }}</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($categories as $index => $category)
                            <tr class="{{ strtolower($search) == strtolower($category->name) ? 'bg-warning' : null }}">
                                <td>{{ $category->user->name }}</td>
                                <td>{{ $category->name }}</td>
                                <td>{{ Str::limit($category->description,50) }}</td>
                                <td>
                                    <label
                                        class="badge badge-{{$category->status ? 'primary' : 'danger' }}">{{ $category->status ? "Active" : "Inactive" }}</label>
                                </td>
                                <td>
                                    <button wire:click='editCategory({{ $category->id }})' class="btn btn-facebook">{{ __('message.edit') }}</button>
                                    <button  wire:click='deleteCategory({{ $category }})' class="btn btn-google">{{ __('message.delete') }}</button>
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
            <div class="px-md-4">{{ $categories->links('livewire::bootstrap') }}</div>
        </div>
    </div>
    <!-- Modal -->
    <div wire:ignore.self class="modal fade" id="categoryModal" data-backdrop="static" data-keyboard="false"
        tabindex="-1" aria-labelledby="categoryModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="categoryModalLabel">{{ __('message.add categories') }}</h5>
                    <button type="button" class="close" wire:click.prevent="$dispatch('close-modal')">
                        <span>&times;</span>
                    </button>
                </div>
                <form wire:submit.prevent='addCategory()' class="forms-sample">
                    <div class="modal-body">
                        <div>
                            <div class="form-group">
                                <label for="name">{{ __('message.name') }} :</label>
                                <input wire:model='category_data.name' type="text" class="form-control" id="name"
                                    autocomplete="off" placeholder="{{ __('message.categoryname') }}" />
                                @error('category_data.name')
                                <p class="text-danger">{{ $message }}</p>
                                @enderror
                            </div>

                            <div class="form-group">
                                <label for="description">{{ __('message.description') }} (optional) :</label>
                                <textarea rows="6" wire:model='category_data.description' name="description" id="description"
                                    class="form-control" placeholder="{{ __('message.descriptionname') }}"></textarea>
                            </div>

                            <div class="form-group">
                                <label class="form-check-label" for="status">{{ __('message.status') }} : </label>
                                <input wire:model='category_data.status' type="checkbox" class="form-check" id="status">
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
            $('#categoryModal').modal('show');
        });
        Livewire.on('close-modal', (event) => {
            $('#categoryModal').modal('hide');
        });
    });
    </script>
    @endpush
</div>