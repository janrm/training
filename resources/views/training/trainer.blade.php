@extends('layouts.app')

@section('content')
<div class="panel-body">
<!-- Display Validation Errors -->
<form name="trainers" id="trainers" class="form"
		action="{{ url('/')}}/training"
		method="post">
{{ csrf_field() }}
<table class="table table-condensed table-bordered">
@foreach ($trainingDates as $date_id => $trainingDate)
<tr><td>{{$trainingDate->start}}</td><td>{{$trainingDate->end}}</td><td>{{$teams[$trainingDate->team_id]}}</td>
<fieldset>
<!--input type="hidden" name="trainingDate_id[{{$trainingDate->id}}]" value="{{$trainingDate->id}}"/-->
<input type="hidden" name="trainingDate_team_id[{{$trainingDate->id}}]" value="{{$trainingDate->team_id}}"/>
<td>
@foreach ($trainers as $trainer_id => $trainer)
<input type="checkbox" 
@if ($trainer_id == $trainingDate->id) 
checked 
@endif name="trainer[{{$trainingDate->id}}][{{$trainer_id}}]" value="{{$trainer_id}}">&nbsp;{{$trainer}}<br/>
@endforeach
</fieldset></td></tr>
@endforeach
</table>
<input type="submit" name="trainers" value="Verzenden"/>
</form>
</div>
@endsection
