<?php

namespace App\Http\Controllers;

use App\Models\Course;
use App\Models\Chapter;
use App\Services\ChapterServices;
use App\Services\WalletServices;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class ChapterController extends Controller
{

    //show all chapters
    public function redirectToCourses(){
        return redirect('/admin/courses');
    }

    //view a chapter
    public function show(Request $request, ChapterServices $chapterServices){
        $user_id = Auth::id();
        $course_id = $request->route('course');
        $chapter_number = $request->query('chapter_number');

        $chapter = DB::select("SELECT * FROM chapters WHERE chapter_number = '$chapter_number' AND course_id = '$course_id'");

        $hasAccess = $chapterServices->hasAccess($chapter[0]->coins_needed, $course_id, $chapter_number, $user_id);


        return view('chapter.show', [
            'hasAccess' => $hasAccess
        ]);
    }

    //show add new chapter form
    public function create(Course $course){
        return view('chapter.create', [
            'course' => $course
        ]);
    }

    //store new chapter
    public function store(Request $request, Course $course, Chapter $chapter){
        
        $formFields = $request->validate([
            'title' => 'required',
            'chapter_number' => 'required',
            'content' => 'required',
            'coins_needed' => 'required',
            'xp_earned' => 'required'
        ]);

        $formFields['course_id'] = $course->id;
        $chapter_number = $formFields['chapter_number'];

        $result = DB::select("SELECT * FROM chapters WHERE course_id = '$course->id' AND chapter_number = '$chapter_number'");

        if(!empty($result)){
            return redirect('/admin/courses/'.$course->id);
        }

        $chapter->create($formFields);

        return redirect('/admin/courses/'.$course->id);
    }

    //show edit form
    public function edit(Chapter $chapter, Request $request){
        $chapter_number = $request->query('chapter_number');
        $chapter = Chapter::where('chapter_number', $chapter_number)->first();

        return view('chapter.update', [
            'chapter' => $chapter
        ]);
    }

    //update chapter
    public function update(Request $request, Chapter $chapter){
        $formFields = $request->validate([
            'title' => 'required',
            'chapter_number' => 'required',
            'content' => 'required'
        ]);

        $chapter->update($formFields);

        return back();
    }


    //pay for a chapter
    public function pay(Request $request, WalletServices $walletServices, ChapterServices $chapterServices){
        $user_id = Auth::id();
        $course_id = $request->route('course');
        $chapter_number = $request->query('chapter_number');
        $coins_needed = $request->query('coins_needed');

        $hasAccess = $chapterServices->hasAccess($coins_needed, $course_id, $chapter_number, $user_id);

        if($hasAccess){
            //If user has access, redirect user to view the chapter.
            return redirect("/admin/courses/$course_id/chapters/view?chapter_number=$chapter_number");
        }
        
        $user_email = DB::select("SELECT email FROM users WHERE id = '$user_id'");

        $debit_status = $walletServices->debitWallet($user_email[0]->email, $coins_needed);

        if($debit_status === 'failed'){
            return back();
        }

        //Insert into record that user has paid for the chapter
        DB::insert("INSERT INTO users_chapters (user_id, course_id, chapter_number) VALUES (?,?,?)", [$user_id, $course_id, $chapter_number]);

        return redirect("/admin/courses/$course_id/chapters/view?chapter_number=$chapter_number");

    }


}
