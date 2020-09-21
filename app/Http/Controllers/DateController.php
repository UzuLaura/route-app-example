<?php

namespace App\Http\Controllers;

use Yasumi\Yasumi;

class DateController extends Controller
{
    /**
     * @var array of unavailable days in month (used days, holidays, weekends)
     */
    private static $unavailable_days = [];

    /**
     * Set dates for dates options in form.
     * Starting from 2020 last day of January.
     * Ending in current year's last day of current month.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function getDates()
    {
        $dates = [];

        for ($year = date('Y'); $year >= 2020; $year--) {
            for ($month = 12; $month >= 1; $month--) {

                if ($year === date('Y') && $month > date('m')) {
                    continue;
                }

                $dates[] = self::getDate(($month . '/1/' . $year), self::getLastDayOfMonth(($month . '/1/' . $year)));
            }
        }

        return response()->json($dates);
    }

    /**
     * Get number of last day of month.
     *
     * @param string $date
     * @return false|string - number of days in month
     */
    public static function getLastDayOfMonth(string $date)
    {
        return date('t', strtotime(date($date)));
    }

    /**
     * Get unique available day of month.
     * Reset unavailable days
     * if no available days in current month have left.
     *
     * @param string $date
     * @return int - day number
     */
    private static function getUniqueDay(string $date)
    {
        // Reset unavailable days, if all days in month already have been set as unavailable
        if (count(self::$unavailable_days) === (self::getLastDayOfMonth($date) - 1)) {
            self::$unavailable_days = [];
        }

        $day = rand(1, self::getLastDayOfMonth($date));

        // Reset day if it is in unavailable days array
        while (in_array($day, self::$unavailable_days)) {
            $day = rand(1, self::getLastDayOfMonth($date));
        }

        // Set day as unavailable
        array_push(self::$unavailable_days, $day);

        return $day ?? 'error';
    }

    /**
     * Get properly formatted date.
     *
     * @param string $date
     * @param int|string $day
     * @return string - formatted date
     */
    public static function getDate(string $date, int $day): string
    {
        $date_arr = explode('/', $date);
        $month = strlen($date_arr[0]) >= 2 ? $date_arr[0] : '0' . $date_arr[0];
        $year = $date_arr[2];

        $day = strlen($day) >= 2 ? $day : '0' . $day;

        return $month . '/' . $day . '/' . $year;
    }

    /**
     * Get random date in month, that is not weekend or holiday.
     *
     * @param string $date
     * @return string
     * @throws \ReflectionException
     */
    public static function getRandomDayInMonth(string $date): string
    {
        $day = self::getUniqueDay($date);
        $weekend = self::checkIfWeekend(self::getDate($date, $day));
        $holiday = self::checkIfHoliday(self::getDate($date, $day));

        while ($weekend || $holiday) {
            $day = self::getUniqueDay($date);
            $weekend = self::checkIfWeekend(self::getDate($date, $day));
            $holiday = self::checkIfHoliday(self::getDate($date, $day));
        }

        return self::getDate($date, $day);
    }

    /**
     * Check if selected date is not weekend (Saturday or Sunday).
     *
     * @param string $date
     * @return bool
     */
    public static function checkIfWeekend(string $date): bool
    {
        $day_of_week = date('D', strtotime($date));

        if ($day_of_week === 'Sun' || $day_of_week === 'Sat') {
            return true;
        }

        return false;
    }

    /**
     * Check if selected date is not public holiday in selected country (Lithuania).
     *
     * @param string $date
     * @return bool
     * @throws \ReflectionException
     */
    public static function checkIfHoliday(string $date): bool
    {
        $date_arr = explode('/', $date);
        $year = $date_arr[2];

        $holidays = Yasumi::create('Lithuania', $year);

        foreach ($holidays->getHolidayDates() as $holiday) {
            if (strtotime($holiday) === strtotime($date)) {
                return true;
            }
        }

        return false;
    }
}
