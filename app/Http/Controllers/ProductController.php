<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Http\Requests\StoreProductRequest;
use App\Http\Requests\UpdateProductRequest;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;

class ProductController extends Controller
{
    private const VIEW_PATH = 'products.';
    public function index()
    {
        $products = Product::query()->latest('id')->paginate(1);
        return view(self::VIEW_PATH . __FUNCTION__, compact('products'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view(self::VIEW_PATH . __FUNCTION__);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreProductRequest $request)
    {
        $data = $request->validated();
        try {

            // nếu k có biến is_active thì = 0
            $data['is_active'] ??= 0;

            // nếu có image thì put image vào storage
            if ($request->hasFile('image')) {
                // put ảnh vào thư mục images
                $data['image'] = Storage::put('images', $request->file('image'));
            }

            Product::create($data);
            return redirect()->route('products.index');
        } catch (\Throwable $th) {
            Log::error($th->getMessage());

            // nếu trong quá trình create vào db lỗi thì xóa ảnh
            if (!empty($data['image']) && Storage::exists($data['image'])) {
                Storage::delete($data['image']);
            }

            // nếu thấy back lại trang create mà k báo lỗi đỏ thì tự động vào file laravel.log check lỗi
            return back();
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(Product $product)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Product $product)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateProductRequest $request, Product $product)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Product $product)
    {
        //
    }
}
