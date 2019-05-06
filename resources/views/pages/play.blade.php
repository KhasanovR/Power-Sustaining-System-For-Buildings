@extends('layouts.app')

@section('content')

    <div class="container-fluid">
        <div class="row my-5">
            <div class="col-md-6">
                <div class="playCard">
                    <a href="/constructor">
                        <img src="/storage/images/construction.png" alt="home construction">
                        <h3>Home construction</h3>
                    </a>
                </div>
            </div>
            <div class="col-md-6">
                <div class="playCard">
                    <a href="/shop">
                        <img src="/storage/images/shop.jpg" alt="home construction">
                        <h3>Item store</h3>
                    </a>
                </div>
            </div>
        </div>
    </div>
@endsection
