<?php

namespace App\Http\Livewire;

use App\Models\EditingFac;
use App\Models\EmployeeTable;
use DateInterval;
use DateTime;
use Livewire\Component;

class Assignment extends Component
{
    public $mon, $tue, $wed, $thurs, $friday, $sat, $sun;
    public function assignEditorMonMoA($id)
    {

        $assign = EditingFac::where('id', $id)->first();
        $assign->editor_id = $this->editorMonMorning;
        $assign->save();
        if ($assign) {
            return back()->with('Success', 'Editor assigned successfully');
            return redirect()->back();
        } else {
            return back()->with('Failed', 'something went wrong, try again');
        }
    }


    public function render()
    {

        $nextMon = date('Y-m-d', strtotime('monday next week'));

        $this->mon = $nextMon;
        $this->tue = new DateTime($nextMon);
        $this->tue->add(new DateInterval('P1D'));
        //WED
        $this->wed = new DateTime($nextMon);
        $this->wed->add(new DateInterval('P2D'));
        //thurs
        $this->thurs = new DateTime($nextMon);
        $this->thurs->add(new DateInterval('P3D'));
        //friday
        $this->friday = new DateTime($nextMon);
        $this->friday->add(new DateInterval('P4D'));
        //saturday
        $this->sat = new DateTime($nextMon);
        $this->sat->add(new DateInterval('P5D'));
        //WED
        $this->sun = new DateTime($nextMon);
        $this->sun->add(new DateInterval('P6D'));

        //suit A monday morning
        $approvalSuccess = EditingFac::select('editing_facs.*', 'users.name', 'programs_tables.program_name')
            ->where('editing_facs.editing_date', $nextMon)
            ->where('editing_facs.suitID', '=', '1')->where('editing_facs.approval_level3', '=', 'Approved')
            ->where('editing_facs.endtime_time', '<=', '17:00:00')
            ->join('users', 'editing_facs.user_id', 'users.id')
            ->join('programs_tables', 'editing_facs.program_title', 'programs_tables.id')
            // ->join('employee_tables', 'editing_facs.editor_id', 'employee_tables.id')
            ->first();
        if (!$approvalSuccess) {
            $approvalMEname = [];
        } else {
            if (!$approvalSuccess->editor_id) {
                $approvalMEname = [];
            } else {
                $approvalMEname = EmployeeTable::where('id', $approvalSuccess->editor_id)->first();
            }
        }
        //suit A tuesday morning
        $tueApprovalSuccess = EditingFac::select('editing_facs.*', 'users.name', 'programs_tables.program_name')
            ->where('editing_facs.editing_date', $this->tue)
            ->where('editing_facs.suitID', '=', '1')->where('editing_facs.approval_level3', '=', 'Approved')
            ->where('editing_facs.endtime_time', '<=', '17:00:00')
            ->join('users', 'editing_facs.user_id', 'users.id')
            ->join('programs_tables', 'editing_facs.program_title', 'programs_tables.id')
            //->join('employee_tables', 'editing_facs.editor_id', 'employee_tables.id')
            ->first();
        if (!$tueApprovalSuccess) {
            $approvalTEname  = [];
        } else {
            if (!$tueApprovalSuccess->editor_id) {
                $approvalTEname  = [];
            } else {
                $approvalTEname = EmployeeTable::where('id', $tueApprovalSuccess->editor_id)->first();
            }
        }
        //suit A wednesday morning
        $wedApprovalSuccess = EditingFac::select('editing_facs.*', 'users.name', 'programs_tables.program_name',)
            ->where('editing_facs.editing_date', $this->wed)
            ->where('editing_facs.suitID', '=', '1')->where('editing_facs.approval_level3', '=', 'Approved')
            ->where('editing_facs.endtime_time', '<=', '17:00:00')
            ->join('users', 'editing_facs.user_id', 'users.id')
            ->join('programs_tables', 'editing_facs.program_title', 'programs_tables.id')
            ->first();

        if (!$wedApprovalSuccess) {
            $approvalWEname  = [];
        } else {
            if (!$wedApprovalSuccess->editor_id) {
                $approvalWEname  = [];
            } else {
                $approvalWEname = EmployeeTable::where('id', $wedApprovalSuccess->editor_id)->first();
            }
        }
        $thursApprovalSuccess = EditingFac::select('editing_facs.*', 'users.name', 'programs_tables.program_name',)
            ->where('editing_facs.editing_date', $this->thurs)
            ->where('editing_facs.suitID', '=', '1')->where('editing_facs.approval_level3', '=', 'Approved')
            ->where('editing_facs.endtime_time', '<=', '17:00:00')
            ->join('users', 'editing_facs.user_id', 'users.id')
            ->join('programs_tables', 'editing_facs.program_title', 'programs_tables.id')
            ->first();
        if (!$thursApprovalSuccess) {
            $approvalTHEname  = [];
        } else {
            if (!$thursApprovalSuccess->editor_id) {
                $approvalTHEname  = [];
            } else {
                $approvalTHEname = EmployeeTable::select('employee_tables.*')->where('id', $thursApprovalSuccess->editor_id)->first();
            }
        }

        $friApprovalSuccess = EditingFac::select('editing_facs.*', 'users.name', 'programs_tables.program_name',)
            ->where('editing_facs.editing_date', $this->friday)
            ->where('editing_facs.suitID', '=', '1')->where('editing_facs.approval_level3', '=', 'Approved')
            ->where('editing_facs.endtime_time', '<=', '17:00:00')
            ->join('users', 'editing_facs.user_id', 'users.id')
            ->join('programs_tables', 'editing_facs.program_title', 'programs_tables.id')
            ->first();

        if (!$friApprovalSuccess) {
            $approvalFREname  = [];
        } else {
            if (!$friApprovalSuccess->editor_id) {
                $approvalFREname  = [];
            } else {
                $approvalFREname = EmployeeTable::where('id', $friApprovalSuccess->editor_id)->first();
            }
        }
        $satApprovalSuccess = EditingFac::select('editing_facs.*', 'users.name', 'programs_tables.program_name',)
            ->where('editing_facs.editing_date', $this->sat)
            ->where('editing_facs.suitID', '=', '1')->where('editing_facs.approval_level3', '=', 'Approved')
            ->where('editing_facs.endtime_time', '<=', '17:00:00')
            ->join('users', 'editing_facs.user_id', 'users.id')
            ->join('programs_tables', 'editing_facs.program_title', 'programs_tables.id')
            ->first();
        if (!$satApprovalSuccess) {
            $approvalSAEname  = [];
        } else {
            if (!$satApprovalSuccess->editor_id) {
                $approvalSAEname  = [];
            } else {
                $approvalSAEname = EmployeeTable::where('id', $satApprovalSuccess->editor_id)->first();
            }
        }
        $sunApprovalSuccess = EditingFac::select('editing_facs.*', 'users.name', 'programs_tables.program_name',)
            ->where('editing_facs.editing_date', $this->sun)
            ->where('editing_facs.suitID', '=', '1')->where('editing_facs.approval_level3', '=', 'Approved')
            ->where('editing_facs.endtime_time', '<=', '17:00:00')
            ->join('users', 'editing_facs.user_id', 'users.id')
            ->join('programs_tables', 'editing_facs.program_title', 'programs_tables.id')
            ->first();
        if (!$sunApprovalSuccess) {
            $approvalSuEname  = [];
        } else {
            if (!$sunApprovalSuccess->editor_id) {
                $approvalSuEname  = [];
            } else {
                $approvalSuEname = EmployeeTable::where('id', $sunApprovalSuccess->editor_id)->first();
            }
        }

        // ----SUIT B Queries----
        //suit B monday morning
        $approvalBSuccess = EditingFac::select('editing_facs.*', 'users.name', 'programs_tables.program_name',)
            ->where('editing_facs.editing_date', $nextMon)
            ->where('editing_facs.suitID', '=', '2')->where('editing_facs.approval_level3', '=', 'Approved')
            ->where('editing_facs.endtime_time', '<=', '17:00:00')
            ->join('users', 'editing_facs.user_id', 'users.id')
            ->join('programs_tables', 'editing_facs.program_title', 'programs_tables.id')
            ->first();
        if (!$approvalBSuccess) {
            $approvalBMEname  = [];
        } else {
            if (!$approvalBSuccess->editor_id) {
                $approvalBMEname  = [];
            } else {
                $approvalBMEname = EmployeeTable::where('id', $approvalBSuccess->editor_id)->first();
            }
        }
        //suit B tuesday morning
        $tueApprovalBSuccess = EditingFac::select('editing_facs.*', 'users.name', 'programs_tables.program_name',)
            ->where('editing_facs.editing_date', $this->tue)
            ->where('editing_facs.suitID', '=', '2')->where('editing_facs.approval_level3', '=', 'Approved')
            ->where('editing_facs.endtime_time', '<=', '17:00:00')
            ->join('users', 'editing_facs.user_id', 'users.id')
            ->join('programs_tables', 'editing_facs.program_title', 'programs_tables.id')
            ->first();
        if (!$tueApprovalBSuccess) {
            $approvalBTEname  = [];
        } else {
            if (!$tueApprovalBSuccess->editor_id) {
                $approvalBTEname  = [];
            } else {
                $approvalBTEname = EmployeeTable::where('id', $tueApprovalBSuccess->editor_id)->first();
            }
        }

        //suit B wednesday morning
        $wedApprovalBSuccess = EditingFac::select('editing_facs.*', 'users.name', 'programs_tables.program_name',)
            ->where('editing_facs.editing_date', $this->wed)
            ->where('editing_facs.suitID', '=', '1')->where('editing_facs.approval_level3', '=', 'Approved')
            ->where('editing_facs.endtime_time', '<=', '17:00:00')
            ->join('users', 'editing_facs.user_id', 'users.id')
            //->join('employee_tables', 'editing_facs.editor_id', 'employee_tables.id')
            ->join('programs_tables', 'editing_facs.program_title', 'programs_tables.id')
            ->first();
        if (!$wedApprovalBSuccess) {
            $approvalWBEname  = [];
        } else {
            if (!$wedApprovalBSuccess->editor_id) {
                $approvalWBEname  = [];
            } else {
                $approvalWBEname = EmployeeTable::where('id', $wedApprovalBSuccess->editor_id)->first();
            }
        }

        //suit B thursday morning
        $thursApprovalBSuccess = EditingFac::select('editing_facs.*', 'users.name', 'programs_tables.program_name',)
            ->where('editing_facs.editing_date', $this->thurs)
            ->where('editing_facs.suitID', '=', '2')->where('editing_facs.approval_level3', '=', 'Approved')
            ->where('editing_facs.endtime_time', '<=', '17:00:00')
            ->join('users', 'editing_facs.user_id', 'users.id')
            ->join('programs_tables', 'editing_facs.program_title', 'programs_tables.id')
            //->join('employee_tables', 'editing_facs.editor_id', 'employee_tables.id')
            ->first();
        if (!$thursApprovalBSuccess) {
            $approvalBTHEname  = [];
        } else {
            if (!$thursApprovalBSuccess->editor_id) {
                $approvalBTHEname  = [];
            } else {
                $approvalBTHEname = EmployeeTable::select('employee_tables.*')->where('id', $thursApprovalBSuccess->editor_id)->first();
            }
        }
        //suit B friday morning
        $friApprovalBSuccess = EditingFac::select('editing_facs.*', 'users.name', 'programs_tables.program_name',)
            ->where('editing_facs.editing_date', $this->friday)
            ->where('editing_facs.suitID', '=', '2')->where('editing_facs.approval_level3', '=', 'Approved')
            ->where('editing_facs.endtime_time', '<=', '17:00:00')
            ->join('users', 'editing_facs.user_id', 'users.id')
            ->join('programs_tables', 'editing_facs.program_title', 'programs_tables.id')
            //->join('employee_tables', 'editing_facs.editor_id', 'employee_tables.id')
            ->first();
        if (!$friApprovalBSuccess) {
            $approvalBFREname  = [];
        } else {
            if (!$friApprovalBSuccess->editor_id) {
                $approvalBFREname  = [];
            } else {
                $approvalBFREname = EmployeeTable::where('id', $friApprovalBSuccess->editor_id)->first();
            }
        }
        //suit B SAT morning
        $satApprovalBSuccess = EditingFac::select('editing_facs.*', 'users.name', 'programs_tables.program_name',)
            ->where('editing_facs.editing_date', $this->sat)
            ->where('editing_facs.suitID', '=', '2')->where('editing_facs.approval_level3', '=', 'Approved')
            ->where('editing_facs.endtime_time', '<=', '17:00:00')
            ->join('users', 'editing_facs.user_id', 'users.id')
            ->join('programs_tables', 'editing_facs.program_title', 'programs_tables.id')
            //->join('employee_tables', 'editing_facs.editor_id', 'employee_tables.id')
            ->first();
        if (!$satApprovalBSuccess) {
            $approvalBSAEname  = [];
        } else {
            if (!$satApprovalBSuccess->editor_id) {
                $approvalBSAEname  = [];
            } else {
                $approvalBSAEname = EmployeeTable::where('id', $satApprovalBSuccess->editor_id)->first();
            }
        }
        // 
        //suit B SUN morning
        $sunApprovalBSuccess = EditingFac::select('editing_facs.*', 'users.name', 'programs_tables.program_name',)
            ->where('editing_facs.editing_date', $this->sun)
            ->where('editing_facs.suitID', '=', '2')->where('editing_facs.approval_level3', '=', 'Approved')
            ->where('editing_facs.endtime_time', '<=', '17:00:00')
            ->join('users', 'editing_facs.user_id', 'users.id')
            ->join('programs_tables', 'editing_facs.program_title', 'programs_tables.id')
            //->join('employee_tables', 'editing_facs.editor_id', 'employee_tables.id')
            ->first();
        if (!$sunApprovalBSuccess) {
            $approvalBSuEname  = [];
        } else {
            if (!$sunApprovalBSuccess->editor_id) {
                $approvalBSuEname  = [];
            } else {
                $approvalBSuEname = EmployeeTable::where('id', $sunApprovalBSuccess->editor_id)->first();
            }
        }
        // 
        // ----SUIT C Queries----
        //suit C monday morning
        $approvalCSuccess = EditingFac::select('editing_facs.*', 'users.name', 'programs_tables.program_name',)
            ->where('editing_facs.editing_date', $nextMon)
            ->where('editing_facs.suitID', '=', '3')->where('editing_facs.approval_level3', '=', 'Approved')
            ->where('editing_facs.endtime_time', '<=', '17:00:00')
            ->join('users', 'editing_facs.user_id', 'users.id')
            ->join('programs_tables', 'editing_facs.program_title', 'programs_tables.id')
            //->join('employee_tables', 'editing_facs.editor_id', 'employee_tables.id')
            ->first();
        if (!$approvalCSuccess) {
            $approvalCMEname  = [];
        } else {
            if (!$approvalCSuccess->editor_id) {
                $approvalCMEname  = [];
            } else {
                $approvalCMEname = EmployeeTable::where('id', $approvalCSuccess->editor_id)->first();
            }
        }
        // 
        //suit C tuesday morning
        $tueApprovalCSuccess = EditingFac::select('editing_facs.*', 'users.name', 'programs_tables.program_name',)
            ->where('editing_facs.editing_date', $this->tue)
            ->where('editing_facs.suitID', '=', '3')->where('editing_facs.approval_level3', '=', 'Approved')
            ->where('editing_facs.endtime_time', '<=', '17:00:00')
            ->join('users', 'editing_facs.user_id', 'users.id')
            ->join('programs_tables', 'editing_facs.program_title', 'programs_tables.id')
            //->join('employee_tables', 'editing_facs.editor_id', 'employee_tables.id')
            ->first();
        if (!$tueApprovalCSuccess) {
            $approvalCTEname  = [];
        } else {
            if (!$tueApprovalCSuccess->editor_id) {
                $approvalCTEname  = [];
            } else {
                $approvalCTEname = EmployeeTable::where('id', $tueApprovalCSuccess->editor_id)->first();
            }
        }

        //suit C wednesday morning
        $wedApprovalCSuccess = EditingFac::select('editing_facs.*', 'users.name', 'programs_tables.program_name',)
            ->where('editing_facs.editing_date', $this->wed)
            ->where('editing_facs.suitID', '=', '3')->where('editing_facs.approval_level3', '=', 'Approved')
            ->where('editing_facs.endtime_time', '<=', '17:00:00')
            ->join('users', 'editing_facs.user_id', 'users.id')
            //->join('employee_tables', 'editing_facs.editor_id', 'employee_tables.id')
            ->join('programs_tables', 'editing_facs.program_title', 'programs_tables.id')
            ->first();
        if (!$wedApprovalCSuccess) {
            $approvalWCEname  = [];
        } else {
            if (!$wedApprovalCSuccess->editor_id) {
                $approvalWCEname  = [];
            } else {
                $approvalWCEname = EmployeeTable::where('id', $wedApprovalCSuccess->editor_id)->first();
            }
        }
        //
        //suit C thursday morning
        $thursApprovalCSuccess = EditingFac::select('editing_facs.*', 'users.name', 'programs_tables.program_name',)
            ->where('editing_facs.editing_date', $this->thurs)
            ->where('editing_facs.suitID', '=', '3')->where('editing_facs.approval_level3', '=', 'Approved')
            ->where('editing_facs.endtime_time', '<=', '17:00:00')
            ->join('users', 'editing_facs.user_id', 'users.id')
            ->join('programs_tables', 'editing_facs.program_title', 'programs_tables.id')
            //->join('employee_tables', 'editing_facs.editor_id', 'employee_tables.id')
            ->first();
        if (!$thursApprovalCSuccess) {
            $approvalCTHEname = [];
        } else {
            if (!$thursApprovalCSuccess->editor_id) {
                $approvalCTHEname  = [];
            } else {
                $approvalCTHEname = EmployeeTable::select('employee_tables.*')->where('id', $thursApprovalCSuccess->editor_id)->first();
            }
        }
        //$approvalCTHEname = EmployeeTable::select('employee_tables.*')
        //  ->where('id', $thursApprovalCSuccess->editor_id)->first();
        //suit C friday morning
        $friApprovalCSuccess = EditingFac::select('editing_facs.*', 'users.name', 'programs_tables.program_name',)
            ->where('editing_facs.editing_date', $this->friday)
            ->where('editing_facs.suitID', '=', '3')->where('editing_facs.approval_level3', '=', 'Approved')
            ->where('editing_facs.endtime_time', '<=', '17:00:00')
            ->join('users', 'editing_facs.user_id', 'users.id')
            ->join('programs_tables', 'editing_facs.program_title', 'programs_tables.id')
            //->join('employee_tables', 'editing_facs.editor_id', 'employee_tables.id')
            ->first();
        if (!$friApprovalCSuccess) {
            $approvalCFREname = [];
        } else {
            if (!$friApprovalCSuccess->editor_id) {
                $approvalCFREname  = [];
            } else {
                $approvalCFREname = EmployeeTable::where('id', $friApprovalCSuccess->editor_id)->first();
            }
        }
        // $approvalCFREname = EmployeeTable::where('id', $friApprovalCSuccess->editor_id)->first();
        //suit C SAT morning
        $satApprovalCSuccess = EditingFac::select('editing_facs.*', 'users.name', 'programs_tables.program_name',)
            ->where('editing_facs.editing_date', $this->sat)
            ->where('editing_facs.suitID', '=', '3')->where('editing_facs.approval_level3', '=', 'Approved')
            ->where('editing_facs.endtime_time', '<=', '17:00:00')
            ->join('users', 'editing_facs.user_id', 'users.id')
            ->join('programs_tables', 'editing_facs.program_title', 'programs_tables.id')
            //->join('employee_tables', 'editing_facs.editor_id', 'employee_tables.id')
            ->first();
        if (!$satApprovalCSuccess) {
            $approvalCSAEname = [];
        } else {
            if (!$satApprovalCSuccess->editor_id) {
                $approvalCSAEname  = [];
            } else {
                $approvalCSAEname = EmployeeTable::where('id', $satApprovalCSuccess->editor_id)->first();
            }
        }
        // $approvalCSAEname = EmployeeTable::where('id', $satApprovalCSuccess->editor_id)->first();
        //suit C SUN morning
        $sunApprovalCSuccess = EditingFac::select('editing_facs.*', 'users.name', 'programs_tables.program_name',)
            ->where('editing_facs.editing_date', $this->sun)
            ->where('editing_facs.suitID', '=', '3')->where('editing_facs.approval_level3', '=', 'Approved')
            ->where('editing_facs.endtime_time', '<=', '17:00:00')
            ->join('users', 'editing_facs.user_id', 'users.id')
            ->join('programs_tables', 'editing_facs.program_title', 'programs_tables.id')
            //->join('employee_tables', 'editing_facs.editor_id', 'employee_tables.id')
            ->first();
        if (!$sunApprovalCSuccess) {
            $approvalCSuEname = [];
        } else {
            if (!$sunApprovalCSuccess->editor_id) {
                $approvalCSuEname  = [];
            } else {
                $approvalCSuEname = EmployeeTable::where('id', $sunApprovalCSuccess->editor_id)->first();
            }
        }
        //  
        // ----SUIT B EVENING Queries----
        //suit B mondayevening
        $EapprovalBSuccess = EditingFac::select('editing_facs.*', 'users.name', 'programs_tables.program_name',)
            ->where('editing_facs.editing_date', $nextMon)
            ->where('editing_facs.suitID', '=', '2')->where('editing_facs.approval_level3', '=', 'Approved')
            ->where('editing_facs.start_time', '>=', '17:00:00')
            ->join('users', 'editing_facs.user_id', 'users.id')
            ->join('programs_tables', 'editing_facs.program_title', 'programs_tables.id')
            //->join('employee_tables', 'editing_facs.editor_id', 'employee_tables.id')
            ->first();
        if (!$EapprovalBSuccess) {
            $EapprovalBMEname = [];
        } else {
            if (!$EapprovalBSuccess->editor_id) {
                $EapprovalBMEname  = [];
            } else {
                $EapprovalBMEname = EmployeeTable::where('id', $EapprovalBSuccess->editor_id)->first();
            }
        }
        //$EapprovalBMEname = EmployeeTable::where('id', $EapprovalBSuccess->editor_id)->first();
        //suit b eveninin tuesday morning
        $EtueApprovalBSuccess = EditingFac::select('editing_facs.*', 'users.name', 'programs_tables.program_name',)
            ->where('editing_facs.editing_date', $this->tue)
            ->where('editing_facs.suitID', '=', '2')->where('editing_facs.approval_level3', '=', 'Approved')
            ->where('editing_facs.start_time', '>=', '17:00:00')
            ->join('users', 'editing_facs.user_id', 'users.id')
            ->join('programs_tables', 'editing_facs.program_title', 'programs_tables.id')
            //->join('employee_tables', 'editing_facs.editor_id', 'employee_tables.id')
            ->first();
        if (!$EtueApprovalBSuccess) {
            $EapprovalBTEname = [];
        } else {
            if (!$EtueApprovalBSuccess->editor_id) {
                $EapprovalBTEname  = [];
            } else {
                $EapprovalBTEname = EmployeeTable::where('id', $EtueApprovalBSuccess->editor_id)->first();
            }
        }
        // $EapprovalBTEname = EmployeeTable::where('id', $EtueApprovalBSuccess->editor_id)->first();
        //suit b eveninin wednesday morning
        $EwedApprovalBSuccess = EditingFac::select('editing_facs.*', 'users.name', 'programs_tables.program_name',)
            ->where('editing_facs.editing_date', $this->wed)
            ->where('editing_facs.suitID', '=', '2')->where('editing_facs.approval_level3', '=', 'Approved')
            ->where('editing_facs.start_time', '>=', '17:00:00')
            ->join('users', 'editing_facs.user_id', 'users.id')
            //->join('employee_tables', 'editing_facs.editor_id', 'employee_tables.id')
            ->join('programs_tables', 'editing_facs.program_title', 'programs_tables.id')
            ->first();
        if (!$EwedApprovalBSuccess) {
            $EapprovalBTWEname = [];
        } else {
            if (!$EwedApprovalBSuccess->editor_id) {
                $EapprovalBTWEname  = [];
            } else {
                $EapprovalBTWEname = EmployeeTable::where('id', $EwedApprovalBSuccess->editor_id)->first();
            }
        }
        // 
        //suit b eveninin thursday morning
        $EthursApprovalBSuccess = EditingFac::select('editing_facs.*', 'users.name', 'programs_tables.program_name',)
            ->where('editing_facs.editing_date', $this->thurs)
            ->where('editing_facs.suitID', '=', '2')->where('editing_facs.approval_level3', '=', 'Approved')
            ->where('editing_facs.start_time', '>=', '17:00:00')
            ->join('users', 'editing_facs.user_id', 'users.id')
            ->join('programs_tables', 'editing_facs.program_title', 'programs_tables.id')
            //->join('employee_tables', 'editing_facs.editor_id', 'employee_tables.id')
            ->first();
        if (!$EthursApprovalBSuccess) {
            $EapprovalBTHEname = [];
        } else {
            if (!$EthursApprovalBSuccess->editor_id) {
                $EapprovalBTHEname  = [];
            } else {
                $EapprovalBTHEname = EmployeeTable::select('employee_tables.*')->where('id', $EthursApprovalBSuccess->editor_id)->first();
            }
        }
        //  
        //suit b eveninin friday morning
        $EfriApprovalBSuccess = EditingFac::select('editing_facs.*', 'users.name', 'programs_tables.program_name',)
            ->where('editing_facs.editing_date', $this->friday)
            ->where('editing_facs.suitID', '=', '2')->where('editing_facs.approval_level3', '=', 'Approved')
            ->where('editing_facs.start_time', '>=', '17:00:00')
            ->join('users', 'editing_facs.user_id', 'users.id')
            ->join('programs_tables', 'editing_facs.program_title', 'programs_tables.id')
            //->join('employee_tables', 'editing_facs.editor_id', 'employee_tables.id')
            ->first();
        if (!$EfriApprovalBSuccess) {
            $EapprovalBFREname = [];
        } else {
            if (!$EfriApprovalBSuccess->editor_id) {
                $EapprovalBFREname  = [];
            } else {
                $EapprovalBFREname = EmployeeTable::where('id', $EfriApprovalBSuccess->editor_id)->first();
            }
        }

        //suit b eveninin SAT morning
        $EsatApprovalBSuccess = EditingFac::select('editing_facs.*', 'users.name', 'programs_tables.program_name',)
            ->where('editing_facs.editing_date', $this->sat)
            ->where('editing_facs.suitID', '=', '2')->where('editing_facs.approval_level3', '=', 'Approved')
            ->where('editing_facs.start_time', '>=', '17:00:00')
            ->join('users', 'editing_facs.user_id', 'users.id')
            ->join('programs_tables', 'editing_facs.program_title', 'programs_tables.id')
            //->join('employee_tables', 'editing_facs.editor_id', 'employee_tables.id')
            ->first();
        if (!$EsatApprovalBSuccess) {
            $EapprovalBSAEname = [];
        } else {
            if (!$EsatApprovalBSuccess->editor_id) {
                $EapprovalBSAEname  = [];
            } else {
                $EapprovalBSAEname = EmployeeTable::where('id', $EsatApprovalBSuccess->editor_id)->first();
            }
        }
        //$EapprovalBSAEname = EmployeeTable::where('id', $EsatApprovalBSuccess->editor_id)->first();
        //suit b eveninin SUN morning
        $EsunApprovalBSuccess = EditingFac::select('editing_facs.*', 'users.name', 'programs_tables.program_name',)
            ->where('editing_facs.editing_date', $this->sun)
            ->where('editing_facs.suitID', '=', '2')->where('editing_facs.approval_level3', '=', 'Approved')
            ->where('editing_facs.start_time', '>=', '17:00:00')
            ->join('users', 'editing_facs.user_id', 'users.id')
            ->join('programs_tables', 'editing_facs.program_title', 'programs_tables.id')
            //->join('employee_tables', 'editing_facs.editor_id', 'employee_tables.id')
            ->first();
        if (!$EsunApprovalBSuccess) {
            $EapprovalBSuEname = [];
        } else {
            if (!$EsunApprovalBSuccess->editor_id) {
                $EapprovalBSuEname  = [];
            } else {
                $EapprovalBSuEname = EmployeeTable::where('id', $EsunApprovalBSuccess->editor_id)->first();
            }
        }
        // $EapprovalBSuEname = EmployeeTable::where('id', $EsunApprovalBSuccess->editor_id)->first();

        $editor = EmployeeTable::select('*')
            ->where('duties', '=', 'Presenter')->get();
        return view(
            'livewire.assignment',
            compact(
                'editor',
                'approvalSuccess',
                'approvalMEname',
                'tueApprovalSuccess',
                'approvalTEname',
                'approvalWEname',
                'approvalTHEname',
                'approvalFREname',
                'approvalSAEname',
                'approvalSuEname',
                'wedApprovalSuccess',
                'thursApprovalSuccess',
                'friApprovalSuccess',
                'satApprovalSuccess',
                'sunApprovalSuccess',
                'approvalBSuccess',
                'approvalBMEname',
                'tueApprovalBSuccess',
                'EapprovalBTWEname',
                'approvalBTEname',
                'wedApprovalBSuccess',
                'approvalWBEname',
                'thursApprovalBSuccess',
                'approvalBTHEname',
                'friApprovalBSuccess',
                'approvalBFREname',
                'satApprovalBSuccess',
                'approvalBSAEname',
                'sunApprovalBSuccess',
                'approvalBSuEname',
                'approvalCSuccess',
                'approvalCMEname',
                'tueApprovalCSuccess',
                'approvalCTEname',
                'wedApprovalCSuccess',
                'thursApprovalCSuccess',
                'approvalCTHEname',
                'friApprovalCSuccess',
                'approvalCFREname',
                'satApprovalCSuccess',
                'approvalCSAEname',
                'sunApprovalCSuccess',
                'approvalCSuEname',
                'EapprovalBSuccess',
                'EapprovalBMEname',
                'EtueApprovalBSuccess',
                'EapprovalBTEname',
                'EwedApprovalBSuccess',
                'approvalWCEname',
                'EthursApprovalBSuccess',
                'EapprovalBTHEname',
                'EfriApprovalBSuccess',
                'EapprovalBFREname',
                'EsatApprovalBSuccess',
                'EapprovalBSAEname',
                'EsunApprovalBSuccess',
                'EapprovalBSuEname'
            )
        )->layout('livewire.layouts.base');
    }
}
