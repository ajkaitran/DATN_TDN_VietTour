<?php

namespace App\Http\Controllers;

use App\Http\Requests\Admin\FeedbackRequest\StoreRequest;
use App\Models\Feedback;
use App\Service\Common\ImageService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class FeedBackController extends Controller
{

    public function __construct(private ImageService $imageService) {}

    public function index()
    {
        $feedback = Feedback::whereNull('deleted_at')->get();
        return view('feedback.index', compact('feedback'));
    }
    public function create()
    {
        return view('feedback.create');
    }
    public function store(StoreRequest $request)
    {
        $active = $request->input('active') ? 1 : 0;
        $imageName = $this->imageService->uploadImage($request->file('image'), 'feedback');
        $response = Feedback::create([
            ...$request->all(),
            'image' => $imageName ?? null,
            'active' => $active,
        ]);

        if (!$response) {
            return redirect()->route('feedback.create')->with('error', 'Created failed!');
        }

        return redirect()->route('feedback.index')->with('success', 'Created successfully!');
    }
    public function edit($id)
    {
        $feedback = Feedback::find($id);
        return view('feedback.edit', compact('feedback'));
    }

    public function update(StoreRequest $request, $id)
    {
        $feedback = Feedback::find($id);
        $active = $request->input('active') ? 1 : 0;
        if ($request->hasFile('image')) {
            $this->imageService->deleteImage($feedback->image, 'feedback');
            $imageName = $this->imageService->uploadImage($request->file('image'), 'feedback');
        } else {
            $imageName = $feedback->image;
        }
        $response = Feedback::where('id', $id)->update([
            'full_name' => $request->full_name,
            'address' => $request->address,
            'position' => $request->position,
            'comment' => $request->comment,
            'type' => $request->type,
            'image' => $imageName ?? null,
            'active' => $active,
        ]);

        if (!$response) {
            return redirect()->route('feedback.edit', $id)->with('error', 'Updated failed!');
        }

        return redirect()->route('feedback.index')->with('success', 'Updated successfully!');
    }
    public function destroy($id)
    {
        $feedback = Feedback::find($id);
        $this->imageService->deleteImage($feedback->image, 'feedback');
        $feedback->delete();
        return redirect()->route('feedback.index')->with('success', 'Deleted successfully!');
    }
}
