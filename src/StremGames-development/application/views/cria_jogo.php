<div id="homebody">
    <br>
    <div>
        <h3>Criar Jogo</h3>
        <p>Use o formulário abaixo para criar um novo jogo.</p>
        <hr>
    </div>
    <div class="row-fluid">
        <?php
            
            echo validation_errors();
            echo form_open_multipart(base_url('jogo/adicionar')). 
            
            form_label('Codigo', 'codigo', array('class'=>'rotulo-forms')) . br().
            form_input(array('id'=>'codigo', 'name'=>'codigo', 'Placeholder'=> 'ex: EU.5047', 'class'=>'col-4 campo-form', 'required'=> 0)) . br(). br().
            
            form_label('Titulo', 'titulo', array('class'=>'rotulo-forms')) . br().
            form_input(array('id'=>'titulo', 'name'=>'titulo', 'Placeholder'=> 'ex: FInal Fantasy VII', 'class'=>'col-4 campo-form', 'required'=> 0)) . br(). br().
            
            form_label('Console', 'console', array('class'=>'rotulo-forms')) . br().
            form_dropdown('console', $consoles, null, array('id'=>'console', 'class'=>'col campo-form', 'required'=> 0)) . br(). br().
            
            
            //CATEGORIAS
            "<hr>".
            "<div id='todasCategorias'  >".
            form_label('Categorias', 'categorias', array('class'=>'rotulo-forms')) . br().
            form_dropdown('categorias[]', $categorias, null, array('id'=>'categorias[]', 'class'=>'col campo-form', 'required'=> 0)) . br(). br().
            "</div>".
            "<button type='button' id='btnCategorias' class='col-2 botao-form' style='font-size: 18px'  onclick='addCat()'>Add categoria</button>
            <br>
            <hr>".
            
            //DESENVOLVEDORAS
            "<div id='todasDesenvolvedoras'  >".
            form_label('Desenvolvedoras', 'desenvolvedoras', array('class'=>'rotulo-forms')) . br().
            form_dropdown('desenvolvedoras[]', $desenvolvedoras, null, array('id'=>'desenvolvedoras[]', 'class'=>'col campo-form', 'required'=> 0)) . br(). br().
            "</div>".
            "<button type='button' id='btnDesenvolvedoras' class='col-2 botao-form' style='font-size: 18px' onclick='addDes()'>Add Desenvolvedora</button>
            <br>
            <hr>".
            
            form_label('Descrição', 'descricao', array('class'=>'rotulo-forms')) . br().
            form_textarea(array('id'=>'descricao', 'name'=>'descricao', 'Placeholder'=>'Pequena descrição sobre o jogo em questão', 'class'=>'col-6 campo-form', 'required'=> 0)) . br(). br().
            
            form_label('Preco', 'preco', array('class'=>'rotulo-forms')) . br().
            form_input(array( 'id'=>'preco', 'name'=>'preco', 'Placeholder'=>'00.00', 'class'=>'col campo-form', 'required'=> 0)) . br(). br().
            
            form_label('Estado', 'estado', array('class'=>'rotulo-forms')) . br().
            form_dropdown('ativo', array(1 => 'ativo', 0 => 'inativo'), 'ativo', array('id'=>'estado', 'class'=>'col campo-form', 'required'=> 0)) . br(). br().
            
            form_label('Imagem de Disco(ISO, cue, etc...)', 'imagem', array('class'=>'rotulo-forms')) . br().
            form_upload(array('id'=>'imagem', 'name'=>'imagem', 'required'=> 0)) . br(). br().
            
            form_label('Imagem da Capa (jpg, png, etc..)', 'imagemCapa', array('class'=>'rotulo-forms')) . br().
            form_upload(array('id'=>'imagemCapa', 'name'=>'imagemCapa', 'required'=> 0)) . br(). br(). 
            
            "<hr>".
            
            form_submit('btn_cadastrar', 'Criar', array('value' => 'upload', 'class' => 'col-auto botao-confirmacao')) . anchor('administrador/jogos', 'Voltar', array('class' => 'botao-form', 'style'=>'font-size: 20px')).
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
