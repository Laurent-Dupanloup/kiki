<?php $title = htmlspecialchars($post['title']); ?>

<?php ob_start(); ?>
<h1>Mon super blog !</h1>
<p><a href="index.php">Retour à la liste des billets</a></p>

<div class="news">
    <h3>
        <?= htmlspecialchars($post['title']) ?>
        <em>le <?= $post['creation_date_fr'] ?></em>
    </h3>
    
    <p>
        <?= /*nl2br(htmlspecialchars(*/$post['content'] ?>
    </p>
</div>

<h2>Commentaires</h2>
<!--<?php
//if (isset($_SESSION['id']) AND isset($_SESSION['pseudo']))
{
 //   echo 'Bonjour ' . $_SESSION['pseudo'];
}
//else
//echo 'ca marche pas2';
?>-->
<?php 
//echo (var_dump($comments->fetch()));
//echo('$comment');
?>

<?php 
    if($_SESSION){
?>

<form action="index.php?action=addComment&amp;id=<?= $post['id'] ?>" method="post">
    <div>
        <label><?=$_SESSION['pseudo']?></label><br />
    </div>
    <div>
        <label for="comment">Commentaire</label><br />
        <textarea id="comment" name="comment"></textarea>
    </div>
    <div>
        <input type="submit" >
    </div>
</form>

<?php }
elseif(!$_SESSION){
    echo 'veuillez vous connecté pour poster un msg';
}

//<?php
while ($comment = $comments->fetch())
{
    //echo var_dump($comment);
    if(!$_SESSION) { /*|| $_SESSION['droit'] ==0){*/
        ?>
    <p><strong><?= htmlspecialchars($comment['pseudo']) ?></strong> le <?= $comment['comment_date_fr'] ?></p>
    <p><?= nl2br(htmlspecialchars($comment['comment'])) ?></p>
    <em><a href="index.php?action=deleteCom&amp;id=<?= $comment['ID'] ?>&amp;postid=<?= $post['id'] ?>">signaler le commentaire</a></em>
    <?php
    }   
   /* elseif ($_SESSION['droit']==1)
    {
        ?>
    <p><strong><?= htmlspecialchars($comment['pseudo']) ?></strong> le <?= $comment['comment_date_fr'] ?></p>
    <p><?= nl2br(htmlspecialchars($comment['comment'])) ?></p>
    <p><?= $comment['ID'] ?></p>
    <em><a href="index.php?action=deleteCom&amp;id=<?= $comment['ID']?>&amp;postid=<?= $post['id'] ?>">Supprimer le commentaire</a></em>
<?php
    }*/
    elseif($_SESSION['droit']==0 || $_SESSION['droit'] ==1)
    {
        ?>
        <p><strong><?= htmlspecialchars($comment['pseudo']) ?></strong> le <?= $comment['comment_date_fr'] ?></p>
        <p><?= nl2br(htmlspecialchars($comment['comment'])) ?></p>
        <p><?= $comment['ID'] ?></p>
    <form action="index.php?action=signalementMsg&amp;id=<?= $comment['ID'] ?>" method="post">
         <input type="checkbox" id="signalement" name="signalement"
         unchecked required>
         <label for="signalement">signaler le msg</label>
         <input type="submit" value="Valider"><br>
    </form>
<?php
        if($_SESSION['id'] == $comment['author_id']){
?>
         <em><a href="index.php?action=deleteCom&amp;id=<?= $comment['ID'] ?>&amp;postid=<?= $post['id'] ?>">Supprimer le commentaire</a></em>
         <?php
     }
    }
//&amp;postid=<?= $comment['post_id'] ?
}
?>
<?php $content = ob_get_clean(); ?>

<?php require('template.php'); ?>




