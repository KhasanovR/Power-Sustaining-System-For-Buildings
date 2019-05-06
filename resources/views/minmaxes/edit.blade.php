@extends('layouts.app')
@section('content')
<div class="container bootstrap snippet">
	<h1>Edit Item Type</h1>
	<a name="forms">
		<a name="csrf-field">
			<form method='POST' action="/minmaxes/{{$minmax->item_type}}">
				@csrf
				@method('POST')
				{{-- <input type="hidden" name="prev_item_type" value="{{$minmax->item_type}}"> --}}
			    <div class="form-group">
			    	<label>Item Type</label>
			    	<input type="text" name="item_type" placeholder="Item Type" class="form-control" value="{{$minmax->item_type}}">
			    </div>
			    <div class="form-group">
			    	<label>Min</label>
			    	<input type="text" name="min" placeholder="Min" class="form-control" value="{{$minmax->min}}">
			    </div>
			    <div class="form-group">
			    	<label>Max</label>
			    	<input type="text" name="max" placeholder="Max" class="form-control" value="{{$minmax->max}}">
			    </div>
			    <div class="form-group">
			    	<input type="submit" class="btn btn-primary">
				</div>
			</form>
		</a>
	</a>
</div>
@endsection
