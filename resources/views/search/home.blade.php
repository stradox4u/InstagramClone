@extends('layouts.app')

@section('content')
<div class="container">
    <form action="/search/index">
        @csrf

        <div class="form-group row d-flex pt-3">
            <label for="searchTerm" class="col-md-4 col-form-label text-md-right">Search:</label>

            <div class="col-md-6">
                <input id="searchTerm" type="searchTerm" class="form-control form-control-lg" name="searchTerm" value="" required autofocus placeholder="Enter Username here">
            </div>

            <button class="btn btn-outline-light">
                <img src="https://img.icons8.com/ios/50/000000/search.png" style="height: 30px; " />
            </button>
        
        </div>
    
    </form>
</div>
@endsection
