<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use App\Http\Controllers\Controller;
use App\Http\Controllers\TemplateController;
use App\Http\Requests\HelloRequest;
use App\Http\Requests\CategoryRequest;
use App\Http\Requests\QaRequest;
use App\Http\Requests\AnswerRequest;
use App\Http\Requests\ResetRequest;
use App\Http\Requests\RegisterRequest;
use App\Http\Requests\NewpassRequest;
use App\Category;
use App\Good;
use App\Question;
use App\Answer;
use App\Point;
use App\User;
use Auth;

class HelloController extends TemplateController
{
  /*会員登録*/
  public function registered(RegisterRequest $request)
  {
    $points = new Point;
    $points->point = 0;
    $points->save();
    $users = new User;
    $users->point_id = $points->id;
    $users->name = $request->name;
    $users->email = $request->email;
    $password = $request->password;
    $users->password = Hash::make($password);
    $users->save();
    return view('auth.registered');
  }

  /*パスワードリセット*/
  public function reset_pass(ResetRequest $request)
  {
    $users = User::where('email',$request->email)->first();
    return view('auth.reset_pass',compact('users'));
  }

  public function reseted(NewpassRequest $request)
  {
    $users = User::where('email',$request->email)->first();
    $users->password = Hash::make($request->new_pass);
    $users->save();
    return view('auth.reseted');
  }

  /*TOPページ表示*/
  public function top(TemplateController $templatecontroller)
  {
    $new = $templatecontroller->getdb();
    $top = $templatecontroller->getranking();
    $best = $templatecontroller->best();
    return view('hello.top',compact('new','top'));
  }

  /*ランキングページ*/
  public function ranking(TemplateController $templatecontroller)
  {
    $new = $templatecontroller->getdb();
    $top = $templatecontroller->getranking();
    $best = $templatecontroller->best();
    $items = DB::table('questions')->get();
    return view('hello.ranking',compact('new','top','items'));
  }

  /*カテゴリ関連*/
  public function category(Request $request,TemplateController $templatecontroller)
  {
    $new = $templatecontroller->getdb();
    $top = $templatecontroller->getranking();
    $best = $templatecontroller->best();
    $items = DB::table('categories')->get();
    return view('hello.category',compact('items','new','top'));
  }

  public function category_add(TemplateController $templatecontroller)
  {
    $new = $templatecontroller->getdb();
    $top = $templatecontroller->getranking();
    $best = $templatecontroller->best();
    return view('hello.category_add',compact('new','top'));
  }

  public function categoried(CategoryRequest $request,TemplateController $templatecontroller)
  {
    $new = $templatecontroller->getdb();
    $top = $templatecontroller->getranking();
    $items = DB::table('questions')->get();
    $category = new Category;
    $category->name = $request->name;
    $category->save();
    return view('hello.categoried',compact('new','top'));
  }

  public function category_all(Request $request,TemplateController $templatecontroller)
  {
    $new = $templatecontroller->getdb();
    $top = $templatecontroller->getranking();
    $id = $request->input('id');
    $items = Question::where('category_id',$id)->get();
    return view('hello.category_all',compact('new','top','items'));
  }

  /*ユーザーページ*/
  public function user(TemplateController $templatecontroller)
  {
    $new = $templatecontroller->getdb();
    $top = $templatecontroller->getranking();
    $best = $templatecontroller->best();
    $auths = Auth::user();
    $point = Auth::user()->point->get_point();
    return view('hello.user',compact('new','top','auths','point'));
  }

  public function pass_change(TemplateController $templatecontroller)
  {
      $new = $templatecontroller->getdb();
      $top = $templatecontroller->getranking();
    return view('hello.pass_change',compact('new','top'));
  }

  /*質問一覧*/
  public function question_all(Request $request,TemplateController $templatecontroller)
  {
    $new = $templatecontroller->getdb();
    $top = $templatecontroller->getranking();
    $items = Question::orderBy('created_at','desc')->Paginate(10);
    return view('hello.question_all',compact('new','top','items'));
  }

  public function qa(Request $request,TemplateController $templatecontroller)
  {
    $new = $templatecontroller->getdb();
    $top = $templatecontroller->getranking();
    $id = $request->input('id');
    $answers = Answer::where('question_id',$id)
             ->orderBy('good','desc')
             ->PaGinate(10);
    $items = Question::where('id',$id)->first();
    return view('hello.qa',compact('id','answers','items','new','top','best','datetime'));
  }

  public function qa_good(Request $request,TemplateController $templatecontroller)
  {
    $new = $templatecontroller->getdb();
    $top = $templatecontroller->getranking();
    $id = $request->input('id');
    $items = Question::where('id',$id)->first();
    $all = $items->all_good;
    $answers = Answer::where('question_id',$id)
             ->orderBy('good','desc')
             ->PaGinate(10);
    foreach($answers as $answer){
    /*質問に紐づいた回答のどれが高評価ボタンを押されたか判別*/
    if($answer->id == $request->goods_answer){
       /*誰がどの回答に高評価を押したか判別するGoodテーブルを取得*/
       $goods = Good::where('answer_id',$request->goods_answer)->where('user_id',$request->good_check)->first();
       $users = User::where('id',$answer->user_id)->first();
       $point = $users->point->get_point();
       /*Goodテーブルがある→すでにユーザーAは回答Aに高評価済み ない→一度も押してないのでGoodテーブルも存在しない*/
       if($goods == null){
         $good_add = new Good;
         $good_add->user_id = $request->good_check;
         $good_add->answer_id = $request->goods_answer;
         $good_add->good_or = 0;
         $good_add->save();
         $check = 0;
         $num = 0;
      }else{
      $check = $goods->good_or;
      $num = $answer->good;
      }

      /*高評価をすでに押しているのなら、押したぶんを取り消す*/
      if($check==0)
      {
        /*$check=Goodを押したか判別用 $num=回答に対する高評価
        $all=質問に対する回答の高評価合計(ランキング用) $point=高評価１につき回答したユーザーに1ポイント*/
        $check++;
        $num++;
        $all++;
        $point++;
      }else if($check==1){
        $check--;
        $num--;
        $all--;
        $point--;
      }
      if($goods == null){
        /*Goodテーブルがなかった場合は最初にinsertした方でsave*/
        $good_add->good_or=$check;
        $good_add->save();
      }else{
        $goods->good_or=$check;
        $goods->save();
      }
      $items->all_good = $all;
      $items->save();
      $answer->good = $num;
      $answer->save();
      $users->point->point = $point;
      $users->point->save();
    }
    }
    return view('hello.qa',compact('id','answers','items','new','top','goods'));
  }

  /*質問投稿*/
  public function question_form(TemplateController $templatecontroller)
  {
   $new = $templatecontroller->getdb();
   $top = $templatecontroller->getranking();
   $items = DB::table('categories')->get();
   return view('hello.question_form',compact('new','top','items'));
  }

  public function question_complete(QaRequest $request,TemplateController $templatecontroller)
  {
   $new = $templatecontroller->getdb();
   $question = new Question;
   $question->title = $request->title;
   $question->category_id = $request->category_id;
   $question->content = $request->content;
   $question->save();
   return view('hello.question_complete',['new'=>$new]);
  }

  /*回答機能*/
  public function answer_form(Request $request,TemplateController $templatecontroller)
  {
    $new = $templatecontroller->getdb();
    $user_id = $request->user_id;
    $question_id = $request->question_id;
    return view('hello.answer_form',compact('new','user_id','question_id'));
  }

  public function answer_complete(AnswerRequest $request,TemplateController $templatecontroller)
  {
    $new = $templatecontroller->getdb();
    $answer = new Answer;
    $answer->user_id = $request->user_id;
    $answer->question_id = $request->question_id;
    $answer->content = $request->content;
    $answer->save();
    return view('hello.answer_complete',['new'=>$new]);
  }

  /*検索機能*/
  public function search(Request $request,TemplateController $templatecontroller)
  {
    $new = $templatecontroller->getdb();
    $top = $templatecontroller->getranking();
    $searchs = Question::where('content','like',"%".$request->search."%")->get();
    return view('hello.search',compact('searchs','new','top'));
  }

  public function delete()
  {
    return view('auth.delete');
  }

  public function deleted(Request $request)
  {
    $email = User::where('email',$request->delete_data)->delete();
    return view('auth.deleted');
  }

}
