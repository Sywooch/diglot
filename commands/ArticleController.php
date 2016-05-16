<?php
namespace app\commands;

use yii\console\Controller;

class ArticleController extends Controller
{
    public function actionSeed($count = 1)
    {
        for ($i=0; $i<$count; $i++) {
			$faker =\Faker\Factory::create();
			$article = new \app\models\Article;
			$article->title_original=$faker->text(80);
			$article->title_translate=$faker->text(80);
			$article->user_id='2';
			$article->lang_original_id='2';
			$article->save();
			var_export($article->errors);
		}
		echo (" created"." ".$count." "."articles ");

        if (!$article->save())
            var_export($article->errors);

        echo "jgjhgjhghgjh";
    }
}
