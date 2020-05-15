<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\ProductAddRequest;
use App\Components\Recusive;
use App\Category;
use App\Product;
use App\Tag;
use App\ProductImage;
use App\Traits\StorageImageTrait;
use DB;

class AdminProductController extends Controller
{
    use StorageImageTrait;
    private $category;
    private $product;
    private $tag;
    private $productImage;
    public function __construct(Category $category, Product $product, Tag $tag, ProductImage $productImage)
    {
        $this->category = $category;
        $this->product = $product;
        $this->tag = $tag;
        $this->productImage = $productImage;
    }
    public function index() {
        $products = $this->product->latest()->paginate(5);
        return view('admin.product.index', compact('products'));
    }

    public function create() {
        $data = $this->category->all();
        $recusiveCategory = new Recusive($data);
        $htmlOption = $recusiveCategory->categoryRecusive('');

        return view('admin.product.add', compact('htmlOption'));
    }

    public function store(ProductAddRequest $request) {
        try {
            // DB::beginTransaction();
            // Create Product
                $dataProductCreate = [
                    'name' => $request->name,
                    'price' => $request->price,
                    'content' => $request->content,
                    'user_id' => $request->user()->id,
                    'category_id' => $request->parent_id,
                ];
                $dataUploadFeatureImage = $this->storageTraitUpload($request, 'avatar', 'products');
                if (!empty($dataUploadFeatureImage)) {
                    $dataProductCreate['feature_image_name'] = $dataUploadFeatureImage['file_name'];
                    $dataProductCreate['feature_image_path'] = $dataUploadFeatureImage['path'];
                }
                $product = $this->product->create($dataProductCreate);

                // Create ProductImage
                if ($request->hasFile('photos')) {
                    foreach ($request->photos as $photo) {
                        $photoData = $this->storageTraitUploadMulti($photo, 'products');
                        $product->productImages()->create([
                            'product_id' => $product->id,
                            'image_name' => $photoData['file_name'],
                            'image_path' => $photoData['path'],
                        ]);
                    }
                }

                //Create Tag
                if ($request->tags) {
                    foreach ($request->tags as $tag) {
                        $tag = $this->tag->firstOrCreate(['name' => $tag]);
                        $tagId[] = $tag->id;
                    }
                    $product->tags()->attach($tagId);
                }
                // DB::commit();

                return redirect()->route('products.index');

          } catch(\Exception $e){ 
            // DB::rollBack();
            dd($e->getMessage() . '----File: ' . $e->getFile() .'----Line: ' . $e->getLine()); 
            
          }
    }

    public function edit($id) {
        $product = $this->product->find($id);
        $categories = $this->category->all();
        $recusiveCategory = new Recusive($categories);
        $htmlOption = $recusiveCategory->categoryRecusive($product->category_id);

        return view('admin.product.edit', compact('product', 'htmlOption'));
    }

    public function update(Request $request, $id) {
        try {
            // Create Product
                $dataProductUpdate = [
                    'name' => $request->name,
                    'price' => $request->price,
                    'content' => $request->content,
                    'user_id' => $request->user()->id,
                    'category_id' => $request->parent_id,
                ];
                $dataUploadFeatureImage = $this->storageTraitUpload($request, 'avatar', 'products');
                if (!empty($dataUploadFeatureImage)) {
                    $dataProductUpdate['feature_image_name'] = $dataUploadFeatureImage['file_name'];
                    $dataProductUpdate['feature_image_path'] = $dataUploadFeatureImage['path'];
                }
                $this->product->find($id)->update($dataProductUpdate);
                $product = $this->product->find($id);

                // Create ProductImage
                if ($request->hasFile('photos')) {
                    $this->productImage->where('product_id', $id)->delete();
                    foreach ($request->photos as $photo) {
                        $photoData = $this->storageTraitUploadMulti($photo, 'products');
                        $product->productImages()->create([
                            'product_id' => $product->id,
                            'image_name' => $photoData['file_name'],
                            'image_path' => $photoData['path'],
                        ]);
                    }
                }

                //Create Tag
                if ($request->tags) {
                    foreach ($request->tags as $tag) {
                        $tag = $this->tag->firstOrCreate(['name' => $tag]);
                        $tagId[] = $tag->id;
                    }
                    $product->tags()->sync($tagId);
                }

                return redirect()->route('products.index');
          }
          catch(\Exception $e){ 
            dd($e->getMessage() . '----File: ' . $e->getFile() .'----Line: ' . $e->getLine()); 
          }
    }

    public function delete($id) {
        
        try {
            if ($this->product->find($id)->delete()) {
                return response()->json([
                    'code' => 200,
                    'message' => 'success'
                ], 200);
            }
        }
        catch (\Exception $e) {
            dd($e->getMessage().'  -- File: '. $e->getFile().' ---Line: '. $e->getFile());
        }
    }

}
