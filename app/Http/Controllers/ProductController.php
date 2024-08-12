<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;

class ProductController extends Controller
{
    // This will show the product list
    public function index()
    {
        $products =Product::orderBy('created_at','DESC')->get();
        return view('products.list',['products'=>$products]);
    }

    // This will show the create product page
    public function create()
    {
        return view('products.create');
    }

    // This will store the information into the DB
    public function store(Request $request)
    {
        $rules = [
            'name' => 'required|min:3',
            'sku' => 'required|min:5',
            'price' => 'required|numeric',
        ];
         
        if ($request-> image !=""){  // checks if the imge is blank or not

            $rules['image'] ='image';   // adding some other rules
            






        }
        // Corrected the method for retrieving all input data
        $validator = Validator::make($request->all(), $rules);

        if ($validator->fails()) {
            return redirect()->route('products.create')->withInput()->withErrors($validator);
        }

        // Store information in DB
        $product = new Product();
        $product->name = $request->name;
        $product->sku = $request->sku;
        $product->price = $request->price;
        $product->description = $request->description;
        $product->save();
        //image implementation task
        if ($request-> image !=""){

        $image = $request-> image;
        $ext = $image->getClientOriginalExtension();
        $imageName=time().'.'.$ext; // this insures unique image name;
        

        //Store img in a directory

        $image->move(public_path('uploads/products'),$imageName);

        //Save image in DB
        $product ->image =$imageName;
        $product->save();


        }
      



        return redirect()->route('products.index')->with('success', 'Product added successfully.');
    }

    // This will show the edit product page
    public function edit($id)
    {
        $product= Product:: findOrFail($id);
        return view('products.edit',['product'=>$product]);
    }

    // This will update the product information in the DB 
    public function update($id,Request $request)
    {
        $product= Product:: findOrFail($id);
        $rules = [
            'name' => 'required|min:3',
            'sku' => 'required|min:5',
            'price' => 'required|numeric',
        ];
         
        if ($request-> image !=""){  // checks if the imge is blank or not

            $rules['image'] ='image';   // adding some other rules
            






        }
        // Corrected the method for retrieving all input data
        $validator = Validator::make($request->all(), $rules);

        if ($validator->fails()) {
            return redirect()->route('products.edit',$product->id)->withInput()->withErrors($validator);
        }

        // update information in DB
        //$product = new Product();
        $product->name = $request->name;
        $product->sku = $request->sku;
        $product->price = $request->price;
        $product->description = $request->description;
        $product->save();
        //image implementation task
        if ($request-> image !=""){
        // Delete old img
         File::delete(public_path('uploads/products/'.$product->image));




        $image = $request-> image;
        $ext = $image->getClientOriginalExtension();
        $imageName=time().'.'.$ext; // this insures unique image name;
        

        //Store img in a directory

        $image->move(public_path('uploads/products'),$imageName);

        //Save image name in DB
        $product ->image =$imageName;
        $product->save();


        }
      



        return redirect()->route('products.index')->with('success', 'Product updated successfully.');


    }

    // This method will delete product
    public function destroy($id)
    {
        $product= Product:: findOrFail($id);

        //delete image
        File::delete(public_path('uploads/products/'.$product->image));
        // delete product
        $product->delete();
        return redirect()->route('products.index')->with('success', 'Product deleted successfully.');

    }
}
