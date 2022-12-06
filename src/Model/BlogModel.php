<?php

namespace App\Model;

use App\Entity\Blog;
use App\Entity\User;
use App\Entity\Commentaire;

use DateTime;

class BlogModel extends Model
{
    public static function hydrateBlog(array $blogArray, $withJoins = true): Blog
    {
        $blog = new Blog();
        if ($blogArray['blogId'] !== null) {
            $blog->setId($blogArray['blogId']);
        } else {
            $blog->setId(null);
        }
        $blog->setTitre(isset($blogArray['blogTitre']) ? $blogArray['blogTitre'] : null);
        $blog->setChapo(isset($blogArray['blogChapo']) ? $blogArray['blogChapo'] : null);
        $blog->setTexte(isset($blogArray['blogTexte']) ? $blogArray['blogTexte'] : null);
        $blog->setCreatedAt(new \datetime(isset($blogArray['blogCreatedAt']) ? $blogArray['blogCreatedAt'] : null));
        $blog->setUpdateAt(new \datetime(isset($blogArray['blogUpdateAt']) ? $blogArray['blogUpdateAt'] : null));
        if (isset($blogArray['commentaireId']) && $withJoins) {
            //Left join
            CommentaireModel::hydrateCommentaire($blogArray);
        }
        if (isset($blogArray['userId']) && $withJoins) {
            //Left join
            $user = UserModel::hydrateUser($blogArray);
            $blog->setUser($user);
        }
        return $blog;
    }

    public function GetViewBlogs()
    {
        try {
            $sth = $this->connexion->prepare(
                "SELECT id as blogId,
                titre as blogTitre,
                chapo as blogChapo,
                texte as blogTexte,
                created_at as blogCreatedAt,
                update_at as blogUpdateAt
                FROM blog"
            );
            $sth->execute();

            $blogs = [];
            foreach ($sth->fetchAll() as $blogArray) {
                $blogs[] = self::hydrateBlog($blogArray);
            }
            return $blogs;
        } catch (\Exception $e) {
            die('Erreur:' . $e->getMessage());
        }
    }
    public function GetModalBlogs($id)
    {
        try {
            $sth = $this->connexion->prepare(
                "SELECT b.id as blogId,
                b.titre as blogTitre,
                b.texte as blogTexte,
                b.chapo as blogChapo,
                b.created_at as blogCreatedAt,
                b.update_at as blogUpdateAt,
                u.id as userId,
                u.is_admin as isAdmin,
                u.nom  as userNom,
                u.prenom as userPrenom,
                u.email as userEmail,
                u.password as userPassword,
                u.is_actif as userIsActif,
                u.created_at as userCreatdAt,
                u.update_at as userUpdateAt
                FROM blog b
                LEFT JOIN users u ON u.id = b.users_id
                where b.id = :id"
            );
            $sth->execute(['id' => $id]);
            $blogs = [];
            foreach ($sth->fetchAll() as $blogArray) {
                $blogs[] = $this->hydrateBlog($blogArray);
            }
            return $blogs;
        } catch (\Exception $e) {
            die('Erreur:' . $e->getMessage());
        }
    }

    //adminController
    public function GetBlogupdateId(int $id): Blog
    {
        try {
            $sth = $this->connexion->prepare(
                "SELECT b.id as blogId,
                b.titre as blogTitre,
                b.texte as blogTexte,
                b.chapo as blogChapo,
                b.created_at as blogCreatedAt,
                b.update_at as blogUpdateAt
                FROM blog b
                where b.id = :id"
            );
            $sth->execute(['id' => $id]);
            return $this->hydrateBlog($sth->fetch());
        } catch (\Exception $e) {
            die('Erreur:' . $e->getMessage());
        }
    }

    public function AddBlogsNew($params)
    {
        $newDate = new \DateTime();
        $date = $newDate->format('Y-m-d H:i:s');
        $titre =$params['titre'] ;
        $chapo =$params['chapo'] ;
        $texte =$params['texte'] ;
        $users_id = $params['userId'];

        try {
            $sth = $this->connexion->prepare(
                "INSERT INTO `blog`
                 (`titre`, `texte`, `chapo`, `created_at`, `update_at`, `users_id`) 
                 VALUES
                 (:titre, :texte, :chapo,:created_at, :update_at ,:users_id)"
            );
            $sth->execute(['titre' => $titre , 'texte' => $texte , 'created_at' => $date ,'update_at' => $date ,'chapo' => $chapo ,'users_id' => $users_id]);
        } catch (\Exception $e) {
            die('Erreur:' . $e->getMessage());
        }
    }

    public function GetBlogupdate()
    {
        try {
            $sth = $this->connexion->prepare(
                "SELECT b.id as blogId,
                b.titre as blogTitre,
                b.texte as blogTexte,
                b.chapo as blogChapo,
                b.created_at as blogCreatedAt,
                b.update_at as blogUpdateAt
                FROM blog b"
            );
            $sth->execute();
            $blogs = [];
            foreach ($sth->fetchAll() as $blogArray) {
                $blogs[] = $this->hydrateBlog($blogArray);
            }
            return $blogs;
        } catch (\Exception $e) {
            die('Erreur:' . $e->getMessage());
        }
    }

    public function NewUpdateBlogs($params): void
    {
        $titre =$params['titre'] ;
        $chapo =$params['chapo'] ;
        $texte =$params['texte'] ;
        $id =$params['blogId'] ;
        try {
            $sth = $this->connexion->prepare(
                "UPDATE `blog` SET
                 `titre` = :titre,
                 `chapo` = :chapo,
                 `texte` = :texte
                 WHERE `id` = :id"
            );
            $sth->execute(['titre' => $titre , 'texte' => $texte ,'chapo' => $chapo,'id' => $id]);
        } catch (\Exception $e) {
            die('Erreur:' . $e->getMessage());
        }
    }

    public function DeleteBlogs($id)
    {
        try {
            $sth = $this->connexion->prepare(
                "DELETE FROM `blog` WHERE (`id` = :id)"
            );
            $sth->execute(['id' => $id]);
        } catch (\Exception $e) {
            die('Erreur:' . $e->getMessage());
        }
    }
}
