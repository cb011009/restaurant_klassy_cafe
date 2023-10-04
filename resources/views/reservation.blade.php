@extends('layouts.app')

@section('content')
<br>
<br>
<br>
<br>
<br>

<!-- ***** Reservation Us Area Starts ***** -->
<section class="section" id="reservation">
    <div class="container">
        <div class="row">
            <div class="col-lg-6 align-self-center">
                <div class="left-text-content">
                    <div class="section-heading">
                        <h6>Contact Us</h6>
                        <h2>Here You Can Make A Reservation Or Just walkin to our cafe</h2>
                    </div>
                    <p>Donec pretium est orci, non vulputate arcu hendrerit a. Fusce a eleifend riqsie, namei sollicitudin urna diam, sed commodo purus porta ut.</p>
                    <div class="row">
                        <div class="col-lg-6">
                            <div class="phone">
                                <i class="fa fa-phone"></i>
                                <h4>Phone Numbers</h4>
                                <span><a href="#">080-090-0990</a><br><a href="#">080-090-0880</a></span>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="message">
                                <i class="fa fa-envelope"></i>
                                <h4>Emails</h4>
                                <span><a href="#">hello@company.com</a><br><a href="#">info@company.com</a></span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-6">
                <div class="contact-form">
                    <form id="contact" action="{{ route('reservation_store') }}" method="post">
                        @csrf <!-- Add CSRF protection -->
                        <div class="row">
                            <div class="col-lg-12">
                                <h4>Table Reservation</h4>
                            </div>
                            <div class="col-lg-6 col-sm-12">
                                <fieldset>
                                    <input name="number_of_guests" type="number" id="number_of_guests" placeholder="Number of Guests*" required>
                                </fieldset>
                            </div>
                            <div class="col-lg-6">
                                <fieldset>
                                <input name="date" id="date" type="date" required>
                            </fieldset>
                            </div>
                            
                            <div class="col-md-6 col-sm-12">
                                <fieldset>
                                    <select name="time_slot" id="time" required>
                                        <option value="">Select Time Slot</option>
                                        <option value="Lunch - 12:00 PM">Lunch - 12:00 PM</option>
                                        <option value="Lunch - 12:30 PM">Lunch - 12:30 PM</option>
                                        <option value="Lunch - 1:00 PM">Lunch - 1:00 PM</option>
                                        <option value="Lunch - 1:30 PM">Lunch - 1:30 PM</option>
                                        <option value="Lunch - 1:00 PM">Lunch - 2:00 PM</option>
                                        <option value="Lunch - 2:00 PM">Lunch - 2:30 PM</option>
                                        <option value="Dinner - 7:00 PM">Dinner - 7:00 PM</option>
                                        <option value="Dinner - 7:30 PM">Dinner - 7:30 PM</option>
                                        <option value="Dinner - 8:00 PM">Dinner - 8:00 PM</option>
                                        <option value="Dinner - 8:30 PM">Dinner - 8:30 PM</option>
                                        <option value="Dinner - 9:00 PM">Dinner - 9:00 PM</option>
                                        <option value="Dinner - 9:30 PM">Dinner - 9:30 PM</option>
                                        <option value="Dinner - 10:00 PM">Dinner - 10:00 PM</option>
                                        <!-- Add more time slots as needed -->
                                    </select>
                                </fieldset>
                            </div>
                            <div class="col-lg-12">
                                <fieldset>
                                    <select name="occasion" id="occasion">
                                        <option value="">Select Occasion (Optional)</option>
                                        <option value="Birthday">Birthday</option>
                                        <option value="Business">Business</option>
                                        <option value="Romantic">Romantic</option>
                                        <!-- Add more options as needed -->
                                    </select>
                                </fieldset>
                            </div>
                            <div class="col-lg-12">
                                <fieldset>
                                    <textarea name="additional_info" rows="6" id="additional_info" placeholder="Additional Information (Optional)"></textarea>
                                </fieldset>
                            </div>
                            <div class="col-lg-12">
                                <fieldset>
                                    <button type="submit" id="form-submit" class="main-button-icon">Make A Reservation</button>
                                </fieldset>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

   
</section>

@if(isset($userReservation)) <!-- Check if $userReservation is set -->
<div class="container">
    <h2>Reservation Details</h2>
    <p>Your reservation has been successfully booked!</p>

    <h3>Reservation Information</h3>
    <ul>
        <li>Reservation ID: {{ $userReservation->id }}</li>
        <li>Date: {{ $userReservation->date }}</li>
        <li>Time Slot: {{ $userReservation->time_slot }}</li>
        <li>Number of Guests: {{ $userReservation->number_of_guests }}</li>
        <!--<li>Table Number: {{ $userReservation->table->table_number }}</li>-->
        <!-- Add other reservation details as needed -->
    </ul>

    <!-- You can provide links or buttons for the user to go back or perform other actions -->
</div>
@endif



@endsection
