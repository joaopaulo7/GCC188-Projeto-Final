<div id="homebody">
    <br>
    <div class="label-login">
        <h3>Efetuar login</h3>
        <p>Informe os dados de usuário e senha para fazer login no website.</p>
    </div>
    <hr>
    
    <div class="row">
        <?php
             if($erro) 
                echo '<div class="alert alert-warning" role="alert">
                              Email ou senha icorretos, por favor entre coms os dados novamente.
                            </div>'; 
            echo validation_errors();
            echo form_open(base_url('login/login'), array('id'=>'form_login')) . 
                form_label('email', 'email', array('class'=>'rotulo-forms')).br().
                form_input(array('id'=>'email', 'class'=>'col-3 campo-form campo-email', 'name'=>'email', 'Placeholder'=>'E-mail', 'value'=>set_value('email'))). br(). br().
                form_label('Senha', 'rotulo-forms',  array('class'=>'rotulo-forms')). br().
                form_password(array('id'=>'senha', 'class'=>'col-3 campo-form compo-senha', 'name'=>'senha', 'Placeholder' =>'Senha')) . br(). br().
                form_submit( array('id'=>'senha', 'class'=>'botao-form', 'name'=>'btnLogin'), "Entrar") .
                anchor(base_url('cadastro/esqueci_minha_senha', ), "Esqueci minha senha", array('class' => 'link-form')).
                form_close() ;
        ?>
    </div>
</div>
