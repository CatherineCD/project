<?php
/* @var $this yii\web\View */

var_dump($question->content_name);

foreach ($answers as $answer)
{
    echo $answer->id.' '.$answer->is_right.'<br>';
}

?>
<h1>question/view</h1>

<p>
    You may change the content of this page by modifying
    the file <code><?= __FILE__; ?></code>.
</p>
