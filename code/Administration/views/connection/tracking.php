<?php
use yii\helpers\Html;
for($i=0;$i<count($model);$i++){
	?>
	<div class="well">
<div class="time">
El <b><?php echo date('j F, Y \a\t h:i a',strtotime($model[$i]->creation_date));?></b>
<b> <?php echo '  ('.$model[$i]->getCreator()->one()->username.') ';?> </b>
</div>
<hr>
<div class="comment">
<?php echo $model[$i]->description; ?>
</div>

</div>
<?php
}

?>