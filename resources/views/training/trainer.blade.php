@extends('layouts.app')

@section('content')
<div class="panel-body">
<!-- Display Validation Errors -->
<form >
@foreach ($trainers as $trainer)
{{ $trainer }}

@endforeach
</form>
</div>
@endsection
