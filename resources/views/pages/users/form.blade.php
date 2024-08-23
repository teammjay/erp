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
            <form action="{{url('/proceed1')}}/{{$customer_id}}" method="post"  enctype="multipart/form-data">
                @csrf
                @if($customer_id)
                    @method('PUT')
                @endif
                <div class="card card-body">
                    <div class="card card-plain h-100">
                        <div class="card-header pb-0 p-3">
                            <div class="row">
                                <div class="col-md-8 d-flex align-items-center">
                                    <h6 class="mb-2">Welcome seller, where are you?</h6>
                                </div>
                            </div>
                        </div>
                        <div class="card-body p-3">
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <label class="form-label">Business Address </label>
                                        <input type="text" name="bus_address" id="bus_address" class="bus_address form-control border border-2 p-2" value="{{isset($custom) ? $custom->bus_address : old('bus_address') }}" >
                                        @error('bus_address')
                                            <p class='text-danger inputerror'>{{ $message }} </p>
                                        @enderror
                                    </div>
                                    <div class="mb-3">
                                        <label class="form-label">City</label>
                                        <input type="text" name="city" class="city form-control border border-2 p-2" id="city" value="{{isset($custom) ? $custom->city : old('city') }}" >
                                        @error('city')
                                            <p class='text-danger inputerror'>{{ $message }} </p>
                                        @enderror
                                    </div>

                                    <div class="mb-3">
                                        <label class="form-label">Zip-Code</label>
                                        <input type="text" name="zipcode" class="zipcode form-control border border-2 p-2" id="zipcode" value="{{isset($custom) ? $custom->zipcode : old('zipcode') }}">
                                        @error('zipcode')
                                            <p class='text-danger inputerror'>{{ $message }} </p>
                                        @enderror
                                    </div>

                                    <div class="mb-3">
                                        <label class="form-label">State</label>
                                        <input type="text" name="state" class="state form-control border border-2 p-2" id="state" value="{{isset($custom) ? $custom->state : old('state') }}" >
                                        @error('state')
                                            <p class='text-danger inputerror'>{{ $message }} </p>
                                        @enderror
                                    </div>

                                    <div class="mb-3">
                                        <label class="form-label">Country</label>
                                        <input type="text" name="country" class="country form-control border border-2 p-2" id="country" value="{{isset($custom) ? $custom->country : old('country') }}" >
                                        @error('country')
                                            <p class='text-danger inputerror'>{{ $message }} </p>
                                        @enderror
                                    </div>
                                </div>

                                
                            </div>
                        </div>
                    </div>

                    
                    <div class="card card-plain h-100">
                        <div class="card-body p-3">
                            <button type="submit" class="btn bg-gradient-dark">Proceed</button>
                            <a href="{{url('/goback1')}}/{{$customer_id}}" class="btn bg-gradient-dark ms-3">Go back</a>
                        </div>
                    </div>
                </div>
            </form>

        </div>
    <x-footers.auth></x-footers.auth>
    </div>
    <x-plugins></x-plugins>

</x-layout>
