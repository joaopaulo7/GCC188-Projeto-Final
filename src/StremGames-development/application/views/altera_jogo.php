<div id="homebody">
    <br>
    <div>
        <h3>Alterar Jogo</h3>
        <p>Use o formulário abaixo para alterar um jogo.</p>
        <hr>
    </div>
    <div class="row-fluid">
        <?php
            
            echo validation_errors();
            echo form_open_multipart(base_url('jogo/alterar')). 
            
            form_hidden('id_jogo', $jogo->id_jogo).
            
            form_label('Codigo', 'codigo', array('class'=>'rotulo-forms')) . br().
            "<span style='margin-left: 20px;'> <i>não pode ser alterado</i> </span>".br().
            form_input(array('id'=>'codigo', 'name'=>'codigo', 'Placeholder'=> 'ex: EU.5047', 'value' => $jogo->codigo, 'class'=>'col-4 campo-form', 'readonly'=>'readonly', 'required'=> 1)) . br(). br().
            
            form_label('Titulo', 'titulo', array('class'=>'rotulo-forms')) . br().
            form_input(array('id'=>'titulo', 'name'=>'titulo', 'Placeholder'=> 'ex: FInal Fantasy VII', 'value' => $jogo->titulo, 'class'=>'col-4 campo-form', 'required'=> 0)) . br(). br().
            
            form_label('Console', 'console', array('class'=>'rotulo-forms')) . br().
            "<span style='margin-left: 20px;'> <i>não pode ser alterado</i> </span>".br().
            form_input('console', $consoles[$jogo->Console_id_console], array('id'=>'console', 'class'=>'col campo-form', 'readonly'=>'readonly', 'required'=> 0)) . br(). br();
            
            
            //CATEGORIAS
            echo
            "<hr>".
            "<div id='todasCategorias'  >".
            form_label('Categorias', 'categorias', array('class'=>'rotulo-forms')) . br();
            foreach($jogo->categorias as $categoria){
                echo
                form_dropdown('categorias[]', $categorias, $categoria->id_categoria, array('id'=>'categorias[]', 'class'=>'col campo-form', 'required'=> 0)) . br(). br();
            }
            echo
            "</div>".
            "<button type='button' id='btnCategorias' class='col-2 botao-form' style='font-size: 18px'  onclick='addCat()'>Add categoria</button>
            <br>
            <hr>";
            
            
            //DESENVOLVEDORAS
            echo
            "<div id='todasDesenvolvedoras'  >".
            form_label('Desenvolvedoras', 'desenvolvedoras', array('class'=>'rotulo-forms')) . br();
            foreach($jogo->desenvolvedoras as $desenvolvedora){
                echo form_dropdown('desenvolvedoras[]', $desenvolvedoras, $desenvolvedora->id_desenvolvedora, array('id'=>'desenvolvedoras[]', 'class'=>'col campo-form', 'required'=> 0)) . br(). br();
            }
            echo
            "</div>".
            "<button type='button' id='btnDesenvolvedoras' class='col-2 botao-form' style='font-size: 18px' onclick='addDes()'>Add Desenvolvedora</button>
            <br>
            <hr>".
            
            form_label('Descrição', 'descricao', array('class'=>'rotulo-forms')) . br().
            form_textarea(array('id'=>'descricao', 'name'=>'descricao', 'value' => $jogo->descricao, 'Placeholder'=>'Pequena descrição sobre o jogo em questão', 'class'=>'col-6 campo-form', 'required'=> 0)) . br(). br().
            
            form_label('Preco', 'preco', array('class'=>'rotulo-forms')) . br().
            form_input(array( 'id'=>'preco', 'name'=>'preco', 'value' => $jogo->preco, 'Placeholder'=>'00.00', 'class'=>'col campo-form', 'required'=> 0)) . br(). br().
            
            form_label('Estado', 'estado', array('class'=>'rotulo-forms')) . br().
            form_dropdown('ativo', array(1 => 'ativo', 0 => 'inativo'), $jogo->ativo, array('id'=>'estado', 'class'=>'col campo-form', 'required'=> 0)) . br(). br().
            
            form_label('Imagem de Disco(ISO, cue, etc...)', 'imagem', array('class'=>'rotulo-forms')) . br().
            "<span style='margin-left: 20px;'> <i>deixe vazio se quiser manter como está</i> </span>".br().
            form_upload(array('id'=>'imagem', 'name'=>'imagem')) . br(). br().
            
            form_label('Imagem da Capa (jpg, png, etc..)', 'imagemCapa', array('class'=>'rotulo-forms')) . br().
            "<span style='margin-left: 20px;'> <i>deixe vazio se quiser manter como está</i> </span>".br().
            form_upload(array('id'=>'imagemCapa', 'name'=>'imagemCapa')) . br(). br(). 
            
            "<hr>".
            
            form_submit('btn_cadastrar', 'Fazer Alteração', array('value' => 'upload', 'class' => 'col-auto botao-confirmacao')) . anchor('administrador/jogos', 'Voltar', array('class' => 'botao-form', 'style'=>'font-size: 20px')).
            "</div>" . 
            form_close();        
        ?>
    </div>
    <br>
    <br>
</div>


<script>
    function addCat() {
        document.getElementById("todasCategorias").innerHTML += '<?php
            echo   str_replace(array("\r", "\n"), '',
                form_dropdown('categorias[]', $categorias, null, array('id'=>'categorias[]', 'class'=>'col campo-form', 'required'=> 0)) . br(). br()
            );
        ?>';
    }
    function addDes() {
        document.getElementById("todasDesenvolvedoras").innerHTML += '<?php
            echo   str_replace(array("\r", "\n"), '',
                form_dropdown('desenvolvedoras[]', $desenvolvedoras, null, array('id'=>'desenvolvedoras[]', 'class'=>'col campo-form', 'required'=> 0)) . br(). br()
            );
        ?>';
    }
</script>
