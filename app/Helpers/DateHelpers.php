<?php

namespace App\Helpers;

use DateTime;

class DateHelpers
{
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

    public static function isBefore(DateTime $date1, DateTime $date2): bool
    {
        return $date1 < $date2;
    }

    public static function invoice(DateTime $date, int $invoice_day): DateTime
    {
        $dateDay = date_format($date, 'j');
        if ((int)$dateDay > $invoice_day) {
            $diff = (int)$dateDay - $invoice_day;
            $dateFor = clone $date;
            $dateFor->modify('-' . $diff . ' days');
            $dateFor->modify('+1 month');
        } else {
            $diff =  $invoice_day - (int)$dateDay;
            $dateFor = clone $date;
            $dateFor->modify('+' . $diff . ' days');
        }
        return $dateFor;
    }

    public static function getDueDayFieldValue(string $last_date_paid_string, string $due_day, int $invoice_for_attention)
    {
        $last_date_paid = date_create($last_date_paid_string);
        $invoice_day = (int) substr($due_day, 0, -2);
        $paid_for_date = DateHelpers::invoice($last_date_paid, $invoice_day);
        $currentYear = date_format(new DateTime(), 'Y');
        $currentMonth = date_format(new DateTime(), 'm');
        $invoice_date = date_create($currentYear . '-' . $currentMonth . '-' . $invoice_day);
        $invoice_date_one_month_ago = clone $invoice_date;
        $invoice_date_one_month_ago->modify('-1 month');

        if (date_format($paid_for_date, 'Y-m-d') == date_format($invoice_date_one_month_ago, 'Y-m-d')) {
            $presentDay = date_format(new DateTime(), 'j');
            if ($presentDay > $invoice_day) {
                return ($presentDay - $invoice_day) .  " days overdue";
            } else {
                $diff = $invoice_day - $presentDay;
                if ($diff <= $invoice_for_attention) {
                    return '(' . $diff . ' days) ' . DateHelpers::format($invoice_date);
                } else {
                    return DateHelpers::format($invoice_date);
                }
            }
        } else {
            $next_date = clone $invoice_date;
            $next_date->modify('+1 month');
            return DateHelpers::format($next_date);
        }
    }
}
