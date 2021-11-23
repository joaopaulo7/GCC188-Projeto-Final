<div class="cabeca">
    <div class="container">
        <div class="row ">
            <div class= "col">
                <?php
                    echo "<a class= 'titulo' href= '".base_url()."'>".heading('Strem Games', 1, array("class"=>"muted", "style"=>"margin-top: 0" ))."</a>";
                ?>
            </div>
            <div class='col-auto'>
                <!-- Carinho Cadastro e perfil-->
                    <?php
                        if(null != $this->session->userdata('logado') and $this->session->userdata('cliente')) {
                                echo "Bom dia, Sr(a). <a href= '". base_url("/carrinho"). "' style=' text-decoration: none; '>". $this->session->userdata('cliente')->nome. "<span class='caret'>  </span> </a>";
                                echo "<a href = '". base_url("login/logout") ."'><img src='".base_url("assets/open-iconic/png/account-logout-3x.png")."' style='transform: rotateY(180deg);' ></a>";
                        } 
                        else if($this->session->userdata('administrador')){
                                echo "Bom dia, Sr(a).". $this->session->userdata('administrador')->nome;
                                echo "<a href = '". base_url("login/logout") ."'><img src='".base_url("assets/open-iconic/png/account-logout-3x.png")."' style='transform: rotateY(180deg);' ></a>";
                        }
                        else {
                                echo anchor(base_url("cadastro"), "Cadastrar ", "id = 'home-cadastrar';'") . "<a href= '".base_url('login')."'> <button type='button' id='bt-login' class='btn btn-outline-primary'>Login</button></a>";
                        }
                    ?>
                </div>
         </div>
                <div class="row">
                        <!-- Categorias -->
                        <div class = "col">
                              <div class="dropdown">
                                    <button class="btn btn-primary dropdown-toggle" type="button" id="dropdownMenuButton1" data-bs-toggle="dropdown" aria-expanded="false">Categorias
                                    <span class="caret"></span></button>
                                    <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton1">
                                    <?php
                                        foreach($categorias as $categoria) {
                                            echo "<li>".anchor(base_url("categoria/".$categoria->id_categoria."/".limpar($categoria->titulo)), $categoria->titulo, array("class"=>"dropdown-item"))."</li>";
                                        }
                                    ?>
                                    </ul>
                            </div>
                        </div>
                        
                        <!-- Consoles -->
                        <div class= "col">
                              <div class="dropdown">
                                    <button class="btn btn-primary dropdown-toggle" type="button" id="dropdownMenuButton3" data-bs-toggle="dropdown" aria-expanded="false">Consoles
                                    <span class="caret"></span></button>
                                    <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton3">
                                    <?php
                                        foreach($consoles as $console) {
                                            echo "<li>".anchor(base_url("console/".$console->id_console."/".limpar($console->nome)), $console->nome, array("class"=>"dropdown-item"))."</li>";
                                        }
                                    ?>
                                    </ul>
                            </div>
                    </div>
                    
                        <!-- Desenvolvedoras -->
                        <div class = "col">
                                <div class="dropdown">
                                    <button class="btn btn-primary dropdown-toggle" type="button" id="dropdownMenuButton2" data-bs-toggle="dropdown" aria-expanded="false">Desenvolvedoras
                                    <span class="caret"></span></button>
                                    <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton2">
                                    <?php
                                        foreach($desenvolvedoras as $desenvolvedora) {
                                            echo "<li>".anchor(base_url("desenvolvedoras/".$desenvolvedora->id_desenvolvedora."/".limpar($desenvolvedora->nome)), $desenvolvedora->nome, array("class"=>"dropdown-item"))."</li>";
                                        }
                                    ?>
                                    </ul>
                            </div>
                        </div>
                    
                        <div name = "OFFSET" class = "col-2"></div>
                        
                        <!-- Busca-->
                        <div class= "col-md-4 ms-auto text-end"> 
                            <?php $atributos = array("name" => "form_busca", "class" => "navbar-search pull-right");
                                  echo form_open(base_url("home/buscar"), $atributos);
                                   echo
                                   '<div class="input-group rounded">
                                      <input type="search" name="txt_busca" id= "barra-busca" class="form-control rounded" placeholder="busca" aria-label="busca" aria-describedby="search-addon" />
                                      <span class="input-group-text border-0" style="background: transparent;">
                                        <i class="bi bi-search"></i>
                                      </span>
                                    </div>';
                                   echo form_close();
                               ?>
                        </div>
                </div>
    </div>
</div>


        <div class="container">
