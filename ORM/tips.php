$genres = Genre::getAll();


// exemple d'utilsiation de l'hydratation
$genre = new Genre;
$genre->id_genre = 4;
$genre->hydrate(); // recueprer tout les valeurs manquantes en BDD

$film = new Film;
$film->id_genre = 2555;
$film->hydrate(); // recueprer tout les valeurs manquantes en BDD
// ici tout les champs de l'instance de films doivent etre renseigné


// pour recup une instance hydratée du fim avec l'id 2555
$film = Film::getOne(2555);

// pour toutes les instance de films hydratés
$film = Film::getAll();



// ex hydratation basique : 
$film = Film::getOne(2555);
$genre = Genre::getOne($film->id_genre);
echo $genre->nom;
// ex : hydration avancée (avec le R de ORM)
// on fait direct
$film = Film::getOne(2555);
$film->genre->nom;



// sur un blog
$user->posts; // si cet valeur contient tous les posts d'un user

foreach ($user->posts as $post) // pacourir tous ses posts
{
	foreach ($post->comments as $comment) // pour chaque post on pacours ses commentaire
	{
		echo $comment->content;  // afficher le content du commentaire
		echo 'ecrit par '.$comment->author->name; // affiche le nom du user auteur du commentaire
	}
}


