<p>
  Depuis CSS3, les développeurs web peuvent utiliser la propriété 'Flexbox' dans leur CSS. Aujourd'hui, selon le site <a target="_blank" href="https://caniuse.com/#feat=flexbox" rel="Ce site liste différentes propriétés CSS et leur adoptions par les différents navigateurs et systèmes d'exploitation.">Can I Use ?</a>, 95,5% des navigateurs supportent Flexbox.
  Ce module, couplé avec les grilles CSS, dont nous verrons l'utilité dans un prochain article, parraît tellement simple d'utilisation qu'on imagine difficilement qu'il ne devienne pas la norme d'ici quelques années dans la création de layouts web.
</p>

<h3>Comprendre Flexbox</h3>
<p>
  Si vous comprenez Flexbox à la perfection, vous serez capables de concrétiser vos idées et maquettes de design web très facilement.<br />
  Pour rappel, en CSS, un <b>container</b> est un élément qui contient d'autres éléments, dits <b>enfants</b>.<br />
  Avec Flexbox, <b>le container va aligner tous les éléments dans une seule direction</b>, pour former une rangée ou une colonne selon l'orientation du container. L'orientation de Flexbox peut être contrôlée via la propriété '<b>flex-direction</b>'.
</p>
<div class="full_width">
  <img src="<?php echo $GLOBALS['url']; ?>ressources/articles/guide-flexbox/container.png" alt="Un container flexbox horizontal" />
  <p class="image_caption">
    Ici le container est orienté horizontalement, grâce à la propriété 'flex-direction: row;'
  </p><br />
  <img src="<?php echo $GLOBALS['url']; ?>ressources/articles/guide-flexbox/container_vertical.png" alt="Un container flexbox vertical" />
  <p class="image_caption">
    Ici le container est orienté verticalement, grâce à la propriété 'flex-direction: column;'
  </p>
</div>
<p>
  Sur l'image ci-dessus, on voit en fond gris le container, et 3 enfants à l'intérieur. Voici la structure HTML :
</p>
<pre><code class="html">&lt;div id="container"&gt;
  &lt;div class="child"&gt;
    &lt;span&gt;Un premier enfant&lt;/span&gt;
  &lt;/div&gt;

  &lt;div class="child"&gt;
    &lt;span&gt;Un second enfant&lt;/span&gt;
  &lt;/div&gt;

  &lt;div class="child"&gt;
    &lt;span&gt;Un troisième enfant&lt;/span&gt;
  &lt;/div&gt;
&lt;/div&gt;
</code></pre>
<p>
  Et en CSS :
</p>
<pre>
  <code class="css">#container {
  background-color: #adadad;
  padding: 10px;
  display: flex;
  /* Pour un alignement horizontal */
  flex-direction: row;
  /* Pour un alignement vertical */
  flex-direction: column;
}</code>
</pre>
<p>
  Pour résumer, <b>'display: flex' s'applique sur l'élément contenant</b>, et va aligner tous les enfants de cet élément <b>dans une seule direction</b>.
</p>
<h3>L'alignement horizontal</h3>
<p>
  Un container Flexbox permet d'aligner les éléments sur le plan horizontal et vertical de plusieurs manières différentes. Pour définir l'orientation horizontale, on utilise la propriété '<b>justify-content</b>' sur le container pour définir les marges et la position des enfants.
</p>
<div class="full_width">
  <img src="<?php echo $GLOBALS['url']; ?>ressources/articles/guide-flexbox/center.png" alt="La propriété justify-content: center;" />
  <p class="image_caption">
    Au centre, avec justify-content: center;
  </p><br />
  <img src="<?php echo $GLOBALS['url']; ?>ressources/articles/guide-flexbox/flex_start.png" alt="La propriété justify-content: center;" />
  <p class="image_caption">
    Au début du container, avec justify-content: flex-start;
  </p><br />
  <img src="<?php echo $GLOBALS['url']; ?>ressources/articles/guide-flexbox/flex_end.png" alt="La propriété justify-content: center;" />
  <p class="image_caption">
    A la fin du container, avec justify-content: flex-end;
  </p><br />
  <img src="<?php echo $GLOBALS['url']; ?>ressources/articles/guide-flexbox/space_between.png" alt="La propriété justify-content: center;" />
  <p class="image_caption">
    En maximisant les marges au centre, avec justify-content: space-between;
  </p><br />
  <img src="<?php echo $GLOBALS['url']; ?>ressources/articles/guide-flexbox/space_around.png" alt="La propriété justify-content: center;" />
  <p class="image_caption">
    En maximisant les marges sur les côtés, avec justify-content: space-around;
  </p><br />
  <img src="<?php echo $GLOBALS['url']; ?>ressources/articles/guide-flexbox/space_evenly.png" alt="La propriété justify-content: center;" />
  <p class="image_caption">
    En ayant des marges égales entre les bords et les éléments, avec justify-content: space-evenly;
  </p>
</div>

<h3>L'alignement vertical</h3>
<p>
  Flexbox permet également de gérer l'alignement vertical, grâce à la propriété '<b>align-items</b>'. Il devient enfin facile de centrer verticalement des éléments de tailles variables en CSS :
</p>
<div class="full_width">

  <img src="<?php echo $GLOBALS['url']; ?>ressources/articles/guide-flexbox/vertical_center.png" alt="La propriété justify-content: center;" />
  <p class="image_caption">
    'align-items: center' centre les éléments
  </p><br/>

  <img src="<?php echo $GLOBALS['url']; ?>ressources/articles/guide-flexbox/vertical_flex_start.png" alt="La propriété justify-content: center;" />
  <p class="image_caption">
    'align-items: flex-start' colle les éléments en haut du container
  </p><br/>

  <img src="<?php echo $GLOBALS['url']; ?>ressources/articles/guide-flexbox/vertical_flex_end.png" alt="La propriété justify-content: center;" />
  <p class="image_caption">
    'align-items: flex-end' colle les éléments en bas du container
  </p><br/>

  <img src="<?php echo $GLOBALS['url']; ?>ressources/articles/guide-flexbox/vertical_stretch.png" alt="La propriété justify-content: center;" />
  <p class="image_caption">
    'align-items: flex-stretch' aligne la hauteur des éléments sur la hauteur du plus grand élément
  </p><br/>

</div>

<h3>Les propriétés enfants</h3>
<p>
  Les enfants d'un container Flexbox peuvent également avoir des propriétés.
  <ul>
    <li>
      La propriété '<b>order</b>' qui permet de déterminer la position d'un élément dans la liste.
      <pre><code class="css">.child:nth-of-type(1) {
  order: 2;
}
.child:nth-of-type(2) {
  order: 0;
}
.child:nth-of-type(3) {
  order: 1;
}</code></pre>
<div class="full_width">
  <img src="<?php echo $GLOBALS['url']; ?>ressources/articles/guide-flexbox/order.png" alt="La propriété order" />
</div><br />
    </li>
    <li>
      La propriété '<b>align-self</b>', qui permet de modifier l'alignement vertical de l'élément en question de manière indivuelle.
    <pre><code class="css">#container {
  width: 100%;
  background-color: #adadad;
  padding: 10px;
  display: flex;
  justify-content: space-evenly;
  align-items: center;
}

.child:nth-of-type(2) {
  align-self: baseline;
}</code></pre>
<div class="full_width">
  <img src="<?php echo $GLOBALS['url']; ?>ressources/articles/guide-flexbox/align_self.png" alt="La propriété align-self" />
</div><br />
</li>
<li>
  Enfin, la propriété '<b>flex</b>', qui permet de définir les espaces que prend chaque élément. Cette propriété prend 3 paramètres, les deux derniers sont optionnels.
  Le premier paramètre, c'est la capacité de l'élément à remplir l'espace libre. Si elle est à zéro, alors l'élément minimise sa taille, sinon, elle occupera la fraction de l'espace indiqué. Ci-dessous un exemple pour mieux comprendre :
  <div class="full_width">
    <img src="<?php echo $GLOBALS['url']; ?>ressources/articles/guide-flexbox/flex_0.png" alt="Un container Flexbox avec ses éléments en flex: 0" />
    <p class="image_caption">
      Ici tous les enfants ont la propriété '<b>flex: 0</b>', ils prennent tous la largeur minimum
    </p><br />
    <img src="<?php echo $GLOBALS['url']; ?>ressources/articles/guide-flexbox/flex_1.png" alt="Un container Flexbox avec des éléments qui prennent différentes fraction de l'espace disponible" />
    <p class="image_caption">
      Les deux premiers éléments ont la propriété '<b>flex: 1</b>', le dernier a la propriété '<b>flex: 2</b>'. Le dernier élément prend donc autant d'espace que les deux premiers
    </p><br />
    <img src="<?php echo $GLOBALS['url']; ?>ressources/articles/guide-flexbox/flex_2.png" alt="Un container Flexbox avec des éléments qui prennent différentes fraction de l'espace disponible" />
    <p class="image_caption">
      Le premier élément a la propriété '<b>flex: 3</b>', les deux autres ont '<b>flex: 1</b>'. Le premier élément prend alors 2/3 de l'espace disponible et les deux derniers se partagent l'espace restant
    </p><br />
  </div>
  <p>
    La deuxième option, qui est optionnelle, définit la capacité de l'élément à <b>réduire sa taille</b>, avec la même logique que pour le premier paramètre. Le dernier correspond à la <b>taille minimale de l'élément</b>, qui peut être en px, em, % ou avoir la valeur auto.
  </p>
  <pre><code class="css">.child {
  /* L'élément n'occupe pas l'espace disponible, et peut réduire sa taille si un autre enfant a besoin de plus de place. Il ne peut pas être plus petit que sa valeur auto. */
  flex: 0 1 auto;
  /* L'élément occupe 2 fractions de l'espace disponible, ne peut pas se réduire et a comme taille minimale sa valeur auto. */
  flex: 2 0 auto;
  /* L'élément n'occupe pas l'espace disponible, peut réduire être réduit, mais ne peut pas avoir une largeure inférieure à 100px */
  flex: 0 1 100px;
}</code></pre>
</li>

  </ul>
</p>

<h3>La force de Flexbox</h3>
<p>
  La principale force de Flexbox, c'est de découper un layout complexe en lignes d'éléments simples à manipuler. Il facilite la gestion des espaces et des alignements, notamment verticaux.
  On peut s'amuser à découper des maquettes en différents containers Flexbox, comme avec ce blog :
</p>
<div class="full_width">
  <img src="<?php echo $GLOBALS['url']; ?>ressources/articles/guide-flexbox/blog_header.png" alt="Le header du blog découpé en layouts Flexbox" />
</div>
<p>
  Le header peut facilement être recréé grâce à deux containers Flexbox. Les deux sont orientés horizontalement. Le premier, celui qui structure le header maximise les marges au centre, donc il possède la propriété '<b>justify-content: space-between</b>'. Tous deux centrent leurs éléments verticalement, ils ont donc la propriété '<b>align-items: center</b>'.
</p>
<pre><code class="html">&lt;header&gt;
  &lt;h2&gt;Tom Marx&lt;/h2&gt;
  &lt;img src="..." alt="..." /&gt;
  &lt;div id="main_menu"&gt;
    &lt;a href="..."&gt;Blog&lt;/a&gt;
    &lt;a href="..."&gt;Mon CV&lt;/a&gt;
    &lt;a href="..."&gt;Contact&lt;/a&gt;
  &lt;/div&gt;
&lt;/header&gt;

&lt;style&gt;
  header {
    width: 100%;
    height: 200px;
    display: flex;
    flex-direction: row;
    justify-content: space-between;
    align-items: center;
  }
  #main_menu {
    width: auto;
    display: flex;
    flex-direction: row;
    align-items: center;
  }
&lt;/style&gt;</code></pre>
<div class="full_width">
  <img src="<?php echo $GLOBALS['url']; ?>ressources/articles/guide-flexbox/blog_body.png" alt="Un article du blog découpé en layouts Flexbox" />
</div>
<p>
  Pour le corps du site, on voit que la page est découpée en deux, avec l'article qui prend environ 2/3 de la largeur, l'aside environ 1/3.
  L'aside est une suite d'éléments alignés verticalement, on peut également utiliser Flexbox pour contrôler les marges et les espaces.
</p>
<pre><code class="html">&lt;div id="post_page"&gt;

  &lt;!-- Article, 2/3 de la largeur --&gt;
  &lt;div id="article"&gt;
    &lt;h1&gt;...&lt;/h1&gt;
    &lt;span class="post_infos"&gt;...&lt;/span&gt;
    &lt;div id="post_header"&gt;
      &lt;img src="..." alt="..." /&gt;
      &lt;ul class="summary"&gt;
        ...
      &lt;/ul&gt;
    &lt;/div&gt;
  &lt;/div&gt;

  &lt;!-- Aside, 1/3 de la largeur --&gt;
  &lt;aside&gt;
    &lt;div class="categories"&gt;
      ...
    &lt;/div&gt;
    &lt;div class="last_posts"&gt;
      ...
    &lt;/div&gt;
  &lt;/aside&gt;

&lt;/div&gt;

&lt;style&gt;
  #post_page {
    width: 100%;
    display: flex;
    flex-direction: row;
  }
  #article {
    flex: 3;
  }
  aside {
    flex: 1;
    display: flex;
    flex-direction: column;
  }
&lt;/style&gt;</code></pre>
<p>
  Flexbox permet de facilement construire vos pages web. De plus, avec les medias queries, il est facile de rendre vos pages responsives. On peut imaginer par exemple que sur mobile vous changiez simplement l'orientation du container pour aligner vos éléments verticalement.
  Ce module permet enfin de centrer verticalement des éléments de hauteur variable sans se prendre la tête.
</p>
