<?php

namespace App\Http\Controllers\Backend\Category;

use App\Http\Requests\Backend\CategoryCreate;
use App\Models\Category;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Symfony\Component\HttpKernel\Exception\BadRequestHttpException;

class CategoryController extends Controller
{
    public function index()
    {
        $categories = Category::with(["parent", "subcategories"])->where("parent", null)->get();
        return view("backend.category.index", compact("categories"));
    }

    public function create()
    {
        $categories = Category::with(["parent", "subcategories"])->where("parent", null)->get();
        return view("backend.category.create", compact("categories"));
    }

    public function createpost(CategoryCreate $request)
    {
        try {
            $cat = new Category();

            $cat->title = $request->title;
            $cat->sort = $request->sort;
            $cat->parent = $request->parent > 0 ? $request->parent : null;

            $cat->seo_title = $request->seo_title;
            $cat->seo_keywords = $request->seo_keywords;
            $cat->seo_description = $request->seo_description;
            $cat->details = $request->details;

            $file = null;
            if ($request->file("image") != null) {
                $file = Storage::disk("category")->putFileAs("", $request->file("image"), $request->file("image")->getClientOriginalName());
                $cat->image = $request->file("image")->getClientOriginalName();
            }

            if ($cat->save()) {
                return response()->json(["title" => "Başarılı!", "message" => "Kategori başarıyla eklendi!", "data" => $cat], 200);
            }
        } catch (\Exception $e) {

            return response()->json(["title" => "Hata Oluştu!", "message" => "Kategori eklenemedi!", 'more' => $e->getMessage()], 500);
        }
    }


    public function delete(Request $request)
    {
        DB::beginTransaction();
        try {
            $cat = Category::findOrFail($request->id);
            if ($cat->delete()) {
                Storage::disk("category")->delete($cat->image);
                DB::commit();
                return response()->json(["title" => "Başarılı!", "message" => "Kategori başarıyla silindi!", "data" => $cat], 200);
            }
        } catch (\Exception $e) {
            DB::rollBack();
            return response()->json(["title" => "Hata Oluştu!", "message" => "Kategori bulunamadı yada silinemez!", 'more' => $e->getMessage()], 500);
        }
    }
}
