@extends('layouts.app')

@section('content')
<br>
<br>
<br>
<br>
<br>

    <div class="container mt-5">
        <div class="alert alert-info" role="alert">
            {{ $message }}
        </div>

        <form action="{{ route('chat') }}" method="POST" class="mt-3">
            @csrf
            <div class="input-group">
                <input type="text" name="message" class="form-control" placeholder="Type your message" aria-label="Type your message" aria-describedby="button-addon2">
                <div class="input-group-append">
                    <button class="btn btn-primary" type="submit" id="button-addon2">Send</button>
                </div>
            </div>
        </form>
    </div>
@endsection
