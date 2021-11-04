<?php
    $parcelas = array(1=>'1 parcela de ' . reais($this->cart->total()),
				  2=>'2 parcelas de ' . reais(($this->cart->total())/2),
				  3=>'3 parcelas de ' . reais(($this->cart->total())/3));
                  
    $bandeiras = array('mastercard'=>'Mastercard', 'visa'=>'Visa');

	echo form_open(base_url("carrinho/finalizar_compra")) .
		"<div class='row-fluid'> <div class='span3 texto-direita'>" .
		heading("Valores", 3) .
		"Produtos: " . reais($this->cart->total()) . br() .
		"Total: " . reais($this->cart->total()) . br() .
		"</div>" . "<div class='span1'></div>" .
		"<div id='dados_cartao'>" . '<div class=span4>';
        
		echo
            form_label('Parcelas') .
            form_dropdown('parcelamento', $parcelas) . br().
            form_label('Bandeira do cartão de crédito') .
			form_dropdown('bandeira', $bandeiras) .br().
			form_label('Nome no cartão de crédito', 'cartao_nome') .
			form_input('cartao_nome') .br().
			form_label('Número do cartão de crédito', 'cartao_numero') .
			form_input('cartao_numero') .br().
			'</div><div class=span4>' . 
			form_label('Validade do cartão', 'cartao_validade') .
			form_input('cartao_validade') .br().
			form_label('Código verificador', 'cartao_cvv') .
			form_input('cartao_cvv').
			'</div></div>' .
			form_submit(array('id'=>'pagar', 'value'=>'Pagar e finalizar compra', 'class'=>'a-direita')) .
			form_close() .
			"</div>";
?>
