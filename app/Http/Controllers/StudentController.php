<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Subject;
use App\Models\Enrollment;
use App\Models\Cart;
use Auth;
use Illuminate\Routing\Controller as BaseController;

class StudentController extends BaseController
{
    public function dashboard()
    {
        // Load the enrollments with subjects
        $user = Auth::user();
        $enrollments = Enrollment::where('student_id', $user->id)->with('subject')->get();
        $cart = Cart::where('student_id', $user->id)->with('subject')->get();

        return view('student.dashboard', [
            'enrollments' => $enrollments,
            'cart' => $cart,
        ]);
    }

    public function search(Request $request)
    {
        $query = $request->input('query');
        $subjects = Subject::where('name', 'ILIKE', "%{$query}%")
            ->orWhere('description', 'ILIKE', "%{$query}%")
            ->get();

        // Load the enrollments and cart items with subjects
        $user = Auth::user();
        $enrollments = Enrollment::where('student_id', $user->id)->with('subject')->get();
        $cart = Cart::where('student_id', $user->id)->with('subject')->get();

        return view('student.dashboard', [
            'subjects' => $subjects,
            'query' => $query,
            'enrollments' => $enrollments,
            'cart' => $cart,
        ]);
    }

    public function addSubject(Request $request)
    {
        $request->validate([
            'subject_id' => 'required|exists:subjects,id',
        ]);
    
        $subject = Subject::findOrFail($request->subject_id);
    
        // Check if subject is already enrolled
        $alreadyEnrolled = Enrollment::where('subject_id', $subject->id)
            ->where('student_id', Auth::id())
            ->exists();
    
        if ($alreadyEnrolled) {
            return redirect()->back()->withErrors(['error' => 'You are already enrolled in this subject.']);
        }
    
        // Check if subject is already in cart
        $alreadyInCart = Cart::where('subject_id', $subject->id)
            ->where('student_id', Auth::id())
            ->exists();
    
        if ($alreadyInCart) {
            return redirect()->back()->withErrors(['error' => 'Subject is already in your cart.']);
        }
    
        // Check if subject has available slots
        if ($subject->remainingSlots() <= 0) {
            return redirect()->back()->withErrors(['error' => 'Subject is full.']);
        }
    
        // Add subject to cart
        Cart::create([
            'subject_id' => $subject->id,
            'student_id' => Auth::id(),
        ]);
    
        return redirect()->route('student.dashboard');
    }

    public function removeSubject($id)
    {
        $cartItem = Cart::where('subject_id', $id)
            ->where('student_id', Auth::id())
            ->first();

        if ($cartItem) {
            $cartItem->delete();
        }

        return redirect()->route('student.dashboard');
    }

    public function finalizeEnrollment()
    {
        // Assuming there's a 'finalized' column to mark the enrollment as finalized
        $cartItems = Cart::where('student_id', Auth::id())->get();

        foreach ($cartItems as $cartItem) {
            // Check if already enrolled
            $alreadyEnrolled = Enrollment::where('subject_id', $cartItem->subject_id)
                ->where('student_id', Auth::id())
                ->exists();

            if (!$alreadyEnrolled) {
                // Create enrollment if not already enrolled
                Enrollment::create([
                    'subject_id' => $cartItem->subject_id,
                    'student_id' => Auth::id(),
                    'finalized' => true,
                ]);
            }

            // Delete cart item regardless of enrollment status
            $cartItem->delete();
        }

        return redirect()->route('student.dashboard');
    }
}
