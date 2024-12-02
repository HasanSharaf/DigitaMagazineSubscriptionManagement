<?php

namespace App\Utilities\Adapters;

use App\Infrastructure\Models\Roster\RosterShiftStatus;
use Carbon\Carbon;

class AttendanceDayAdapter
{
    public static function convertRosterDayToAttendanceDay($rosterDay): array
    {

        // base data
        $attendanceDay = [
            'day_date' => $rosterDay['day_date'],
            'employee_id' => $rosterDay['employee_id'],
            'created_at' => now()->toDateString(),
            'updated_at' => now()->toDateString(),
        ];

        // shifts data
        $shifts = [];
        foreach ($rosterDay['shifts'] ?? [] as $shift) {
            $shifts[] = self::convertRosterShiftToAttendanceShift($shift);
        }

        // attach the shifts array to the attendance day
        $attendanceDay['shifts'] = $shifts;

        return $attendanceDay;
    }


    private static function convertRosterShiftToAttendanceShift($rosterShift): array
    {
        return [
            'expected_time_in' => $rosterShift['emp_time_in']
                ? Carbon::parse($rosterShift['emp_time_in'])->format('Y-m-d H:i')
                : null,
            'expected_time_out' => $rosterShift['emp_time_out']
                ? Carbon::parse($rosterShift['emp_time_out'])->format('Y-m-d H:i')
                : null,
            'workplace_id' => $rosterShift['workplace_id'],
            'status_id' => $rosterShift['roster_shift_status_id'] ?? RosterShiftStatus::$ABSENT,
            'created_at' => now()->toDateString(),
            'updated_at' => now()->toDateString(),
        ];
    }

}
