<?php

namespace App\Http\Controllers;

use App\Training;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;

class TrainingController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        
    	$trainingDates = Training::select(DB::raw('DISTINCT DATE_FORMAT(start,\'%e-%c-%Y\') as startDate, DATE(start) as start'))->where(DB::raw('start'),'<',DB::raw('now()'))->orderBy('start')->get();
    	foreach ($trainingDates as $trainingDate => $date) {
    	$trainings[$date['startDate']] = Training::select(DB::raw('TIME_FORMAT(start,\'%H:%i\') as startTime'), DB::raw('TIME_FORMAT(end,\'%H:%i\') as endTime'),'status_id','team_id')
		->where([[DB::raw('DATE(start)'),'=',$date['start']],[DB::raw('start'),'<',DB::raw('now()')]])
		->orderBy('start')
    		->get();
    	}
        return view('training.index',['trainings' => $trainings]);//
    }

	    public function trainers()
	    {
	$trainingDates = Training::where('start','<','2016-12-03 00:00:00')->orderBy('team_id')->get();
	return view('training.trainer',['trainers' => [
		1000 => 'Maarten Salverda', 
		1001 => 'Ellemijn Meeuwes', 
		1002 => 'Elise Talen', 
		1003 => 'Kim Pullen', 
		1004 => 'Daphne Brouwer', 
		1005 => 'Megan Potman', 
		1006 => 'Kaisly Joosten', 
		1007 => 'Ties Allersma', 
		1008 => 'Frederique Rijkse', 
		1009 => 'Maarten Schut', 
		1010 => 'Rik Agterbosch', 
		1011 => 'Jasper van Eijs', 
		1012 => 'Martijn Nefkens', 
		1013 => 'Claire van der Bruggen', 
		1014 => 'Caspar van Dalen', 
		1015 => 'Rick Roodbergen', 
			], 'trainingDates' => $trainingDates, 'teams' => [1001 => 'MD1', 
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
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
	$input = $request->all();
	foreach ($input['trainingDate_team_id'] as $trainingDate_id => $team_id)
	{
		$trainings = Training::where('team_id','=',$team_id)->get();
		foreach ($trainings as $training_id => $training) 
		{
				echo "$training->id = App\Training::updateOrCreate(['id' => $training->id, 'team_id' => $team_id],]);<br/>";
				$trainers = Training::find($training->id); 
				$trainers->trainer()->sync($input['trainer'][$trainingDate_id],['status' => 101,]);
				//foreach ($input['trainer'][$trainingDate_id] as $trainer) {
				//	$trainers->trainer()->attach($trainer);
				//}
				//$trainers->trainers()->attach($input['trainer'][$training_id]);
		}
	}
        var_dump($input);exit;//
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
