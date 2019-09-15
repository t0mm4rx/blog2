<p>Maintenant que j'utilise mon Hackintosh comme station de travail depuis plus de deux ans, je peux vous donner mes bonnes raisons de passer à un Hackintosh. Je n'oublirai pas les contraintes que cela apporte et à qui cette expérience s'adresse.</p>
<h3>Qu'est-ce qu'un Hackintosh ?</h3>
<p>
  Un Hackintosh, c'est un PC qui fait tourner MacOS. Apple n'aime pas trop avoir ses logiciels installés sur une grande variété de materiels. L'OS n'est donc pas fait pour être installé sur une machine autre que Apple. Il faut <b>modifier le système</b> pour qu'il soit compatible avec notre materiel.<br />
  Une véritable <b>communautée</b> s'est formée autour de la modification de l'OS d'Apple, comme les forums Tonymacx86, le site Hackintosher ou encore le subreddit /r/hackintosh. Vous pourrez y trouver tutoriaux, logiciels, configurations...<br />
  Vous l'imaginer, le "hack" est assez contraignant, d'autant plus que chaque configuration matérielle est différentes. Il faut passer des heures à chercher sur Internet des solutions à des erreurs propres à votre système. Mais c'est aussi cela qui passionne : le bidouillage.
</p>
<h3>Les raisons qui m'ont poussées à passer sur MacOS</h3>
<p>
  De nombreuses raisons m'ont poussé à passer à MacOS.<br />
</p>
<p>
  Tout d'abord par contrainte, car pour publier une appli sur l'App Store, obligé de paser par Xcode qui n'est disponible que sur l'OS d'Apple.<br />
  MacOS est basé sur <b>le noyeau Unix</b>, ce qui apporte beaucoup d'avantages, surtout pour les développeurs. Une seule ligne de commande vous permet d'installer un logiciel, Git est prêt à l'emploi, vous pouvez compiler du code source facilement...<br />
  Le <b>design et l'ergonomie</b> peuvent être insignifiant pour beaucoup, mais j'aime bien travailler sur un environement "propre".<br />
  Certains logiciels ne sont disponibles que sur MacOS, comme Sketch, qui sert à réaliser des maquettes de sites et d'applications.<br />
  Si vous faite déjà parti de l'écosystème Apple, vous pouvez controller vos différents appareils.<br />
  Enfin, le nombre de virus visant MacOS est bien moindre. Contrairement aux légendes urbaines, MacOS n'est pas plus sécurisé que Windows, il y a simplement moins d'utilisateurs, donc moins de cibles potentielles.
</p>
<p>
  Windows a aussi de quoi faire fuir : ses mises à jour de force, qui de plus peuvent faire planter votre configuration.<br />
  Globalement mon expérience de Windows est assez mauvaise, j'ai souvent eu des petits bugs, comme le menu Windows qui ne s'ouvre plus, la recherche de fichiers qui ne fonctionne pas ou encore des logiciels qui crashent quand on les lance.
</p>
<p>
  Windows a encore de l'avance sur certains domaines. <b>Impossible pour un gamer de passer sur MacOS</b>, les jeux y sont rares et mals optimisés.
  Même si cette tendance change, les ressources de <b>MAO</b>, musique assistée par ordinateur, sont plus nombreuses sur le système de Microsoft.
  Apple peut également être agaçant en vous intégrant de force dans son écosystème, même si ce phénomène est moins important que sur iOS par exemple.
</p>

<h3>Pourquoi un hackintosh ?</h3>
<p>
  Pourquoi choisir de se compliquer la tâche à installer un système d'exploitation sur une machine pas forcemment compatible, acheter un iMac ne serait pas plus simple ?
  Principalement pour le prix.<br />
  Ci-dessous ma configuration, et la configuration d'iMac la plus proche que j'ai trouvé :
</p>
<div class="full_width">
  <table cellspacing="0" cellpadding="0">
    <tr class="table_header">
      <th>
        Composant
      </th>
      <th>
        Modèle
      </th>
      <th>
        Prix
      </th>
    </tr>
    <tr>
      <td>
        Ecran 27 pouces
      </td>
      <td>
        Viseo 273D
      </td>
      <td>
        130€
      </td>
    </tr>
    <tr>
      <td>
        Ecran 22 pouces
      </td>
      <td>
        Samsung S22D300
      </td>
      <td>
        110€
      </td>
    </tr>
    <tr>
      <td>
        Processeur
      </td>
      <td>
        i5 6600
      </td>
      <td>
        260€
      </td>
    </tr>
    <tr>
      <td>
        RAM
      </td>
      <td>
        2 * 8Go G.Skill
      </td>
      <td>
        135€
      </td>
    </tr>
    <tr>
      <td>
        Carte graphique
      </td>
      <td>
        GTX 1060
      </td>
      <td>
        225€
      </td>
    </tr>
    <tr>
      <td>
        SSD
      </td>
      <td>
        Crucial MX500
      </td>
      <td>
        100€
      </td>
    </tr>
    <tr>
      <td>
        Autres (Carte mère, alim, ...)
      </td>
      <td></td>
      <td>
        260€
      </td>
    </tr>
    <tr>
      <td></td>
      <td>
        <b>Total</b>
      </td>
      <td>
        <b>1220€</b>
      </td>
    </tr>
  </table>
</div>
<br />
<div class="full_width">
  <img src="<?php echo $GLOBALS['url']; ?>ressources/articles/experience-hackintosh/imac.png" alt="Prix iMac 27 pouces avec une configuration semblable"/>
</div>
<p>
  <b>Il y a plus de 1000€ de différence</b> pour des composants similaires, une meilleur carte graphique, un disque dur en plus, mais deux écrans Full HD au lieu d'un écran 4k. Il est donc beaucoup plus intéressant financièrement de monter un Hackintosh.
</p>
<p>
  Un autre gros avantage est la personnalisation, vous pouvez monter un PC qui correspond à vos besoins.<br />
  De plus, vous pourrez le faire évoluer en fonction de vos besoins ou de pannes, ce qui est très compliqué et onéreux avec un iMac.
</p>

<h3>La stabilité</h3>
<p>
  La principale crainte lorque l'on souhaite passer à un Hackintosh, c'est la stabilité. Un ordinateur pour travailler au quotidien doit être très fiable.<br />
  Dans mon cas, la machine ne présente aucun défault, ou presque :
</p>
  <ul>
    <li>
      Quand j'éteint le PC, il redémarre. Je suis donc obligé d'attendre qu'il s'éteigne, et de rappuyer sur le bouton extinction. Il est possible de corriger ce problème, mais je n'en ai pas la motivation.
    </li>
    <li>
      Quand j'utilise trop la RAM, il plante. Cela arrive une fois tous les 3-4 jours en moyenne. Ce bug est aussi présent sur Windows, mais a une fréquence plus élevée. Je ne sais pas si c'est lié au hack.
    </li>
  </ul>
<p>
    Autrement, aucun problème, j'ai l'impression d'être sur un iMac normal. En fait, la stabilité dépend grandement de votre materiel. Plus il sera proche de celui d'un Mac classique, plus il sera facile d'installer MacOS et la machine sera stable. Il est tout à fait possible d'<b>avoir un Hackintosh pour travailler au quotidien</b>, si vous avez des composants adéquats.
</p>
<h3>Les contraintes</h3>
<p>
  Avoir un Hackintosh, ce sont aussi des contraintes.
</p>
<p>
  L'installation, peut être compliquée, surtout la première fois. Il faut trouver les bons "kexts", l'équivalent des drivers sur MacOS. On peut facilement être perdu dans la masse d'information sur Internet.
</p>
<p>
  Une fois l'installation effectuée, il est dur de refaire des modifications. Une fois que le système fonctionne, on a peur de tout casser en résolvant un petit bug. Le plus gros point noir, ce sont <b>les mises à jour</b>. Elles sont assez contraignantes, il faut refaire une partie du processus d'installation, et attendre que tous les drivers soit disponibles. À l'heure ou j'écris cet article, MacOS 10.14 est sorti depuis un mois, mais NVIDIA n'a toujours pas sorti les drivers pour ma carte graphique. Résultat, je suis bloqué sur une version précédente.
</p>
<p>
  Enfin, cette manipulation est théoriquement illégale. Apple interdit dans ses conditions d'utilisation l'utilisation de leur logiciel sur une machine non vendue par Apple. Cependant, ils ne font absolument rien pour empêcher les Hackintosh. Il leur serait facile de bloquer complètement l'installation sur un materiel inconnu, comme ils avaient fait pour les vitres d'iPhone non officielles. Je pense que cela leur apporte de potentiels clients et fait vivre leur système, donc ils laissent faire.
</p>

<h3>Conclusion</h3>
<p>
  Un Hackintosh est parfait si vous avez besoin ou envie de travailler sur MacOS, <b>et que vous êtes bidouilleur</b>. Il est possible d'avoir un Hackintosh puissant et stable, mais cela nécessite de choisir ses composants minutieusement. L'installation est contraignante, tout comme les mises à jour.<br />
  Vous êtes allergique aux lignes de commandes ou voulez être réactif aux mises à jour ? Passez votre chemin.
</p>
