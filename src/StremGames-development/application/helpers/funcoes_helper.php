<?php defined('BASEPATH') or exit('No direct script access allowed');
    
    function limpar($string) {
        $string = preg_replace('/[ ‘^~\ ’"]/', null, iconv('UTF-8', 'ASCII//TRANSLIT', $string));
        $string = strtolower($string);
        $string = str_replace(" ", "-", $string);
        $string = str_replace("---", "-", $string);
        $string = str_replace("'", "", $string);
        
        return $string;
    }
    
    function limpa_nome($string) {
        $string = str_replace("'", "", $string);
        
        return $string;
    }
    
    function reais($decimal) {
		return "R$".number_format($decimal, 2, ",", ".");
	}
	
	function dataHTML_to_dataMySQL($data) {
		$campos = explode("-", $data);
		return date("Y-m-d", strtotime($campos[0]."/".$campos[1]."/".$campos[2]));
	}
    
    function removePonto($data) {
        return str_replace('.','', $data);
	}
