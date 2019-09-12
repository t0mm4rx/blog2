<h3>Présentation du projet</h3>
<div class="full_width">
  <iframe width="100%" height="500px" src="https://www.youtube.com/embed/8bQihpcXgHg" frameborder="0" allow="accelerometer; autoplay; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
</div>
<p>
  Notre objectif est de créer la page web ci-dessus affichant le flux vidéo de la webcam, et que l’utilisateur puisse déclencher des sons en <b>passant sa main dans certaines zones de l’image</b>.
Pour cela on utilisera <b>la librairie p5.js et l’extension p5.sound.js</b>, afin de récupérer l’image de la webcam, détecter quand l’utilisateur déclenche certaines zones, que l’on appellera pads, et jouer les sons de la batterie correspondant.
Pour détecter si l’utilisateur passe sa main sur un pad, on va partir du principe que la couleur de la peau de l’utilisateur est distincte de la couleur du fond. On va ensuite étudier les variations du <b>niveau de gris</b> (l’intensité lumineuse moyenne) de chaque pad afin de déterminer si il est déclenchée ou non.
Les pads peuvent être déplacés et leur taille peut être modifiée.
</p>
<div class="full_width">
  <a class="button" href="<?php echo $GLOBALS['url']; ?>webcamdrumming" target="_blank"><i class="fas fa-drum"></i> Jouez !</a>
</div>

<h3>Récupération du flux vidéo de la webcam</h3>
<p>
  On va utiliser la fonction “createCapture” de p5 afin de récupérer le flux vidéo dans un objet “Graphics”, que l’on pourra afficher avec la fonction
  “image()”. L’intérêt d’un objet Graphics, c’est que l’on peut récupérer ses pixels sous la forme d’un tableau grâce à la fonction “loadPixels()”.
  Cela nous sera utile pour étudier la luminosité des zones correspondantes aux pads.
</p>
<pre><code class="javascript">// La fonction setup() est appelé une seule fois quand le navigateur est prêt, c'est ici qu'on va instancier nos variables
var capture = null

function setup()
{
  // On crée un canvas (une zone où l'on peut dessiner) de 480x320 pixels et on le met dans la div #canvas_wrapper
  createCanvas(480, 320).parent('canvas_wrapper')

  // On crée un objet HTML capture, on le cache car on va juste récupérer ses pixels pour les afficher nous-même
  capture = createCapture(VIDEO)
  capture.size(240, 160)
  capture.hide()
}

function draw()
{
  // On affiche le flux de la webcam sur notre canvas
  image(capture, 0, 0, 480, 320)
}</code></pre>

<p>
  On va ensuite faire un symétrie verticale sur l’image, pour que l’écran se comporte comme un miroir.
</p>
<pre><code class="javascript">function draw()
{
  // On sauvegarde la matrice de transformation (rotation, aggrandissement, translation)
  push()

  // On se place au centre de l'écran pour faire une symétrie verticale, puis on revient à (0, 0)
  translate(width / 2, height / 2)
  scale(-1, 1)
  translate(-width / 2, -height / 2)

  // On affiche le flux de la webcam sur notre canvas
  image(capture, 0, 0, 480, 320)

  /* Toutes autres opérations graphique */

  // On rétablit la matrice sauvegardée
  pop()
}</code></pre>
<p>
  Désormais il faudra faire attention lorsque nous utiliserons le système de coordonnées, car <b>x correspond à width - x à cause de la symétrie</b>.
</p>

<h3>Création des pads</h3>
<p>
  Chaque pad est composé de :
</p>
<ul>
  <li>
    Un identifiant, qui sera le nom du fichier son associé
  </li>
  <li>
    Un objet Sound, qui permettra de jouer le son
  </li>
  <li>
    Une position x, y
  </li>
  <li>
    Une variable boolean isTriggered qui détermine si le pad est déclenché
  </li>
</ul>
<p>
  On aura aussi une variable “pad_size” qui sera la taille des pads.
</p>
<pre><code class="javascript">var pads = [
  {
    name: "kick.wav",
    label: "Kick",
    x: 380,
    y: 260,
    threeshold: 120,
    sound: null,
    triggered: false
  },
  {
    name: "snare.wav",
    label: "Snare",
    x: 100,
    y: 260,
    threeshold: 120,
    sound: null,
    triggered: false
  },
  {
    name: "open_hat.wav",
    label: "Open HiHat",
    x: 380,
    y: 60,
    threeshold: 120,
    sound: null,
    triggered: false
  },
  {
    name: "hat.wav",
    label: "Closed HiHat",
    x: 240,
    y: 60,
    threeshold: 120,
    sound: null,
    triggered: false
  },
  {
    name: "symbal.wav",
    label: "Symbal",
    x: 100,
    y: 60,
    threeshold: 120,
    sound: null,
    triggered: false
  }
]
var pad_size = 80
</code></pre>
<p>
  On va maintenant charger tous les sons un à un, grâce à la fonction loadSound(filename). On va charger les images dans la fonction preload(), qui est appelé <b>avant l'affichage du canvas</b>, c'est dans cette fonction qu'il faut charger toutes les ressources.
</p>
<pre><code class="javascript">function preload()
{
  for (var pad of pads)
  {
    pad.sound = loadSound(pad.name)
  }
}
</code></pre>
<p>
  On affiche ces pads sur le flux vidéo de la webcam afin que l'utilisateur sache où placer ses mains.
</p>
<pre><code class="javascript">function draw()
{

  /* Le code qui affiche le flux de la webcam */

  // Le bord des carrés à 5px d'épaisseur
  strokeWeight(5)
  // Les coordonnées x, y donnée à la fonction rect() correspondent au centre du carré
  rectMode(CENTER)

  for (var pad of pads)
  {
    // On rempli en transparent, donc pas de remplissage
    fill(0, 0, 0, 0)
    // On change la couleur du bord si le pad est activé ou non
    if (pad.triggered)
    {
      stroke(100, 200, 100)
    } else
    {
      stroke(230, 100, 100)
    }
    // On dessine le carré
    rect(pad.x, pad.y, pad_size, pad_size)
  }

}
</code></pre>

<p>
  On va ensuite créer la possibilité de déplacer les pads en glisser-déposer. La variable “drag” correspondra au nom du pad sélectionné, et sera à null si aucun pad n’est sélectionné, donc quand le clique gauche est relaché.
</p>
<pre><code class="javascript">var drag = null

// Fonction appelé quand l'utilisateur fait un clique gauche
function mousePressed()
{
  // On oublie pas que l'image est une symétrie
  var x = width - mouseX
  var y = mouseY
  // Pour chaque pad, on regarde si le clique est sur sa zone, si c'est le cas, drag pointe vers ce pad
  for (var pad of pads)
  {
    if (x > pad.x - pad_size / 2 && x < pad.x + pad_size / 2 && y > pad.y - pad_size / 2 && y < pad.y + pad_size / 2)
      drag = pad.name
  }
}

// On relache le pad si le clique gauche est laché
function mouseReleased()
{
  drag = null
}

// Fonction qui nous permet de retrouver un pad depuis la variable drag
function get_pad(name)
{
  for (var pad of pads)
  {
    if (pad.name == name)
      return pad
  }
  return null
}

function draw()
{
  /* Le code précédent */

  // Si le clique gauche n'est pas enfoncé, on relache le pad
  if (!mouseIsPressed)
  {
    drag = null
  }

  // Si le glisser-déposer cible un pad, on modifie la position de ce pad en fonction de la position de la souris
  if (drag != null)
  {
    let x = width - mouseX
    let y = mouseY

    get_pad(drag).x = x
    get_pad(drag).y = y
  }
}
</code></pre>

<h3>Récupérer la valeur du niveau de gris moyen de chaque pad</h3>
<p>
  C’est maintenant que la partie intéressante commence. On va pour chaque pad :
</p>
<ul>
  <li>
    Récupérer les pixels de l’image de la webcam correspondant à la zone du pad
  </li>
  <li>
    Calculer le niveau de gris moyen de ce tableau de pixel. <b>Niveau de gris = (r +g + b) / 3</b>
  </li>
  <li>
    Comparer cette valeur avec le seuil que l’utilisateur a défini
  </li>
  <li>
    Jouer le son si le pad n’était pas déjà déclenché
  </li>
</ul>
<pre><code class="javascript">// Fonction qui récupère la valeur de la luminosité d'un pixel en position x, y
function get_pixel(x, y)
{
  // Le tableau de pixel de l'image est composé de 4 valeurs : [r1, g1, b1, a1, r2, g2, b2, a2, ...]
  // On doit donc convertir nos coordonnées en 2 dimensions en un index de 1 dimension
  let index = ((width - x) + y * width) * 4
  // On retourne (r + g + b) / 3
  return ((pixels[index] + pixels[index + 1] + pixels[index + 2]) / 3)
}

// Cette fonction retourne un tableau de la valeur du niveau de gris des pixels de la zone en paramètre
function get_pixel_area(x, y, w, h)
{
  let res = []
  for (var i = 0; i < h; i += 1)
  {
    for (var j = 0; j < w; j += 1)
    {
      res.push(get_pixel(x + j, y + i))
    }

  }
  return res
}

// Cette fonction retourne la valeur de gris moyenne d'un tableau de pixels (simple moyenne)
function get_grayscale(array)
{
  let s = 0
  for (var a of array)
  {
    s += a
  }
  return s / array.length
}

// Enfin, la fonction qui retourne le niveau de gris d'un pad
function get_pad_grayscale(pad)
{
  // Vu que x,y représente le centre du carré, on soustrait pad_size / 2 pour avoir le coin en haut à gauche
  return get_grayscale(get_pixel_area(pad.x - Math.floor(pad_size / 2), pad.y - Math.floor(pad_size / 2), pad_size, pad_size))
}

// la fonction pour activer un pad, on joue le son quand la main entre dans la zone seulement
function toggle_pad(pad)
{
  if (!pad.triggered)
  {
    pad.triggered = true
    pad.sound.play()
  }
}</code></pre>
<p>
  On vérifie maintenant à chaque image si la luminosité du pad a dépassée le seuil.
</p>
<pre><code class="javascript">function draw()
{

  /* Le code qui affiche le flux de la webcam + les pads */

  for (var pad of pads)
  {
    if (get_pad_grayscale(pad) > pad.threeshold)
    {
      toggle_pad(pad)
    } else {
      pad.triggered = false
    }
  }
}</pre></code>

<h3>Conclusion</h3>
<p>
  Pour aller plus loin, vous pouvez ajouter plus de sons pour créer une vraie batterie avec plus de sons. Vous pouvez également mettre un autre instrument, afin de jouer des notes.
  Ce système fonctionne bien à condition que la couleur de fond soit suffisamment distincte de votre couleur de peau. Pour une meilleur détection, vous pouvez également coller des feuilles de papier blanches sur vos mains.
  De plus, votre webcam doit avoir une fréquence d’image assez élevée pour réduire la latence qui devient vite gênante pour faire le musique.
  Le code complet :
</p>
<div class="full_width">
  <a href="https://github.com/t0mm4rx/WebcamDrumming" target="_blank" class="button"><i class="fab fa-github"></i>Repo Github</a>
</div>
