<?php

namespace App\Helpers;

use DateTime;

class DateHelpers
{
    public static function create_date($due_date)
    {
        $day = substr($due_date, 0, -2);
        $month = date_format(new DateTime(), 'n');
        $year = date_format(new DateTime(), 'Y');
        $date_as_string = $year . '-' . $month . '-' . $day;
        return DateHelpers::format(date_create($date_as_string));
    }

    public static function month_and_year($due_date)
    {
        $month = date_format(new DateTime(), 'n');
        $year = date_format(new DateTime(), 'Y');
        return [
            'month' => $month,
            'year' => $year
        ];
    }

    public static function format(DateTime $date): string
    {
        $months = [
            1 => 'Jan',
            2 => 'Feb',
            3 => 'Mar',
            4 => 'Apr',
            5 => 'May',
            6 => 'Jun',
            7 => 'Jul',
            8 => 'Aug',
            9 => 'Sep',
            10 => 'Oct',
            11 => 'Nov',
            12 => 'Dec'
        ];
        $year = date_format($date, 'Y');
        $month = date_format($date, 'n');
        $day = date_format($date, 'j');
        return $months[$month] . ' ' . $day . ", " . $year;
    }

    public static function get_due_day_field_value($due_date, $invoice_for_attention)
    {
        $day = date_format(new DateTime(), 'j');
        $day_from_due_date = (int) substr($due_date, 0, -2);
        if($day_from_due_date >= $day){
            if($day_from_due_date > $invoice_for_attention + $day){
                return '⚪ ' . DateHelpers::create_date($due_date);
            } else {
                return '🔴 (' . ($day_from_due_date - $day) . ' days) ' . DateHelpers::create_date($due_date);
            }
        } else {
            $days_overdue = $day - $day_from_due_date;
            return '🟠 ' . $days_overdue .  ' days overdue';
        }
    }
}
