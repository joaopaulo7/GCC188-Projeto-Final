<div id="homebody">
    <br>
    <div class="alinhado-centro borda-base espaco-vertical">
        <h3>Seja bem-vindo</h3>
        <p>Use o formulário abaixo para se cadastrar e começar a jogatina ; )</p>
        <hr>
    </div>
    <div class="row-fluid">
        <?php
            echo validation_errors();
            echo form_open(base_url('cadastro/adicionar'), array('id'=>'form_cadastro')) . 
            form_label('Nome', 'nome', array('class'=>'rotulo-forms')) . br().
            form_input(array('id'=>'nome', 'name'=>'nome', 'Placeholder'=>'Nome', 'value' => set_value('nome'), 'class'=>'col-3 campo-form', 'required'=> 0)) . br(). br().
            
            form_label('Sobrenome', 'sobrenome', array('class'=>'rotulo-forms')) . br().
            form_input(array('id'=>'sobrenome', 'name'=>'sobrenome', 'Placeholder'=>'Sobrenome', 'value'=>set_value('sobrenome'), 'class'=>'col-3 campo-form', 'required'=> 0)) . br(). br().
            
            form_label('Data de Nascimento', 'data_nac', array('class'=>'rotulo-forms')) . br().
            form_input(array('id'=>'data_nascimento', 'type'=>'date', 'max'=>(date("Y")-18)."-".date("m-d"), 'name'=>'data_nascimento', 'Placeholder'=>'dd/mm/aaaa', 'class'=>'campo-form', 'required'=> 0)) . br(). br().
            
            form_label('email', 'email', array('class'=>'rotulo-forms')) . br().
            form_input(array('id'=>'email', 'name'=>'email', 'Placeholder'=>'E-mail', 'value'=>set_value('email'), 'class'=>'col-3 campo-form', 'required'=> 0)). br(). br().
            
            form_label('Senha', 'senha', array('class'=>'rotulo-forms')) . br().
            form_password(array('id'=>'senha', 'name'=>'senha', 'Placeholder'=>'Senha', 'value'=>set_value('senha'), 'class'=>'col-3 campo-form', 'required'=> 0)) . br(). br().
            
            form_label('Confrme a senha', 'conf_senha', array('class'=>'rotulo-forms')) . br().
            form_password(array('id'=>'con_senha', 'name'=>'conf_senha', 'Placeholder'=>'Confirme a senha', 'value'=>set_value('senha'), 'class'=>'col-3 campo-form', 'required'=> 0)) . br(). br(). "<hr>".
            form_submit('btn_cadastrar', 'Cadastrar', array('class' => 'col-auto botao-form')) .
            "</div>" . 
            form_close();        
        ?>
    </div>
</div>

