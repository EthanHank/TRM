@extends('layouts.user')

@section('header')
    User Dashboard
@endsection

@section('content')
<div class="row justify-content-center" style="height: 100vh;">
    <div class="col-md-8">
        <div class="card shadow-sm" data-aos="fade-up">
            <div class="card-body">
                <h4 class="card-title mb-3" data-aos="fade-down">Welcome, {{ Auth::user()->name }}!</h4>
                <p class="card-text text-muted">This is your dashboard. More features coming soon.</p>
            </div>
        </div>
    </div>
</div>
@endsection
