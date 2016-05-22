<?php

use yii\db\Migration;
use yii\db\Expression;

class m160522_191915_insert_article extends Migration
{
    public function up()
    {
        $this->insert('article', [
            'id'=>-1,
            'title_original' => 'Analysis Paralysis: Over-thinking and Knowing Too Much to Just CODE',
            'url_original' => 'http://www.hanselman.com/blog/AnalysisParalysisOverthinkingAndKnowingTooMuchToJustCODE.aspx',
            'title_translate' => 'Паралич анализа: вы знаете слишком много, чтобы просто писать код',
            'url_translate' => 'https://habrahabr.ru/post/218345/',
            'status' => 'published',
            'date_created' => new Expression('NOW()'),
            'date_published' => new Expression('NOW()'),
            'user_id' => 16,
            'author_name' => 'Scott Hanselman',
            'author_url' => 'http://hanselman.com/about',
            'own_original' => false,
            'translator_name' => '@a553',
            'translator_url' => 'https://habrahabr.ru/users/a553/',
            'own_translate' => false,
            'lang_original_id' => 53,
            'lang_transtate_id' => 54,
        ]);
    }

    public function down()
    {
        $this->delete('article', [
            'title_original' => 'Analysis Paralysis: Over-thinking and Knowing Too Much to Just CODE',
            'url_original' => 'http://www.hanselman.com/blog/AnalysisParalysisOverthinkingAndKnowingTooMuchToJustCODE.aspx',
        ]);
        return true;
    }

    /*
    // Use safeUp/safeDown to run migration code within a transaction
    public function safeUp()
    {
    }

    public function safeDown()
    {
    }
    */
}
