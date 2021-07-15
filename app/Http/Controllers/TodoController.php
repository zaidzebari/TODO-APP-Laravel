<?php

namespace App\Http\Controllers;

use App\Models\Todo;
use Illuminate\Http\Request;

use function inertia;

class TodoController extends Controller
{
    public function index()
    {
        $todos = Todo::with('user')->where('user_id','=', auth()->id())->paginate(5);
        return inertia('Dashboard',['userName' => auth()->user()->name,'todos'=>$todos]);
    }
    public function destroy($dashboard) {
        //without authorization
        Todo::find($dashboard)->delete();
        return back()->with('success','deleted success full');
    }
    public function store(Request  $request) {
       $request->validate([
            'body' => 'required',
        ]);
        $todo = new Todo();
        $todo->body = $request->body;
        $todo->user_id = auth()->id();
        $todo->save();

        return redirect()->back()->with('success', 'success');
    }
    public function update(Request $request, $id)
    {
        //with out authorization
        $request->validate([
            'body' => 'required',
        ]);
        $todo = Todo::find($id);
        $todo->body = $request->body;
        $todo->save();
        return redirect()->back();
    }
}
