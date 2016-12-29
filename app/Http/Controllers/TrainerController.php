<?php

namespace App\Http\Controllers;

use App\Trainer;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class TrainerController extends Controller
{

	public function index(Request $request, $trainer_id)
	{
	$trainer = Trainer::find($trainer_id);
	
	$trainings = $trainer->training()->withPivot('status')->orderBy('status')->orderBy('start')->orderBy('team_id')->get();
	return view('trainer.index',['trainings' => $trainings, 'trainer' => $trainer,  'teams' => [1001 => 'MD1',
1002 => 'JB1',
1003 => 'MB2',
1004 => 'JA1',
1005 => 'MD2',
1006 => 'MB1',
1007 => 'MA2',
1008 => 'MA1',
1009 => 'MD3',
1010 => 'MC5',
1011 => 'MC1',
1012 => 'JC1',
1013 => 'MB4',
1014 => 'MD4',
1015 => 'MC4',
1016 => 'MC2',
1017 => 'MC3',
1018 => 'MB3', ]
]);
	}

	public function update_status(Request $request)
	{
	$input = $request->all();
	//return response()->json(['OK' => 'Status Changed']);
	return response()->json(['OK' => true]);
	}
}
