<div id="homebody">
    <br>
    <div>
        <h3>Alterar um Console</h3>
        <p>Use o formulário abaixo para alterar o console desejado.</p>
        <hr>
    </div>
    <div class="row-fluid">
        <?php
            echo validation_errors();
            echo form_open(base_url('console/alterar'), array('id'=>'form_cadastro')) . 
            
            form_hidden('numero', $console->id_console).
            
            form_label('Nome', 'nome', array('class'=>'rotulo-forms')) . br().
            form_input(array('id'=>'nome', 'name'=>'nome', 'Placeholder'=> 'ex: ps1', 'value'=>$console->nome, 'class'=>'col-4 campo-form', 'required'=> 0)) . br(). br().
            
            form_label('Descrição', 'descricao', array('class'=>'rotulo-forms')) . br().
            form_textarea(array('type'=>'textarea', 'id'=>'descricao', 'name'=>'descricao', 'Placeholder'=>'Pequena descrição sobre o console em questão', 'value'=>$console->descricao, 'class'=>'col-6 campo-form', 'required'=> 0)) . br(). br().
            
            form_submit('btn_cadastrar', 'Alterar', array('class' => 'col-auto botao-confirmacao')) . anchor('administrador/consoles', 'Voltar', array('class' => 'botao-form', 'style'=>'font-size: 20px')).
            "</div>" . 
            form_close();        
        ?>
    </div>
    
</div>

