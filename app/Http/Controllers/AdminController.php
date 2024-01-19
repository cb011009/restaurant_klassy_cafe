<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User; 
use App\Models\Product;
use App\Models\ProductCategory;

class AdminController extends Controller
{
    //
    public function manageUsers()
{
    // Example: Retrieve and display a list of users for admin management
    $users = User::all();

    return view('admin_panel', compact('users'));
}

//newly added for editing users 
public function editUser($id)
    {
        // Retrieve the user by ID
        $user = User::find($id);

        if (!$user) {
            // Handle the case when the user is not found
            return redirect()->route('admin_panel')->with('error', 'User not found.');
        }

        // Load a view to edit user information
        return view('admin_edit_user', compact('user'));
    }

//newly addded for updating user information
public function updateUser(Request $request, $id)
{
    // Validate the request data (add validation rules as needed)

    $user = User::find($id);

    if (!$user) {
        return redirect()->route('admin_edit_user')->with('error', 'User not found.');
    }

    // Update user attributes based on the form data
    $user->name = $request->input('name');
    // Update other user attributes as needed

    // Save the updated user
    $user->save();

    return redirect()->route('admin_panel')->with('success', 'User updated successfully.');
}


//newly added for deleting a user
public function deleteUser($id)
    {
        // Retrieve the user by ID
        $user = User::find($id);

        if ($user) {
            // Delete the user
            $user->delete();
            return redirect()->route('admin_panel')->with('success', 'User deleted successfully.');
        }

        // Handle the case when the user is not found
        return redirect()->route('admin_panel')->with('error', 'User not found.');
    }






//newly added for managing products and product catergories


public function createProductPage()
    {
        $products = Product::all();
        $categories = ProductCategory::all();

        return view('admin_create_product', compact('products', 'categories'));
    }


    public function addProduct(Request $request)
    {
        // Validate the request data

        $product = new Product;
        $product->code = $request->input('product_code');
        $product->name = $request->input('product_name');
        $product->description = $request->input('product_description');
        $product->product_category_id = $request->input('category_id');
        $product->save();

        return redirect()->route('admin_create_product')->with('success', 'Product added successfully.');
    }

    public function addCategory(Request $request)
{
    // Validate the request data
    $request->validate([
        'category_name' => 'required|max:255', // Adjust as needed
    ]);
    $category = new ProductCategory;
    $category->category_name = $request->input('category_name'); // Use the correct column name
    $category->save();

    return redirect()->route('admin_create_product')->with('success', 'Category added successfully.');
}



    public function deleteProduct($id)
    {
        $product = Product::find($id);

        if ($product) {
            $product->delete();
            return redirect()->route('admin_create_product')->with('success', 'Product deleted successfully.');
        }

        return redirect()->route('admin_create_product')->with('error', 'Product not found.');
    }


    public function filterProducts(Request $request)
    {
        $categoryId = $request->input('category_id');
        /*$products = Product::where('product_category_id', $categoryId)->get();*/
       
        $products = Product::where('product_category_id', $categoryId)->with('category')->get();


        $categories = ProductCategory::all();

        return view('admin_create_product', compact('products', 'categories'));

      
    }



    //newly added for delete category

    public function deleteCategory($id)
{
   
    $category = ProductCategory::find($id);

    if ($category) {
        $category->delete();
        return redirect()->route('admin_create_product')->with('success', 'Category deleted successfully.');
    }

    return redirect()->route('admin_create_product')->with('error', 'Category not found.');
}

//newly added for editing 

public function editProduct($id)
{
    $product = Product::find($id);
    $categories = ProductCategory::all();

    return view('admin_edit_product', compact('product', 'categories'));
}

public function updateProduct(Request $request, $id)
{
    $product = Product::find($id);

    if ($product) {
        // Validate the request data
        $request->validate([
            'product_code' => 'required',
            'product_name' => 'required',
            'product_description' => 'required',
            'category_id' => 'required',
        ]);

        // Update the product data
        $product->code = $request->input('product_code');
        $product->name = $request->input('product_name');
        $product->description = $request->input('product_description');
        $product->product_category_id = $request->input('category_id');
        $product->save();

        return redirect()->route('admin_create_product')->with('success', 'Product updated successfully.');
    }

    return redirect()->route('admin_create_product')->with('error', 'Product not found.');
}


public function editCategory($id)
{
    $category = ProductCategory::find($id);

    if ($category) {
        return view('admin_edit_category', compact('category'));
    }

    return redirect()->route('admin_create_product')->with('error', 'Category not found.');
}


public function updateCategory(Request $request, $id)
{
    $category = ProductCategory::find($id);

    if ($category) {
        // Validate the request data
        $request->validate([
            'category_name' => 'required|max:255',
        ]);

        // Update the category data
        $category->category_name = $request->input('category_name');
        $category->save();

        return redirect()->route('admin_create_product')->with('success', 'Category updated successfully.');
    }

    return redirect()->route('admin_create_product')->with('error', 'Category not found.');
}





}
