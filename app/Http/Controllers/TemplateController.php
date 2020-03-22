<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Question;
use App\User;
use App\Answer;
use App\Point;

class TemplateController extends Controller
{
  public static function getdb()
 {
   $newquestions = Question::orderBy('created_at','desc')->PaGinate(10);
   return $newquestions;
 }

 public static function getranking()
 {
   $qranking = Question::orderBy('all_good','desc')->PaGinate(10);
   return $qranking;
 }

 public static function best()
 {
   /*回答の投稿日を全て取得*/
   $questions = Question::select('id','created_at')->get();
   foreach($questions as $question)
   {
     $best = $question->created_at;
     /*投降日から一週間ごの日付を取得*/
     $datetime = date('Y/m/d',strtotime('+1 week'.$best));
     $today = date('Y/m/d');
     /*今日の日付が登校日から7日以降か*/
     if(strtotime($datetime)<strtotime($today))
     {
       /*質問のベストアンサーが決まっているかどうか*/
       $check = $question->best_check;
       if($check == 0)
       {
         /*高評価順で１番上の一つを取得*/
         $answer = Answer::where('question_id',$question->id)->orderBy('good','desc')->first();
          /*回答がないとエラーが出るのでその対策*/
          if($answer != null)
           {
               /*ベストアンサーに選ばれた回答をしたユーザーにポイント付与*/
               $user = User::where('id',$answer->user_id)->first();
               $point=$user->point->get_point();
               $point = $point+10;
               $user->point->point= $point;
               $user->point->save();
               $answer->best_status = 1;
               $answer->save();
               $question->best_check = 1;
               $question->save();
             }
           }
         }
       }
      }

}
