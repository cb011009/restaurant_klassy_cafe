@extends('layouts.app')

@section('content')

<section class="section">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <div class="alert alert-success">
                    <strong>Success!</strong> {{ session('success') }}
                </div>
            </div>
        </div>
    </div>
</section>

@endsection
