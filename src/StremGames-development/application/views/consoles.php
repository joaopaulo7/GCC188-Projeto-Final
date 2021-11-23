<br>
<div class="label-administrador">
    <h3>Listagem de Consoles</h3>
    <p>Aqui você pode ver os consoles já cadastrados, caso queria, pode criar um novo console ou alterar/apagar jogo já existentes.</p>
    <hr>
    <br>
</div>

<?php
    if($resultado == 7){
        echo "<div class='alert alert-success' role='alert'>
                    Ação concluída com sucesso!
                    </div>";
    }
    else if($resultado != 0){
        echo "<div class='alert alert-warning' role='alert'>
                    Oops! Parece que algo deu errado. Por favor tente novamente.
                    </div>";
    }
    
    echo 
    br() . "<div class='row-fluid'>" .
        "<div class='span6'>" .
            anchor(base_url('administrador/adiciona_console'), "Criar novo", array( "class"=>"botao-form", "style" => "margin-left: 0px;")) .
        "</div>" .
    "</div>
    <br>
    <hr>";
    
    foreach($consoles as $console) {
        echo "<div class='row'>
            <div class='col'> 
                <h5 style='float: left;'>" .
                    $console->nome.
                "</h5>
            </div>
                <div class='col-auto'>" .
                    anchor(base_url('administrador/altera_console/'. $console->id_console), "Alterar", array( "class"=>"botao-form-inverso", "style" => "font-size: 20px;")) .
                "</div>
                <div class='col-auto'>".
                    anchor(base_url('administrador/remove_console/'. $console->id_console), "Remover", array( "class"=>"botao-del", "style" => "font-size: 20px;")) .
                "</div>
        </div>
        <hr>";
    }
    
?>
