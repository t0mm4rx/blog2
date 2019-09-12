<h3>Le projet</h3>
<p>
Il s'agit d'un générateur "d'oeuvres d'art" animées, composées de cercles de différentes tailles, couleurs, transparence... L'aléatoire a une grande place dans la génération de l'animation. Cependant, l'utilisateur peut définir quel degré de hasard intervient dans les différents paramètres : distance entre les cercles, variations de couleur, vitesse de l'animation...
<br />
Ce projet est une page web, remplie avec un <b>'canvas'</b>. Cet élément HTML crée par Apple pour certain de ses outils en ligne a été intégré aux normes HTML5. Il est supporté par tous les navigateurs (sauf IE < 8). Il sert principalement à créer des animations, comme celle en haut de ce blog. Les canvas HTML5 sont aussi voués à remplacer Flash pour les jeux web.
J'ai utilisé l'excellente librairie javascript <a target="_blank" href="https://p5js.org/">p5js</a>, qui permet d'utiliser ces éléments avec une facilité déconcertante.
</p>

<h3>Comment utiliser l'outil ?</h3>
<p>L'outil ne fonctionne que sur ordinateur car il nécessite un clavier. Vous avez deux commandes :</p>
<ul>
  <li>
    La touche <b>C</b>, qui permet d'ouvrir et de fermer la panneau de configuration
  </li>
  <li>
    La touche <b>R</b>, qui génère aléatoirement une nouvelle animation aléatoire en fonction de vos réglages
  </li>
</ul>
<p>
  Dans le panneau de réglage, vous pouvez modifier 8 paramètres :
</p>
<ul>
  <li>
    <b>'Color delta'</b> : comment la couleur varie. À 0, tous les cercles ont la même couleur, à 2 la couleur varie légerment, plus la valeur est haute, plus les couleurs seront variées.
  </li>
  <li>
    <b>'Position delta'</b> : écart moyen entre les cercles.
  </li>
  <li>
    <b>'Radius'</b> : diamètre maximal des cercles. Le diamètre de chaque cercle est choisi aléatoirement entre 0 et la valeur donnée.
  </li>
  <li>
    <b>'Speed delta'</b> : la variation de vitesse moyenne
  </li>
  <li>
    <b>'N'</b> : le nombre de cercles générés. Attention, augmentez ce paramètre progressivement si vous ne voulez pas faire planter votre navigateur.
  </li>
  <li>
    <b>'Min alpha'</b> : la transparence minimal des cercles. À 0, les cercles les plus transparents sont totalement invisible, à 255, tous les cercles sont opaques.
  </li>
  <li>
    <b>'Alpha delta'</b> : la quantité d'aléatoire dans la transparence des cercles. À 0, tous les cercles ont la transparence minimales défini avant, à 255, les cercles sont tous différents en opacité.
  </li>
  <li>
    <b>'Background light'</b> : la clareté du fond.
  </li>
</ul>
<p>
  Pas besoin de comprendre comment tous ces paramètres influencent le résultat, expérimentez !
</p>

<div class="full_width">
  <a class="button" href="<?php echo $GLOBALS['url']; ?>art/" target="_blank">Essayez le générateur d'art procédural<i class="fas fa-external-link-alt"></i></a>
</div>
<h3>Démo</h3>
<p>Quelques exemples obtenus.</p>

<div class="full_width">
  <img src="<?php echo $GLOBALS['url']; ?>content/articles/art-procedural/1opt.gif" alt="Exemple n°1 d'animation générée aléatoirement">
  <img src="<?php echo $GLOBALS['url']; ?>content/articles/art-procedural/5opt.gif" alt="Exemple n°2 d'animation générée aléatoirement">
  <img src="<?php echo $GLOBALS['url']; ?>content/articles/art-procedural/2opt.gif" alt="Exemple n°3 d'animation générée aléatoirement">
  <img src="<?php echo $GLOBALS['url']; ?>content/articles/art-procedural/6opt.gif" alt="Exemple n°4 d'animation générée aléatoirement">
  <img src="<?php echo $GLOBALS['url']; ?>content/articles/art-procedural/4opt.gif" alt="Exemple n°5 d'animation générée aléatoirement">
</div>
<div class="full_width">
  <a class="button" href="<?php echo $GLOBALS['url']; ?>art/" target="_blank">Lien vers le générateur<i class="fas fa-external-link-alt"></i></a>
</div>
