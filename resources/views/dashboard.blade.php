@extends('layouts.app')
@section('content')
<style type="text/css">
    .table div{
         border-bottom: 1px solid;
         padding: 5px;
    }
</style>
    @php
        $user = auth()->user();
    @endphp
    <div class="container bootstrap snippet">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">Dashboard</div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-sm-3">
                                <div class="text-center">
                                    <img src="/storage/images/{{$user->avatar}}" alt="avatar">
                                    <div class="m-2">
                                        {{$user->Nickname}}
                                    </div>
                                    </div>
                            </div>
                            <div class="col-sm-9">
                                <div class="row">
                                    <div class="col-sm-3 mt-2 md-2">
                                        Name:
                                    </div>
                                    <div class="col-sm-9 mt-2 md-2">
                                        {{$user->Fname}}
                                        {{$user->Lname}}
                                    </div>
                                    
                                    @if(count($user->phones) > 0)
                                        <div class="col-sm-3 mt-2 md-2">
                                            Phones:
                                        </div>
                                        <div class="col-sm-9 mt-2 md-2">
                                            @foreach($user->phones as $phone)
                                            {{$phone->phone}}<br>
                                            @endforeach
                                        </div>
                                    @endif

                                    <div class="col-sm-3 mt-2 md-2">
                                        Email:
                                    </div>
                                    <div class="col-sm-9 mt-2 md-2">
                                        {{$user->email}}
                                    </div>

                                    <div class="col-sm-3 mt-2 md-2">
                                        Type:
                                    </div>
                                    <div class="col-sm-9 mt-2 md-2">
                                        @if($user->type == 'pl')
                                        Player
                                        @else
                                        Content Manager
                                        @endif
                                    </div>
                                    @if(!empty($user->rank))
                                        <div class="col-sm-3 mt-2 md-2">
                                            Pts of Rank:
                                        </div>
                                        <div class="col-sm-9 mt-2 md-2">
                                            {{$user->rank->rank_no}}
                                        </div>
                                    @endif
                                    
                                    @if(!empty($user->rank->level))
                                        <div class="col-sm-3 mt-2 md-2">
                                            Pts of Level:
                                        </div>
                                        <div class="col-sm-9 mt-2 md-2">
                                            {{$user->rank->level->level_no}}
                                        </div>
                                    @endif
                                </div>
                            </div>
                        </div>  
                        @if($user->type == 'cm')
                        <hr>
                        <div class="row">
                            <div class="m-5">
                                <div class="row table">
                                        <div class="col-sm-2" style="font-weight: bold">
                                            Season     
                                        </div>
                                        <div class="col-sm-3" style="font-weight: bold">
                                            Money Pack
                                        </div>
                                        <div class="col-sm-7" style="font-weight: bold">
                                            Price per kW
                                        </div>
                                        @foreach($buildings as $building)
                                            <div class="col-sm-2">
                                                {{$building->season}}
                                            </div>
                                            <div class="col-sm-3">
                                                {{$building->money_pack}}
                                            </div>
                                            <div class="col-sm-3">
                                                {{$building->price_kw}}
                                            </div>
                                            <div class="col-sm-2">
                                                <a href="/buildings/{{$building->season}}" class="btn btn-primary">Edit</a>
                                            </div>
                                            <div class="col-sm-2">
                                                <a name="forms">
                                                    <a name="csrf-field">
                                                        <form method='POST' action="/buildings/{{$building->season}}">
                                                            @csrf
                                                            @method('DELETE')
                                                            <input type="submit" class="btn btn-danger" value="Delete">
                                                        </form>
                                                    </a>
                                                </a>
                                            </div>
                                        @endforeach
                                </div>  
                            </div> 
                        </div>
                        <hr>
                        <div class="row">
                            <div class="m-5">
                                <div class="row table">
                                        <div class="col-sm-4" style="font-weight: bold">
                                            Item  Types     
                                        </div>
                                        <div class="col-sm-2" style="font-weight: bold">
                                            Min
                                        </div>
                                        <div class="col-sm-6" style="font-weight: bold">
                                            Max
                                        </div>
                                        @foreach($minmaxes as $minmax)
                                            <div class="col-sm-4">
                                                {{$minmax->item_type}}
                                            </div>
                                            <div class="col-sm-2">
                                                {{$minmax->min}}
                                            </div>
                                            <div class="col-sm-2">
                                                {{$minmax->max}}
                                            </div>
                                            <div class="col-sm-2">
                                                <a href="/minmaxes/{{$minmax->item_type}}" class="btn btn-primary">Edit</a>
                                            </div>
                                            <div class="col-sm-2">
                                                <a name="forms">
                                                    <a name="csrf-field">
                                                        <form method='POST' action="/minmaxes/{{$minmax->item_type}}">
                                                            @csrf
                                                            @method('DELETE')
                                                            <input type="submit" class="btn btn-danger" value="Delete">
                                                        </form>
                                                    </a>
                                                </a>
                                            </div>
                                        @endforeach
                                </div>  
                            </div> 
                        </div>
                        <hr>
                        {{-- {{dd($ecg_items)}} --}}
                        <div class="row">
                            <div class="m-5">
                                <div class="row table">
                                        <div class="col-sm-2" style="font-weight: bold">
                                                Image
                                        </div>
                                        <div class="col-sm-2" style="font-weight: bold">
                                            model   
                                        </div>
                                        <div class="col-sm-1" style="font-weight: bold">
                                            price
                                        </div>
                                        <div class="col-sm-2" style="font-weight: bold">
                                            Energy <br> Type
                                        </div>
                                        <div class="col-sm-2" style="font-weight: bold">
                                            Enegery <br>   Usage
                                        </div>
                                        <div class="col-sm-1" style="font-weight: bold">
                                            Item <br> Type   
                                        </div>
                                        <div class="col-sm-2" style="font-weight: bold">
                                        </div>
                                        @foreach($ecg_items as $ecg)
                                            <div class="col-sm-2">
                                                <img src="/storage/images/{{$ecg->image}}" width="100%;">
                                            </div>
                                            <div class="col-sm-2">
                                                {{$ecg->model}}
                                            </div>
                                            <div class="col-sm-1">
                                                {{$ecg->price}}
                                            </div>
                                            <div class="col-sm-2">
                                                {{$ecg->energy_type}}
                                            </div>
                                            <div class="col-sm-2">
                                                {{$ecg->energy_cg}}
                                            </div>
                                            <div class="col-sm-1">
                                                {{$ecg->item_type}}
                                            </div>
                                            <div class="col-sm-2">
                                                <p>
                                                    <a href="/ecgitems/{{$ecg->id}}" class="btn btn-primary" style="width: 100%">Edit</a>
                                                </p>
                                                <p>
                                                    <a name="forms">
                                                        <a name="csrf-field">
                                                            <form method='POST' action="/ecgitems/{{$ecg->id}}">
                                                                @csrf
                                                                @method('DELETE')
                                                                <input type="submit" class="btn btn-danger" value="Delete"  style="width: 100%">
                                                            </form>
                                                        </a>
                                                    </a>
                                                </p>
                                            </div>
                                        @endforeach
                                </div>  
                            </div> 
                        </div>
                        @endif                        
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
