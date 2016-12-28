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
	return view('training.trainer',['trainers' => [
		1000 => 'Maarten Salvereda', 
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
			]]);
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
        //
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
