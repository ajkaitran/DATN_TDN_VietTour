<?php

namespace App\Http\Controllers;

use App\Models\Banner;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class BannerController extends Controller
{
    public function index()
    {
        $banner = Banner::all();
        return view('banner.index', compact('banner'));
    }
    public function create()
    {
        return view('banner.create');
    }
    public function store(Request $request)
    {
        $request->validate([
            'banner_name' => 'required|string|max:255',
            'url' => 'nullable|url',
            'image' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
            'image_mobile' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
            'active' => 'required|boolean',
            'group_id' => 'required|integer',
            'sort' => 'required|integer',
            'slogan' => 'nullable|string|max:255',
        ]);

        // Lưu hình ảnh
        $imagePath = $request->file('image')->store('images/banners');
        $imageMobilePath = $request->file('image_mobile')->store('images/banners/mobile');

        // Tạo mới banner
        Banner::create([
            'banner_name' => $request->banner_name,
            'url' => $request->url,
            'image' => $imagePath,
            'image_mobile' => $imageMobilePath,
            'active' => $request->active,
            'group_id' => $request->group_id,
            'sort' => $request->sort,
            'slogan' => $request->slogan,
        ]);

        return redirect()->route('banner.index')->with('success', 'Thêm banner thành công.');
    }


    public function destroy($id)
    {
        $banner = Banner::find($id);
        if (!$banner) {
            return redirect()->route('banners.index')->with('error', 'Banner không tồn tại.');
        }
        $banner->delete();
        return redirect()->route('banners.index')->with('success', 'Banner đã được xóa thành công.');
    }


    public function edit($id)
    {
        $banner = Banner::findOrFail($id);

        return view('banner.edit', compact('banner'));
    }

    public function update(Request $request, $id)
    {
        // Validate dữ liệu
        $request->validate([
            'banner_name' => 'required|string|max:255',
            'slogan' => 'nullable|string|max:255',
            'url' => 'required|url',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'image_mobile' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'active' => 'required|boolean',
            'group_id' => 'nullable|integer',
            'sort' => 'nullable|integer',
        ]);

        // Tìm banner theo ID
        $banner = Banner::findOrFail($id);

        // Cập nhật thông tin banner
        $banner->banner_name = $request->banner_name;
        $banner->slogan = $request->slogan;
        $banner->url = $request->url;
        $banner->active = $request->active;
        $banner->group_id = $request->group_id;
        $banner->sort = $request->sort;

        // Nếu có hình ảnh mới, lưu trữ và cập nhật đường dẫn
        if ($request->hasFile('image')) {
            // Xóa hình ảnh cũ nếu có
            if ($banner->image) {
                Storage::delete($banner->image);
            }
            $banner->image = $request->file('image')->store('images/banners', 'public');
        }

        if ($request->hasFile('image_mobile')) {
            // Xóa hình ảnh cũ nếu có
            if ($banner->image_mobile) {
                Storage::delete($banner->image_mobile);
            }
            $banner->image_mobile = $request->file('image_mobile')->store('images/banners', 'public');
        }

        // Lưu các thay đổi
        $banner->save();

        return redirect()->route('banners.index')->with('success', 'Cập nhật banner thành công.');
    }
}
