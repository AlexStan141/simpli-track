<?php

namespace App\Helpers;

use DateTime;
use Carbon\Carbon;

class DateHelpers
{
    public static function create_date($due_date)
    {
        return DateHelpers::format($due_date);
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

    public static function format($date): string
    {
        $months = [
            '01' => 'Jan',
            '02' => 'Feb',
            '03' => 'Mar',
            '04' => 'Apr',
            '05' => 'May',
            '06' => 'Jun',
            '07' => 'Jul',
            '08' => 'Aug',
            '09' => 'Sep',
            '10' => 'Oct',
            '11' => 'Nov',
            '12' => 'Dec'
        ];
        $year = substr($date, 0, 4);
        $month = substr($date, 5, 2);
        $day = substr($date, 8, 2);
        return $months[$month] . ' ' . $day . ", " . $year;
    }

    public static function get_due_day_field($due_date, $invoice_for_attention)
    {
        $current_day = date_format(new DateTime(), 'j');
        $current_month = date_format(new DateTime(), 'n');
        $current_year = date_format(new DateTime(), 'Y');
        $current_date = $current_year . '-' . $current_month . '-' . $current_day;
        $diff_in_days = Carbon::parse($current_date)->diffInDays(Carbon::parse($due_date));
        if ($diff_in_days > $invoice_for_attention) {
            return '⚪ ' . DateHelpers::create_date($due_date);
        } else if ($diff_in_days >= 0) {
            return '🔴 (' . $diff_in_days . ' days) ' . DateHelpers::create_date($due_date);
        } else {
            $days_overdue = Carbon::parse($due_date)->diffInDays(Carbon::parse($current_date));
            return '🟠 ' . $days_overdue .  ' days overdue';
        }
    }
}
