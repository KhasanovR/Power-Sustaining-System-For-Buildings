@extends('layouts.app')

@section('script')
    <script rel="text/javascript" src="{{asset('js/angular.js')}}"></script>
    <script type="text/javascript">
        var item=@json($items);
    </script>
@endsection

@section('content')
    <div id="wrapper">
        <div id="sidebar-wrapper">
            <button class="close1" id="menu-toggle1"></button>
            <ul class="sidebar-nav">
                <li ng-repeat="item in cart track by $index">
                    <div class="col-md-12 my-2 pl-1">
                        <div class="card">
                            <div class="row no-gutters">
                                <div class="col-md-4">
                                    <img ng-src="@{{item.img}}" class="" alt="">
                                </div>
                                <div class="col-md-8">
                                    <span>@{{item.to}}</span>
                                    <h5 class="card-title">@{{item.name}}</h5>
                                    <h6>@{{item.price | currency}}</h6>
                                </div>
                            </div>
                            <div class="row">
                                <h5 class="card-text text-muted">@{{  item.count +  " - $" + getCost(item)}}</h5>
                                <div class="btn-group m-4">
                                    <button type="button" class="btn btn-outline-danger" ng-click="removeItemCart(item);">-</button>
                                    <input type="text" id="quantity" name="quantity" class="form-control input-number" ng-model="item.count">
                                    <button type="button" ng-disabled="givenPrice - getTotal() + getSellTotal() < item.price" ng-click="addItem(item);" class="btn btn-outline-success">+</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </li>

                <li ng-repeat="item in cartSell track by $index">
                    <div class="col-md-12 my-2 pl-1">
                        <div class="card">
                            <div class="row no-gutters">
                                <div class="col-md-4">
                                    <img ng-src="@{{item.img}}" class="" alt="">
                                </div>
                                <div class="col-md-8">
                                    <span>@{{item.to}}</span>
                                    <h5 class="card-title">@{{item.name}}</h5>
                                    <h6>@{{item.price | currency}}</h6>
                                </div>
                            </div>
                            <div class="row">
                                <h5 class="card-text text-muted">@{{  item.count +  " - $" + getCost(item)}}</h5>
                                <div class="btn-group m-4">
                                    <button type="button" class="btn btn-outline-danger" ng-click="removeItemSellCart(item);">-</button>
                                    <input type="text" id="quantity" name="quantity" class="form-control input-number" ng-model="item.count">
                                    <button type="button" ng-disabled="item.quantity == 0" ng-click="sellItem(item);" class="btn btn-outline-success">+</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </li>
            </ul>
            <div ng-if="getTotal() == 0 && getSellTotal() == 0">
                <h4 class="text-center my-5" style="color: #fff">Your cart is empty</h4>
            </div>
            <div class="col-md-12 my-4" ng-if="getTotal() != 0">
                <h4 style="color: white">Total: @{{getTotal() | currency}}</h4>
            </div>
            <div class="col-md-12 my-4" ng-if="getSellTotal() != 0">
                <h4 style="color: white">Sell Total: @{{getSellTotal() | currency}}</h4>
            </div>
            <div class="col-md-12 my-4 text-center" ng-if="getTotal() != 0 || getSellTotal() != 0">
                <button class="btn btn-light">Purchase</button>
                <button class="btn btn-danger" ng-click="clearCart()">Drop items</button>
            </div>
        </div>
    </div>


    <div class="container-fluid main1">
        <div class="container">
            <div class="row shop-top">
                <div class="col-md-3">
                    <p><span>Given price:</span> @{{ '$' + (givenPrice - getTotal() + sellingPrice())  }} </p>
                </div>
                <div class="col-md-3">
                    <p><span>Purchase price:</span> @{{ '$' + getTotal() }} </p>
                </div>
                <div class="col-md-3">
                    <p><span>Selling price:</span> @{{ '$' + sellingPrice() }}</p>
                </div>
                <div class="col-md-3">
                    <a href="#menu-toggle" id="menu-toggle"><img src="data/img/shopping-cart.svg" alt=""> @{{ cart.length + cartSell.length }}</a>
                    <!-- <button ng-click="clearCart();"">clear</button> -->
                </div>
            </div>
        </div>
        <div class="row m-3 shop-card">
            <div class="col-md-6">
                <h5>UserName suggests you these items</h5>
                <div class="row">
                    <div class="col-md-6">

                        <div class="row" ng-repeat="item in items" ng-if="item.type == 'energy consuming'">
                            <div class="card">
                                <img class="card-img-top" ng-src="@{{ item.img }}" alt="Card image">
                                <div class="card-body">
                                    <h4 class="card-title">@{{item.name}}</h4>
                                    <p class="card-text">@{{ item.type }}</p>
                                    <p class="card-text">@{{ item.desc }}</p>
                                    <div class="row">
                                        <div class="col-md-12">
                                            <button ng-disabled="givenPrice - getTotal() + getSellTotal() < item.price" class="btn btn-primary" ng-click="addItem(item)">Buy - @{{ item.price | currency }}</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="row" ng-repeat="item in items" ng-if="item.type == 'energy generating'">
                            <div class="card">
                                <img class="card-img-top" ng-src="@{{item.img}}" alt="Card image">
                                <div class="card-body">
                                    <h4 class="card-title">@{{item.name}}</h4>
                                    <p class="card-text">@{{item.type}}</p>
                                    <p class="card-text">@{{item.desc}}</p>
                                    <div class="row">
                                        <div class="col-md-12">
                                            <button ng-disabled="givenPrice - getTotal() + getSellTotal() < item.price" class="btn btn-primary" ng-click="addItem(item)">Buy - @{{ item.price | currency }}</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-6">
                <h5>Already at home</h5>
                <div class="row" >
                    <div class="col-md-6">
                        <div class="row" ng-repeat="atHomeItem in itemsAtHome" ng-if="atHomeItem.type == 'energy consuming'">
                            <div class="card">
                                <img class="card-img-top" ng-src="@{{atHomeItem.img}}" alt="Card image">
                                <div class="card-body">
                                    <h4 class="card-title">@{{atHomeItem.name}}</h4>
                                    <p class="card-text">@{{atHomeItem.type}}</p>
                                    <p class="card-text">@{{atHomeItem.desc}}</p>
                                    <div class="row">
                                        <div class="col-md-7">
                                            <button ng-disabled="atHomeItem.quantity == 0" class="btn btn-primary" ng-click="sellItem(atHomeItem)">Sell - @{{ atHomeItem.price | currency }}</button>
                                        </div>
                                        <div class="col-md-5">
                                            <span>Quantity: </span>@{{atHomeItem.quantity}}
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="row" ng-repeat="atHomeItem in itemsAtHome" ng-if="atHomeItem.type == 'energy generating'">
                            <div class="card">
                                <img class="card-img-top" ng-src="@{{atHomeItem.img}}" alt="Card image">
                                <div class="card-body">
                                    <h4 class="card-title">@{{atHomeItem.name}}</h4>
                                    <p class="card-text">@{{atHomeItem.type}}</p>
                                    <p class="card-text">@{{atHomeItem.desc}}</p>
                                    <div class="row">
                                        <div class="col-md-7">
                                            <button ng-disabled="atHomeItem.quantity == 0" class="btn btn-primary" ng-click="sellItem(atHomeItem)">Sell - @{{ atHomeItem.price | currency }}</button>
                                        </div>
                                        <div class="col-md-5">
                                            <span>Quantity: </span>@{{atHomeItem.quantity}}
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection