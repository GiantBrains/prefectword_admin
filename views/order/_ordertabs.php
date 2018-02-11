<?php
/**
 * Created by PhpStorm.
 * User: gits
 * Date: 1/15/18
 * Time: 1:03 PM
 */
$myscript = <<< JS
function openCity(evt, cityName) {
    // Declare all variables
    var i, tabcontent, tablinks;

    // Get all elements with class="tabcontent" and hide them
    tabcontent = document.getElementsByClassName("tabcontent");
    for (i = 0; i < tabcontent.length; i++) {
        tabcontent[i].style.display = "none";
    }

    // Get all elements with class="tablinks" and remove the class "active"
    tablinks = document.getElementsByClassName("tablinks");
    for (i = 0; i < tablinks.length; i++) {
        tablinks[i].className = tablinks[i].className.replace(" active", "");
    }

    // Show the current tab, and add an "active" class to the button that opened the tab
    document.getElementById(cityName).style.display = "block";
    evt.currentTarget.className += " active";
}
JS;
$this->registerJs($myscript);
?>
<div class="row tabs">
    <ul class="order-details-menu" style="height: 40px; list-style-type: none; background-color: midnightblue; margin-bottom: 20px; line-height: 40px; vertical-align: middle">
        <li class="<?=$tabactive ?>" style="display: inline-block;"><a href="<?= \yii\helpers\Url::to(['order/view',
                'oid'=>$model->ordernumber])?>"><strong>Order details</strong></a></li>
        <li class="<?=$tab2active?>" style="display: inline-block; "> <a href="<?= \yii\helpers\Url::to(['order/attached',
                'oid'=>$model->ordernumber])?>"><strong>Order Files</strong></a></li>
        <li class="<?=$tab3active?>" style="display: inline-block;"><a href="<?= \yii\helpers\Url::to(['order/messages',
                'oid'=>$model->ordernumber])?>"><strong>Messages</strong></a></li>
    </ul>
</div>
<!--<!-- Tab links -->
<!--<div class="tab">-->
<!--    <button class="tablinks" onclick="openCity(event, 'London')">London</button>-->
<!--    <button class="tablinks" onclick="openCity(event, 'Paris')">Paris</button>-->
<!--    <button class="tablinks" onclick="openCity(event, 'Tokyo')">Tokyo</button>-->
<!--</div>-->
<!---->
<!--<!-- Tab content -->
<!--<div id="London" class="tabcontent">-->
<!--    <h3>London</h3>-->
<!--    <p>London is the capital city of England.</p>-->
<!--</div>-->
<!---->
<!--<div id="Paris" class="tabcontent">-->
<!--    <h3>Paris</h3>-->
<!--    <p>Paris is the capital of France.</p>-->
<!--</div>-->
<!---->
<!--<div id="Tokyo" class="tabcontent">-->
<!--    <h3>Tokyo</h3>-->
<!--    <p>Tokyo is the capital of Japan.</p>-->
<!--</div>-->