<br>
<?php
    echo form_open(base_url("carrinho/atualizar"));
    $contador = 1;
    foreach($this->cart->contents() as $item) {
        echo form_hidden($contador.'[rowid]', $item['rowid']) ;
        echo form_hidden('qty', 1) .
        "<div class='row'>
            <div class='col-auto me-auto col-1'>" .
                img(base_url("/assets/img/jogos/".$item['codigo'].".jpg")).
                img(base_url("/assets/img/jogos/".$item['codigo'].".png")).
            "</div>
            <div class='col'>
                <h3 style='float: left;'>" .
                    anchor($item['url'], $item['name'], "class='nome-miniatura'") .
                "</h3>
            </div>
            <div class='col-auto'>
                <div>" .
                    reais($item['price']) .
                "</div>
                <div>".
                    anchor(base_url('carrinho/remover/'.$item['rowid']), "Remover") .
                "</div>
            </div>
        </div>
        <hr>";
        $contador++;
    }


    echo br() . "<div class='row-fluid'>" .
    "<div class='span6'>" .
        anchor(base_url('carrinho/pagar'), "Pagar") .
    "</div>" .
    "<div class='span1 texto-direita'>Total:</div>" .
    "<div class='span2 texto-direita'>" .
        reais($this->cart->total()) .
    "</div>" .
    "</div>" .
    form_close();


