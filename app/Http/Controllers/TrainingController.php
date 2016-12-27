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
	return view('training.trainer',['trainers' => [0 => 'Ellemijn', 1 => 'Maarten Salverda']]);
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
