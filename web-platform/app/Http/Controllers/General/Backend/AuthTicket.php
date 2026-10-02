<?php
namespace App\Http\Controllers\General\Backend;
use App\Traits\Ticket;
use Illuminate\Http\Request;

class AuthTicket
{
    use Ticket;

    public function getAuthTicket(Request $request)
    {
        $user = auth()->user();
        $ticket = $this->generateAuthTicket($user->id);
        return response($ticket, 200);
    }
}
