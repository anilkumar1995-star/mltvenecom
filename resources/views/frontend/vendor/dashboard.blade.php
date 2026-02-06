@extends('frontend.layouts.app')

@section('title', 'Vendor Dashboard')

@section('content')
<div class="container py-5">
    <div class="row">
        <div class="col-12">
            <h2 class="mb-4">Vendor Dashboard</h2>
            <div class="card">
                <div class="card-body">
                    <p>Welcome, {{ auth()->user()->name }}!</p>
                    <p>This is your vendor dashboard.</p>
                    
                    <div class="mt-4">
                        <a href="{{ route('logout') }}" class="btn btn-danger" 
                           onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                            Logout
                        </a>
                        <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                            @csrf
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
