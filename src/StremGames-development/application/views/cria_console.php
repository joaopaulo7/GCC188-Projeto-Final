<div id="homebody">
    <br>
    <div>
        <h3>Criar Console</h3>
        <p>Use o formulário abaixo para criar um novo console.</p>
        <hr>
    </div>
    <div class="row-fluid">
        <?php
            echo validation_errors();
            echo form_open(base_url('console/adicionar'), array('id'=>'form_cadastro')) . 
            
            form_label('Nome', 'nome', array('class'=>'rotulo-forms')) . br().
            form_input(array('id'=>'nome', 'name'=>'nome', 'Placeholder'=> 'ex: ps1', 'class'=>'col-4 campo-form', 'required'=> 0)) . br(). br().
            
            form_label('Descrição', 'descricao', array('class'=>'rotulo-forms')) . br().
            form_textarea(array('type'=>'textarea', 'id'=>'descricao', 'name'=>'descricao', 'Placeholder'=>'Pequena descrição sobre o console em questão', 'class'=>'col-6 campo-form', 'required'=> 0)) . br(). br().
            
            form_submit('btn_cadastrar', 'Criar', array('class' => 'col-auto botao-confirmacao')) . anchor('administrador/consoles', 'Voltar', array('class' => 'botao-form', 'style'=>'font-size: 20px')).
            "</div>" . 
            form_close();        
        ?>
    </div>
    
</div>

