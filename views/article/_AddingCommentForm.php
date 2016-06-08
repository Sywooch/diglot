<?php
use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\widgets\Pjax;

/* @var $article app\models\Article */
/* @var $comment app\models\Comment */
/* @var $added bool */

Pjax::begin(['id'=>'new_comment_form',
    'enablePushState' => false,
    'enableReplaceState' => false
]);
if (!empty($added))
    echo '<div>', Yii::t('app', 'Response published'), '</div>';

$form = ActiveForm::begin([
    'action' => [ 'add-comment', 'id' => $article->id ],
    'id' => 'addComment',
    'enableClientValidation' => false,
    'enableAjaxValidation' => true,
    'options' => [
        'data-pjax' => true,
    ]]);
?>
    <?= $form->field($comment, 'comment')->textarea(['rows' => 6])?>
    <div class="controls form-group">
        <?php echo Html::submitButton($comment->isNewRecord ? Yii::t('app', 'Create') : Yii::t('app', 'Create'), ['class' => $comment->isNewRecord ? 'btn btn-success' : 'btn btn-primary','id' => 'btn_create','value' => 'add-comment?id='.$article->id]); ?>
    </div>

<?php ActiveForm::end();
Pjax::end();
?>