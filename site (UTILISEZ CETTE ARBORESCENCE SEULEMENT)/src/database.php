<?php

/**//**//**//**//**//**//**//**//**//**//**//**//**//**//**//**//**//**//**//**//**//**//**//**//**/
/***************************************************************************************************
*  *  *   * Auteurs: Harun | Théo | Yann | Leonar                         *   *  *  *   *  *  *  * *
*  *  *   * Date: 06.12.2023 // ETML - Lausanne - Sébeillon               *   *  *  *   *  *  *  * *
*  *  *   * Description : Classe de DB pour gérer les opérations liées à la base de données. * * * *
***************************************************************************************************/
/**//**//**//**//**//**//**//**//**//**//**//**//**//**//**//**//**//**//**//**//**//**//**//**//**/

class Database {
    
    // Variable de classe
    private $connector;

    public function __construct(){
        // Se connecter via PDO
        try 
        {
            $this->connector = new PDO('mysql:host=localhost:3306;dbname=db_readersRealm;charset=utf8','root','root');
            echo "db connecté";
        } 
        catch (PDOException $e) 
        {
                die('Erreur : ' . $e->getMessage());
        }
    }

    private function queryPrepareExecute($query, $binds){
        $req = $this->connector->prepare($query);
        foreach ($binds as $key => $value) {
            $req->bindValue(':'.$key, $value); // Assurez-vous que le type de données est correct pour chaque bind
        }
        $req->execute();
        return $req;
    }

    private function queryPrepareExecuteIndexed($query, $binds){
 
        $req = $this->connector->prepare($query);
        foreach($binds as $bind) {
            $req->bindValue($bind[0], $bind[1], PDO::PARAM_STR);
        }    
        $req->execute();
        return $req;
    }

    private function querySimpleExecute($query){
        // Fait la requête en utilisant query
        return $this->connector->query($query);
    }

    private function formatData($req){
        return $req->fetchALL(PDO::FETCH_ASSOC);
    
    }

    private function unsetData($req){
        // Vider le jeu d'enregistrements
        $req->closeCursor();
    }

    public function addUser($userData) {
    $hashedPassword = password_hash($userData['usePassword'], PASSWORD_DEFAULT); // Hashage du mot de passe

    $query = "INSERT INTO t_user (useUsername, usePassword, useRegistrationDate, useNbrProposedBook, useNbrLike, useIsAdmin) 
            VALUES (:useUsername, :usePassword, :useRegistrationDate, :useNbrProposedBook, :useNbrLike, :useIsAdmin)";

    $binds = [
        ['useUsername', $userData['useUsername'], PDO::PARAM_STR],
        ['usePassword', $hashedPassword, PDO::PARAM_STR], // Assurez-vous que c'est le mot de passe hashé
        ['useRegistrationDate', date('Y-m-d'), PDO::PARAM_STR],
        ['useNbrProposedBook', $userData['useNbrProposedBook'] ?? 0, PDO::PARAM_INT], 
        ['useNbrLike', $userData['useNbrLike'] ?? 0, PDO::PARAM_INT], 
        ['useIsAdmin', $userData['useIsAdmin'] ?? 0, PDO::PARAM_INT]
    ];

    $this->queryPrepareExecuteIndexed($query, $binds);
    return; 
    }

    public function loginUser($username, $password) {
        $query = "SELECT * FROM t_user WHERE useUsername = :username";
    
        try {
            $req = $this->connector->prepare($query);
            $req->bindValue(':username', $username, PDO::PARAM_STR);
            $req->execute();
    
            $user = $req->fetch(PDO::FETCH_ASSOC);
    
            // Ajout du débogage
            var_dump($user);
            echo "Résultat de la vérification du mot de passe : " . (password_verify($password, $user['usePassword']) ? 'true' : 'false') . "<br/>";
    
            if ($user && password_verify($password, $user['usePassword'])) {
                return $user; // Retournez les informations de l'utilisateur
            }
    
            return false; // Échec de la connexion
        } catch (PDOException $e) {
            // Gestion des exceptions
            echo 'Erreur de connexion: ' . $e->getMessage();
            return false;
        }
    }

    public function deleteUser($userId) {
        $query = "DELETE FROM t_user WHERE user_id = :userId";
    
        try {
            $stmt = $this->connector->prepare($query);
            $stmt->bindParam(':userId', $userId, PDO::PARAM_INT);
            $stmt->execute();
        } catch (PDOException $e) {
            throw new Exception("Erreur lors de la suppression du compte : " . $e->getMessage());
        }
    }
    
    public function addBook($data){
        $query = "INSERT INTO t_book (category_fk, booWriter, user_fk, booTitle, booExemplary, booResumeBook, booEditionDate, booNbrPage, booEditorName, booLikeRatio, booCoverImage) 
                  VALUES (:category_fk, :booWriter, :user_fk, :booTitle, :booExemplary, :booResumeBook, :booEditionDate, :booNbrPage, :booEditorName, :booLikeRatio, :booCoverImage)";
    
        $binds = [
            'category_fk' => $data['category_fk'],
            'booWriter' => $data['booWriter'],
            'user_fk' => $data['user_fk'],
            'booTitle' => $data['booTitle'],
            'booExemplary' => $data['booExemplary'],
            'booResumeBook' => $data['booResumeBook'],
            'booNbrPage' => $data['booNbrPage'],
            'booEditorName' => $data['booEditorName'],
            'booLikeRatio' => $data['booLikeRatio'],
            'booCoverImage' => $data['booCoverImage'],
            'booEditionDate' => $_POST['releaseDate'], 
        ];
    
        try {
            $this->queryPrepareExecute($query, $binds);
            echo 'Livre ajouté avec succès à la base de données.';
            // Vous pouvez également retourner un message ou une valeur selon vos besoins.
        } catch (Exception $e) {
            // Gérer l'exception
            die('Erreur lors de l\'ajout du livre : ' . $e->getMessage());
        }
    }

    public function incrementUserNbrProposedBooks($user_id) {
        $query = "UPDATE t_user SET UseNbrProposedBook = UseNbrProposedBook + 1 WHERE user_id = :user_id";
        
        try {
            $stmt = $this->connector->prepare($query);
            $stmt->bindParam(':user_id', $user_id, PDO::PARAM_INT);
            $stmt->execute();
            
            // Récupérez la nouvelle valeur du nombre d'ouvrages proposés après la mise à jour
            $newCount = $this->getUserNbrProposedBooks($user_id);
            
            return $newCount; // Retourne la nouvelle valeur du nombre d'ouvrages proposés
        } catch (PDOException $e) {
            throw new Exception("Erreur lors de la mise à jour du nombre de livres proposés par l'utilisateur : " . $e->getMessage());
        }
    }

    public function getUserNbrProposedBooks($user_id) {
        $query = "SELECT UseNbrProposedBook FROM t_user WHERE user_id = :user_id";
        
        try {
            $stmt = $this->connector->prepare($query);
            $stmt->bindParam(':user_id', $user_id, PDO::PARAM_INT);
            $stmt->execute();
            $result = $stmt->fetch(PDO::FETCH_ASSOC);
            if ($result) {
                return $result['UseNbrProposedBook'];
            } else {
                return 0; // Retourne 0 si l'utilisateur n'est pas trouvé
            }
        } catch (PDOException $e) {
            throw new Exception("Erreur lors de la récupération du nombre d'ouvrages proposés par l'utilisateur : " . $e->getMessage());
        }
    }

/*
    // Méthode pour récupérer tous les livres d'une catégorie spécifique
    }
    */

    public function getBooksByCategory($categoryId) {
        $query = "SELECT booTitle, booResumeBook FROM t_book WHERE category_fk = :categoryId";
        $stmt = $this->connector->prepare($query);
        $stmt->bindValue(':categoryId', $categoryId, PDO::PARAM_INT);
        $stmt->execute();
        
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
    

/*
    // Méthode pour récupérer le nom de la catégory grâce à l'id 
    }
    */

    public function getCategoryName($categoryId) {
        $query = "SELECT catCategory FROM t_category WHERE category_id = :categoryId";
        $stmt = $this->connector->prepare($query);
        $stmt->bindValue(':categoryId', $categoryId, PDO::PARAM_INT);
        $stmt->execute();
        
        $result = $stmt->fetch(PDO::FETCH_ASSOC);
        return $result ? $result['catCategory'] : null;
    }
    
/*
    // Méthode pour supprimer un livre. Méthode faite avec un prepare pour éviter les injections sql.
    public function deleteTeacher($book_id){
        $req = $this->connector->prepare("DELETE FROM t_book WHERE book_id = :book_id");
        $req->bindValue(':idTeacher', $book_id, PDO::PARAM_STR);
        $req->execute();
    }
    */
    public function addWriter($data){

        $query = "INSERT INTO t_writer (wriFirstname, wriLastname) 
        VALUES (:wriFirstname,wriLastname)";

        $binds = [   
            ['wriFirstname', $data['wriFirstname']],
            ['wriLastname', $data['wriLastname']], 
        ];
        $req = $this->queryPrepareExecute($query, $binds);
    }

    public function getAllBooks() {

        $query = "SELECT book_id, booTitle, booExemplary, booResumeBook, booNbrPage, booEditorName, booEditionBook, 
        booLikeRatio, booCoverImage, wriFirstname, wriLastname, catCategory,useUsername, ratRate

        FROM t_book AS B JOIN t_user AS U ON B.user_fk = U.user_id
        JOIN t_writer AS W ON B.booWriter = W.writer_id09
        JOIN t_category AS C ON B.category_fk = C.category_id
        JOIN t_rate AS R ON R.book_fk = B.book_id;
        ";
    
        // Fait la requête en utilisant query
        $req = $this->querySimpleExecute($query);

        // Traitement, transformer le résultat en tableau associatif
        return $this->formatData($req);
    }

    public function getOneBook($id) {
        return $this->formatData($this->querySimpleExecute("SELECT book_id, booTitle, booExemplary, booResumeBook, booNbrPage, booEditorName, booEditionBook, 
        booLikeRatio, booCoverImage, wriFirstname, wriLastname, catCategory,useUsername, ratRate

        FROM t_book AS B JOIN t_user AS U ON B.user_fk = U.user_id
        JOIN t_writer AS W ON B.booWriter = W.writer_id09
        JOIN t_category AS C ON B.category_fk = C.category_id
        JOIN t_rate AS R ON R.book_fk = B.book_id;"));          
    }

    public function getAllCategories()
    {
        // avoir la requête sql pour récupérer toutes les sections
        $query = "SELECT * FROM t_category;";
       
        // appeler la méthode pour exécuter la requête
        $req = $this->querySimpleExecute($query);
 
        // appeler la méthode pour avoir le résultat sous forme de tableau
        $categories = $this->formatData($req);
 
        // retourne toutes les sections
        return $categories;
    }

    public function getLastAddedBooks($limit = 5)
    {
        // avoir la requête sql pour récupérer toutes les sections
        $query = "SELECT * FROM t_book ORDER BY book_id DESC LIMIT 5";
       
        // appeler la méthode pour exécuter la requête
        $req = $this->querySimpleExecute($query);
 
        // appeler la méthode pour avoir le résultat sous forme de tableau
        $lastAddedBooks = $this->formatData($req);
 
        // retourne toutes les sections
        return $lastAddedBooks;
    }
}