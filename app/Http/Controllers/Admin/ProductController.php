<?php

namespace App\Http\Controllers\Admin;
use App\Models\Product;
use App\Models\ProductCategory;
use App\Http\Controllers\Controller;
use Auth;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('is_admin');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $products = Product::paginate(10);
        return view('admin.products.list')->with('products',$products);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $categories = ProductCategory::all();
        return view('admin.products.create')->with('categories',$categories);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'image'=> 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'roi' => 'required',
            'price' => 'required',
            'category_id' => 'required'
        ]);
        $data  = $request->all();
        $imageName = 'product_'.time() . '.'. $request->image->extension();  
        $request->image->move(public_path('file'), $imageName);
        $data['image'] = $imageName;
        // var_dump($data);die();
        Product::create($data);
        // \DB::enableQueryLog(); // Enable query log

        // Your Eloquent query executed by using get()
        
        // dd(\DB::getQueryLog(Product::create($request->all())));
        return redirect()->route('admin.products.index')
                        ->with('success','Product created successfully.');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Product $product)
    {
        $categories = ProductCategory::all();
        return view('admin.products.edit',compact('product','categories'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request,  Product $product)
    {
        $request->validate([
            'name' => 'required',
            'roi' => 'required',
            'price' => 'required',
            'category_id' => 'required'
        ]);
        $request['updated_by'] = Auth::user()->id;
        $product->update($request->all());
        return redirect()->route('admin.products.index')
                        ->with('success','Product updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Product $product)
    {
        $product->delete();
        return redirect()->route('admin.products.index')
                        ->with('success','Product deleted successfully');
    }
    public function categorystore(Request $request){
        ProductCategory::create($request->all());
        return redirect()->route('admin.products.create')
                        ->with('success','Product Category created successfully.');
    }
}
