@extends('layouts.app')

@section('content')
 <div id="top">
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-4">
                <div class="left-content">
                    <div class="inner-content">
                        <h4>KlassyCafe</h4>
                        <h6>THE BEST EXPERIENCE</h6>
                        <div class="main-white-button scroll-to-section">
                             <a  href="{{ route('register') }}">{{ __('Make a reservation') }}</a>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-8">
                <div class="main-banner header-text">
                    <div class="Modern-Slider">
                      <!-- Item -->
                      <div class="item">
                        <div class="img-fill">
                            <img src="assets/images/slide-01.jpg" alt="">
                        </div>
                      </div>
                      <!-- // Item -->
                      <!-- Item -->
                      <div class="item">
                        <div class="img-fill">
                            <img src="assets/images/slide-02.jpg" alt="">
                        </div>
                      </div>
                      <!-- // Item -->
                      <!-- Item -->
                      <div class="item">
                        <div class="img-fill">
                            <img src="assets/images/slide-03.jpg" alt="">
                        </div>
                      </div>
                      <!-- // Item -->
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- ***** Main Banner Area End ***** -->


<!-- ***** About Area Starts ***** -->
<section class="section" id="about">
    <div class="container">
        <div class="row">
            <div class="col-lg-6 col-md-6 col-xs-12">
                <div class="left-text-content">
                    <div class="section-heading">
                        <h6>About Us</h6>
                        <h2>Your Culinary Journey, Your Way</h2>
                    </div>
                    <p>Welcome to Klassy Cafe! We're delighted to offer you the opportunity to share your unique dining preferences in advance. By doing so, you'll help us create a tailored dining experience just for you.  <br><br>Your input allows us to prepare and cater to your diverse tastes, ensuring you have the best possible meal with us.</p>
                    <div class="row">
                        <div class="col-4">
                            <img src="assets/images/about-thumb-01.jpg" alt="">
                        </div>
                        <div class="col-4">
                            <img src="assets/images/about-thumb-02.jpg" alt="">
                        </div>
                        <div class="col-4">
                            <img src="assets/images/about-thumb-03.jpg" alt="">
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-6 col-md-6 col-xs-12">
                <div class="right-content">
                    <div class="thumb">
                        <a rel="nofollow" href="http://youtube.com"><i class="fa fa-play"></i></a>
                        <img src="assets/images/about-video-bg.jpg" alt="">
                    </div>
                </div>
            </div>
        </div>
    </div>
   
           
</section>
<!-- ***** About Area Ends ***** -->


<!-- ***** Menu Area Starts ***** -->
<section class="section" id="menu">
    <div class="container">
        <div class="row">
            <div class="col-lg-4">
                <div class="section-heading">
                    <h6>Our Menu</h6>
                    <h2>A Selection Of Our Signature Dishes</h2>
                </div>
            </div>
        </div>
    </div>
    <div class="menu-item-carousel">
        <div class="col-lg-12">
            <div class="owl-menu-item owl-carousel">
                <div class="item">
                    <div class='card card1'>
                       
                        <div class='info'>
                          <h1 class='title'>Kimichi</h1>
                          <p class='description'>A traditional Korean side dish made by fermenting salted vegetables, often napa cabbage or Korean radish.</p>
                         
                        </div>
                    </div>
                </div>
                <div class="item">
                    <div class='card card2'>
                       
                        <div class='info'>
                          <h1 class='title'>Egg & Chiken Katsudon</h1>
                          <p class='description'>fried chicken, onions, eggs, soy sauce over steamed rice.</p>
                         
                        </div>
                    </div>
                </div>
                <div class="item">
                    <div class='card card3'>
                        
                        <div class='info'>
                          <h1 class='title'>Spicy Thai Noodles</h1> 
                          <p class='description'>Thai dish with spicy chili-based sauce and noodles.</p>
                          
                        </div>
                    </div>
                </div>
                <div class="item">
                    <div class='card card4'>
                        
                        <div class='info'>
                          <h1 class='title'>Shoyu Ramen Noodles</h1>
                          <p class='description'>Shoyu ramen noodles are a Japanese noodle dish with soy sauce-based broth.</p>
                         
                        </div>
                    </div>
                </div>
                <div class="item">
                    <div class='card card5'>
                        
                        <div class='info'>
                          <h1 class='title'>Spicy Korean Tofu</h1>
                          <p class='description'>Tofu cooked in a spicy sauce, often flavored with ingredients like chili, garlic, and soy sauce.</p>
                          
                        </div>
                    </div>
                </div>
                
            </div>
        </div>
    </div>
</section>
<!-- ***** Menu Area Ends ***** -->

<!-- ***** Cuisine Area Starts ***** -->
<section class="section" id="chefs">
    <div class="container">
        <div class="row">
            <div class="col-lg-4 offset-lg-4 text-center">
                <div class="section-heading">
                    <h6>Our Cuisines</h6>
                    <h2>Diverse Asian Delights</h2>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-4">
                <div class="chef-item">
                    <div class="thumb">
                        <div class="overlay"></div>
                        <ul class="social-icons">
                            <li><a href="#"><i class="fa fa-facebook"></i></a></li>
                            <li><a href="#"><i class="fa fa-twitter"></i></a></li>
                            <li><a href="#"><i class="fa fa-instagram"></i></a></li>
                        </ul>
                        <img src="assets/images/japan_Cuisine.jpg" >
                    </div>
                    <div class="down-content">
                        <h4>Japanese Cuisine</h4>
                    </div>
                </div>
            </div>
            <div class="col-lg-4">
                <div class="chef-item">
                    <div class="thumb">
                        <div class="overlay"></div>
                        <ul class="social-icons">
                            <li><a href="#"><i class="fa fa-facebook"></i></a></li>
                            <li><a href="#"><i class="fa fa-twitter"></i></a></li>
                            <li><a href="#"><i class="fa fa-behance"></i></a></li>
                        </ul>
                        <img src="assets/images/korean_Cuisine.jpg" >
                    </div>
                    <div class="down-content">
                        <h4>Korean Cuisine</h4>
                    </div>
                </div>
            </div>
            <div class="col-lg-4">
                <div class="chef-item">
                    <div class="thumb">
                        <div class="overlay"></div>
                        <ul class="social-icons">
                            <li><a href="#"><i class="fa fa-facebook"></i></a></li>
                            <li><a href="#"><i class="fa fa-twitter"></i></a></li>
                            <li><a href="#"><i class="fa fa-google"></i></a></li>
                        </ul>
                        <img src="assets/images/thai_Cuisine.jpg" >
                    </div>
                    <div class="down-content">
                        <h4>Thai Cuisine</h4>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- ***** Cuisine Area Ends ***** -->



<section id="services">
    <div class="container">
        <div id="ServicesCon">
            <div class="col-lg-4 offset-lg-4 text-center">
                <div class="section-heading">
                    <h6>Service Information</h6>
                  
                </div>
            </div>
                <div id=serviceInfoContainer>
                   
                    <div id="serviceInfo">
                        <div class="serviceInfoIcons">
                            <p>Parking</p>
                            <img src="assets/images/vallet.png" >
                          </div>
                        <div class="serviceInfoIcons">
                            <p>Bar</p>
                            <img src="assets/images/alchohol.jpg" >
                          </div>
                          <div class="serviceInfoIcons">
                            <p>Toddler Chair</p>
                            <img src="assets/images/toddler.jpg" >
                          </div>
                          <div class="serviceInfoIcons">
                            <p>AC</p>
                            <img src="assets/images/AC.png" >
                          </div>
                        
                        
                       
                         
                        
                    </div>
                    <div id="serviceInfo">
                        <div class="serviceInfoIcons">
                            <p>Wifi</p>
                            <img src="assets/images/wifi.jpg" >
                        </div>
                        <div class="serviceInfoIcons">
                            <p>Visa</p>
                            <img src="assets/images/visa.png" >
                          </div>
                         <div class="serviceInfoIcons">
                            <p>No Smoking</p>
                            <img src="assets/images/no_smoking.png" >
                          </div>
                          <div class="serviceInfoIcons">
                            <p>No Pets</p>
                            <img src="assets/images/no_pets.jpg" >
                          </div>
                    </div>
                </div>
               
                <div id=contact_row2>
                    <div class="contact">
                        <i class="fas fa-clock"></i>
                        <h4>Opening Hours</h4>
                        <span>Daily: 12.00pm - 11.30pm</span>
                    </div>
               
                    <div class="contact">
                        <i class="fa fa-phone"></i>
                        <h4>Hotline</h4>
                        <span>+94 007 738 1234</span>
                    </div>
             
                    <div class="contact">
                        <i class="fas fa-rupee-sign"></i>
                        <h4>Price Range</h4>
                        <span>LKR 5000-15,000 for 2 Pax</span>
                    </div>
                </div>
                
                            
                               
                                    
                                    
                                            
                                    
                                       
              
        </div>
        

    </div>
           
</section>

@endsection
