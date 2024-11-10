<?php

namespace App\Http\Controllers;

use App\Models\Testimonial;
use App\Models\User;
use Illuminate\Http\Request;

class TestimonialController extends Controller
{
    public function index()
    {
        $testimonials = Testimonial::with('user')->paginate(2);
        return view('contact', compact('testimonials'));
    }

    public function index1(Request $request){
        if ($request->search){
            $contact = Testimonial::where('name', 'LIKE', '%' .$request->search. '%')
                ->orWhere('email', 'LIKE', '%' .$request->search. '%')->get();
        }else{
            $contact = Testimonial::with('user')->get();
        }
        return view('contactadm', ['contact' => $contact, 'contact'=>Testimonial::all()]);
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|max:255',
            'message' => 'required|string|max:255',
        ]);

        Testimonial::create([
            'name' => $request->input('name'),
            'email' => $request->input('email'),
            'message' => $request->input('message'),
        ]);

        return redirect()->back()->with('success', 'Testimonial added successfully!');
    }
}
