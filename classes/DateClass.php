<?php


namespace cobra_salsa;


class DateClass
{
    /**
     *
     * @param string $date
     * @return boolean
     */
    protected function validDate($date) {
        if (empty($date)) {
            return FALSE;
        }
        $time = strtotime($date);
        $year = date('Y',$time);
        $month = date('m',$time);
        $day = date('d',$time);
        if (checkdate($month, $day, $year)) {
            return TRUE;
        } else {
            return FALSE;
        }
    }

    /**
     *
     * @param string $date
     * @param string $default
     * @return string
     */
    public function fixDate($date, $default) {
        if ($this->validDate($date)) {
            return $date;
        } else {
            return $default;
        }
    }

}