@extends('layouts.app')
@section('content')
<div class="container bootstrap snippet">
	<h1>Create Building</h1>
	<a name="forms">
		<a name="csrf-field">
			<form method='POST' action="/minmaxes">
				@csrf
				<!-- @method('POST') -->
			    <div class="form-group">
			    	<label>Item Type</label>
			    	<input type="text" name="item_type" placeholder="Item Type" class="form-control">
			    </div>
			    <div class="form-group">
			    	<label>Min</label>
			    	<input type="text" name="min" placeholder="Min" class="form-control">
			    </div>
			    <div class="form-group">
			    	<label>Max</label>
			    	<input type="text" name="max" placeholder="Max" class="form-control">
			    </div>
			    <div class="form-group">
			    	<input type="submit" class="btn btn-primary" onclick="console.log('Clicked');">
				</div>
			</form>
		</a>
	</a>
</div>
@endsection
