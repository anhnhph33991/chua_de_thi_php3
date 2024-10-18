<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\UpdateProductRequest;
use App\Models\Product;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        try {
            $product = Product::findOrFail($id);

            return response()->json([
                'products' => $product
            ], Response::HTTP_OK);
        } catch (\Throwable $th) {
            Log::error($th->getMessage());

            // nếu k có product
            if ($th instanceof ModelNotFoundException) {
                return response()->json([
                    'message' => "Product Not Found"
                ], Response::HTTP_NOT_FOUND);
            }

            // mặc định trả về 500

            return response()->json([
                'message' => "Server Error"
            ], Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateProductRequest $request, string $id)
    {
        $data = $request->validated();
        try {
            $product = Product::findOrFail($id);

            $data['is_active'] ??= 0;

            if ($request->hasFile('image')) {
                $data['image'] = Storage::put('images', $request->file('image'));
            }

            // lưu image cũ
            $imageOld = $product->image;

            $product->update($data);

            // nếu có ảnh mới và ảnh cũ tồn tại trong storage thì xóa
            if (!empty($data['image']) && $imageOld && Storage::exists($imageOld)) {
                Storage::delete($imageOld);
            }

            return response()->json([
                'message' => "Update product success",
                'products' => $product
            ], Response::HTTP_OK);
        } catch (\Throwable $th) {
            Log::error($th->getMessage());

            // nếu k có product
            if ($th instanceof ModelNotFoundException) {
                return response()->json([
                    'message' => "Product Not Found"
                ], Response::HTTP_NOT_FOUND);
            }

            // nếu update ảnh mới mà lưu vào db lỗi
            if (!empty($data['image']) && Storage::exists($data['image'])) {
                Storage::delete($data['image']);
            }

            // mặc định trả về 500
            return response()->json([
                'message' => "Server Error"
            ], Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        try {
            $product = Product::findOrFail($id);

            $imageOld = $product->image;

            $product->delete();

            if (!empty($imageOld) && Storage::exists($imageOld)) {
                Storage::delete($imageOld);
            }

            return response()->json([], Response::HTTP_NO_CONTENT);
        } catch (\Throwable $th) {
            Log::error($th->getMessage());

            // nếu k có product
            if ($th instanceof ModelNotFoundException) {
                return response()->json([
                    'message' => "Product Not Found"
                ], Response::HTTP_NOT_FOUND);
            }

            // mặc định trả về 500

            return response()->json([
                'message' => "Server Error"
            ], Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }
}
