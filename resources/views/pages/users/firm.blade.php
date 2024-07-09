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
            <form action="{{url('/finalstep')}}/{{$customer_id}}" method="post"  enctype="multipart/form-data">
                @csrf
                @if($customer_id)
                    @method('PUT')
                @endif
                <div class="card card-body">
                    

                   
                    <div class="card card-plain h-100">
                        <div class="card-header pb-0 p-3">
                            <div class="row">
                                <div class="col-md-8 d-flex align-items-center">
                                    <h6 class="mb-2">{{$customer_id}} Tell us about your business...</h6>
                                </div>
                            </div>
                        </div>
                        <div class="card-body p-3">
                            <div class="row">
                                

                               

                                
                                 <div class="col-md-6 mb-3">

                                    <label for="">Which community do you belong:</label>
                                
                                        @php
                                    $businesses = array(
                                        "Company",
                                            "B2B",
                                            "B2C",
                                            "Wholesaler",
                                            "Retailer"

                                    );
                                    @endphp

                                    <select name="business">
                                    @foreach($businesses as $key => $business)
                                        <option value="{{intval($key) + 1}}" id="business" class="business" value="{{ isset($custom) ? $custom->business : old('business') }}" >{{$business}}</option>
                                    @endforeach    
                                    </select>

                                    @error('business')
                                        <p class='text-danger inputerror'>{{ $message }} </p>
                                    @enderror
                                </div>

                                <div class="col-md-6 mb-3">
                                    <label for="">Where would you like to sell your products:</label><br>
                                    <input type="checkbox" name="pws" id="pws" class="pws" value=" pws {{ isset($custom) ? $custom->pws : old('pws') }}"> 
                                    <label for="PWS">Personalised Web Store</label>

                                    <input type="checkbox" name="inperson" id="inperson" class="inperson" value=" inperson{{ isset($custom) ? $custom->inperson : old('inperson') }}"> 
                                    <label for="inperson">In Person</label>

                                    <input type="checkbox" name="social" id="social"  class="social" value=" social {{ isset($custom) ? $custom->social : old('social') }}"> 
                                    <label for="PWS">Social Media</label>

                                    <input type="checkbox" name="onlinemarket" id="onlinemarket"  class="onlinemarket" value=" onlinemarket {{ isset($custom) ? $custom->onlinemarket : old('onlinemarket') }}"> 
                                    <label for="PWS">Online Marketplace</label>
                                </div>

                                <div class="col-md-6 mb-3">
                                    <label for="">Status:</label>
                                    <input type="radio" name="status" id="newseller" value="New Seller" class="newseller" value=" {{ isset($custom) ? $custom->newseller : old('newseller') }}"> 
                                    <label for="newseller">New Seller</label>

                                    <input type="radio" name="status" id="existingseller" value="Existing Seller" class="existingseller" value=" {{ isset($custom) ? $custom->existingseller : old('existingseller') }}" > 
                                    <label for="existingseller">Existing Seller</label>
                                </div>

                                <div class="col-md-6 mb-3">
                                        <label for="">Product Category:</label>
                                    
                                            @php
                                        $primaries = array(
                                        "Grocery & Gourmet Food",
                                        "Handmade Products",
                                        "Health, Household & Baby Care",
                                        "Home & Kitchen",
                                        "Industrial & Scientific",
                                        "Kindle Store",
                                        "Books",
                                        "Luggage & Travel Gear",
                                        "Movies & TV",
                                        "Musical Instruments",
                                        "Office Products",
                                        "Pet Supplies",
                                        "Devices & Accessories",
                                        "Apps & Games",
                                        "Cell Phones & Accessories",
                                        "Computers",
                                        "Software",
                                        "Video Games",
                                        "Clothing, Shoes & Jewelry",
                                        "Arts, Crafts & Sewing",
                                        "Baby Products",
                                        "Beauty & Personal Care",
                                        "Collectibles & Fine Art",
                                        "Garden & Outdoor",
                                        "Electronics",
                                        "Home & Furniture",
                                        "Appliances",
                                        "Beauty, Toys & More",
                                        "Toys & Games",
                                        "Tools & Home Improvement",
                                        "CDs & Vinyl",
                                        "Automotive Parts & Accessories",
                                        "Personal Safety and Household"
                                        );
                                        @endphp


                                    <select name="primary">
                                    @foreach($primaries as $key => $primary)
                                        <option value="{{intval($key) + 1}}" id="primary"  placeholder="Primary Category" class="primary form-control border border-2 p-2" value="{{ isset($custom) ? $custom->primary : old('primary') }}">{{$primary}}</option>
                                    @endforeach    
                                    </select>

                                    @php
                                    $secondaries = array(
                                        "Grocery & Gourmet Food",
                                        "Handmade Products",
                                        "Health, Household & Baby Care",
                                        "Home & Kitchen",
                                        "Industrial & Scientific",
                                        "Kindle Store",
                                        "Books",
                                        "Luggage & Travel Gear",
                                        "Movies & TV",
                                        "Musical Instruments",
                                        "Office Products",
                                        "Pet Supplies",
                                        "Devices & Accessories",
                                        "Apps & Games",
                                        "Cell Phones & Accessories",
                                        "Computers",
                                        "Software",
                                        "Video Games",
                                        "Clothing, Shoes & Jewelry",
                                        "Arts, Crafts & Sewing",
                                        "Baby Products",
                                        "Beauty & Personal Care",
                                        "Collectibles & Fine Art",
                                        "Garden & Outdoor",
                                        "Electronics",
                                        "Home & Furniture",
                                        "Appliances",
                                        "Beauty, Toys & More",
                                        "Toys & Games",
                                        "Tools & Home Improvement",
                                        "CDs & Vinyl",
                                        "Automotive Parts & Accessories",
                                        "Personal Safety and Household"
                                    );
                                    @endphp

                                        <select name="secondary">
                                        @foreach($secondaries as $key => $secondary)
                                            <option value="{{intval($key) + 1}}" id="secondary"  placeholder="Secondary Category" class="secondary form-control border border-2 p-2" value=" {{ isset($custom) ? $custom->secondary : old('secondary') }}">{{$secondary}}</option>
                                        @endforeach    
                                        </select>

                                </div>

                                <div class="col-md-6 mb-3">
                                    <label for="">Selling Region:</label>

                                    @php
                                    $regions = array(
                                    
                                    "In your City",
                                    "In your State",
                                    "In your Country",
                                    "Worldwide",
                                    );
                                    @endphp

                                    <select name="region">
                                        @foreach($regions as $key => $region)
                                            <option value="{{intval($key) + 1}}" id="region"  placeholder="region" value=" {{ isset($custom) ? $custom->region : old('region') }}">{{$region}}</option>
                                        @endforeach    
                                    </select>
                                </div>





                                

                            </div>
                        </div>
                    </div>

                    <div class="card card-plain h-100">
                        <div class="card-body p-3">
                            <button type="submit" class="btn bg-gradient-dark">Go to dashboard</button>
                            <a href="{{url('/goback3')}}/{{$customer_id}}" class="btn bg-gradient-dark ms-3">Go back</a>
                        </div>
                    </div>
                </div>
            </form>

        </div>
    <x-footers.auth></x-footers.auth>
    </div>
    <x-plugins></x-plugins>

</x-layout>
