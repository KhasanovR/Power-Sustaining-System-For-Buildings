@extends('layouts.app')


@section('content')
    <div class="card card-profile">
        <div class="card-avatar">
            <a href="#">
                <img src="{{$user->avatar}}" alt="">
            </a>
        </div>
        <div class="card-body">
            <h6 class="card-category text-gray">
                <td>{{$user->FName}}</td>
                <td>{{$user->MName}}</td>
                <td>{{$user->LName}}</td>
                <td>{{$user->email}}</td>
                <td>{{$user->type}}</td>
                @if($user->type == "pl")
                    <td> Player</td>
                @endif
            </h6>
        </div>
    </div>
@endsection