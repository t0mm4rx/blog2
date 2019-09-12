<script src='https://cdnjs.cloudflare.com/ajax/libs/mathjax/2.7.5/MathJax.js?config=TeX-MML-AM_CHTML' async></script>
<h3>Introduction</h3>
<p>
  L'intelligence artificielle est un sujet en vogue. Une des branches les plus populaire de l'IA, les réseaux de neurones, sont présentés comme un <b>outil puissant</b> permettant de résoudre des problèmes jusqu'alors réservés au cerveau humain. Nous verrons ici leur cas d'utilisation et leur fonctionnement.
  Cette première partie est centrée sur le <b>fonctionnement théorique d'un seul neurone</b>, qui constitue la base d'un réseau de neurones. Un neurone seul peut, nous le verrons, résoudre des problèmes simples. Après les explications théoriques je vous montrerai dans la partie 2 comment implémenter un neurone en Python, et nous résoudrons un premier problème grâce au <b>machine learning</b>.
  <br />Nous utiliserons principalement des additions et des multiplications, aucune notion de maths avancés ou d'informatique n'est requise !
  Cet article se veut destiné aux débutants, certains détails seront simplifiés afin de rendre les explications les plus claires possible.
</p>
<h3>À quoi sert un réseau de neurones ?</h3>
<p>
  Un réseau de neurones à un but précis : <b>prédire un résultat à partir de valeurs données</b>. Voici une liste d'exemple :
</p>
<ul>
  <li>Prédire un résultat sportif à partir de facteurs comme la forme des joueurs, le classement des équipes</li>
  <li>Décider les actions à exercer pour conduire une voiture autonome grâce aux données des capteurs retranscrivants l'environnement</li>
  <li>Déterminer si un mail est un spam en se basant sur des paramètres comme la forme de l'adresse d'envoi, la longueur du mail, la présence de certains mot-clés</li>
  <li>Détecter une maladie en se basant sur des critères comme l'activité de la personne, son alimentation</li>
</ul>
<p>
  Dans tous ces cas, le réseau prend en entrée des données, et sort des nouvelles valeurs.
</p>

<p>
  Mais comment le réseau peut-il "deviner" la valeur attendue ? C'est là qu'intervient l'aspect <b>machine learning</b>. Il faut entrainer le réseau avec des milliers voir des millions de cas déjà résolus selon la complexité du problème.<br />
  Reprenons l'exemple du spam : votre messagerie doit détecter si un mail reçu est un spam ou non. Il va constituer une base de données de mails spam signalés par les utilisateurs. Grâce à cette base de mails spam il peut entrainer son réseau de neurones à détecter de nouveaux cas inconnus. <b>Un réseau de neurones crée une règle générale à partir de données existantes afin de pouvoir appliquer cette règle à de nouveaux cas</b>.
</p>

<h3>Comment fonctionne un neurone ?</h3>
<p>
  Nous rentrons maintenant dans la partie technique. Un neurone virtuel est une imitation très simplifiée d'un neurone biologique. Ce neurone prend en entrée une liste de valeurs. Il fait un calcul que nous détaillerons plus tard et retourne une valeur de sortie.<br />
  À chaque entrée correspond un <b>poids</b>. Le poids est un coefficient qui indique quelle est <b>l'influence d'une entrée sur le résultat</b>. Quelle valeur ces poids prennent t-ils ? Ils sont calculés grâce à l'entrainement du neurone. La seule fonction de l'entrainement est de trouver des poids qui donnent le résultat le plus correcte possible.
  Imaginez une boite avec des potars qui correspondent au poids. Le machine learning, ça consiste à tourner ces boutons dans tous les sens pour trouver une configuration qui donne le résultat le plus satisfaisant possible.<br/>
  Prenons un exemple : notre neurone a pour but de prédire si un patient est malade ou non. Il renvoi 1 si le patient est malade, 0 si il est sain. Ses entrées sont :
</p>
<ul>
  <li>Le patient fait-il du sport ?</li>
  <li>Le patient fume t-il ?</li>
  <li>Le patient possède t-il une trotinette ?</li>
</ul>
<p>
  Toutes ces entrées sont binaires, soit 1, soit 0. On entraine le neurone avec une base de données de milliers de patients malades et sains, pour lesquels <b>on connaît les entrées et la sortie</b>. On peut anticiper les valeurs que les poids vont prendre après l'entrainement :
</p>
<ul>
  <li>La première entrée va avoir un poids négatif et important, car elle influence de manière négative le fait d'être malade.</li>
  <li>La deuxème entrée va avoir un poids positif, car elle influence de manière positive le fait d'être malade.</li>
  <li>La troisième entrée va avoir un poids très proche de zéro, car le fait de posséder une trotinette ne semble pas être corrélé avec le fait d'être malade. Cette entrée a donc une influence nulle sur le résultat.</li>
</ul>
<div class="full_width">
  <img src="<?php echo $GLOBALS['url']; ?>content/articles/ia-partie-1/schema1.jpg" alt="Schéma du fonctionement d'un neurone"/>
</div>
<p>
  Voyons maintenant comment en connaissant les poids et les entrées, le neurone calcule une sortie. C'est relativement simple, cela ce fait en deux étapes :
</p>
<ul>
  <li>Tout d'abord on fait la somme des entrées multipliées par leur poids respectif. On note X les entrées et W les poids.
    <br />
    `S = sum(Wi * X i)`
    <br />
    On ajoute ensuite le <b>bias</b>, noté `\beta`, une nouvelle valeur qui ne dépend d'aucune entrée dont vous comprendrez l'utilitée lors de la mise en pratique. C'est une valeur qui a le même rôle qu'une entrée classique, elle nous permettera de résoudre certains problèmes. Pour simplifier, <b>le bias est une entrée activée en permanence</b>.
    <br />
    `S = sum(Wi * X i) + \beta`
  </li>
  <li>On passe ensuite cette somme dans une <b>fonction d'activation</b>. Cette fonction va restreindre la somme obtenue dans un interval donné. Il existe de très nombreuses fonctions d'activations, vous pouvez même en définir vous même. La fonction doit juste avoir une dérivée connue. Une des fonctions les plus utilisées est la fonction sigmoïd, et elle va nous être utile car elle restreint le résultat entre 0 et 1, c'est ce qu'on veut dans notre exemple :
  <br />
  `sig(x) = 1 / (1 + e^-x)`
  <br />
  Cette fonction ressemble à ça :
  <div class="full_width">
    <img src="<?php echo $GLOBALS['url']; ?>content/articles/ia-partie-1/sig.jpg" alt="Schéma du fonctionement d'un neurone"/>
  </div>
</ul>
<p>
  Résumons tous les composants d'un neurone artificiel :
</p>
<ul>
  <li>Une liste d'entrées `X`</li>
  <li>Une liste de poids `W`</li>
  <li>Un bias `\beta`</li>
  <li>Une fonction d'activation, généralement sigmoïd ou signe</li>
</ul>
<p>
  Pour <b>effectuer une prédiction</b>, le neurone multiplie chaque entrée par son poid respectif, ajoute le bias lui aussi multiplié par son poid. Il additionne toutes ces valeurs, et passe la somme par une fonction d'activation.
</p>
<h3>L'apprentissage du neurone</h3>
<p>
  Nous allons maintenant aborder une partie cruciale dans le fonctionnement d'un réseau de neurones : l'apprentissage. Le machine learning consiste à donner une grande quantité d'exemples issus d'un <b>dataset</b>, un large ensemble de données, afin de trouver les poids qui donne un résultat le plus juste possible. Autrement dit, <b>il faut minimiser l'erreur d'un neurone</b>. Pour chaque donnée d'entrainement, le neurone va ajuster ses poids pour se rapprocher du résultat attendu. Voici le procédé d'apprentissage :
</p>
<ul>
  <li>
    On donne au neurone une liste d'entrée, et la sortie attendue. Pour reprendre notre exemple précédent, on a 3 informations : le patient fait-il du sport, fume t-il, et possède t-il une trotinette. On a également la sortie attendue, le patient est sain ou malade. On a toutes les informations, on va maintenant utiliser ces données pour corriger les poids.
  </li>
  <li>
    En utilisant les calculs précédents, on prédit le résultat (malade ou sain) en se basant sur les entrées. On a maintenant notre prédiction et la véritable réponse. On peut calculer l'erreur :<br />
    `E = "réponse" - "prédiction"`<br />
    Si nous avions prédit le bon résultat, l'erreur serait égale à 0. Sinon, l'erreur peut-être 1 ou -1.
  </li>
  <li>
    Avec cette erreur, on est capable de corriger les poids des neurones, grâce à la <b>régression linéaire</b>. Ce procédé mathématique consiste à ajouter au poids son entrée multipliée par l'erreur. En effet, plus l'erreur est grande, plus la correction à effectuer est grande. Si le neurone a juste, alors l'erreur vaut 0 et aucune correction n'est effectuée sur le poids.
    <br />
    `Wi = Wi + "Xi" * E`
    <br />
    On ne peut malheureusement pas s'arréter à ce calcul, nous avons besoin de diminuer la correction apportée : je vous avais dit que le machine learning consistait à tourner des boutons jusqu'à ce qu'il nous donne un résultat convaincant. Ici nos boutons ce sont les poids, qu'il faut ajuster pour trouver les prédictions les plus justes possible. Imaginez qu'à chaque erreur vous tourniez le bouton d'un demi-tour. Vous n'arriverez jamais au bon réglage car vous manqueriez de précision. Ici c'est pareil, on multiplie la correction par un <b>learning rate</b>, qu'on définira ici à 0,1. Le learning rate c'est la précision avec laquelle vous ajustez vos poids.<br />
    `Wi = Wi + "Xi" * E * "learning rate"`<br />
  </li>
  <li>
    Maintenant que nos poids sont corrigés, on corrige le bias, la valeur supplémentaire, de la même manière que les poids. Seulement il n'est associé à aucune entrée, donc on lui ajoute seulement l'erreur multipliée par le learning rate :
    <br />
    `\beta = \beta + E * "learning rate"`
  </li>
</ul>
<p>
  On peut résumer ce procédé avec ce schéma :
</p>
<div class="full_width">
  <img src="<?php echo $GLOBALS['url']; ?>content/articles/ia-partie-1/schema2.jpg" alt="Schéma machine learning"/>
</div>
<p>
    On voit ici que :
</p>
<ul>
  <li>
    Le poids sport n'a pas été amélioré. Il serait amélioré dans le cas où nous pronosticons la maladie mais le malade est sain. L'erreur serait alors -1, et le poids serait égal à 2,2.
  </li>
  <li>
    Le poids cigarette a été amélioré. Sa valeur est passée de -0,3 à -0,2. Nous avons estimé que ce poids devrait avoir une valeur positive, donc il se rapproche de cet objectif.
  </li>
  <li>
    Le poids trotinette a regressé : sa valeur à augmentée, alors qu'elle devrait se rapprocher de 0. Nous avons vu que le rôle d'un neurone était de créer une règle générale. Ici sa seule information est que le patient est malade et qu'il possède une trotinette. Il est logique que le neurone crée une corrélation. Cependant, en répétant l'opération avec l'ensemble du dataset, le neurone va faire rapprocher ce poids de 0.
  </li>
  <li>
    Le bias a augmenté sa valeur, mais on ne sait pas forcemment vers quoi il doit tendre.
  </li>
</ul>
<p>
  On en déduit qu'il faut un très grand nombre de répétitions afin de trouver les poids optimums. Il faut également un dataset qui offre beaucoup de combinaisons différentes.
</p>
<h3>Conclusion</h3>
<p>
  Résumons ce que nous avons vu dans cette première partie :
</p>
<ul>
  <li>
    Un neurone prend des entrées et réalise une prédiction à partir de ces entrées.
  </li>
  <li>
    À chaque entrée correspond un poids qui défini l'influence de l'entrée sur le résultat.
  </li>
  <li>
    Le machine learning ou l'entrainement vise à chercher les poids qui réduisent l'erreur du neurone au maximum.
  </li>
  <li>
    Le dataset doit être le plus grand et le plus varié possible, avec un nombre minimal d'erreurs.
  </li>
</ul>
<p>
  Un neurone est composé :
</p>
<ul>
  <li>
    D'une liste de poids qui correspondent à chaque entrée.
  </li>
  <li>
    D'une valeur qui ne dépend d'aucune entrée, le bias.
  </li>
  <li>
    D'une fonction d'activation, généralement sigmoïd ou signe, qui normalise une somme entre 0 et 1.
  </li>
  <li>
    D'une fonction de prédiction, qui correspond à la somme des entrées multipliées par les poids correspondants plus le bias, tout ça passé dans la fonction d'activation.
  </li>
  <li>
    D'une fonction d'entrainement, qui prend des entrées et la sortie associée. Elle réalise une prédiction, calcule l'erreur entre la prédiction et la solution, puis corrige chacun des poids et le bias grâce à un procédé mathématique appelé "régression linéaire".
  </li>
</ul>
<p>
  Dans la partie 2, nous allons implémenter cette théorie en code, et résoudre notre premier problème.
</p>
<div class="full_width">
  <a href="<?php echo $blog->get_post_by_link('ia-partie-2')->get_url(); ?>" class="button">Partie 2</a>
</div>
