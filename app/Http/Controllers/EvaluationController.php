<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Evaluation;
use App\Models\Applicant;

class EvaluationController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
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
        switch($request->type){
            case 'call': 
                Evaluation::create([
                    'call' => $request->grade,
                    'applicant_id' => $request->applicant_id,
                ]);
            break;
            case 'english': 
                Evaluation::create([
                    'english' => $request->grade,
                    'applicant_id' => $request->applicant_id,
                ]);
            break;
            case 'excel': 
                Evaluation::create([
                    'excel' => $request->grade,
                    'applicant_id' => $request->applicant_id,
                ]);
            break;
            case 'powerpoint': 
                Evaluation::create([
                    'powerpoint' => $request->grade,
                    'applicant_id' => $request->applicant_id,
                ]);
            break;
        }

        $view = $request->view;
        return redirect()->route('applicants.index', compact('view'));
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
    public function update(Request $request, Applicant $applicant)
    {
        switch($request->type){
            case 'call': 
                Evaluation::where('applicant_id',$request->applicant_id)->update([
                    'call' => $request->grade,
                ]);
            break;
            case 'english': 
                Evaluation::where('applicant_id',$request->applicant_id)->update([
                    'english' => $request->grade,
                ]);
            break;
            case 'excel': 
                Evaluation::where('applicant_id',$request->applicant_id)->update([
                    'excel' => $request->grade,
                ]);
            break;
            case 'powerpoint': 
                Evaluation::where('applicant_id',$request->applicant_id)->update([
                    'powerpoint' => $request->grade,
                ]);
            break;
        }
        $view = $request->view;
        return redirect()->route('applicants.index', compact('view'));
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
