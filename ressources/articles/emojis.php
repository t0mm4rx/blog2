<h3>Un réseau de neurone capable de reconnaître un dessin</h3>
<p>
  L'objectif de ce projet était de créer une page web capable de <b>reconnaître le dessin de l'utilisateur et de l'associer avec un emoji</b>. La page comporte deux canvas, l'un pour entraîner le modèle en représentant l'emoji demandé, l'autre pour prédire l'emoji associé au dessin de l'utilisateur.
</p>
<div class="full_width">
  <img src="<?php echo $GLOBALS['url']; ?>ressources/articles/emojis/canvas.png" alt="Les canvas de la page." />
</div>
<p>
  La partie graphique a été faite avec la librairie p5.js, la partie machine learning avec Tensorflow.js. Ce qui est intéressant, c'est que l'entrainement a lieu dans le navigateur, et utilise la puissance graphique de l'ordinateur client. Démo :
</p>
<div class="full_width">
  <iframe width="100%" height="500px" src="https://www.youtube.com/embed/z3hUJqG19qw" frameborder="0" allow="accelerometer; autoplay; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
  <br />
  <a href="<?php echo $GLOBALS['url']; ?>emojis/" target="_blank" class="button" rel="Emoji NN">Essayez vous-même</a>
</div>
<h3>Tensorflow.js, le machine learning dans le navigateur</h3>
<p>
  Tensorflow, c'est la librairie de calcul créee en rendue open source par Google. Elle est utilisée dans tous les produits Google pour affiner leurs algorithmes, faire de meilleurs suggestions, rendre les interfaces plus ergonomiques et plus globalement rendre leurs outils 'intelligents'.
  Le machine learning demande beaucoup de ressources materiels, ce pourquoi il était auparavant impossible d'entrainer des modèles depuis le navigateur. Or, <b>WebGL</b> s'est démocratisé en 2013. Cette technologie permet d'utiliser la carte graphique depuis le JS d'une page web, principalement pour créer des jeux et animations en ligne. Cependant, les cartes graphiques sont très performantes pour les tâches de machine learning.
  Un projet nommé 'deeplearn.js' s'est alors développé pour exploiter cette puissance, puis il s'est fait absorbé par Tensorflow pour devenir Tensorflow.js.
</p>
<p>
  Tensorflow.js fonctionne comme Tensorflow python, vous pouver créer des <b>torseurs et des opérations</b>. Cependant, Keras, une librairie plus haut niveau pour créer des modèles facilement, a été intégré directement sous le nom de 'Layers API'.
  Créer et entrainer un réseau est donc <b>très simple</b>, vous n'avez qu'à choisir les paramètres, sans vous préoccuper des calculs et des algorithmes de retropropagation ou d'entrainement.
  Voilà un exemple de réseau que vous pouvez créer avec Tensorflow.js :
</p>
<pre>
<code class="js">// On crée un modèle
const model = tf.sequential();
// On ajoute la première couche de neurones, avec 4096 entrées (le nombre de pixels de l'image du dessin), et autant de 'hidden units'
model.add(tf.layers.dense({
  inputShape: [4096],
  units: 4096,
  activation: 'sigmoid'
}))
// On ajoute la couche de sortie, avec 5 neurones, pour les 5 emojis possibles
model.add(tf.layers.dense({
  units: 5,
  activation: 'sigmoid'
}))
// On compile le modèle pour lui indiquer différents paramètres
model.compile({
  loss: 'meanSquaredError',
  optimizer: tf.train.sgd(0.1)
})

// On lance un entrainement avec les dessins d'entrainement
model.fit(inputs, labels, {
   batchSize: 1,
   shuffle: true,
   epochs: 10
})

// On réalise une prédiction à partir d'un dessin inconnu
model.predict(tf.tensor2d(pixels, shape=[1, 4096])).dataSync()</code>
</pre>
<p>
  Si vous êtes habitué à Keras, vous pouvez voir que les instructions sont très proches.
</p>
