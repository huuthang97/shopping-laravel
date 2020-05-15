<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Components\Recusive;
use App\Category;
use App\Product;
use App\Tag;
use App\Traits\StorageImageTrait;
use DB;

class AdminProductController extends Controller
{
    use StorageImageTrait;
    private $category;
    private $product;
    private $tag;
    public function __construct(Category $category, Product $product, Tag $tag)
    {
        $this->category = $category;
        $this->product = $product;
        $this->tag = $tag;
    }
    public function index() { 
        return view('admin.product.index');
    }

    public function create() {
        $data = $this->category->all();
        $recusiveCategory = new Recusive($data);
        $htmlOption = $recusiveCategory->categoryRecusive('');

        return view('admin.product.add', compact('htmlOption'));
    }

    public function store(Request $request) {
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
                $product =$this->product->create($dataProductCreate);

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
                    $product->Tags()->attach($tagId);
                }
                // DB::commit();

                return view('admin.product.index');

          } catch(\Exception $e){ 
            // DB::rollBack();
            dd($e->getMessage().'Line: ' . $e->getLine()); 
            
          }
        
    }

}
