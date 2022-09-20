<?php

namespace App\Http\Livewire;

use App\Models\EditingFac;
use App\Models\Master_booking;
use Livewire\Component;

class HONApproved extends Component
{
    public $viewBookingid,$viewUserid,$viewProgram,$viewItemsBooked,$viewlocation,$viewRecordingTime,$viewGuests,$viewLeader,$viewBookedDate,$viewApprovalTime,$viewRemarks,$viewapprovalComments;
    public function viewDetails($id){
        $booking = Master_booking::where('id',$id)->first();

        $this->viewBookingid =$booking->id;
        $this->viewUserid =$booking->user_id;
        $this->viewProgram =$booking->program_title;
        $this->viewItemsBooked =$booking->items_booked;
        $this->viewlocation =$booking->location;
        $this->viewRecordingTime =$booking->recording_time;
        $this->viewGuests =$booking->guests;
        $this->viewLeader =$booking->shift_leader;
        $this->viewBookedDate =$booking->date_booked;
        $this->viewApprovalTime =$booking->approval1_time;
        $this->viewRemarks =$booking->remarks;
       // $this->viewapprovalComments =$booking->comments;
       $this->dispatchBrowserEvent('view-close-modal');
    }
    // public function closeViewmodal(){
    //     $this->viewBookingid ='';
    //     $this->viewUserid ='';
    //     $this->viewProgram ='';
    //     $this->viewItemsBooked ='';
    //     $this->viewlocation ='';
    //     $this->viewRecordingTime ='';
    //     $this->viewGuests ='';
    //     $this->viewLeader ='';
    //     $this->viewBookedDate ='';
    //     $this->viewApprovalTime ='';
    //     $this->viewRemarks ='';

   // }
    public function render()
    {
        $userApprovalSuccess= Master_booking::where('approver1_id', '=', session('LoggedUser'))->where('approval_level1', '=', 'Approved')->get();
        $userBookings = EditingFac::where('approver1_id', '=', session('LoggedUser'))->where('approval_level1', '=', 'Approved')->get();
        return view('livewire.h-o-n-approved',['userApproval' => $userApprovalSuccess],['userBooking' => $userBookings])->layout('livewire.layouts.client');
    }
}