
<div id="homebody">
    <br>
    <div>
        <h3>Remover Console</h3>
        <p>Escreva o nome do console abaixo para confirmar a remoção. CUIDADO: Isso é permanente.</p>
        <hr>
        <br>
    </div>
    <div class="row-fluid">
        <?php
            echo validation_errors();
            
            echo 
            "<h3><b>". $console->nome. "</b></h3>
            
            <p>". $console->descricao."</p>
            <br>
            <br>
            <hr>";
            if($podeDel)
            {
                echo 
                form_open(base_url('console/remover'), array('id'=>'form_cadastro', 'name' => 'confirmacao', 'onsubmit' =>'return validaRemocao()')) . 
                
                form_hidden('numero', $console->id_console).
                 
                form_label('Confirme o Nome', 'nome', array('class'=>'rotulo-forms')) . br().
                form_input(array('id'=>'nome', 'name'=>'nome', 'Placeholder'=> 'nome do console', 'class'=>'col-4 campo-form', 'required'=> 0)) . br(). br().
                
                form_submit('btn_cadastrar', 'Remover', array('class' => 'col-auto botao-perigo')) . anchor('administrador/consoles', 'Voltar', array('class' => 'botao-form', 'style'=>'font-size: 20px')).
                "</div>" . 
                form_close();        
            }
            else
            {
                echo "<div class='alert alert-danger' role='alert'>
                    Oops! Parece que você quer remover um console que tem jogos como dependência.
                    Por favor, cetifique-se que não há nenhum jogo desse console no sistema antes de apagá-lo.
                    </div>";
                echo anchor('administrador/consoles', 'Voltar', array('class' => 'botao-form', 'style'=>'font-size: 20px'));
            }
        ?>
    </div>
</div>

<script>
function validaRemocao() {
  let x = document.forms["confirmacao"]["nome"].value;
  if (x != "<?php echo $console->nome ?>") {
    alert("Nome incorreto. Por favor tente novamente");
    return false;
  }
}
</script>

