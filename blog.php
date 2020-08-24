<?php

class Post
{
    private $title;
    private $text_preview; // Text shown in post listings, 200 chars max
    private $link; // /blog/:link/
    private $tags = [];
    private $date; // DD/MM/YYYY
    private $time; // Time to read, minutes

    public function __construct($title, $text_preview, $link, $tags, $date, $time)
    {
        $this->title = $title;
        $this->text_preview = $text_preview;
        $this->link = $link;
        $this->tags = $tags;
        $this->date = $date;
        $this->time = $time;
    }

    public function get_image()
    {
      if (file_exists('content/images/' . $this->link . '.jpg'))
        return $GLOBALS['url'] . 'content/images/' . $this->link . '.jpg';
      return 'https://via.placeholder.com/1000x500';
    }

    public function get_preview_image()
    {
        if (file_exists('content/images/' . $this->link . '_preview.jpg'))
          return $GLOBALS['url'] . 'content/images/' . $this->link . '_preview.jpg';
        return 'https://via.placeholder.com/100x100';
    }

    public function get_content()
    {
        return 'ressources/articles/' . $this->link . '.php';
    }

    public function get_url()
    {
        return $GLOBALS['url'] . 'blog/' . $this->link . '/';
    }

    public function get_link()
    {
      return $this->link;
    }

    public function get_title()
    {
        return $this->title;
    }

    public function get_preview()
    {
        return substr($this->text_preview, 0, 200);
    }

    public function get_full_preview()
    {
        return $this->text_preview;
    }

    public function get_date()
    {
        return $this->date;
    }

    public function get_month_year()
    {
        $year = explode('/', $this->date)[2];
        $month = intval(explode('/', $this->date)[1]) - 1;
        return [$GLOBALS["months"][$month], $year];
    }

    public function get_tags()
    {
        return $this->tags;
    }

    public function get_timestamp()
    {
        return DateTime::createFromFormat('d/m/Y', $this->date)->getTimestamp();
    }

    public function is_tagged($tag)
    {
        return in_array($tag, $this->tags);
    }

    public function get_time_to_read()
    {
      return $this->time;
    }
}

class Blog
{
    private $posts = [];

    public function __construct()
    {
        $this->posts = [
        new Post('Introduction aux réseaux de neurones - Partie 1 : Théorie', 'Cet article vous permettera de comprendre comment un neurone artificiel fonctionne, et comment le machine learning permet de prédire des résultats en s\'appuyant sur des données d\'entrainement.', 'ia-partie-1', ['IA'], '10/10/2018', 15),
        new Post('Introduction aux réseaux de neurones - Partie 2 : Mise en pratique', 'Maintenant que vous comprenez le fonctionnement d\'un neurone, nous allons coder une classe python capable de résoudre des problèmes.', 'ia-partie-2', ['IA'], '13/10/2018', 15),
        new Post('Mon expérience avec un Hackintosh', 'Un Hackintosh, c\'est un PC qui fait tourner MacOS. Je vous explique pourquoi j\'ai fait ce choix et quelles contraintes cela apporte.', 'experience-hackintosh', ['Hackintosh'], '15/09/2018', 6),
        new Post('Simplifiez le design web avec Flexbox', 'Le CSS permet depuis quelques années d\'utiliser des layouts Flexbox, qui vous permettrons de concrétiser vos maquettes web très facilement.', 'guide-flexbox', ['Web'], '27/12/2018', 15),
        new Post('Générateur d\'art procédural', 'Pésentation d\'un petit projet réalisé en javascript avec p5.js, qui génère des dessins aléatoires.', 'art-procedural', ['Web'], '08/02/2019', 5),
        new Post('EmojiNN', 'Tensorflow.js permet de créer, d\'entrainer, et d\'utiliser un modèle de réseau de neurones directement depuis le navigateur.', 'emojis', ['IA', 'Web'], '13/02/2019', 5),
        new Post('Contrôler un instrument de musique avec votre webcam', 'Apprenez à créer un instrument de musique contrôlable avec les mouvements de votre corps.', 'webcam-musique', ['Web'], '05/03/2019', 15),
        new Post('Calculez PI avec la méthode de Monte Carlo', 'Calculer la valeur de PI à partir de nombres aléatoires, d\'un carré, et d\'un cercle.', 'pi', ['Web'], '16/03/2019', 10),
        new Post('Comment se préparer pour la piscine de 42 ?', 'Vous êtes inscrit à la piscine de 42 et vous souhaitez être prêt pour ce mois intense ? Je vous donne quelques conseils.', '42-piscine', ['42'], '31/07/2019', 10),
        new Post('Une IA qui comprend les visages', 'L\'IA peut apprendre grâce au machine learning, mais peut-elle comprendre ?', 'auto-encodeur-visages', ['IA', '42'], '20/08/2020', 20)
      ];
    }

    public function get_posts_by_tag($tag)
    {
        $res = [];
        foreach ($this->posts as $key => $post) {
            if ($post->is_tagged($tag)) {
                $res[] = $post;
            }
        }
        return $res;
    }

    public function get_last_posts()
    {
        $res = [];
        usort($this->posts, function ($a, $b) {
            return strcmp($b->get_timestamp(), $a->get_timestamp());
        });
        foreach ($this->posts as $post) {
            $res[] = $post;
        }
        return $res;
    }

    public function get_tags()
    {
        $res = [];
        foreach ($this->posts as $key => $post) {
            foreach ($post->get_tags() as $key => $tag) {
                if (!in_array($tag, $res)) {
                    $res[] = $tag;
                }
            }
        }
        return $res;
    }

    public function get_posts()
    {
        return $this->posts;
    }

    public function check_tag($tag)
    {
        foreach ($this->posts as $key => $post) {
          if ($post->is_tagged($tag)) {
            return true;
          }
        }
        return false;
    }

    public function check_link($link)
    {
      foreach ($this->posts as $key => $post) {
        if ($post->get_link() == $link) {
          return true;
        }
      }
      return false;
    }

    public function get_pinned_post()
    {
      return $this->posts[0];
    }

    public function get_post_by_link($link)
    {
      foreach ($this->posts as $key => $p) {
        if ($p->get_link() == $link) {
          return $p;
        }
      }
      return $p;
    }
}
