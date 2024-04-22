<!doctype html>
<html lang="en">
  <head>
    <title>Registration!</title>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <div class="container text-right">
       <h2 class="text-container"> ERP.</h2>
       <!--<h3 class="text-container">The first step to ace in your business.</h3>
--></div>
  </head>
  <body>

   <form action="{{url('/finalstep')}}/{{$customer_id}}" method="post">
    @csrf  
    
    <div class="container text-center">
        <h1 class="text-container ">{{$customer_id}} Tell us about your business...</h1>

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
    <option value="{{intval($key) + 1}}" id="business" >{{$business}}</option>
@endforeach    
</select><br>

    <label for="">Where would you like to sell your products:</label>
          <input type="checkbox" name="pws" id="pws" value="pws"> 
          <label for="PWS">Personalised Web Store</label>

          <input type="checkbox" name="inperson" id="inperson" value="inperson"> 
          <label for="inperson">In Person</label>

          <input type="checkbox" name="social" id="social" value="social"> 
          <label for="PWS">Social Media</label>

          <input type="checkbox" name="onlinemarket" id="onlinemarket" value="onlinemarket"> 
          <label for="PWS">Online Marketplace</label><br>



    <label for="">Status:</label>
          <input type="radio" name="status" id="newseller" value="New Seller"> 
          <label for="newseller">New Seller</label>

          <input type="radio" name="status" id="existingseller" value="Existing Seller"> 
          <label for="existingseller">Existing Seller</label><br>

   
   


    

        <label for="">Product Category:</label>
    
    @php
$primaries = array(
  "Grocery",
  "Mobiles",
  "Fashion",
  "Electronics",
  "Home & Furniture",
  "Appliances",
  "Beauty, Toys & More",
  "Automobile"
);
@endphp


<select name="primary">
@foreach($primaries as $key => $primary)
    <option value="{{intval($key) + 1}}" id="primary"  placeholder="Primary Category">{{$primary}}</option>
@endforeach    
</select>

@php
$secondaries = array(
  "Grocery",
  "Mobiles",
  "Fashion",
  "Electronics",
  "Home & Furniture",
  "Appliances",
  "Beauty, Toys & More",
  "Automobile"
);
@endphp

<select name="secondary">
@foreach($secondaries as $key => $secondary)
    <option value="{{intval($key) + 1}}" id="secondary"  placeholder="Secondary Category">{{$secondary}}</option>
@endforeach    
</select>

<br>

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
    <option value="{{intval($key) + 1}}" id="region"  placeholder="region">{{$region}}</option>
@endforeach    
</select>

<br>

<button class="btn btn-primary">Go to Dashboard</button>
</div>
    
   </form>

   <div class="container text-center"> 
	<a href=""> <button class="btn btn-primary">Go Back</button> </a>
   </div>

 </body>
</html>