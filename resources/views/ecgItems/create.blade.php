@extends('layouts.app')
@section('content')
<div class="container bootstrap snippet">
	<h1>Create ECG Item</h1>
	<a name="forms">
		<a name="csrf-field">
			<form method='POST' action="/ecgitems" enctype="multipart/form-data">
				@csrf
				<!-- @method('POST') -->
			    <div class="form-group">
			    	<label>Model</label>
			    	<input type="text" name="model" placeholder="Model" class="form-control">
			    </div> 
			    <div class="form-group">
			    	<label>Price</label>
			    	<input type="text" name="price" placeholder="Price" class="form-control">
			    </div>
			    
			    <div class="form-group">
			    	<label>Amount of Energy Consumption/Generation</label>
			    	<input type="text" name="energy_cg" placeholder="Amount of Energy Consumption/Generation" class="form-control">
			    </div>

			    <div class="form-group">
			    	<label>Quantity</label>
			    	<input type="text" name="quantity" placeholder="Quantity" class="form-control">
			    </div>

			    <div class="form-group">
			    	<label>Item Type</label>
			    	<select name="item_type" class="form-control">
			    		@foreach($minmax as $mm)
				    		<option value="{{$mm->item_type}}">{{$mm->item_type}}</option>
			    		@endforeach
			    	</select>
			    </div>
			    <div class="form-group">
			    	<label>Energy Type</label>
			    	<select name="energy_type" class="form-control">
			    		<option value="cons">Consuming</option>
			    		<option value="gen">Generating</option>
			    	</select>
			    </div>
			    <div class="form-group">
			    	<label>Is in house?</label>
			    	<select name="check" class="form-control">
			    		<option value="1">Yes</option>
			    		<option value="0">No</option>
			    	</select>
			    </div>
			    <div class="form-group">
			    	<label>Item Image</label>
				    <input type="file" name="image" class="form-control">
				</div>
			    <div class="form-group">
			    	<input type="submit" class="btn btn-primary">
				</div>
			</form>
		</a>
	</a>
</div>
@endsection
