<?php


namespace cobra_salsa;


class TimesheetViewClass
{
    /**
     * @var string
     */
    private string $yr;

    /**
     * @var string
     */
    private string $mes;

    /**
     * @var int
     */
    private int $dia;

    /**
     * TimesheetViewClass constructor.
     * @param bool $thisMonth
     */
    public function __construct(bool $thisMonth)
    {
        $date = strtotime('last day of last month');
        if ($thisMonth) {
            $date = time();
        }
        $this->yr = date('Y', $date);
        $this->mes = date('m', $date);
        $this->dia = (int)date('d', $date);
    }

    /**
     * @param string $label
     * @param TimesheetDayObject[] $month
     * @param TimesheetDayObject $sum
     * @param string $field
     * @return string
     */
    public function timeRow(string $label, array $month, TimesheetDayObject $sum, string $field): string
    {
        $total = $sum->$field;
        $template = "<tr><td class='heavy'>$label</td>";
        for ($i = 1; $i <= $this->dia; $i++) {
            $red = '';
            $value = $month[$i]->$field;
            if ($value === '00:00') {
                $red = ' zeros';
            }
            $template .= "<td class='light$red'>$value</td>";
        }
        $template .= "<td class='heavy'>$total</td>";
        $template .= "</tr>";
        return $template;
    }

    /**
     * @param string $label
     * @param array $month
     * @param TimesheetDayObject $sum
     * @param string $field
     * @return string
     */
    public function diffRow(string $label, array $month, TimesheetDayObject $sum, string $field): string
    {
        $total = $sum->$field;
        $template = "<tr><td class='heavy'>$label</td>";
        for ($i = 1; $i <= $this->dia; $i++) {
            $red = '';
            $value = $month[$i]->$field;
            if ($value === '0') {
                $red = ' zeros';
            }
            $string = $this->convertTime($value);
            $template .= "<td class='light$red'>$string</td>";
        }
        $string = $this->convertTime($total);
        $template .= "<td class='heavy'>$string</td>";
        $template .= "</tr>";
        return $template;
    }

    /**
     * @param string $label
     * @param array $month
     * @param TimesheetDayObject $sum
     * @param string $field
     * @param string $gestor
     * @param string $capt
     * @param string $link
     * @return string
     */
    public function countRow(string $label, array $month, TimesheetDayObject $sum, string $field, string $gestor, string $capt, string $link = ''): string
    {
        $total = $sum->$field;
        $template = "<tr><td class='heavy'>$label</td>";
        for ($i = 1; $i <= $this->dia; $i++) {
            $red = '';
            $value = $month[$i]->$field;
            if ($value === '0') {
                $red = ' zeros';
            }
            if (is_array($value)) {
                var_dump($month[$i]);
            }
            $linkText = "<td class='light$red'>$value</td>";
            if (!empty($link)) {
                $aLink = strtolower($link . '.php?capt=' . $capt
                    . '&i=' . $value
                    . '&gestor=' . $gestor
                    . '&fecha=' . $this->yr . '-' . $this->mes . '-' . $i);
                $linkText = "<td class='light$red'><a href='$aLink'>$value</a></td>";
            }
            $template .= $linkText;
        }
        $template .= "<td class='heavy'>$total</td>";
        $template .= "</tr>";
        return $template;
    }

    /**
     *
     * @param float $dec
     * @return string
     */
    private function convertTime(float $dec): string
    {
        $hour = floor($dec / 3600);
        $min = floor($dec / 60) - ($hour * 60);
        return $hour . ':' . str_pad($min, 2, '0', STR_PAD_LEFT);
    }

}