<?php
class Service
{

	// Méthode qui vérifie si l'utilisateur est connécté.
	public static function checkIfUserIsConnected()
	{
		//On définie $userConnected = false;
		$user_is_connected = FALSE;
		$userRepository = new UserRepository();

		//On va vérifie si l'utilisateur est connecté.
		if (
			isset($_SESSION["user_is_connected"], $_SESSION["user_id"])
			&& !empty($_SESSION["user_is_connected"])
			&& !empty($_SESSION["user_id"])
			&& !empty($userRepository->find($_SESSION["user_id"]))
		) {
			//Ici l'utilisateur est connecté.
			$user_is_connected = TRUE;
		}
		return $user_is_connected;
	}
	//Méthode qui permet de déplacer le fichier upload du dossier tmp à son dossier finale.
	public static function moveFile(array $file): ?string
	{
		$filePath = null;
		$folder = dirname(__DIR__, 2) . "/public/img/upload/";
		if (!file_exists($folder)) {
			mkdir($folder, 0777);
		}
		$filename = self::renameFile($file["name"]);
		//move_uploaded_file() — Déplace un fichier téléchargé
		if (move_uploaded_file($file["tmp_name"], $folder . $filename)) {
			$filePath = "/img/upload/" . $filename;
		}
		return $filePath;
	}

	//Méthode qui vérifie si la categorie existe et renvoie un array contenant les categories existants.
	public static function checkCategoriesExist(array $categoriesSearch)
	{
		$categories = [];
		$categoryRepository = new CategoryRepository();
		foreach ($categoriesSearch as $key => $category) {
			$categories[] = $categoryRepository->find($category);
		}
		return $categories;
	}

	//Méthode qui renomme le fichier selon un new DateTime("now"))->format("Ymdhis") et l'extention de fichier (.png).

	private static function renameFile(string $filename): string
	{
		$filename_array = explode(".", $filename);
		return (new DateTime("NOW"))->format("YmdHis") . "." . end($filename_array);
	}
}