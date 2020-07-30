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
     * @param string $value
     * @return string
     */
    public function timeRow(string $label, string $value)
    {
        $template = "<tr><td class='heavy'>$label</td>";
        for ($i = 1; $i <= $this->dia; $i++) {
            $template .= " <td class='light";
            if ($value == '00:00') {
                $template .= ' zeros';
            }
            $template .= "'> $value</td>";
        }
        $template .= "</tr>";
        return $template;
    }

    /**
     * @param string $label
     * @param int $value
     * @param string $capt
     * @param string $gestor
     * @param int[] $total
     * @param string $link
     * @return string
     */
    public function countRow(string $label, int $value, string $capt, string $gestor, array &$total, string $link)
    {
        $template = "<tr><td class='heavy'>$label</td>";
        $sum = 0;
        for ($i = 1; $i <= $this->dia; $i++) {
            $template .= "<td class='light";
            if ($value == 0) {
                $template .= ' zeros';
            }
            $template .= "'><a href='";
            $template .= strtolower($link . '.php?capt=' . $capt
                . '&i=' . $value
                . '&gestor=' . $gestor
                . '&fecha=' . $this->yr . '-' . $this->mes . '-' . $i);
            $template .= "'>";
            $template .= $value;
            $template .= "</a></td>";
            $sum += $value;
            $total[$i] += $value;
        }
        $template .= "<td class='heavy'>";
        $template .= $sum;
        $template .= "</td></tr>";
        return $template;
    }
}