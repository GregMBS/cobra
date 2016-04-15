<?php 
/* 
KOIVI HTML Form to FDF Parser for PHP (C) 2004 Justin Koivisto 
Version 1.1 
Last Modified: 2010-02-17 

    This library is free software; you can redistribute it and/or modify it 
    under the terms of the GNU Lesser General Public License as published by 
    the Free Software Foundation; either version 2.1 of the License, or (at 
    your option) any later version. 

    This library is distributed in the hope that it will be useful, but 
    WITHOUT ANY WARRANTY; without even the implied warranty of MERCHANTABILITY 
    or FITNESS FOR A PARTICULAR PURPOSE. See the GNU Lesser General Public 
    License for more details. 

    You should have received a copy of the GNU Lesser General Public License 
    along with this library; if not, write to the Free Software Foundation, 
    Inc., 59 Temple Place, Suite 330, Boston, MA 02111-1307 USA  

    Full license agreement notice can be found in the LICENSE file contained 
    within this distribution package. 

    Justin Koivisto 
    justin.koivisto@gmail.com 
    http://koivi.com 
*/ 

/** 
 * createXFDF 
 *  
 * Tales values passed via associative array and generates XFDF file format 
 * with that data for the pdf address sullpiled. 
 *  
 * @param string $file The pdf file - url or file path accepted 
 * @param array $info data to use in key/value pairs no more than 2 dimensions 
 * @param string $enc default UTF-8, match server output: default_charset in php.ini 
 * @return string The XFDF data for acrobat reader to use in the pdf form file 
 */ 
function createXFDF($file,$info,$enc='UTF-8'){ 
    $data='<?xml version="1.0" encoding="'.$enc.'"?>'."\n". 
        '<xfdf xmlns="http://ns.adobe.com/xfdf/" xml:space="preserve">'."\n". 
        '<fields>'."\n"; 
    foreach($info as $field => $val){ 
        $data.='<field name="'.$field.'">'."\n"; 
        if(is_array($val)){ 
            foreach($val as $opt) 
                $data.='<value>'.htmlentities($opt).'</value>'."\n"; 
        }else{ 
            $data.='<value>'.htmlentities($val).'</value>'."\n"; 
        } 
        $data.='</field>'."\n"; 
    } 
    $data.='</fields>'."\n". 
        '<ids original="'.md5($file).'" modified="'.time().'" />'."\n". 
        '<f href="'.$file.'" />'."\n". 
        '</xfdf>'."\n"; 
    return $data; 
} 
?> 
