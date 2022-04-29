<?php

namespace Njecky\Felix;

/**
 * Comments
 */
class Comments{
    private $pdo;	
	/**
	 * options
	 *
	 * @var array
	 */
	private $options = array(
        'username_error' => "Vous n'avez pas entré de pseudo",
        'email_error' => "Votre email n'est pas valide",
        'content_error' => "Vous n'avez pas mis de message",
        'parent_error' => "Vous essasez de répondre à un commentaire qui n'éxiste pas"
    );    
    /**
     * errors
     *
     * @var array
     */
    public $errors = array();
	public function __construct($pdo) {
        $this->pdo = $pdo;
    }
      
    /**
     * Permet de récupérer les commentaires associé à un contenu
     *
     * @param  mixed $ref
     * @param  mixed $ref_id
     * @return void
     */
    public function findAll($ref, $ref_id){
        $q = $this->pdo->prepare("SELECT * FROM comments WHERE ref_id =:ref_id AND ref=:ref ORDER BY created DESC");
        $q->execute(['ref'=> $ref, 'ref_id'=>$ref_id]);
        $comments = $q->fetchAll();
        $replies = [];
        foreach ($comments as $k => $comment) {
            if ($comment->parent_id) {
                $replies[$comment->parent_id][] = $comment;
                unset($comments[$k]);
            }
        }
        foreach ($comments as $k => $comment) {
            if (isset($replies[$comment->id])) {
                $r = $replies[$comment->id];
                usort($r, [$this,'sortReplies']);
                $comments[$k]->replies = $r;
            }else{
                $comments[$k]->replies = [];
            }
        }
        return $comments;
    }
      
    /**
     * Permet de classer les commentaire du plus ancien au plus récent
     *
     * @param  mixed $a
     * @param  mixed $b
     * @return void
     */
    public function sortReplies($a, $b){
        $atime = strtolower($a->created);
        $btime = strtolower($b->created);
        return $btime > $atime ? -1 : 1;
    }
    /**
     * Permet de sauvegarder un commentaire
     *
     * @param  mixed $ref
     * @param  mixed $ref_id
     * @return void
     */
    public function save($ref, $ref_id) {
        $errors = [];
        if (empty($_POST['username'])) {
            $errors['username'] = $this->options['username_error'];
        }
        if (empty($_POST['email']) || !filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)) {
            $errors['email'] = $this->options['email_error'];
        }
        if (empty($_POST['content'])) {
            $errors['content'] = $this->options['content_error'];
        }
        if (count($errors) > 0) {
            $this->errors = $errors;
            return false;
        }
        if (!empty($_POST['parent_id'])) {
            $q = $this->pdo->prepare("SELECT id
            FROM comments
            WHERE ref = :ref AND ref_id = :ref_id AND id = :id AND parent_id = 0");
            $q->execute([
                'ref' => $ref,
                'ref_id' => $ref_id,
                'id' => $_POST['parent_id']
            ]);
            if ($q->rowCount() <= 0) {
                $this->errors['parent'] =$this->options['parent_error'];
                return false;
            }
        }
        $q = $this->pdo->prepare("INSERT INTO comments SET username = :username, email = :email, content = :content, ref = :ref, ref_id = :ref_id,  created = :created, parent_id = :parent_id");
        $data = [
            'username' => $_POST['username'],
            'email' => $_POST['email'],
            'content' =>$_POST['content'],
            'parent_id' =>$_POST['parent_id'],
            'ref' => $ref,
            'ref_id' => $ref_id,
            'created' => date('Y-m-d H:i:s')
        ];
        return $q->execute($data);
    }
}