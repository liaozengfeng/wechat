<?php

namespace App\Http\Controllers\Admin;

use App\Models\CourseModel;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class CourseController extends Controller
{
    public function list(Request $request){
        $info=CourseModel::get()->toArray();
        return view("admin.course.list",['info'=>$info]);
    }
}
