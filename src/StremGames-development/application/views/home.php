<div id="homebody">
    <br>
    <div class="row">
        <?php
			$contador = 0;
			foreach($destaques as $destaque) {
				$contador++;
				echo "<div class='col amostra'>" . 
                    "<a href = '".base_url("jogo/info/".$destaque->id_jogo . "/" . limpar($destaque->titulo))."' style= 'color: black; text-decoration: none;'>".
                    img(base_url("/assets/img/jogos/".$destaque->id_jogo."/".$destaque->image)).
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
