<div class="comment row" style="margin:10px 0;">
	<div class="col-sm-2">
		<img src="photo/internaute.png" alt="internaute" width="100%">
	</div>
	<div class="col-sm-10">
		<p>
			<strong><?=$comment->username;?>,</strong>
			<em><?= date('d/m/Y',strtotime($comment->created));?></em>
			<a href="#" class="reply" data-id="<?=$comment->parent_id? $comment->parent_id : $comment->id?>">Répondre</a>
		</p>
		<p>
			<?= htmlentities($comment->content);?>
		</p>
	</div>
</div>