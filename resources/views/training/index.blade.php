@extends('layouts.app')

@section('content')
<div class="panel-body">
<!-- Display Validation Errors -->


<table>
@foreach($trainings as $training)
	<tr><td>{{ $training->start }}</td><td>{{$training->end}}</td><td>{{$training->location_id}}</td><td>{{$training->team_id}}</td></tr>
	@endforeach
<table>
</div>
@endsection