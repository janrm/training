@extends('layouts.app') @section('content')
<link rel="stylesheet"
	href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-alpha.5/css/bootstrap.min.css"
	integrity="sha384-AysaV+vQoT3kOAXZkl02PThvDr8HYKPZhNT5h/CXfBThSRXQ6jW5DO2ekP5ViFdi"
	crossorigin="anonymous">
<div class="panel-body">
	<!-- Display Validation Errors -->
	Training Overview : {{ $trainer->name }}
	<table class="table">
		@foreach ($trainings as $training_id => $training)
		<tr id="training_{{$training->id}}">
			<td>{{ date_format(date_create($training->start), 'd-m-Y H:i')}} - {{
				date_format(date_create($training->end), 'H:i')}}</td>
			<td>{{
				date_diff(date_create($training->end),date_create($training->start))->format('%H:%I')
				}}</td>
			<td>{{ $teams[$training->team_id] }}</td>
			<!--td>{{ $training->pivot->status }}</td-->
			<td id="training_button{{$training->id}}"><button
					title="Klik hier om de training te bevestigen"
					id="{{$training->id}}" type="button"
					class="btn btn-success status_confirm" style="color: #E0E0E0;">Bevestingen
					&check;</button>
				<button title="Klik hier wanneer de training is afgelast"
					id="{{$training->id}}" type="button"
					class="btn btn-danger status_cancel" style="color: #e0e0e0;">Afgelast
					&cross;</button>
				<button
					title="Klik hier wanneer de training is vervangen door een andere trainer."
					id="{{$training->id}}" type="button"
					class="btn btn-warning status_changed" style="color: #e0e0e0;">Vervangen
					&circlearrowright;</button></td>
		</tr>
		@endforeach
	</table>
</div>
<script src="https://code.jquery.com/jquery-3.1.1.min.js"></script>
<script src="//github.hubspot.com/tether/dist/js/tether.js"></script>
<script
	src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-alpha.5/js/bootstrap.min.js"
	integrity="sha384-BLiI7JTZm+JWlgKa0M0kGRpJbF2J8q+qreVrKBC47e3K6BW78kGLrCkeRX6I9RoK"
	crossorigin="anonymous"></script>
<script>
    $(document).ready(function(){   
		init_button();
	});

	function init_button() {   
		$('.status_confirm').unbind('click'); 
		$('.status_confirm').click(function(){
	        var thisid = $(this).attr('id');
	        var this_html = $("#training_button"+thisid).html(); 
	        $.ajax({
	            url: "status/confirmed/",
	            method: "POST",
	            data: {
	                id: thisid
	            },
	            success: function (response) {
					$("#training_button"+thisid).html('<button id="'+thisid+'" type="button" class="status_confirm btn btn-success">&check; Bevestigd</button><button id="reset_'+thisid+'" type="button" class="btn status_reset">Reset</button>');
					$("#reset_"+thisid).click(function(){
						$.ajax({
				            url: "status/reset/",
				            method: "POST",
				            data: {
				                id: thisid
				            },
				            success: function (response) {
								$("#training_button"+thisid).html(this_html); 
								init_button();
							}				
						});
	        		});
	        	}
	    	});
	    });
	    $('.status_cancel').unbind('click');
	    $('.status_cancel').click(function(){
	        var thisid = $(this).attr('id');
	        var this_html = $("#training_button"+thisid).html(); 
	
	        $.ajax({
	            url: "status/confirmed/",
	            method: "POST",
	            data: {
	                id: thisid
	            },
	            success: function (response) {
					$("#training_button"+thisid).html('<button id="'+thisid+'" type="button" class="status_confirm btn btn-success">&cross; Afgelast</button><button id="reset_'+thisid+'" type="button" class="btn status_reset">Reset</button>');
					$("#reset_"+thisid).click(function(){
						$.ajax({
				            url: "status/reset/",
				            method: "POST",
				            data: {
				                id: thisid
				            },
				            success: function (response) {
								$("#training_button"+thisid).html(this_html); 
								init_button();
							}						
						});
	        		});
	        	}
	    	});
	    });
	    $('.status_changed').unbind('click');
	    $('.status_changed').click(function(){
	        var thisid = $(this).attr('id');
	
	        $.ajax({
	            url: "status/changed/",
	            method: "POST",
	            data: {
	                id: thisid
	            },
	            success: function (response) {
					$("#training_button"+thisid).html('<button id="'+thisid+'" type="button" class="status_confirm btn btn-success">&circlearrowright; Vervangen</button><button id="reset_'+thisid+'" type="button" class="btn status_reset">Reset</button>');
					$("#reset_"+thisid).click(function(){
						$.ajax({
				            url: "status/reset/",
				            method: "POST",
				            data: {
				                id: thisid
				            },
				            success: function (response) {
								$("#training_button"+thisid).html(this_html); 
								init_button();
							}						
						});
	        		});
	        	}
	    	});
	    });
    };
</script>
@endsection

