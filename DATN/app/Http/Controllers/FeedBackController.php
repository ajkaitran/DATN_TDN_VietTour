<?php

namespace App\Http\Controllers;

use App\Http\Requests\Admin\FeedbackRequest\StoreRequest;
use App\Models\Feedback;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class FeedBackController extends Controller
{
    public function index(){
        $feedback = Feedback::whereNull('deleted_at')->get();
        return view('feedback.index', compact('feedback'));
    }
    public function create(StoreRequest $request){
        if($request->isMethod('POST')){
            $param = $request->except('_token');
            if($request->hasFile('image') && $request->file('image')->isValid()){
                $param['image'] = uploadFile('FeedBack', $request->file('image'));
            }
            $feedback = Feedback::create($param);
            if($feedback->id){
                session()->flash('success', 'Thêm mới phản hồi thành công');
                return redirect()->route('feedback.index');
            }
        }
        return view('feedback.create');
    }
    public function store(Request $request)
    {
        $param = $request->all();

        $feedback = Feedback::create($param);

        if ($feedback) {
            return response()->json(['message' => 'Thêm mới phản hồi thành công', 'data' => $feedback], 201);
        } else {
            return response()->json(['message' => 'Có lỗi xảy ra khi thêm phản hồi'], 500);
        }
    }
    public function edit(StoreRequest $request, $id){
        // dd();
        $feedback = Feedback::find($id);
        // dd($feedback);
        if($request->post()){
            $param = $request->except('_token');
            if($request->hasFile('image') && $request->file('image')->isValid()){
                $resultDl = Storage::delete('/public/'.$feedback->image);
                if($resultDl){
                    $param['image'] = uploadFile('FeedBack', $request->file('image'));
                }
            }else{
                $param['image'] = $feedback->image;
            }
            $result = Feedback::where('id', $id)
            ->update($param);
            if($result){
                session()->flash('success', 'Sửa phản hồi thành công');
                return redirect()->route('feedback.index');
            }
        }
        return view('feedback.edit', compact('feedback'));
    }
    public function destroy($id){
        Feedback::where('id', $id)->delete();
        session()->flash('success', 'Xóa phản hồi thành công');
        return redirect()->route('feedback.index');
    }
}

