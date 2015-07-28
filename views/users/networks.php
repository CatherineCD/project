
<table class="table table-striped table-bordered detail-view">
<?php
use yii\helpers\Html;
use yii\widgets\DetailView;

foreach ($networks as $network)
{
    echo "<tr>";

    echo "<th>".$network['name']."</th>";

    echo "<td>";

    if (is_null($network['user_id']))
    {
        if ($network['id'] == 3)
            echo "<a href='"."https://oauth.vk.com/authorize?client_id=5006568&display=popup&redirect_uri=http://project/users/networks&scope=friends&response_type=code&v=5.35'>+</a>";
        else
            echo "<a href='"."/users/add?networkId=".$network['id']."'>+</a>";
    }
    else
    {
        echo "<a href='"."/users/remove?networkId=".$network['id']."'>-</a>";
    }

    echo "</td>";

    echo "</tr>";

}

?>
</table>