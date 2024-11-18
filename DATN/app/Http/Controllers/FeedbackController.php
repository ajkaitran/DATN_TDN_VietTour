<?php

namespace App\Http\Controllers;

use App\Http\Requests\FeedBack\FeedbackRequest;
use App\Models\Feedback;
use Illuminate\Http\Request;
use Illuminate\Session\Store;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Storage;

class FeedbackController extends Controller
{
    public function index(){
        $listfeedback = Feedback::whereNull('deleted_at')->get();
        return view('feedback.index', compact('listfeedback'));
    }
    public function create(FeedbackRequest $request){
        if ($request->isMethod('POST')){
            // dd('create');
            $param = $request->except('_token');
            if($request->hasFile('image') && $request->file('image')->isValid()){
                $param['image'] = uploadFile('feedback', $request->file('image'));
            }
            $feedback = Feedback::create($param);
            if($feedback->id){
                Session::flash('success', 'Thêm mới danh mục thành cỏng');
                return redirect()->route('feedback.index');
            }
        }
        return view('feedback.create');
    }
    /**
     * Update the specified feedback in storage.
     *
     * @param FeedbackRequest $request The request object containing the feedback data.
     * @param int $id The ID of the feedback to be updated.
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\View\View
     */
    public function edit(FeedbackRequest $request, $id){
        $feedback = Feedback::find($id);

        // Check if the request method is POST
        if($request->post()){
            // Prepare the parameters for updating
            $param = $request->except('_token');

            // Check if a new image is uploaded
            if($request->hasFile('image') && $request->file('image')->isValid()){
                // Delete the old image if exists
                $resultDl = Storage::delete('/public/'.$feedback->image);

                // If the old image is successfully deleted, upload the new image
                if($resultDl){
                    $param['image'] = uploadFile('feedback', $request->file('image'));
                }
            }else{
                // If no new image is uploaded, keep the old image
                $param['image'] = $feedback->image;
            }

            // Update the feedback record in the database
            $result = Feedback::where('id', $id)
            ->update($param);

            // Check if the update is successful
            if($result){
                // Set a success flash message and redirect to the feedback index page
                Session::flash('success', 'Cập nhật danh mục thành công');
                return redirect()->route('feedback.index');
            }
        }

        // Render the edit feedback form with the feedback data
        return view('feedback.edit', compact('feedback'));
    }
    public function delete($id){
        Feedback::where('id',$id)->delete();
        Session::flash('success', 'Xóa danh mục thành công');
        return redirect()->route('feedback.index');
    }
}
