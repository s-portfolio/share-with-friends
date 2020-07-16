<?php

namespace App\Http\Controllers;

use App\Problem;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class QuizController extends Controller
{
    public function make(){
        return view('quiz.make');
    }

    public function list(){
        $problems = Auth::user()->problems()->get();
        return view('quiz.list',compact('problems'));
    }

    public function get($id){
        if(!$id){
            return redirect('/home');
        }else{
            $problem = Problem::find($id);
            $user_id = $problem->user_id;
            if(Auth::user()->id !==  $user_id){
                return redirect('/home');
            }else{
                return view('quiz.index',compact('problem'));
            }
        }
    }

    public function save(Request $request){
        $problem = new Problem();
        $problem->subject = $request->subject;
        $problem->problem = json_encode($request->problem);
        $problem->choice1 = json_encode($request->choice1);
        $problem->choice2 = json_encode($request->choice2);
        $problem->choice3 = json_encode($request->choice3);
        $problem->choice4 = json_encode($request->choice4);
        $problem->answer = json_encode($request->answer);
        $problem->user_id = Auth::user()->id;
        $problem->save();
        $id = $problem->id;
        return $id;
    }

    public function test($id){
        $problem = Problem::find($id);
        return view('quiz.test',compact('problem'));
    }

    public function delete($id){
        $problem = Problem::find($id);
        $problem->delete();
        return redirect('/quiz/list');
    }

    public function edit($id){
        $problem = Problem::find($id);
        return view('quiz.edit',compact('problem'));
    }

    public function change(Request $request,$id){
        $problem = Problem::find($id);
        $problem->subject = $request->subject;
        $problem->problem = json_encode($request->problem);
        $problem->choice1 = json_encode($request->choice1);
        $problem->choice2 = json_encode($request->choice2);
        $problem->choice3 = json_encode($request->choice3);
        $problem->choice4 = json_encode($request->choice4);
        $problem->answer = json_encode($request->answer);
        $problem->user_id = Auth::user()->id;
        $problem->save();
        $id = $problem->id;
        return $id;
    }
}
