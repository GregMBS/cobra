<?php


namespace cobra_salsa;


class TimesheetViewClass
{
    /**
     * @var string
     */
    private $yr;

    /**
     * @var string
     */
    private $mes;

    /**
     * @var int
     */
    private $dia;

    public function __construct()
    {
        $this->yr = date('Y');
        $this->mes = date('m');
        $this->dia = (int) date('d');
    }

    /**
     * @param string $label
     * @param array $month
     * @param TimesheetDayObject $sum
     * @param string $field
     * @return string
     */
    public function timeRow(string $label, array $month, TimesheetDayObject $sum, string $field)
    {
        $total = $sum->$field;
        $template = "<tr><td class='heavy'>$label</td>";
        for ($i = 1; $i <= $this->dia; $i++) {
            $red = '';
            $value = $month[$i]->$field;
            if ($value == '00:00') {
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
    public function diffRow(string $label, array $month, TimesheetDayObject $sum, string $field)
    {
        $total = $sum->$field;
        $template = "<tr><td class='heavy'>$label</td>";
        for ($i = 1; $i <= $this->dia; $i++) {
            $red = '';
            $value = $month[$i]->$field;
            if ($value == '0') {
                $red = ' zeros';
            }
            $string = $this->convertTime($value);
            $template .= "<td class='light$red'>$string</td>";
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
     * @param string $gestor
     * @param string $capt
     * @param string $link
     * @return string
     */
    public function countRow(string $label, array $month, TimesheetDayObject $sum, string $field, string $gestor, string $capt, string $link = '')
    {
        $total = $sum->$field;
        $template = "<tr><td class='heavy'>$label</td>";
        for ($i = 1; $i <= $this->dia; $i++) {
            $red = '';
            $value = $month[$i]->$field;
            if ($value == '0') {
                $red = ' zeros';
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
    private function convertTime($dec)
    {
        $hour = floor($dec / 3600);
        $min = floor($dec / 60) - ($hour * 60);
        return $hour . ':' . str_pad($min, 2, '0', STR_PAD_LEFT);
    }

}