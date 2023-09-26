<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Models\Task;
use Illuminate\Support\Facades\DB;

class TaskController extends Controller
{
    function getTasks(){
        $tasks = Task::orderBy("id")->get()->all();  //get the data from the table
        return response()->json($tasks,200);
    }
    public function addTask(Request $request)
        {
            $tasks = new Task;
            $tasks->name = $request->name;
            $tasks->done = 0;
            $tasks->save();
        }

    public function deleteTask($id){
        $tasks = Task::find($id);
        $result = $tasks->delete();
        if($result){

            return ["result"=>"the task has been deleted "];
        }else{
            return "delete operation faild";
        }

    }
}
