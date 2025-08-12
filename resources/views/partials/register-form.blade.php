                                        @if (isset($tokenData->role) && $tokenData->role == 'internal')
                                            <div class="row">
                                                <div class="mb-3 col-md-4">
                                                    <label for="first_name" class="form-label">First Name <span class="text-danger">*</span></label>
                                                    <input type="text"
                                                        class="form-control @error('first_name') is-invalid @enderror"
                                                        id="first_name" name="first_name" value="{{ old('first_name') }}"
                                                        placeholder="Enter first name" required>
                                                    @error('first_name')
                                                        <div class="invalid-feedback">{{ $message }}</div>
                                                    @enderror
                                                </div>

                                                <div class="mb-3 col-md-4">
                                                    <label for="middle_name" class="form-label">Middle Name</label>
                                                    <input type="text"
                                                        class="form-control @error('middle_name') is-invalid @enderror"
                                                        id="middle_name" name="middle_name" value="{{ old('middle_name') }}"
                                                        placeholder="Enter middle name">
                                                    @error('middle_name')
                                                        <div class="invalid-feedback">{{ $message }}</div>
                                                    @enderror
                                                </div>

                                                <div class="mb-3 col-md-4">
                                                    <label for="last_name" class="form-label">Last Name <span class="text-danger">*</span></label>
                                                    <input type="text"
                                                        class="form-control @error('last_name') is-invalid @enderror"
                                                        id="last_name" name="last_name" value="{{ old('last_name') }}"
                                                        placeholder="Enter last name" required>
                                                    @error('last_name')
                                                        <div class="invalid-feedback">{{ $message }}</div>
                                                    @enderror
                                                </div>
                                            </div>

                                            <div class="mb-3">
                                                <label for="email" class="form-label">Email Address <span class="text-danger">*</span></label>
                                                <input id="email" type="email"
                                                    class="form-control @error('email') is-invalid @enderror" name="email"
                                                    value="{{ old('email') }}" required autocomplete="email"
                                                    placeholder="Enter email" required>
                                                @error('email')
                                                    <div class="invalid-feedback">{{ $message }}</div>
                                                @enderror
                                            </div>
                                            <div class="mb-3">
                                            <label for="phone" class="form-label">Phone Number <span class="text-danger">*</span></label>
                                            <input type="text" class="form-control @error('phone') is-invalid @enderror"
                                                id="phone" name="phone" value="{{ old('phone') }}"
                                                placeholder="Enter phone number" required>
                                            @error('phone')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>
                                        @else

                                        <div class="row">
                                            <div class="mb-3 col-md-4">
                                                <label for="first_name" class="form-label">First Name <span class="text-danger">*</span></label>
                                                <input type="text"
                                                    class="form-control @error('first_name') is-invalid @enderror"
                                                    id="first_name" name="first_name" value="{{ old('first_name') }}"
                                                    placeholder="Enter first name" required>
                                                @error('first_name')
                                                    <div class="invalid-feedback">{{ $message }}</div>
                                                @enderror
                                            </div>

                                            <div class="mb-3 col-md-4">
                                                <label for="middle_name" class="form-label">Middle Name</label>
                                                <input type="text"
                                                    class="form-control @error('middle_name') is-invalid @enderror"
                                                    id="middle_name" name="middle_name" value="{{ old('middle_name') }}"
                                                    placeholder="Enter middle name">
                                                @error('middle_name')
                                                    <div class="invalid-feedback">{{ $message }}</div>
                                                @enderror
                                            </div>

                                            <div class="mb-3 col-md-4">
                                                <label for="last_name" class="form-label">Last Name <span class="text-danger">*</span></label>
                                                <input type="text"
                                                    class="form-control @error('last_name') is-invalid @enderror"
                                                    id="last_name" name="last_name" value="{{ old('last_name') }}"
                                                    placeholder="Enter last name" required>
                                                @error('last_name')
                                                    <div class="invalid-feedback">{{ $message }}</div>
                                                @enderror
                                            </div>
                                        </div>

                                        <div class="mb-3">
                                            <label for="email" class="form-label">Email Address <span class="text-danger">*</span></label>
                                            <input id="email" type="email"
                                                class="form-control @error('email') is-invalid @enderror" name="email"
                                                value="{{ old('email') }}" required autocomplete="email"
                                                placeholder="Enter email" required>
                                            @error('email')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>


                                        <div class="mb-3">
                                            <label for="phone" class="form-label">Phone Number <span class="text-danger">*</span></label>
                                            <input type="text" class="form-control @error('phone') is-invalid @enderror"
                                                id="phone" name="phone" value="{{ old('phone') }}"
                                                placeholder="Enter phone number" required>
                                            @error('phone')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>

                                        <div class="mb-3">
                                            <label for="dob" class="form-label">Date of Birth <span class="text-danger">*</span></label>
                                            <input type="date" class="form-control @error('dob') is-invalid @enderror"
                                                id="dob" name="dob" value="{{ old('dob') }}" required>
                                            @error('dob')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>

                                        <x-google-map-autocomplete :api-key="$googleMapAPI" :address="null" :lat="null" :long="null" />


                                        <div class="mb-3">
                                            <label for="state_id" class="form-label">State ID <span class="text-danger">*</span></label>
                                            <input type="text" name="state_id" class="form-control @error('state_id') is-invalid @enderror"
                                                id="state_id" value="{{ old('state_id') }}"
                                                placeholder="Enter State ID" required>
                                        </div>

                                        <div class="mb-3">
                                            <label for="state_id" class="form-label">Upload State ID Front <span class="text-danger">*</span></label>
                                            <input type="file"
                                                class="form-control @error('image') is-invalid @enderror"
                                                id="image_1"
                                                name="image_1"
                                                accept=".jpg,.jpeg,.png,.gif,.webp,.bmp,.svg,.pdf" required>
                                            @error('image')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>

                                        <div class="mb-3">
                                            <label for="state_id" class="form-label">Upload State ID Back <span class="text-danger">*</span></label>
                                            <input type="file"
                                                class="form-control @error('image') is-invalid @enderror"
                                                id="image_2"
                                                name="image_2"
                                                accept=".jpg,.jpeg,.png,.gif,.webp,.bmp,.svg,.pdf" required>
                                            @error('image')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>


                                        @endif


                                        <div class="mb-3">
                                            <label for="password" class="form-label">Password <span class="text-danger">*</span></label>
                                            <input type="password"
                                                class="form-control @error('password') is-invalid @enderror"
                                                id="password" name="password" required placeholder="Enter password" required>
                                            @error('password')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>

                                        <div class="mb-3">
                                            <label for="password_confirmation" class="form-label">Confirm Password <span class="text-danger">*</span></label>
                                            <input type="password" class="form-control" id="password_confirmation"
                                                name="password_confirmation" required placeholder="Confirm password" required>
                                        </div>

                                                                                <div class="mb-3 row">
                                            <div class="col-12 text-end">
                                                <button type="submit"
                                                    class="btn btn-primary w-md waves-effect waves-light">
                                                    {{ __('Register') }}
                                                </button>
                                            </div>
                                        </div>
