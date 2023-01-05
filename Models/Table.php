<?php

// minilib MySQL
function my_query($query)
{
	global $link;
	mysqli_report(MYSQLI_REPORT_OFF);

	if (empty($link))
		$link = @mysqli_connect('localhost', 'root', 'lucas31', 'ecv_orm_project');

	if (!$link)
		die("Failed to connect to MySQL: " . mysqli_connect_error());

	$result = @mysqli_query($link, $query);
	if (!$result)
		die("Failed to execute MySQL query: " . mysqli_error($link));

	return $result;
}

function my_fetch_array($query)
{
	$result = my_query($query);
	$data = [];

	while ($line = mysqli_fetch_array($result))
		$data[] = $line;

	return $data;
}

function my_insert_id()
{
	global $link;
	$pk_val = mysqli_insert_id($link);
	return $pk_val;
}


// classe generique Table
class Table
{
	public static $primary_key_field_name;
	public static $table_name;
	public static $fields_names;

	public function __construct(string $table_name, string $primary_key_field_name, array $fields_names)
	{
		// self::$table_name = $table_name;
		// $this->primary_key_field_name = $primary_key_field_name;
		// $this->fields_names = $fields_names;
	}

	public function save() 
	{
		$query = '';
		// si $this->id_film est set alors on genere une requete UPDATE
		if (isset($this->{static::$primary_key_field_name}))
		{
			$query .= 'UPDATE '.static::$table_name.' SET ';

			$first = true;
			foreach (static::$fields_names as $field)
			{
				if ($first)
					$first = false;
				else
					$query .= ', ';
				$query .= $field.' = \''.$this->{$field}.'\'';
			}
			$query .= ' WHERE id_film = '.$this->{static::$primary_key_field_name};
			// echo $query.'<br>';
			$res = my_query($query);
		}
		else // sinon on genere une requete INSERT et on recupere l'id auto-incrémenté
		{
			$query .= 	"INSERT INTO ".static::$table_name." (";
			$first = true;
			foreach (static::$fields_names as $field)
			{
				if ($first)
					$first = false;
				else
					$query .= ', ';
				$query .= $field;
			}
			$query .= ") VALUES (";
			$first = true;
			foreach (static::$fields_names as $field)
			{
				if ($first)
					$first = false;
				else
					$query .= ', ';
				$query .= '\''.$this->{$field}.'\'';
			}

			$query .= ")";
						
			// echo $query.'<br>';
			$res = my_query($query);
			$pk_val = my_insert_id();
			$this->{static::$primary_key_field_name} = $pk_val;
		}
	}

	// renvoie un tableau d'objets avec une instance hydratée pour chaque ligne de la table
	public static function getAll()
	{
		$sInstance = static::class;
		$query = 'SELECT * FROM '.static::$table_name.' ORDER BY created_at DESC';
		$data = my_fetch_array($query);
		$objects = [];
		foreach ($data as $line)
		{
			$oInstance = new $sInstance();
			$oInstance->id = $line[static::$primary_key_field_name];
			foreach (static::$fields_names as $field)
			{
				$oInstance->$field = $line[$field];
			}
			$objects[] = $oInstance;
		}
		return $objects;
	}

	// renvoie une instance hydratée pour la ligne de la table correspondant a la PK fournie en parametre
	public static function getOne(int $pk_value)
	{
		$sInstance = static::class;
		$oInstance = new $sInstance();
		$oInstance->{static::$primary_key_field_name} = $pk_value;
		$oInstance->hydrate();
		return $oInstance;
	}

	// récupère dans l'instance courante toutes les valeurs correspondantes à la ligne
	// dont la valeur de la pk est deja présente dans l'instance dans
	// l'attribut $this->{$this->primary_key_field_name}

	// hydrate level 2
	// ex : pour film, ajouter un attribut genre contenant une instance hydratée de sont genre
	// ET ajouter un attribut distributeur contenant une instance hydratée de sont genrdistributeur

	public function hydrate()
	{
        $sSQL = 'SELECT * FROM '.static::$table_name.' WHERE '.static::$primary_key_field_name.'='.$this->{static::$primary_key_field_name};
        $tData = my_fetch_array($sSQL);

        foreach (static::$fields_names as $field) {
            $this->{$field} = $tData[0][$field];
        }
	}

}