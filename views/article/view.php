<?php

use app\models\Article;
use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\widgets\ListView;
use yii\data\ActiveDataProvider;
use yii\widgets\LinkPager;
use yii\widgets\Pjax;


/* @var $this yii\web\View */
/* @var $model Article */
/* @var $comments_selected ActiveDataProvider */
/* @var $comments ActiveDataProvider */

$this->title = $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Articles', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="container article-view">

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

<div class="comments">
    <div class="container">

        <h4>Responses</h4>

        <div class="comment-feed" id="js-add-comment">
            <div class="float-left comment-card">
                <div class="card-avatar"><a class="card-avatar" href="#"><img src="/upload/user/0_440x440.png" class="avatar-image u-xs-size32x32"></a></div>
                <div class="card-summary">
                    <div class="comment-placeholder" id="js-add-card-placeholder">Write a response... <!-- Be the first to write a response... --></div>
                    <div class="card-extra" id="js-add-card-user"><a href="#"><?php echo Yii::$app->user->identity->username ?></a></div>
                </div>
            </div>
            <div class="comment-form" id="js-add-card-form">
                <?php $form = ActiveForm::begin(['id' => 'comment_post', 'method' => 'post']); ?>
                <?= $form->field($comment, 'comment')->textarea(['rows' => 6]) ?>
                <div class="form-group">
                    <?= Html::submitButton('Publish', ['class' => 'btn']) ?>
                </div>
                <?php ActiveForm::end(); ?>
            </div>
        </div>

    <div id="js-comments-recommended">
    <?= ListView::widget([
        'dataProvider' => $comments_selected,
        'itemView' => '_comment',
        'layout' => "{items}",
        'emptyText' => '',
        'emptyTextOptions' => [
            //'tag' => 'p'
        ],
    ]);
    ?>
    </div>

    <div class="comments" id="js-comments-page" style="display: none;">
    <?php Pjax::begin(['id'=>'comments_list']); ?>
    <?= ListView::widget([
        'dataProvider' => $comments,
        'itemView' => '_comment',
        'layout' => "{summary}\n{items}\n{pager}",
    ]);
    ?>
    <?php Pjax::end(); ?>
    </div>

    <?php if ($comments_selected->totalCount > 0) { ?>
        <div class="comments-show-all" id="js-comments-show-all"><a href="?responses">Show all responses</a></div>
    <?php } ?>

    </div> <!-- /.container -->
</div> <!-- /.comments -->



