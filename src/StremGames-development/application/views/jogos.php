<br>
<div class="label-administrador">
    <h3>Listagem de Jogos</h3>
    <p>Aqui você pode ver os jogos já cadastrados, caso queria, pode criar um novo jogo ou alterar/apagar jogo já existentes.</p>
    <hr>
    <br>
</div>

<?php

    echo 
    br() . "<div class='row-fluid'>" .
        "<div class='span6'>" .
            anchor(base_url('administrador/form_add_jogo'), "Criar novo", array( "class"=>"botao-form", "style" => "margin-left: 0px;")) .
        "</div>" .
    "</div>
    <br>
    <hr>";
    
    foreach($jogos as $jogo) {
        echo "<div class='row'>
            <div class='col'> 
                <h5 style='float: left;'>" .
                    $jogo->titulo.
                "<span style= 'color: grey' >  (". $jogo->console .")<span>
                </h5>
            </div>
                <div class='col-auto'>" .
                    anchor(base_url('administrador/form_altera_jogo/'.$jogo->id_jogo), "Alterar", array( "class"=>"botao-form-inverso", "style" => "font-size: 20px;")) .
                "</div>
                <div class='col-auto'>".
                    anchor(base_url('administrador/form_remove_jogo/'.$jogo->id_jogo), "Remover",  array( "class"=>"botao-del", "style" => "font-size: 20px; ")) .
                "</div>
        </div>
        <hr>";
    }
    
?>
