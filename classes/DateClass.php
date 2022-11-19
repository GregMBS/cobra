<?php


namespace cobra_salsa;


class DateClass
{
    /**
     *
     * @param string|null $date
     * @return boolean
     */
    protected function validDate(?string $date): bool
    {
        if (empty($date)) {
            return FALSE;
        }
        $time = strtotime($date);
        $year = date('Y',$time);
        $month = date('m',$time);
        $day = date('d',$time);
        if (checkdate($month, $day, $year)) {
            return TRUE;
        }
        return FALSE;
    }

    /**
     *
     * @param string $date
     * @param string $default
     * @return string
     */
    public function fixDate(string $date, string $default): string
    {
        if ($this->validDate($date)) {
            return $date;
        }
        return $default;
    }

}