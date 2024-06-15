<div class="container">
    <div class="col-md-6 mx-auto stretch-card">
        <div class="card shadow">
            <div class="card-body">
                <h3 class="text-center py-3">Login into <span class="text-danger">Dokan</span></h3>
                @session('error')
                <p class="text-danger">{{ session('error') }}</p>
                @endsession
                <form wire:submit.prevent='loginUser()' class="forms-sample">
                    <div class="form-group">
                        <label for="password">Username</label>
                        <input wire:model.defer='username' type="text" class="form-control" id="username"
                            autocomplete="off" placeholder="Username" />
                        @error('username')
                        <p class="text-danger">{{ $message }}</p>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="password">Password</label>
                        <input wire:model.defer='password' type="password" class="form-control" id="password"
                            placeholder="Password" autocomplete="off" />
                        @error('password')
                        <p class="text-danger">{{ $message }}</p>
                        @enderror
                    </div>
                    <button type="submit" class="btn btn-primary mr-2 col-12">{{ __('message.login') }} </button>
                </form>
            </div>
        </div>
    </div>
</div>