<?php

namespace App\Http\Controllers;

use App\Task;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;

class TaskController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return response(Task::orderBy('date')->get());
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
        Log::debug('Showing user profile for user: '.$request);
        $input = $request->all();
        $task = new Task;
        $task->name = $input['name'];
        $task->desc = $input['desc'];
        $task->date = $input['date'];
        $task->priority = $input['priority'];
        $task->category_id = $input['category_id'];
        $task->user_id = Auth::user()->id;
        $task->save();

        return response("Success");
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Task  $task
     * @return \Illuminate\Http\Response
     */
    public function show(Task $task)
    {
       return response(Task::find($task));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Task  $task
     * @return \Illuminate\Http\Response
     */
    public function edit(Task $task)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Task  $task
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Task $task)
    {
        $task->name = $request->input('name');
        $task->desc = $request->input('desc');
        $task->date = $request->input('date');
        $task->priority = $request->input('priority');
        $task->completed = $request->input('completed');
        $task->category_id = $request->input('category_id');
        $task->save();

        return response('Success',200);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Task  $task
     * @return \Illuminate\Http\Response
     */
    public function destroy(Task $task)
    {
         Task::destroy([$task->id]);
         return response("Success",202);
    }

    public function dailyTasks($date){
        return Task::daily($date);
    }

    public function weeklyTasks($date){
        return Task::weekly($date);
    }
}
