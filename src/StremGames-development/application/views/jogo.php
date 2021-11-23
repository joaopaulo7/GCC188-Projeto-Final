<div id="homebody">
    <br>
    <div class="row">
        <div class="col-3">
            <?php 
                echo img(base_url("/assets/img/jogos/". removePonto($jogo->codigo).".jpg"));
                echo img(base_url("/assets/img/jogos/". removePonto($jogo->codigo).".png"));
                echo br(). br();
                echo heading("Comprar ". $jogo->titulo, 3 ) .
                        "<span class='preco'> Por: ".reais($jogo->preco) ."</span>". br() .
                        form_open(base_url("carrinho/adicionar"));
                        
                $campos_hidden = array('id_jogo' => $jogo->id_jogo,
                                    'nome' => $jogo->titulo,
                                    'preco' => $jogo->preco,
                                    'codigo' => removePonto($jogo->codigo),
                                    'url'      => uri_string());
                                           
                echo form_hidden($campos_hidden).
                form_submit("adicionar", "Adicionar ao carrinho", array('class'=> 'botao-form-inverso')).
                form_close();
            ?>
        </div>
        <div class="col-6">
            <?php 
            echo heading($jogo->titulo." (".$jogo->codigo.")", 2); 
            
            echo "<hr>";
            echo "<span>Console: </span> <a href='".$jogo->console->id_console."'>".$jogo->console->nome."</a>";
            echo "<hr>";
            
            echo "<span>Categorias: </span>";
            foreach($jogo->categorias as $categoria)
            {
                echo "<a href='".base_url("categoria/".$categoria->id_categoria)."'>".$categoria->titulo.", </a>";
            }
            echo "<hr>";
            
            echo "<span>Desenvolvedoras: </span>";
            foreach($jogo->desenvolvedoras as $desenvolvedora)
            {
                echo "<a href='".base_url("desenvolvedora/".$desenvolvedora->id_desenvolvedora)."'>".$desenvolvedora->nome.", </a>";
            }
            echo "<hr>";
            
            echo"<p class = 'descricao'>". $jogo->descricao. "</p>";
            ?>
        </div>

        <div>
           <?php                    

            ?>
        </div>

    </div>
</div>
