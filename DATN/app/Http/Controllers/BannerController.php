<?php

namespace App\Http\Controllers;

use App\Models\Banner;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use App\Http\Requests\Admin\Banner\StoreBannerRequest;
use App\Http\Requests\Admin\Banner\UpdateBannerRequest;

class BannerController extends Controller
{
    public function index()
    {
        $objBanner = new Banner();
        $this->view['listBanner']= $objBanner->loadListBanner();
        return view('banner.index',$this->view);
    }
    public function uploadFile($file){
        $fileName = time().'_'.$file->getClientOriginalName();
        return $file->storeAs('AnhQuangCao',$fileName,'public');
    }
    public function create()
    {
        $this->view['bannerGroup'] = [
            1 => 'Banner slide',
            2 => 'Ưu đãi',
            3 => 'Đối tác',
            4 => 'Góc báo trí',
            5 => 'Cam kết',
            6 => 'Lý do chọn chúng tôi',
        ];
        return view('banner.create', $this->view);
    }
    public function store(StoreBannerRequest $request)
    {
        $data = $request->validated();
        if ($request->hasFile('image') && $request->file('image')->isValid()) {
            $data['image'] = $this->uploadFile($request->file('image'));
        }
        if ($request->hasFile('image_mobile') && $request->file('image_mobile')->isValid()) {
            $data['image_mobile'] = $this->uploadFile($request->file('image_mobile'));
        }
        $data['banner_group'] = $request->input('banner_group');
        $banner = new Banner();
        $res = $banner->insertDataBanner($data);
        if ($res) {
            return redirect()->back()->with('success', 'Quảng cáo được thêm thành công');
        }

        return redirect()->back()->with('error', 'Quảng cáo không thêm thành công');
    }



    public function edit(int $id)
    {
        $objTable = new Banner();
        $this->view['idBanner']=$objTable->loadIdBanner($id);
        $this->view['bannerGroup'] = [
            1 => 'Banner slide',
            2 => 'Ưu đãi',
            3 => 'Đối tác',
            4 => 'Góc báo trí',
            5 => 'Cam kết',
            6 => 'Lý do chọn chúng tôi',
        ];
        return view('banner.edit',$this->view);
    }

    public function update(UpdateBannerRequest $request, $id)
    {
        $objTable = new Banner();
        $idCheck = $objTable->loadIdBanner($id);

        if ($idCheck) {
            $data = $request->except(['image', 'image_mobile']);

            // Xử lý `image`
            if ($request->hasFile('image') && $request->file('image')->isValid()) {
                $data['image'] = $this->uploadFile($request->file('image'));
                $imageOld = $idCheck->image;
            } else {
                $data['image'] = $idCheck->image;
            }

            // Xử lý `image_mobile`
            if ($request->hasFile('image_mobile') && $request->file('image_mobile')->isValid()) {
                $data['image_mobile'] = $this->uploadFile($request->file('image_mobile'));
                $imageMobileOld = $idCheck->image_mobile;
            } else {
                $data['image_mobile'] = $idCheck->image_mobile;
            }

            $res = $objTable->updateDataBanner($data, $id);

            if ($res) {
                // Xóa file cũ `image` nếu có
                if ($request->hasFile('image') && isset($imageOld) && Storage::disk('public')->exists($imageOld)) {
                    Storage::disk('public')->delete($imageOld);
                }

                // Xóa file cũ `image_mobile` nếu có
                if ($request->hasFile('image_mobile') && isset($imageMobileOld) && Storage::disk('public')->exists($imageMobileOld)) {
                    Storage::disk('public')->delete($imageMobileOld);
                }

                return redirect()->back()->with('success', 'Chỉnh sửa quảng cáo thành công');
            } else {
                return redirect()->back()->with('error', 'Chỉnh sửa quảng cáo không thành công');
            }
        } else {
            return redirect()->back()->with('error', 'Không tìm thấy id');
        }
    }
    
    public function destroy(int $id)
    {
        $objTable = new Banner();
        $idCheck = $objTable->loadIdBanner($id);
        $imageOld = $idCheck->image;
        $imageMobileOld = $idCheck->image_mobile;
        if($idCheck){
            $res = $objTable->deleteDataBanner($id);
            if($res){
                if(Storage::disk('public')->exists($imageOld)){
                    Storage::disk('public')->delete($imageOld);
                }
                if(Storage::disk('public')->exists($imageMobileOld)){
                    Storage::disk('public')->delete($imageMobileOld);
                }
                return redirect()->back()->with('success','Xóa quảng cáo thành công');
            }else{
                return redirect()->back()->with('error','Xóa quảng cáo không thành công');
            }
        }else{
            return redirect()->back()->with('error','Không tìm thấy id');
        }
    }

}
