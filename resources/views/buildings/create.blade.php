@extends('layouts.app')
@section('content')
<div class="container bootstrap snippet">
	<h1>Create Building</h1>
	<a name="forms">
		<a name="csrf-field">
			<form method='POST' action="/buildings" enctype="multipart/form-data">
				@csrf
				<!-- @method('POST') -->
			    <div class="form-group">
			    	<label>Money Pack</label>
			    	<input type="text" name="money_pack" placeholder="Money Pack" class="form-control">
			    </div>
			    <div class="form-group">
			    	<label>Price per kiloWatt</label>
			    	<input type="text" name="price_kw" placeholder="Price per kiloWatt" class="form-control">

			    </div>
			    <div class="form-group">
			    	<input type="submit" class="btn btn-primary">
				</div>
			</form>
		</a>
	</a>
</div>
@endsection
