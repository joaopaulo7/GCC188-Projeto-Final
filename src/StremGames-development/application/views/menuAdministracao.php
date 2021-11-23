
    <br>
    <div id="homebody">
        <div class="label-administrador">
            <h3>Menu do Administrador</h3>
            <p>Olá, administrador, nesse menu você pode acessar as listagens de cadastros do site. Ao clicar em alguns dos botões abaixo, você poderá consultar os cadastros e fazer as alterações que forem necessárias.</p>
            <hr>
            <br>
        </div>
            <h4>Alterações em cadastros</h4>
            <div class= "row" >
                    <?php 
                        echo" <div class = 'col' ><a href= ".base_url('administrador/jogos')."><button type='button' class='botao-form-inverso'>Jogos</button></a> </div>";
                        echo" <div class = 'col' > <a href= ".base_url('administrador/consoles')."><button type='button' class='botao-form-inverso'>Consoles</button></a> </div>";
                        echo" <div class = 'col' > <a href= ".base_url('administrador/categorias')."><button type='button' class='botao-form-inverso'>Categorias</button></a> </div>";
                        echo" <div class = 'col' > <a href= ".base_url('administrador/desenvolvedoras')."><button type='button' class='botao-form-inverso'>Desenvolvedoras</button></a> </div>";
                    ?>
            </div>
            <br>
            <hr>
            <br>
            <h4>Alterações em contas</h4>
            <div class= "row justify-content-center" >
                    <?php 
                        echo" <div class = 'col' > <a href= ".base_url('administrador/clientes')."><button type='button' class='botao-form-inverso'>Clientes</button></a> </div>";
                        echo" <div class = 'col' > <a href= ".base_url('administrador/administradores')."><button type='button' class='botao-form-inverso'>Administradores</button></a> </div>";
                        echo" <div class = 'col' > <a href= ".base_url('administrador/excluirPropria')."><button type='button' class='botao-perigo'>Excluir Prórpia Conta</button></a> </div>";
                    ?>
            </div>
        </div>
