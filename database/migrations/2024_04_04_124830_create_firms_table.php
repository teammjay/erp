<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('firms', function (Blueprint $table) {
            $table->id('firm_id');
//            $table->enum('business', ["Company","B2B","B2C","Wholesaler","Retailer"]);
            $table->smallInteger('pws');
            $table->smallInteger('inperson');
            $table->smallInteger('social');
            $table->smallInteger('onlinemarket');
//            $table->enum('status', ['New Seller', 'Existing Seller']);
//            $table->enum('primary', ["Grocery & Gourmet Food",
//                                        "Handmade Products",
//                                        "Health, Household & Baby Care",
//                                        "Home & Kitchen",
//                                        "Industrial & Scientific",
//                                        "Kindle Store",
//                                        "Books",
//                                        "Luggage & Travel Gear",
//                                        "Movies & TV",
//                                        "Musical Instruments",
//                                        "Office Products",
//                                        "Pet Supplies",
//                                        "Devices & Accessories",
//                                        "Apps & Games",
//                                        "Cell Phones & Accessories",
//                                        "Computers",
//                                        "Software",
//                                        "Video Games",
//                                        "Clothing, Shoes & Jewelry",
//                                        "Arts, Crafts & Sewing",
//                                        "Baby Products",
//                                        "Beauty & Personal Care",
//                                        "Collectibles & Fine Art",
//                                        "Garden & Outdoor",
//                                        "Electronics",
//                                        "Home & Furniture",
//                                        "Appliances",
//                                        "Beauty, Toys & More",
//                                        "Toys & Games",
//                                        "Tools & Home Improvement",
//                                        "CDs & Vinyl",
//                                        "Automotive Parts & Accessories",
//                                        "Personal Safety and Household"]);
//            $table->enum('secondary', ["Grocery & Gourmet Food" => [
//                                                            "Beverages",
//                                                            "Snack Foods",
//                                                            "Breakfast Foods",
//                                                            "Dairy",
//                                                            "Pantry Staples"
//                                                        ],
//                                                        "Handmade Products" => [
//                                                            "Home Décor",
//                                                            "Jewelry",
//                                                            "Clothing",
//                                                            "Toys",
//                                                            "Art"
//                                                        ],
//                                                        "Health, Household & Baby Care" => [
//                                                            "Vitamins & Dietary Supplements",
//                                                            "Medical Supplies",
//                                                            "Baby & Child Care",
//                                                            "Household Supplies",
//                                                            "Health Care"
//                                                        ],
//                                                        "Home & Kitchen" => [
//                                                            "Furniture",
//                                                            "Home Décor",
//                                                            "Bedding",
//                                                            "Kitchen & Dining",
//                                                            "Storage & Organization"
//                                                        ],
//                                                        "Industrial & Scientific" => [
//                                                            "Lab & Scientific Products",
//                                                            "Occupational Health & Safety Products",
//                                                            "Additive Manufacturing Products",
//                                                            "Industrial Electrical",
//                                                            "Industrial Tools & Equipment"
//                                                        ],
//                                                        "Kindle Store" => [
//                                                            "Kindle eBooks",
//                                                            "Kindle Singles",
//                                                            "Kindle Magazines",
//                                                            "Kindle Newspapers",
//                                                            "Kindle Comics"
//                                                        ],
//                                                        "Books" => [
//                                                            "Fiction",
//                                                            "Non-Fiction",
//                                                            "Children's Books",
//                                                            "Textbooks",
//                                                            "Biographies"
//                                                        ],
//                                                        "Luggage & Travel Gear" => [
//                                                            "Carry-Ons",
//                                                            "Backpacks",
//                                                            "Travel Accessories",
//                                                            "Suitcases",
//                                                            "Luggage Sets"
//                                                        ],
//                                                        "Movies & TV" => [
//                                                            "Blu-ray",
//                                                            "DVD",
//                                                            "4K Ultra HD",
//                                                            "TV Shows",
//                                                            "Documentaries"
//                                                        ],
//                                                        "Musical Instruments" => [
//                                                            "Guitars",
//                                                            "Keyboards",
//                                                            "Drums",
//                                                            "Wind Instruments",
//                                                            "Microphones & Accessories"
//                                                        ],
//                                                        "Office Products" => [
//                                                            "Office Supplies",
//                                                            "Office Electronics",
//                                                            "Office Furniture",
//                                                            "Presentation Products",
//                                                            "Desk Accessories"
//                                                        ],
//                                                        "Pet Supplies" => [
//                                                            "Dog Supplies",
//                                                            "Cat Supplies",
//                                                            "Bird Supplies",
//                                                            "Fish & Aquatic Pets",
//                                                            "Small Animal Supplies"
//                                                        ],
//                                                        "Devices & Accessories" => [
//                                                            "Smartphones",
//                                                            "Tablets",
//                                                            "Wearable Devices",
//                                                            "Smart Home Devices",
//                                                            "Mobile Phone Accessories"
//                                                        ],
//                                                        "Apps & Games" => [
//                                                            "Games",
//                                                            "Education",
//                                                            "Music & Audio",
//                                                            "Health & Fitness",
//                                                            "Productivity"
//                                                        ],
//                                                        "Cell Phones & Accessories" => [
//                                                            "Smartphones",
//                                                            "Cases",
//                                                            "Chargers",
//                                                            "Screen Protectors",
//                                                            "Headsets"
//                                                        ],
//                                                        "Computers" => [
//                                                            "Laptops",
//                                                            "Desktops",
//                                                            "Monitors",
//                                                            "Computer Accessories",
//                                                            "Networking Products"
//                                                        ],
//                                                        "Software" => [
//                                                            "Operating Systems",
//                                                            "Business & Office",
//                                                            "Education & Reference",
//                                                            "Utilities",
//                                                            "Security Software"
//                                                        ],
//                                                        "Video Games" => [
//                                                            "PlayStation",
//                                                            "Xbox",
//                                                            "Nintendo",
//                                                            "PC Gaming",
//                                                            "Gaming Accessories"
//                                                        ],
//                                                        "Clothing, Shoes & Jewelry" => [
//                                                            "Women’s Clothing",
//                                                            "Men’s Clothing",
//                                                            "Kid’s Clothing",
//                                                            "Shoes",
//                                                            "Jewelry"
//                                                        ],
//                                                        "Arts, Crafts & Sewing" => [
//                                                            "Fabric",
//                                                            "Sewing Machines",
//                                                            "Craft Supplies",
//                                                            "Painting Supplies",
//                                                            "Knitting & Crochet"
//                                                        ],
//                                                        "Baby Products" => [
//                                                            "Nursery",
//                                                            "Baby Clothing",
//                                                            "Car Seats",
//                                                            "Strollers",
//                                                            "Feeding"
//                                                        ],
//                                                        "Beauty & Personal Care" => [
//                                                            "Skin Care",
//                                                            "Hair Care",
//                                                            "Makeup",
//                                                            "Fragrance",
//                                                            "Tools & Accessories"
//                                                        ],
//                                                        "Collectibles & Fine Art" => [
//                                                            "Collectible Coins",
//                                                            "Collectible Figurines",
//                                                            "Fine Art",
//                                                            "Sports Collectibles",
//                                                            "Entertainment Collectibles"
//                                                        ],
//                                                        "Garden & Outdoor" => [
//                                                            "Lawn Care",
//                                                            "Gardening Tools",
//                                                            "Outdoor Furniture",
//                                                            "Grills & Outdoor Cooking",
//                                                            "Garden Décor"
//                                                        ],
//                                                        "Electronics" => [
//                                                            "Televisions",
//                                                            "Home Audio",
//                                                            "Cameras & Photography",
//                                                            "Wearable Technology",
//                                                            "Video Projectors",
//                                                            "Home Theater Systems"
//                                                        ],
//                                                        "Home & Furniture" => [
//                                                            "Furniture",
//                                                            "Lighting",
//                                                            "Rugs",
//                                                            "Home Décor",
//                                                            "Bedding"
//                                                        ],
//                                                        "Appliances" => [
//                                                            "Refrigerators",
//                                                            "Washing Machines",
//                                                            "Microwave Ovens",
//                                                            "Air Conditioners",
//                                                            "Dishwashers"
//                                                        ],
//                                                        "Beauty, Toys & More" => [
//                                                            "Toys",
//                                                            "Beauty Products",
//                                                            "Games",
//                                                            "School Supplies",
//                                                            "Gift Cards"
//                                                        ],
//                                                        "Toys & Games" => [
//                                                            "Action Figures",
//                                                            "Dolls & Accessories",
//                                                            "Building Toys",
//                                                            "Learning & Education",
//                                                            "Games"
//                                                        ],
//                                                        "Tools & Home Improvement" => [
//                                                            "Power Tools",
//                                                            "Hand Tools",
//                                                            "Lighting & Ceiling Fans",
//                                                            "Hardware",
//                                                            "Plumbing"
//                                                        ],
//                                                        "CDs & Vinyl" => [
//                                                            "Rock",
//                                                            "Jazz",
//                                                            "Classical",
//                                                            "Pop",
//                                                            "Soundtracks"
//                                                        ],
//                                                        "Automotive Parts & Accessories" => [
//                                                            "Car Care",
//                                                            "Replacement Parts",
//                                                            "Interior Accessories",
//                                                            "Exterior Accessories",
//                                                            "Tools & Equipment"
//                                                        ],
//                                                        "Personal Safety and Household" => [
//                                                            "Home Security Systems",
//                                                            "Personal Protective Equipment",
//                                                            "Fire Safety",
//                                                            "First Aid",
//                                                            "Emergency Kits"]
//                                                    ]);
//            $table->enum('region', ["In your City","In your State","In your Country","Worldwide",]);
            // $table->unsignedBigInteger('customer_id');
            $table->foreignId('customer_id')->references('customer_id')->on('customers');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('firms');
    }
};
