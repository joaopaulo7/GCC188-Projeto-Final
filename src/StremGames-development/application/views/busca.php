<div id="homebody">
    <br>
    <div>
        <h3>Você buscou por: "<i><?php echo $termo ?>"</i></h3>
        <p>Os seguintes resultados foram encontrados.</p>
    </div>
    <hr>
    <div class="row">
        <?php
			$contador = 0;
			foreach($destaques as $destaque) {
				$contador++;
				echo "<div class='col amostra'>" . 
                    "<a href = '".base_url("jogo/info/".$destaque->id_jogo . "/" . limpar($destaque->titulo))."' style= 'color: black; text-decoration: none;'>".
                        img(base_url("/assets/img/jogos/".$destaque->codigo.".jpg")).
                        img(base_url("/assets/img/jogos/".$destaque->codigo.".png")).
					heading(word_limiter($destaque->titulo, 3), 3) . 
                    "<p>".word_limiter($destaque->descricao, 20) . "</p>" . 
                    "</a>".
					 "</div>";
					if ($contador%3 == 0) {
							echo "</div> <br>".
                            "<div class='row'>";
					}
			}
            if($contador%3 == 1)
            {
                echo "<div class='col'></div>";
                echo "<div class='col'></div>";
            }
            else if($contador%3 == 2)
                echo "<div class='col'></div>";
        ?>
    </div>
</div>
