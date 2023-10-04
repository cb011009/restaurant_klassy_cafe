<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User; 

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

}
