<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;
use Cloudinary\Api\Upload\UploadApi;
use Cloudinary\Configuration\Configuration;


class ProductController extends Controller
{
    public function list(Request $request) {
        $search = $request->get("search");
        $category_id = $request->get("category_id");
        $lowest_price = $request->get("lowest_price");
        $highest_price = $request->get("highest_price");
        $orderCol = $request->has("orderCol") ? $request->get("orderCol") : "id";
        $sortBy = $request->has("sortBy") ? $request->get("sortBy") : "desc";

        $data = Product::with("Category")->CategoryFilter($category_id)->LowestPrice($lowest_price)->HighestPrice($highest_price)->Search($search)->orderBy($orderCol, $sortBy)->paginate(20);

        $categories = Category::all();
        return view("admin.product.list", compact('data', 'categories'));
    }
    public function list2() {
        //$data = Product::all(); //SELECT * FROM products
        //$data = Product::limit(20)->orderBy("id","desc")->get();

        //$data = Product::leftJoin("categories","categories.id","=","products.category_id")
        //    ->orderBy("id", "desc")
        //    ->select(["products.*","categories.name as category_name"])
        //    ->paginate(20);
        //Paginator: danh sách có phân trang (cho web thôi, làm API thì khác)
        $data = Product::orderBy("id", "desc")->paginate(20);

        //$data = Product::withTrashed()->orderBy("id", "desc")->paginate(20);
        //hoac onlyTrashed()

        return view("admin.product.list", compact('data'));//Cách 1 truyền biến data vào view, dạng collection
        //return view("admin.product.list",["data"=>$data]); //Cách 2
    }

    public function create() {
        //Truy van categories tư db
        $categories = Category::all();
        return view("admin.product.create", compact('categories'));
    }

    public function store(Request $request) {
        $request->validate([
            "name" => "required|string|min:6",
            "price" => "required|numeric|min:0",
            "quantity" => "required|numeric|min:0",
            "thumbnail" => "nullable|image|mimes:jpeg,png,jpg,gif,svg"
        ],[
            "required" => "Vui long nhap thong tin",
            "numeric" => "Vui long nhap so",
            "min" => "Gia tri cua :attribute toi thieu la :min"
        ]); //Neu sai se back lai trang truoc

        //nhan data tu form
        //Không cần $_POST như PHP
        $data = $request->except("thumbnail");
        //dd($data); //dd là var_dump và die
        try {
            //--upload file image:
            if($request->hasFile('thumbnail')) {
                $file = $request->file("thumbnail");
                $fileName = time() . $file->getClientOriginalName();
                $path = public_path("uploads");
                $file->move($path,$fileName);
                $data['thumbnail'] = '/uploads/'.$fileName;
            }
        } catch (\Exception $e) {
        } finally {
            $data['thumbnail'] = isset($data['thumbnail']) ? $data['thumbnail'] : null;
        }

        Product::create($data);
        return redirect()->to("/admin/product");
    }

    public function edit(Product $product) {
//        //Cach 1: lam API: ( public function edit($id) )
//        $product = Product::find($id);
//        if($product == null) {
//            abort(404); //khong tim thay di sang 404
//        }

//        //Cach 2: Lam web chi can: ( public function edit($id) )
//        $product = Product::findOrFail($id); //ap dung khi tim nhieu hon 1 items

//        //Cach 3:
//        public function edit(Product $product)

        $categories = Category::all();
        return view("admin.product.edit", compact('categories','product'));
    }

    public function update(Product $product, Request $request) {
        $request->validate([
            "name" => "required|string|min:6",
            "price" => "required|numeric|min:0",
            "quantity" => "required|numeric|min:0",
            "thumbnail" => "nullable|image|mimes:jpeg,png,jpg,gif,svg"
        ],[
            "required" => "Vui long nhap thong tin",
            "numeric" => "Vui long nhap so",
            "min" => "Gia tri cua :attribute toi thieu la :min"
        ]); //Neu sai se back lai trang truoc

        //nhan data tu form
        //Không cần $_POST như PHP
        $data = $request->except("thumbnail");
        //dd($data); //dd là var_dump và die
        try {
            //--upload file image:
            if($request->hasFile('thumbnail')) {
                $file = $request->file("thumbnail");
                $fileName = time() . $file->getClientOriginalName();
                $path = public_path("uploads");
                $file->move($path,$fileName);
                $data['thumbnail'] = '/uploads/'.$fileName;
            }
        } catch (\Exception $e) {
        } finally {
            $data['thumbnail'] = isset($data['thumbnail']) ? $data['thumbnail'] : $product->thumbnail;
        }

        $product->update($data);
        return redirect()->to("/admin/product");
    }

    public function delete(Product $product) {
        $product->delete();
        return redirect()->to("/admin/product");
    }
}
