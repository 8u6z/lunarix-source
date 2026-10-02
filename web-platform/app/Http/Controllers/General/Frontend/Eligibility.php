<?php
namespace App\Http\Controllers\General\Frontend;
use Illuminate\Http\Request;
use App\Http\Controllers\General\Backend\BCEligibility;

class Eligibility
{
    public function showBcPage(Request $request)
    {
        $eligibility = BCEligibility::getBcEligibility($request);
        return view('membership.eligibility', ['checks' => $eligibility['checks'], 'eligible' => $eligibility['eligible']]);
    }
}