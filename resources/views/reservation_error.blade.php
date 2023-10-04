@extends('layouts.app')

@section('content')

<section class="section">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <div class="alert alert-danger">
                    <strong>Error!</strong> {{ session('error') }}
                </div>
            </div>
        </div>
    </div>
</section>

@endsection
