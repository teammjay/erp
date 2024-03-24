<x-layout bodyClass="g-sidenav-show bg-gray-200">
    <x-navbars.sidebar activePage="user-management"></x-navbars.sidebar>
    <div class="main-content position-relative bg-gray-100 max-height-vh-100 h-100">
        <!-- Navbar -->
        <x-navbars.navs.auth titlePage='User Profile'></x-navbars.navs.auth>
        <!-- End Navbar -->
        <div class="container-fluid">
            @if (session('status'))
                <div class="alert alert-success alert-dismissible text-white" role="alert">
                    <span class="text-sm">{{ Session::get('status') }}</span>
                    <button type="button" class="btn-close text-lg py-3 opacity-10"
                        data-bs-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
            @endif
            @if (Session::has('demo'))
                <div class="alert alert-danger alert-dismissible text-white" role="alert">
                    <span class="text-sm">{{ Session::get('demo') }}</span>
                    <button type="button" class="btn-close text-lg py-3 opacity-10"
                        data-bs-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
            @endif
            <form method='POST' action='/user-management/{{ $user ? $user->id : ''  }}' enctype="multipart/form-data">
                @csrf
                @if($user)
                    @method('PUT')
                @endif
                <div class="card card-body">
                    <div class="card card-plain h-100">
                        <div class="card-header pb-0 p-3">
                            <div class="row">
                                <div class="col-md-8 d-flex align-items-center">
                                    <h6 class="mb-2">Profile Information</h6>
                                </div>
                            </div>
                        </div>
                        <div class="card-body p-3">
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <label class="form-label">Name</label>
                                        <input type="text" name="name" class="form-control border border-2 p-2" value='{{ old('name', $user ? $user->name : '') }}'>
                                        @error('name')
                                            <p class='text-danger inputerror'>{{ $message }} </p>
                                        @enderror
                                    </div>
                                    <div class="mb-3">
                                        <label class="form-label">Email address</label>
                                        <input type="email" name="email" class="form-control border border-2 p-2" value='{{ old('email', $user ? $user->email : '') }}'>
                                        @error('email')
                                            <p class='text-danger inputerror'>{{ $message }} </p>
                                        @enderror
                                    </div>

                                    <div class="mb-3">
                                        <label class="form-label">Phone</label>
                                        <input type="text" name="phone" class="form-control border border-2 p-2" value='{{ old('phone', $user ? $user->phone : '') }}'>
                                        @error('phone')
                                            <p class='text-danger inputerror'>{{ $message }} </p>
                                        @enderror
                                    </div>
                                </div>

                                <div class="mb-3 col-md-6">
                                    <label for="floatingTextarea2">About</label>
                                    <textarea class="form-control border border-2 p-2" placeholder="Say something about yourself" id="floatingTextarea2" name="about"
                                        rows="9" cols="50">{{ old('about', $user ? $user->about : '') }}</textarea>
                                        @error('about')
                                            <p class='text-danger inputerror'>{{ $message }} </p>
                                        @enderror
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="card card-plain h-100">
                        <div class="card-header pb-0 p-3">
                            <div class="row">
                                <div class="col-md-8 d-flex align-items-center">
                                    <h6 class="mb-2">Business Information</h6>
                                </div>
                            </div>
                        </div>
                        <div class="card-body p-3">
                            <div class="row">
                                <div class="col-md-6 mb-3">
                                    <label class="form-label">GSTIN</label>
                                    <input type="text" name="gstin" class="form-control border border-2 p-2" value='{{ old('gstin', $user ? $user->gstin : '') }}'>
                                    @error('gstin')
                                        <p class='text-danger inputerror'>{{ $message }} </p>
                                    @enderror
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label class="form-label">GSTIN Type</label>
                                    <select name="gstin_type" class="form-control border border-2 p-2">
                                        <option value=""> -- Select Option -- </option>
                                        @foreach (['Regular'] as $gstin_type)
                                            <option value="{{ $gstin_type }}" @selected(old('gstin_type', $user ? $user->gstin_type : '') == $gstin_type)>
                                                {{ $gstin_type }}
                                            </option>
                                        @endforeach
                                    </select>
                                    @error('gstin_type')
                                        <p class='text-danger inputerror'>{{ $message }} </p>
                                    @enderror
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label class="form-label">Legal Name</label>
                                    <input type="text" name="legal_name" class="form-control border border-2 p-2" value='{{ old('legal_name', $user ? $user->legal_name : '') }}'>
                                    @error('legal_name')
                                        <p class='text-danger inputerror'>{{ $message }} </p>
                                    @enderror
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label class="form-label">Store Name</label>
                                    <input type="text" name="store_name" class="form-control border border-2 p-2" value='{{ old('store_name', $user ? $user->store_name : '') }}'>
                                    @error('store_name')
                                        <p class='text-danger inputerror'>{{ $message }} </p>
                                    @enderror
                                </div>
                                <div class="mb-3 col-md-12">
                                    <label class="form-label">Address</label>
                                    <input type="text" name="address" class="form-control border border-2 p-2" value='{{ old('address', $user ? $user->address : '') }}'>
                                    @error('address')
                                        <p class='text-danger inputerror'>{{ $message }} </p>
                                    @enderror
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label class="form-label">Pincode</label>
                                    <input type="text" name="pincode" class="form-control border border-2 p-2" value='{{ old('pincode', $user ? $user->pincode : '') }}'>
                                    @error('pincode')
                                        <p class='text-danger inputerror'>{{ $message }} </p>
                                    @enderror
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label class="form-label">City</label>
                                    <input type="text" name="city" class="form-control border border-2 p-2" value='{{ old('city', $user ? $user->city : '') }}'>
                                    @error('city')
                                        <p class='text-danger inputerror'>{{ $message }} </p>
                                    @enderror
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label class="form-label">State</label>
                                    <input type="text" name="state" class="form-control border border-2 p-2" value='{{ old('state', $user ? $user->state : '') }}'>
                                    @error('state')
                                        <p class='text-danger inputerror'>{{ $message }} </p>
                                    @enderror
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label class="form-label">GSTIN Certificate (pdf, png, jpg, gif)</label>
                                    <input type="file" name="certificate" class="form-control border border-2 p-2" accept=".jpg,.gif,.png,.pdf">
                                    @error('certificate')
                                        <p class='text-danger inputerror'>{{ $message }} </p>
                                    @enderror
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="card card-plain h-100">
                        <div class="card-body p-3">
                            <button type="submit" class="btn bg-gradient-dark">Submit</button>
                            <a href='{{ route("user-management.index") }}' class="btn bg-gradient-dark ms-3">Back</a>
                        </div>
                    </div>
                </div>
            </form>

        </div>
        <x-footers.auth></x-footers.auth>
    </div>
    <x-plugins></x-plugins>

</x-layout>
