<?php

namespace App\Http\Livewire;

use App\Models\Master_booking;
use Illuminate\Http\Request;
use Livewire\Component;

class CstoApproveProdView extends Component
{
    
    public function veiwline(int $id)
    {
        $record = Master_booking::select('master_bookings.*', 'users.name', 'programs_tables.program_name')
            ->where('master_bookings.id', $id)
            ->join('users', 'master_bookings.user_id', 'users.id')
            ->join('programs_tables', 'master_bookings.program_title', 'programs_tables.id')
            //->join('inventories', 'master_bookings.items_booked', 'inventories.id')           
            ->first();
            return view('livewire.csto-approve-prod-view', compact('record'));
    }
    public function aproveline(Request $request)
    {
        $userId = session('LoggedUser');
        //validate comment
        $request->validate([
            'comments' => 'required',
        ]);

        $bookingline = Master_booking::where('id', $request->recordid)->first();
        $bookingline->approval_level3 = 'Approved';
        $bookingline->approver3_id = $userId;
        $bookingline->approval3_time = now();
        $bookingline->comments = $request->comments;
        $bookingline->save();
        if ($bookingline) {
            return back()->with('Success', 'Record Approved');
            return redirect('/');
        } else {
            return back()->with('Failed', 'something went wrong, try again');
        }
    }
    public function render()
    {
        return view('livewire.csto-approve-prod-view');
    }
}
