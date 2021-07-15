<?php

namespace App\Http\Controllers;

use App\Components\Recursive;
use App\Http\Requests\ProductRequest;
use App\Models\Category;
use App\Models\Product;
use App\Models\product_images;
use App\Models\product_tags;
use App\Models\tag;
use App\Traits\DeleteTrait;
use App\Traits\StoreImageTrait;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;

class ProductController extends Controller
{
    use StoreImageTrait, DeleteTrait;

    private $category;
    private $product;
    private $product_images;
    private $tags;

    public function __construct(Category $category, Product $product, product_images $product_images, tag $tags, product_tags $product_tags)
    {
        $this->category = $category;
        $this->product = $product;
        $this->product_images = $product_images;
        $this->tags = $tags;
        $this->product_tags = $product_tags;
    }

    public function getCategory($parentId)
    {
        $data = $this->category->all();
        $recursive = new Recursive($data);
        return $recursive->categoryRecursive($parentId);;
    }

    public function index()
    {
        $products = $this->product->paginate(10);
        return view('admin.product.index', compact('products'));
    }

    public function create()
    {
        $htmlOption = $this->getCategory($parent_id = '');
        return view('admin.product.add', compact('htmlOption'));
    }

    public function store(ProductRequest $request)
    {
        try {
            DB::beginTransaction();
            //Products
            $dataCreated = [
                'name' => $request->name,
                'price' => $request->price,
                'content' => $request->contents,
                'user_id' => auth()->id(),
                'category_id' => $request->category_id,
            ];

            $dataUpload = $this->StoreTraitUpload($request, 'feature_image', 'product');

            //Feature_image
            if (!empty($dataCreated)) {
                $dataCreated['feature_image'] = $dataUpload['file_path'];
                $dataCreated['feature_image_name'] = $dataUpload['file_name'];
            }
            $product = $this->product->create($dataCreated);

            //Detail Image
            if ($request->hasFile('image_path')) {
                foreach ($request->image_path as $imageItem) {
                    $dataMultipleUpload = $this->StoreTraitUploadMultiple($imageItem, 'product');
                    $product->images()->create([
                        'image_path' => $dataMultipleUpload['file_path'],
                        'image_name' => $dataMultipleUpload['file_name']
                    ]);
                }
            }

            //Tags
            if (!empty($request->tags)) {
                foreach ($request->tags as $tagItem) {
                    $tagInstance = $this->tags->firstOrCreate(['name' => $tagItem]);
                    $tagIds[] = $tagInstance->id;
                }
            }

            $product->tags()->attach($tagIds);
            DB::commit();
            return redirect()->route('product.index');
        } catch (\Exception $exception) {
            DB::rollBack();
        }

    }

    public function edit($id)
    {
        $product = $this->product->find($id);
        $htmlOption = $this->getCategory($product->category_id);
        return view("admin.product.edit", compact('product', 'htmlOption'));
    }

    public function update(ProductRequest $request, $id)
    {
        try {
            DB::beginTransaction();
            //Products
            $dataUpdated = [
                'name' => $request->name,
                'price' => $request->price,
                'content' => $request->contents,
                'user_id' => auth()->id(),
                'category_id' => $request->category_id,
            ];

            $dataUpload = $this->StoreTraitUpload($request, 'feature_image', 'product');

            //Feature_image
            if (!empty($dataUpload)) {
                $dataUpdated['feature_image'] = $dataUpload['file_path'];
                $dataUpdated['feature_image_name'] = $dataUpload['file_name'];
            }
            $this->product->find($id)->update($dataUpdated);
            $product = $this->product->find($id);

            //Detail Image
            if ($request->hasFile('image_path')) {
                $this->product_images->where('product_id', $id)->delete();
                foreach ($request->image_path as $imageItem) {
                    $dataMultipleUpload = $this->StoreTraitUploadMultiple($imageItem, 'product');
                    $product->images()->create([
                        'image_path' => $dataMultipleUpload['file_path'],
                        'image_name' => $dataMultipleUpload['file_name']
                    ]);
                }
            }

            //Tags
            if (!empty($request->tags)) {
                foreach ($request->tags as $tagItem) {
                    $tagInstance = $this->tags->firstOrCreate(['name' => $tagItem]);
                    $tagIds[] = $tagInstance->id;
                }
            }

            $product->tags()->sync($tagIds);
            DB::commit();
            return redirect()->route('product.index');
        } catch (\Exception $exception) {
            DB::rollBack();
            Log::error('Message: ' . $exception->getMessage() . '---Line: ' . $exception->getLine());
        }

    }

    public function delete($id)
    {
        return $this->deleteModelTrait($this->product, $id);
    }
}
