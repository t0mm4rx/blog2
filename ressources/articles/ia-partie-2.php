<script src='https://cdnjs.cloudflare.com/ajax/libs/mathjax/2.7.5/MathJax.js?config=TeX-MML-AM_CHTML' async></script>
<h3>Introduction</h3>
<p>
  Dans cette deuxième partie, nous allons coder un neurone en se basant sur la théorie vue dans l'article précédent. Le code en example sera en Python, mais vous pouvez très bien le faire dans votre langage favori. Pour cette partie vous aurez donc besoin d'une compréhension minimale de la programmation. Tous les fichiers sont disponibles en téléchargement à la fin de l'article.<br />
  Nous allons résoudre un problème simple : on nous donne la masse et le diamètre d'un fruit, et l'on doit déterminer si ce fruit est une pomme ou un citron.<br />
  Nous disposons du dataset suivante :
</p>
<div class="full_width">
  <a href="<?php echo $GLOBALS['url']; ?>content/articles/ia-partie-2/dataset.json" class="button" target="_blank">Télécharger le dataset (.json) <i class="fas fa-download"></i></a>
</div>
<p>
  On défini le type 0 pour les pommes et 1 pour les citrons. Le dataset est composé de 100 examples de fruits.
</p>
<h3>La classe neurone</h3>
<p>Pour commencer, listons les différentes propriétés d'un objet neurone :</p>
<ul>
  <li>
    Les poids
  </li>
  <li>
    Un bias
  </li>
  <li>
    Un learning rate
  </li>
</ul>
<p>
  Le neurone est construit à partir d'un nombre d'entrées. Au lancement du programme, les poids sont des valeurs <b>aléatoires</b> comprises entre -1 et 1. Notons que cette classe n'est pas spécifique à notre problème, vous pourrez donc la <b>réutiliser pour d'autres projets</b>. Voilà ce que ça donne en Python :
</p>
<pre><code class="python"># Fichier "Neuron.py"
class Neuron:

    def __init__(self, inputs_n):
        self.learning_rate = 0.01
        self.weights = []
        self.bias = 0
        self.init_weights(inputs_n)

    # Fonction d'initialisation des poids, on crée le tableau de dimension inputs_n et on le rempli de valeurs aléatoires entre -1 et 1
    def init_weights(self, inputs_n):
        for i in range(0, inputs_n):
            self.weights.append(random.uniform(-1, 1))

</code></pre>
<h3>La fonction de prédiction</h3>
<p>
  Maintenant que toutes nos propriétés sont définies est initialisées, on peut créer une méthode 'guess', qui prend en entrée un tableau de valeur, les inputs, et qui retourne la prédiction.
  Pour réaliser cette fonction on a besoin de définir notre fonction d'activation. L'algorithme que nous faisons est un <b>classificateur linéaire</b>, ses valeurs de sorties sont soit pomme soit citron. Notre fonction d'activation doit donc renvoyer soit 1, soit 0. Pour cela, nous allons utiliser une fonction qui renvoi 1 si `x >= 0`, 0 si `x < 0` :
</p>
<pre><code class="python"># Fonction d'activation, x: float
def activate(self, x):
    if x >= 0:
        return 1
    else:
        return 0
</code></pre>
<p>
  On peut ensuite définir notre méthode 'guess'. Pour rappel, voici le procédé d'activation d'un neurone :
</p>
<ul>
  <li>
    On réalise la somme des entrées (inputs) par les poids correspondants
  </li>
  <li>
    On ajoute le bias
  </li>
  <li>
    On passe le résultat dans la fonction d'activation
  </li>
</ul>
<pre><code class="python"># Fonction de prédiction, inputs: float[], retourne la prédiction, 0 (pomme) ou 1 (citron)
def guess(self, inputs):
    sum = 0
    for i in range(0, len(inputs)):
        sum += self.weights[i] * inputs[i]
    sum += self.bias
    return self.activate(sum)
</code></pre>
<h3>L'entrainement</h3>
<p>
  Notre neurone est désormais capable de faire un prédiction, mais ses poids sont définis de manière aléatoirs. Notre fonction 'train' prend en entrée les inputs, et la sortie correspondante. Voici un rappel du déroulement de l'entrainement :
</p>
<ul>
  <li>
    On réalise une prédiction à partir des entrées
  </li>
  <li>
    On calcul l'erreur :
    <br />
    `"erreur" = "résultat" - "prédiction"`
  </li>
  <li>
    On ajoute aux poids l'entrée correspondante multipliée par l'erreur multipliée par le learning rate :<br />
    `"Wi" = "Wi" + "Xi" * "erreur" * "learning rate"`
  </li>
  <li>
    On ajoute au bias l'erreur multipliée par le learning rate :<br />
    `\beta = \beta + "erreur" * "learning rate"`
  </li>
</ul>
<pre><code class="python"># Fonction d'entrainement, input: float[], output: 0 ou 1, retourne l'erreur
def train(self, inputs, output):
    # On réalise une prédiction
    guess = self.guess(inputs)
    # On calcul l'écart entre notre prédiction et la réponse attendue
    error = output - guess
    # On corrige chacun des poids
    for i in range(0, len(self.weights)):
        self.weights[i] += error * inputs[i] * self.learning_rate
    self.bias += error * self.learning_rate
    return error
</code></pre>
<h3>Application à notre problème</h3>
<p>
  Nous avons maintenant une classe neurone complètement fonctionnelle, capable de réaliser une prédiction et de s'entrainer. On veut maintenant créer un neurone à 2 entrées, la masse et le diamètre du fruit. Ensuite il faudra l'entrainer avec notre dataset. En plus, on calculera l'erreur moyenne que commet le neurone pour chaque entrainement, afin de suivre l'évolution des résultats.<br />
  Vous devrez parser le dataset qui est au format JSON. Beaucoup de langagues ont des outils pour le faire. Il se présente sous la forme :
</p>
<pre><code class="json">[
  {
    "masse": 130,
    "diametre": 5,
    "type": 0
  },
  {
    "masse": 99,
    "diametre": 6,
    "type": 1
  },
  ...
]</code></pre>
<p>
  On va répéter l'entrainement 1000 fois, afin de trouver un résultat satisfaisant. Voici le code :
</p>
<pre><code class="python"># Fichier "main.py"
from Neuron import Neuron
import math
import json

# On défini une fonction qui calcul la valeur moyenne d'un tableau de float
def array_average(array):
    sum = 0
    for i in array:
        sum += i
    return sum / len(array)

# On instantie notre neurone avec 2 entrées, masse et diamètre
neuron = Neuron(2)

# On charge en mémoire le dataset sous forme de tableau
dataset = json.loads(open('dataset.json').read())

# Ce tableau va contenir l'erreur moyenne de chaque entrainement (1000 au total)
average_errors = []

# On répète 1000 fois l'entrainement
for x in range(1, 1000):
    # On enregistre toutes les erreurs de cet entrainement afin de calculer l'erreur moyenne sur cet entrainement
    errors = []
    # Pour toutes les entrées du dataset on fait apprendre le neurone et on enregistre son erreur dans le tableau errors
    for fruit in dataset:
        inputs = [fruit['masse'], fruit['diametre']]
        errors.append(math.fabs(neuron.train(inputs, fruit['type'])))

    average_errors.append(array_average(errors))
    print('Entrainement n°', x, 'erreur moyenne :', array_average(errors))

print('Entrainement terminé')
</code></pre>
<p>
  Si on exécute notre programme, voici le résultat :
</p>

<pre><code>Entrainement n° 1 erreur moyenne : 0.77
Entrainement n° 2 erreur moyenne : 0.81
Entrainement n° 3 erreur moyenne : 0.81
Entrainement n° 20 erreur moyenne : 0.77
Entrainement n° 21 erreur moyenne : 0.74
Entrainement n° 265 erreur moyenne : 0.63
Entrainement n° 266 erreur moyenne : 0.62
Entrainement n° 689 erreur moyenne : 0.38
Entrainement n° 690 erreur moyenne : 0.29
Entrainement n° 731 erreur moyenne : 0.09
Entrainement n° 732 erreur moyenne : 0.0
Entrainement n° 999 erreur moyenne : 0.0
Entrainement terminé
</code></pre>
<p>
  Et voilà ! Notre neurone est capable de différencier parfaitement les deux fruits après 732 répétitions de l'entrainement. Si on lui demande de prédire la nature d'un fruit qui n'est pas dans le dataset, il y arrivera sans soucis. Ci-dessous le graphe de la progession du neurone :
</p>
<div class="full_width">
  <img src="<?php echo $GLOBALS['url']; ?>content/articles/ia-partie-2/graph.png" alt="Progression de notre neurone" />
</div>
<p>
  On voit que la courbe est loin d'être lisse, mais <b>globalement le réseau progresse</b>. Maintenant, nous allons reproduire l'expérience <b>sans le bias</b> :
</p>
<div class="full_width">
  <img src="<?php echo $GLOBALS['url']; ?>content/articles/ia-partie-2/graph_bias.png" alt="Progression de notre neurone sans le bias" />
</div>
<p>
  On voit que le neurone est incapable de descendre en dessous d'une erreur de 0,6. Le bias a donc bien une importance cruciale. Faisons un autre essai, cette fois-ci avec un <b>learning rate à 1</b> (ce qui équivaut à l'absence de celui-ci) :
</p>
<div class="full_width">
  <img src="<?php echo $GLOBALS['url']; ?>content/articles/ia-partie-2/graph_lr.png" alt="Progression de notre neurone sans learning rate" />
</div>
<p>
  Là aussi, le neurone bloque aux alentours de 0,6. Ces deux valeurs sont donc indispensables pour un perceptron. Vous pouvez essayer de faire varier les différents paramètres de votre neurone pour en voir l'influence sur le résultat. Vous pouvez également essayer de donner un learning rate différent pour le bias, vous verrez que pour ce dataset en particulier, il est possible d'optimiser l'apprentissage.
</p>
<h3>La limite du neurone seul</h3>
<p>
  Il faut bien l'avouer, notre problème aurait pu être résolu de manière beaucoup plus simple, en définissant des seuils pour la masse et le diamètre par exemple.<br />
  En effet, <b>le machine learning est surtout utile pour résoudre des problèmes très complexes à modéliser mathématiquement</b>. Demandez à un humain de reconnaître un arbre sur une image : il y arrivera sans aucune difficultée. Maintenant écrivez un algorithme capable de reconnaître un arbre. Il est impossible de déterminer une formule mathématique qui reconnais à coup sûr un motif qui dépend de l'angle de vue, de l'éclairage, qui subit des variations... C'est pour ce genre d'usage que le machine learning est très fort.<br />
  Nous avons pour le moment vu le fonctionnement d'un réseau composé d'un seul neurone. Ce genre de réseau est appelé <b>perceptron</b>. Ils ne peuvent résoudre que des problèmes de classification <b>linéaire</b> :
  si l'on représente nos fruits sur un plan avec deux axes, masse et diamètre, on est capable de tracer une droite qui sépare les deux fruits :<br />
</p>
<div class="full_width">
  <img src="<?php echo $GLOBALS['url']; ?>content/articles/ia-partie-2/graph_dataset.png" alt="Représentation graphique du dataset" />
</div>
<p>
  Le bias est lié à <b>l'ordonnée à l'origine de la droite</b>, les poids au coefficient diecteur. Un neurone seul sera incapable de classifier ce genre de dataset :
</p>
<div class="full_width">
  <img src="<?php echo $GLOBALS['url']; ?>content/articles/ia-partie-2/graph_xor.png" alt="Progression de notre neurone sans learning rate" />
</div>
<p>
  Dans ce cas, il est impossible de séparer les classes avec une seule droite, il faudra donc plus d'un neurone.
  Pour résumer, un réseau de neurones et un <b>approximateur de fonction</b>. Plus sa taille est grande, plus il pourra trouver des fonctions complexes.<br />
  Un réseau de neurones prend des entrées et des sorties numériques, et trouve la relation mathématique qui les lient.
</p>
<h3>Conclusion</h3>
<p>
  Nous avons crée un neurone capable de s'entrainer à résoudre des problèmes très simples. L'entrainement permet de trouver les meilleurs poids, mais cela prend un certain nombre d'entrainements avant de pouvoir obtenir un résultat satisfaisant. Il est très important d'avoir un retour sur la progression de l'algorithme, en calculant l'erreur moyenne par exemple. Le fonctionnement d'un neurone peut être représenté graphiquement, par le fait de trouver une droite capable de séparer les différentes classes du dataset.
</p>
<div class="full_width">
  <a href="<?php echo $GLOBALS['url']; ?>content/articles/ia-partie-2/dataset.json" class="button" target="_blank">Dataset (.json) <i class="fas fa-download"></i></a>
  <a href="<?php echo $GLOBALS['url']; ?>content/articles/ia-partie-2/projet partie 2.zip" class="button" target="_blank">Projet (.zip) <i class="fas fa-download"></i></a>
</div>
