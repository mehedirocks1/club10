<?php

namespace App\Http\Controllers;
namespace App\Http\Controllers;
use Illuminate\Support\Facades\File;
use Illuminate\Http\Request;
use App\Models\Contact;
use App\Models\Branch;
use App\Models\Team;
use App\Models\AboutUs;
use App\Models\Gallery;




class FrontendController extends Controller
{
 // Show Home Page
 public function home()
 {
     return view('frontend.home');
 }

 // Show About Page
 public function about()
 {
     // Fetch all team members
     $teamMembers = Team::all();
     
     // Fetch the AboutUs data (assuming only one record exists in the 'about_us' table)
     $aboutUs = AboutUs::first();  // Assuming you only have one record for the AboutUs

     // Return the view with both the AboutUs and Team data
     return view('frontend.about', compact('teamMembers', 'aboutUs'));
 }



 public function branch()
 {
     // Fetch all branches from the database
     $branches = Branch::all();
 
     // Pass the branches data to the frontend view
     return view('frontend.branch', compact('branches'));
 }
 


 public function contact(Request $request)
 {
     if ($request->isMethod('post')) {
         // Validate the form inputs
         $validated = $request->validate([
             'full_name' => 'required|string|max:255',
             'email' => 'required|email|max:255',
             'subject' => 'required|string|max:255',
             'message' => 'required|string',
         ]);

         // Save the contact message to the database
         Contact::create([
             'full_name' => $request->input('full_name'),
             'email' => $request->input('email'),
             'subject' => $request->input('subject'),
             'message' => $request->input('message'),
         ]);

         // Redirect back with a success message
         return redirect()->back()->with('success', 'Your message has been sent successfully!');
     }

     // Show the contact form
     return view('frontend.contact-us');
 }

 

/*
 // Show Gallery Page
 public function gallery()
 {
     return view('frontend.gallery');
 }
*/




public function gallery()
{
 // Fetch gallery images with pagination
 $galleryImages = Gallery::paginate(6);

 return view('frontend.gallery', compact('galleryImages'));
}









 // Show Registration Page
 public function registration()
 {
     return view('frontend.registration');
 }



// Add this method to show the team




}
