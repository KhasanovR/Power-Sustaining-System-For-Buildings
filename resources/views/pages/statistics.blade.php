@extends('layouts.app')
{{-- @section('script')
	<script type="text/javascript">
	var currentSeason=@json($ranks);
	console.log(currentSeason);
	var level=@json($levels);
	</script>
@endsection
 --}}
@section('content')
{{--front--}}
<div class="container statistics" ng-controller="statistics">
	<div class="row my-5">
		<div class="col-md-6">
			<h5 class="my-5">Current Season</h5>
			<table class="table">
				<thead class="thead-main">
				<tr>
					<th>Nick Name</th>
					<th>Rank</th>
					<th></th>
				</tr>
				</thead>
				<tbody>
					@php
					$i = 1;
					@endphp
					@foreach($ranks as $rank)
						<tr >
							<td>{{$rank->user->Nickname}}</td>
							<td>{{$i++}}</td>
							<td>
								<a class="btn btn-primary" style="color: #fff;">Guide
									<img src="/storage/images/info.svg" alt="">
								</a>
							</td>
						</tr>
					@endforeach
				</tbody>
			</table>
		</div>
		<div class="col-md-6">
			<h5 class="my-5">Level</h5>
			<table class="table">
				<thead class="thead-main">
				<tr>
					<th>Nick Name</th>
					<th>Level</th>
					<th></th>
				</tr>
				</thead>
				<tbody>
				@php
				$i = count($levels);
				@endphp
				@foreach($levels as $level)
					<tr>
						<td>{{$level->rank->user->Nickname}}</td>
						<td>{{$i--}}</td>
						<td>
							{{--Link to Guide--}}
							<a class="btn btn-primary" style="color: #fff;">Guide
								<img src="/storage/images/info.svg" alt="">
							</a>
						</td>
					</tr>
				@endforeach
				</tbody>
			</table>
		</div>
	</div>
</div>

@endsection
