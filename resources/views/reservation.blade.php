@extends('layouts.app')

@section('content')

<!-- ***** Reservation Us Area Starts ***** -->
<section class="section" id="reservation">
    <div class="container">
        <div class="row">
            <div class="col-lg-6 align-self-center">
                <div class="left-text-content">
                    <div class="section-heading">
                        <h6>Visit Us</h6>
                        <h2>Here You Can Make A Reservation and view your reservation history below.</h2>
                    </div>
                    <!--newly added-->
                    <p> Max 4 pax per table: For more than 4 packs please reserve multiple tables or, contact hotline for group reservations </p>
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

@if(isset($userReservations) && $userReservations->count() > 0)
    <br>
    <br>
    <div class="container">
        <h2>Your Reservations</h2>
        <table class="table">
            <thead>
                <tr>
                    <th>Reservation ID</th>
                    <th>Date</th>
                    <th>Time Slot</th>
                    <th>Number of Guests</th>
                    <th>Additional Information</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach($userReservations as $reservation)
                    @if($reservation->dining_status !== 'cancelled')
                        <tr>
                            <td>{{ $reservation->id }}</td>
                            <td>{{ $reservation->date }}</td>
                            <td>{{ $reservation->time_slot }}</td>
                            <td>{{ $reservation->number_of_guests }}</td>
                            <td>{{ $reservation->additional_info }}</td>
                            <td>
                                <form method="POST" action="{{ route('cancel_reservation', ['id' => $reservation->id]) }}">
                                    @csrf
                                    @method('POST')
                                    <button type="submit" class="btn btn-danger">Cancel Reservation</button>
                                </form>
                            </td>
                        </tr>
                    @endif
                @endforeach
            </tbody>
        </table>
    </div>
@else
    <div class="container">
        <br>
        <br>
        <h2>You have no reservations.</h2>
    </div>
@endif





@if(session('error'))
<div class="container">
    <div class="alert alert-danger">
        {{ session('error') }}
    </div>
</div>
@endif

@endsection

