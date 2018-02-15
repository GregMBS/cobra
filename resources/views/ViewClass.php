<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of ViewClass
 *
 * @author gmbs
 */
class ViewClass {
    
    /**
     * 
     * @param array $aarray
     * @return string
     */
    public function Table($aarray) {
        $header = array_keys($aarray[0]);
        $output = '<table id="classy" class="ui-widget"><thead class="ui-widget-header"><tr>';
        foreach ($header as $column) {
            $output .= '<th>'.$column.'</th>';
        }
        $output .= '</tr></thead><tbody class="ui-widget-content"><tr>';
        foreach ($aarray as $row) {
            foreach ($row as $cell) {
                $output .= '<td>'.$cell.'</td>';
            }
            $output .= '</tr><tr>';
        }
        $output .= '</tr></tbody></table>';
        return $output;
    }
}
