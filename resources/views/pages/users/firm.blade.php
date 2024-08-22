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
                                        <label for="">Product Category:</label><br>
                                    
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
                                                        "Grocery & Gourmet Food" => [
                                                            "Beverages",
                                                            "Snack Foods",
                                                            "Breakfast Foods",
                                                            "Dairy",
                                                            "Pantry Staples"
                                                        ],
                                                        "Handmade Products" => [
                                                            "Home Décor",
                                                            "Jewelry",
                                                            "Clothing",
                                                            "Toys",
                                                            "Art"
                                                        ],
                                                        "Health, Household & Baby Care" => [
                                                            "Vitamins & Dietary Supplements",
                                                            "Medical Supplies",
                                                            "Baby & Child Care",
                                                            "Household Supplies",
                                                            "Health Care"
                                                        ],
                                                        "Home & Kitchen" => [
                                                            "Furniture",
                                                            "Home Décor",
                                                            "Bedding",
                                                            "Kitchen & Dining",
                                                            "Storage & Organization"
                                                        ],
                                                        "Industrial & Scientific" => [
                                                            "Lab & Scientific Products",
                                                            "Occupational Health & Safety Products",
                                                            "Additive Manufacturing Products",
                                                            "Industrial Electrical",
                                                            "Industrial Tools & Equipment"
                                                        ],
                                                        "Kindle Store" => [
                                                            "Kindle eBooks",
                                                            "Kindle Singles",
                                                            "Kindle Magazines",
                                                            "Kindle Newspapers",
                                                            "Kindle Comics"
                                                        ],
                                                        "Books" => [
                                                            "Fiction",
                                                            "Non-Fiction",
                                                            "Children's Books",
                                                            "Textbooks",
                                                            "Biographies"
                                                        ],
                                                        "Luggage & Travel Gear" => [
                                                            "Carry-Ons",
                                                            "Backpacks",
                                                            "Travel Accessories",
                                                            "Suitcases",
                                                            "Luggage Sets"
                                                        ],
                                                        "Movies & TV" => [
                                                            "Blu-ray",
                                                            "DVD",
                                                            "4K Ultra HD",
                                                            "TV Shows",
                                                            "Documentaries"
                                                        ],
                                                        "Musical Instruments" => [
                                                            "Guitars",
                                                            "Keyboards",
                                                            "Drums",
                                                            "Wind Instruments",
                                                            "Microphones & Accessories"
                                                        ],
                                                        "Office Products" => [
                                                            "Office Supplies",
                                                            "Office Electronics",
                                                            "Office Furniture",
                                                            "Presentation Products",
                                                            "Desk Accessories"
                                                        ],
                                                        "Pet Supplies" => [
                                                            "Dog Supplies",
                                                            "Cat Supplies",
                                                            "Bird Supplies",
                                                            "Fish & Aquatic Pets",
                                                            "Small Animal Supplies"
                                                        ],
                                                        "Devices & Accessories" => [
                                                            "Smartphones",
                                                            "Tablets",
                                                            "Wearable Devices",
                                                            "Smart Home Devices",
                                                            "Mobile Phone Accessories"
                                                        ],
                                                        "Apps & Games" => [
                                                            "Games",
                                                            "Education",
                                                            "Music & Audio",
                                                            "Health & Fitness",
                                                            "Productivity"
                                                        ],
                                                        "Cell Phones & Accessories" => [
                                                            "Smartphones",
                                                            "Cases",
                                                            "Chargers",
                                                            "Screen Protectors",
                                                            "Headsets"
                                                        ],
                                                        "Computers" => [
                                                            "Laptops",
                                                            "Desktops",
                                                            "Monitors",
                                                            "Computer Accessories",
                                                            "Networking Products"
                                                        ],
                                                        "Software" => [
                                                            "Operating Systems",
                                                            "Business & Office",
                                                            "Education & Reference",
                                                            "Utilities",
                                                            "Security Software"
                                                        ],
                                                        "Video Games" => [
                                                            "PlayStation",
                                                            "Xbox",
                                                            "Nintendo",
                                                            "PC Gaming",
                                                            "Gaming Accessories"
                                                        ],
                                                        "Clothing, Shoes & Jewelry" => [
                                                            "Women’s Clothing",
                                                            "Men’s Clothing",
                                                            "Kid’s Clothing",
                                                            "Shoes",
                                                            "Jewelry"
                                                        ],
                                                        "Arts, Crafts & Sewing" => [
                                                            "Fabric",
                                                            "Sewing Machines",
                                                            "Craft Supplies",
                                                            "Painting Supplies",
                                                            "Knitting & Crochet"
                                                        ],
                                                        "Baby Products" => [
                                                            "Nursery",
                                                            "Baby Clothing",
                                                            "Car Seats",
                                                            "Strollers",
                                                            "Feeding"
                                                        ],
                                                        "Beauty & Personal Care" => [
                                                            "Skin Care",
                                                            "Hair Care",
                                                            "Makeup",
                                                            "Fragrance",
                                                            "Tools & Accessories"
                                                        ],
                                                        "Collectibles & Fine Art" => [
                                                            "Collectible Coins",
                                                            "Collectible Figurines",
                                                            "Fine Art",
                                                            "Sports Collectibles",
                                                            "Entertainment Collectibles"
                                                        ],
                                                        "Garden & Outdoor" => [
                                                            "Lawn Care",
                                                            "Gardening Tools",
                                                            "Outdoor Furniture",
                                                            "Grills & Outdoor Cooking",
                                                            "Garden Décor"
                                                        ],
                                                        "Electronics" => [
                                                            "Televisions",
                                                            "Home Audio",
                                                            "Cameras & Photography",
                                                            "Wearable Technology",
                                                            "Video Projectors",
                                                            "Home Theater Systems"
                                                        ],
                                                        "Home & Furniture" => [
                                                            "Furniture",
                                                            "Lighting",
                                                            "Rugs",
                                                            "Home Décor",
                                                            "Bedding"
                                                        ],
                                                        "Appliances" => [
                                                            "Refrigerators",
                                                            "Washing Machines",
                                                            "Microwave Ovens",
                                                            "Air Conditioners",
                                                            "Dishwashers"
                                                        ],
                                                        "Beauty, Toys & More" => [
                                                            "Toys",
                                                            "Beauty Products",
                                                            "Games",
                                                            "School Supplies",
                                                            "Gift Cards"
                                                        ],
                                                        "Toys & Games" => [
                                                            "Action Figures",
                                                            "Dolls & Accessories",
                                                            "Building Toys",
                                                            "Learning & Education",
                                                            "Games"
                                                        ],
                                                        "Tools & Home Improvement" => [
                                                            "Power Tools",
                                                            "Hand Tools",
                                                            "Lighting & Ceiling Fans",
                                                            "Hardware",
                                                            "Plumbing"
                                                        ],
                                                        "CDs & Vinyl" => [
                                                            "Rock",
                                                            "Jazz",
                                                            "Classical",
                                                            "Pop",
                                                            "Soundtracks"
                                                        ],
                                                        "Automotive Parts & Accessories" => [
                                                            "Car Care",
                                                            "Replacement Parts",
                                                            "Interior Accessories",
                                                            "Exterior Accessories",
                                                            "Tools & Equipment"
                                                        ],
                                                        "Personal Safety and Household" => [
                                                            "Home Security Systems",
                                                            "Personal Protective Equipment",
                                                            "Fire Safety",
                                                            "First Aid",
                                                            "Emergency Kits"
                                                        ]
                                                    );
                                    @endphp
                                    value=" {{ isset($custom) ? $custom->secondary : old('secondary') }}">{{$secondary}}
                                    <select name="secondary" id="secondary" class="secondary form-control border border-2 p-2"  value=" {{ isset($custom) ? $custom->secondary : old('secondary') }}">{{$secondary}}>
                                    <option value="">Select a subcategory</option>
                                    <!-- Options will be dynamically added here via JavaScript -->
                                </select>


                                        <script>
                                        const secondaries = json($secondaries);

                                        function updateSubcategories() {
                                            const primarySelect = document.getElementById("primary");
                                            const secondarySelect = document.getElementById("secondary");
                                            const selectedCategory = primarySelect.value;

                                            // Clear the existing options in the secondary dropdown
                                            secondarySelect.innerHTML = '<option value="">Select a subcategory</option>';

                                            // Check if the selected category has subcategories
                                            if (secondaries[selectedCategory]) {
                                                // Populate the secondary dropdown with relevant subcategories
                                                secondaries[selectedCategory].forEach(secondaries => {
                                                    const option = document.createElement("option");
                                                    option.value = secondaries;
                                                    option.textContent = secondaries;
                                                    secondarySelect.appendChild(option);
                                                });
                                            }
                                        }
                                        </script>


                                        

                                        


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
