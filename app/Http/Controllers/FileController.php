<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;
use App\Imports\FacebookLeadsImport;

class FileController extends Controller
{
    // عرض صفحة رفع الملف باستخدام GET
  // طريقة عرض النموذج
public function index()
{
    return view('upload'); // اسم الـ View التي تحتوي على النموذج
}


    // استقبال البيانات عند رفع الملف باستخدام POST
    public function upload(Request $request)
    {
        $userName = $request->input('user_name'); // استخدام الاسم المستخدم المرسل
        $request->validate([
            'file' => 'required|mimes:xlsx,csv',
        ]);

        // استيراد البيانات من الملف
        Excel::import(new FacebookLeadsImport($userName), $request->file('file'));

        // إرجاع صفحة النجاح بعد رفع الملف
        return back()->with('success', 'File uploaded successfully!');
    }
}
