<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

use yii\widgets\ActiveForm;
use yii\grid\GridView;
use yii\widgets\ListView;
//use ScrollPage;
use yii\widgets\LinkPager;
use yii\widgets\Pjax;


/* @var $this yii\web\View */
/* @var $model app\models\Article */
/* @var $comment app\models\Comment*/

$this->title = $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Articles', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="article-view">

<!--    <h1>--><?//= Html::encode($this->title) ?><!--</h1>-->

<!--    <p>-->
<!--        --><?//= Html::a('Update', ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
<!--        --><?//= Html::a('Delete', ['delete', 'id' => $model->id], [
//            'class' => 'btn btn-danger',
//            'data' => [
//                'confirm' => 'Are you sure you want to delete this item?',
//                'method' => 'post',
//            ],
//        ]) ?>
<!--    </p>-->

    <div class="row article-heading">
        <div class="col col-md-6 article-heading-title-translate">
            <h1><?php echo $model->title_translate ?>
                <span class="label"><?php echo $model->langTranslate->language ?></span>
            </h1>
            <a class="permalink" href="<?php echo $model->url_translate ?>"><?php echo $model->url_translate ?></a>
            <p class="author">Перевод <a href="<?php echo $model->translator_url ?>"><?php echo $model->translator_name ?></a></p>
        </div>
        <div class="col col-md-6 article-heading-title-original">
            <h1><?php echo $model->title_original ?>
                <span class="label"><?php echo $model->langOriginal->language ?></span>
            </h1>
            <a class="permalink" href="<?php echo $model->url_original ?>"><?php echo $model->url_original ?></a>
            <p class="author">By <a href="<?php echo $model->author_url ?>"><?php echo $model->author_name ?></a></p>
        </div>
    </div>
    <div class="vertical spacer"></div>
    <?php foreach($model->paragraphs as $paragraph) { ?>
        <div class="row article-paragraph">
            <div class="col col-md-6 article-paragraph-translate">
                <p><?php echo $paragraph->paragraph_translate ?></p>
            </div>
            <div class="col col-md-6 article-paragraph-original">
                <p><?php echo $paragraph->paragraph_original ?></p>
            </div>
        </div>
    <?php } ?>

    <div class="row article-footnote">
        <div class="col col-md-1"></div>
        <div class="col col-md-10">
            <p>
                Тексты были взяты из открытых источников и соединены в формате "билингва" (bilingual book).
                Материал на левой стороне страницы является переводом, а на правой - оригиналом.
                Для каждой страницы указан источник, автор и переводчик.
                Если вы заметили неточность перевода, или неправильно сопоставленные абзацы, или текст оформлен неаккуратно - сообщите в комментариях.
            </p>
        </div>
    </div>

</div>

<div class="container comments">

<div class="comment-form">
    <?php
    yii\widgets\Pjax::begin(['id' => 'new_note']);
    $form = ActiveForm::begin(['options' => ['data-pjax' => true]],[
    'id' => 'comment-form',
    ]) ?>
    <?= $form->field($comment, 'comment')->textarea(['rows' => 6]) ?>
    <div class="form-group">
        <?= Html::submitButton($comment->isNewRecord ? Yii::t('app', 'Create') : Yii::t('app', 'Create'), ['class' => $comment->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>
    </div>

    <?php ActiveForm::end();
    Pjax::end();
    ?>
</div>


<div class="container comments" id="js-comments-recommended">
<?= ListView::widget([
    'dataProvider' => $comments_selected,
    'itemView' => function ($model, $key, $index, $widget) {
        return $this->render('_comment', [
            'comment' => $model,
        ]);
    },
    'layout' => "{summary}\n{items}",
    'summary' => 'Показано {count} из {totalCount}',
    'summaryOptions' => [
    'tag' => 'span',
    'class' => 'my-summary',
],
    'emptyText' => 'Список пуст',
]);
?>

</div>

    <div class="container comments" id="js-comments-page" style="display:none;">
<?php Pjax::begin(['id'=>'comments_list']); ?>
    <?= ListView::widget([
        'dataProvider' => $comments,
        'itemView' => function ($model, $key, $index, $widget) {
            return $this->render('_comment', [
                'comment' => $model,
            ]);
        },
        'layout' => "{summary}\n{items}\n{pager}",
    ]);
    ?>
<?php Pjax::end(); ?>
</div>


<?php
if (!empty($comments_selected)) { ?>
    <div class="comments-show-all" id="js-comments-show-all"><a href="#">Show all responses</a></div>
<?php }
?>

</div>



