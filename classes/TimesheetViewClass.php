<?php


namespace cobra_salsa;


class TimesheetViewClass
{
    /**
     * @var string
     */
    private $yr = '';

    /**
     * @var string
     */
    private $mes = '';

    /**
     * @var int
     */
    private $dia = 0;

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
     * @param string $gestor
     * @return string
     */
    public function timeRow(string $label, array $month, TimesheetDayObject $sum, string $field, string $gestor)
    {
        $value = $month[$gestor]->$field;
        $total = $sum->$field;
        $template = "<tr><td class='heavy'>$label</td>";
        for ($i = 1; $i <= $this->dia; $i++) {
            $red = '';
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
     * @param string $gestor
     * @param string $capt
     * @param string $link
     * @return string
     */
    public function countRow(string $label, array $month, TimesheetDayObject $sum, string $field, string $gestor, string $capt, string $link = '')
    {
        $value = $month[$gestor]->$field;
        $total = $sum->$field;
        $template = "<tr><td class='heavy'>$label</td>";
        for ($i = 1; $i <= $this->dia; $i++) {
            $red = '';
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
}