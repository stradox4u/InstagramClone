@extends('layouts.app')

@section('content')
<div class="container">
    <table class="table table-striped table-borderless table-hover">
        <thead class="thead-dark">
            <tr>
                <th>Name</th>
                <th>Username</th>
            </tr>
        </thead>
        <tbody>
        @if (count($results) == 0)
        <p>No results for your search term. Please try another search term.</p>
        @else
        @foreach($results as $result)
            <tr>
                <td>{{ $result->name }}</td>
                <td>{{ $result->username }}</td>
            </tr>
        @endforeach
        @endif
        
        </tbody>
    </table>
    <div>
        <a href="/profile/{{Auth::user()->id }}">Go To Profile</a>
    </div>
</div>
@endsection