<?php
namespace App\Traits;
use Illuminate\Http\Request;

trait AccessKey
{
    protected function isRCC(Request $request): bool
    {
        $provided = $request->header('accesskey');
        $expected = env('RCC_ACCESS_KEY');
        if (!$expected || !$provided) {
            return false;
        }
        return hash_equals($expected, $provided);
    }
}