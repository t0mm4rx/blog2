<script src='https://cdnjs.cloudflare.com/ajax/libs/mathjax/2.7.5/MathJax.js?config=TeX-MML-AM_CHTML' async></script>
<h3>L'expérience de Monte Carlo</h3>
<p>
  Les expériences de Monte Carlo sont des protocoles permettant d'<b>approcher la valeur d'un nombre à l'aide de nombres aléatoires</b>.<br />
  On peut se servir de ces méthodes pour approximer la valeur de PI. Voici le protocole :
</p>
  <ul>
    <li>
      On crée une surface carrée, de côté C.
    </li>
    <li>
      On crée une cible, qui est un cercle inscrit dans le carré. Il a pour milieu le centre du carré, et pour rayon C / 2.
    </li>
    <li>
      On lance un grand nombre de fléchettes sur le carré, et on note le nombre de fléchettes inscrites dans la cible `N_{"cible"}`, et le nombre de fléchettes totales `N_{"total"}`.
    </li>
  </ul>
<div class="full_width">
  <img src="<?php echo $GLOBALS['url']; ?>content/articles/pi/target.png" rel="" />
</div>
<p>
  Ici, on a lancé 2 fléchettes, une dans la cible (la bleue), et une en dehors (la rouge).<br />
  Maintenant, comment obtenir la valeur de PI grâce au nombre de fléchettes qui ont touché la cible et le nombre de fléchette total ?<br />
  D'abord voyons la formule de l'air du cercle et du carré :<br />
  `A_{"cerle"} = pi*r^2`<br />
  `A_{"carre"} = (2 * r)^2 = 4 * r^2`<br />
  En lançant un grand nombre de fléchettes, `N_{"cible"}/N_{"total"}` va tendre vers `A_{"cercle"} / A_{"carre"}`. Il faut maintenant extraire PI de cette relation : <br />
  `A_{"cercle"} / A_{"carre"} = (pi*r^2)/(4 * r^2) = pi / 4`<br />
  `N_{"cible"}/N_{"total"} = pi / 4`<br />
  `pi = 4 * N_{"cible"}/N_{"total"}`<br />
  On a désormais une relation qui nous permet de retrouver PI en fonction du nombres de fléchettes qui touchent la cible. On peut désormais créer une simulation.
</p>
<h3>Création d'une simulation en javascript</h3>
<p>
  Le code est plutôt court et simple :
</p>
<pre><code class="javascript">// Le nombre de fléchettes qui ont touché la cible, et le nombre total de fléchettes tirées
var inside = 0
var total = 0

function setup()
{
  // On crée le canvas de taille 500x500px
  // La fonction .parent() permet de placer le canvas dans la div avec l'id donnée
  createCanvas(500, 500).parent("content")

  background(200)

  // On dessine le cercle
  stroke(100)
  fill(0, 0, 0, 0)
  ellipse(width / 2, height / 2, width, height)
}

function draw()
{
  // A chaque frame, on tir 100 fléchettes
  for (var i = 0; i < 100; i++)
    random_point()

  // On met à jour notre approximation de PI grâce à la formule
  let pi_val = (inside / (total)) * 4
  // On affiche notre valeur arrondie à 4 chiffres après la virgule dans la console
  console.log(Math.rond(pi_val * 10000) / 10000)
}

// La fonction qui tire une fléchette
function random_point()
{
  // On choisi des coordonnées aléatoires sur le canvas
  let x = random(0, width)
  let y = random(0, height)

  // On regarde si la distance du point par rapport au centre du cercle est inférieur à son rayon --> on regarde si le point est dans le cercle on non
  if ( Math.pow((width / 2) - x, 2) + Math.pow((height / 2) - y, 2) < Math.pow(width / 2, 2) )
  {
    fill(23, 109, 169)
    inside += 1
  } else {
    fill(200, 100, 100)
  }
  total += 1
  noStroke()
  ellipse(x, y, 3, 3)
}
</code></pre>
<div class="full_width">
  <a href="https://tommarx.fr/pi/" target="_blank" class="button" rel="Approximer PI avec la méthode de Monte Carlo"><i class="fas fa-external-link-alt"></i>Démo</a>
</div>
