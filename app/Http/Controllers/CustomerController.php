<?php

namespace App\Http\Controllers;

use App\Models\Customer;
use App\Models\FamilyMember;
use App\Models\Nationality;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class CustomerController extends Controller
{
    public function index()
    {
        $nationalities = Nationality::all();
        return view('customer.register', compact('nationalities'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'cst_name' => 'required|string|max:50',
            'cst_dob' => 'required|date',
            'nationality_id' => 'required|exists:nationality,nationality_id',
            'cst_phonenum' => 'required|string|max:20',
            'cst_email' => 'required|email|max:50',
            'family_members.*.ft_name' => 'nullable|string|max:50',
            'family_members.*.ft_dob' => 'nullable|string|max:50',
        ]);

        DB::transaction(function () use ($request) {
            // Get the next customer ID
            $nextId = Customer::max('cst_id') + 1;
            
            // Create customer
            $customer = Customer::create([
                'cst_id' => $nextId,
                'cst_name' => $request->cst_name,
                'cst_dob' => $request->cst_dob,
                'nationality_id' => $request->nationality_id,
                'cst_phonenum' => $request->cst_phonenum,
                'cst_email' => $request->cst_email,
            ]);

            // Create family members if provided
            if ($request->has('family_members')) {
                foreach ($request->family_members as $member) {
                    if (!empty($member['ft_name']) && !empty($member['ft_dob'])) {
                        $nextFtId = FamilyMember::max('ft_id') + 1;
                        FamilyMember::create([
                            'ft_id' => $nextFtId,
                            'cst_id' => $customer->cst_id,
                            'ft_relation' => 'Family', // Default relation
                            'ft_name' => $member['ft_name'],
                            'ft_dob' => $member['ft_dob'],
                        ]);
                    }
                }
            }
        });

        return redirect()->back()->with('success', 'Customer registered successfully!');
    }
}
