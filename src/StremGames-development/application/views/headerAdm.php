<div class="cabeca">
    <div class="container">
        <div class="row ">
            <div class= "col">
                <?php
                    echo "<a class= 'titulo' href= '".base_url("administrador")."'>".heading('Strem Games', 1, array("class"=>"muted", "style"=>"margin-top: 0" ))."</a>";
                ?>
            </div>
            <div class='col-auto'>
                <!-- Perfil e loggout-->
                    <?php
                        echo "Bom dia, Sr(a).". $this->session->userdata('administrador')->nome. "    ";
                        echo "         <a href = '". base_url("login/logout") ."'><img src='".base_url("assets/open-iconic/png/account-logout-3x.png")."' style='transform: rotateY(180deg);'></a>";
                    ?>
            </div>
        </div>
    </div>
</div>


<div class="container">
