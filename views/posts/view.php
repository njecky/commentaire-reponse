<?php

/**
*Récupération de l'article
**/
if (!isset($_GET['slug'])) {
	throw new Exception("404");
	
}
$q = $DB->prepare("SELECT * FROM post WHERE slug = :slug");
$q->execute(['slug'=> $_GET['slug']]);
$post = $q->fetch();
if (!$post) {
	throw new Exception("404");
}
/**
* Nos commentaires
**/
use Njecky\Felix\Comments;
$comments_cls = new Comments($DB);

/**
* Soumission d'un commentaire
**/
$errors = false;
$success = false;
if (isset($_POST['action']) && $_POST['action'] == 'comment') {
	$save = $comments_cls->save('post', $post->id);
	if ($save) {
		$success = true;
	}else{
		$errors = $comments_cls->errors;
	}
}

$comments = $comments_cls->findAll('post', $post->id);

/**
*Contenu
**/
?>
<h1><?= $post->name;?></h1>


<?= $post->content; ?>

<h2><?= count($comments)?> Commentaires</h2>
<?php if ($errors):?>
	<div class="alert alert-danger">
		<strong>Impossible de poster ce commentaire pour les raisons suivantes :</strong>
		<ul>
			<?php foreach($errors as $error):?>
				<li><?=$error;?></li>
			<?php endforeach ?>
		</ul>
	</div> 
<?php endif?>
<?php if($success): ?>
	<div class="alert alert-success">
		<strong>Bravo</strong> Votre commentaire a été bien posté
	</div>
<?php endif ?>
<form action="#comment" role="form" method="post" id="comment">
	<div class="row">
		<div class="col-sm-6">
			<div class="form-group">
				<label for="pseudo">Pseudo</label>
				<input type="text" class="form-control" id="pseudo" name="username" required/>
			</div>
		</div>
		<div class="col-sm-6">
			<div class="form-group">
				<label for="email">Email</label>
				<input type="email" class="form-control" id="email" name="email" required/>
			</div>
		</div>
		<div class="col-sm-12">
			<div class="form-group">
				<label for="contenu">Commentaire</label>
				<textarea class="form-control" id="contenu" name="content" required/></textarea>
			</div>
			<p>&nbsp;</p>
			<button type="submit" class="badge bg-warning">Envoyer</button>
		</div>
		<input type="hidden" name="parent_id" value="0" id="parent_id"/>
		<input type="hidden" name="action" value="comment"/>
	</div>
</form>
<?php foreach ($comments as $comment):?>
	<?php require ELEMENTS. 'comment.php'; ?>

	<?php foreach ($comment->replies as $comment):?>
		<div style="margin-left:100px;">
			<?php require ELEMENTS. 'comment.php'; ?>
		</div>
	<?php endforeach?>
<?php endforeach?>