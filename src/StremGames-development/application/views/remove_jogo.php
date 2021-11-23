
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
            "<h3><b>". $jogo->titulo. "</b></h3>
            
            <p>". $jogo->descricao."</p>
            <br>
            <br>
            <hr>";
            if(!$podeDel)
            {
                echo 
                "<div class='alert alert-warning' role='alert'>
                    Oops! Parece que você quer remover um jogo que já foi comprado.
                    Infelizmente esse jogo não pode mais ser removido, só retirado de venda.
                    Ele sairá da loja, mas aqueles que já o compraram ainda poderão acessá-lo.
                </div>";
            }
            echo
                form_open(base_url('jogo/remover'), array('id'=>'form_cadastro', 'name' => 'confirmacao', 'onsubmit' =>'return validaRemocao()')) . 
                
                form_hidden('numero', $jogo->id_jogo).
                 
                form_label('Confirme o Nome', 'nome', array('class'=>'rotulo-forms')) . br().
                form_input(array('id'=>'nome', 'name'=>'nome', 'Placeholder'=> 'nome do console', 'class'=>'col-4 campo-form', 'required'=> 0)) . br(). br().
                
                form_submit('btn_cadastrar', 'Remover', array('class' => 'col-auto botao-del')) . anchor('administrador/jogos', 'Voltar', array('class' => 'botao-form', 'style'=>'font-size: 20px')).
                "</div>" . 
                form_close();
        ?>
    </div>
</div>

<script>
function validaRemocao() {
  let x = document.forms["confirmacao"]["nome"].value;
  if (x != "<?php echo $jogo->titulo ?>") {
    alert("Nome incorreto. Por favor tente novamente");
    return false;
  }
}
</script>

