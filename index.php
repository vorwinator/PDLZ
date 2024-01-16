<?php
function checkFoodFile(){
    if(!file_exists("food.txt"))
        file_put_contents("food.txt","");
}

function getFoodContent(){
    return file_get_contents('food.txt');
}

function prepareFoodData(&$food){
    checkFoodFile();
    $food = array();
    $food = getFoodContent();
    $food = json_decode($food,1);
}

function modifyFoodData($food_name, $ingridients, $food){
    $food[$food_name] = $ingridients;
    file_put_contents("food.txt", json_encode($food));
}

if(isset($_REQUEST['food_name'])){
    prepareFoodData($food);
    modifyFoodData($_REQUEST['food_name'], $_REQUEST['ingridients'], $food);
}
elseif(isset($_REQUEST['food_name_edit'])){
    prepareFoodData($food);
    modifyFoodData($_REQUEST['food_name_edit'], $_REQUEST['ingridients_edit'], $food);
}

// $food['test'] = 'mini test';
// file_put_contents("food.txt", json_encode($food), FILE_APPEND);

prepareFoodData($food);
if(is_array($food)){
    foreach($food as $k=>$f){
        echo $k." => ".$f."<br>";
    }
}
?>
<style>
    .flex_centered{
        display: flex;
        align-items: center; 
        justify-content: center;
    }

    .width_25{
        width:25%;
    }

    .large_input{
        width:250px; 
        height:50px; 
        font-size:x-large;
    }

    .large_textarea{
        width:250px; 
        height:250px; 
        font-size:x-large;
    }
</style>
<div id="page" style="width:100%; height:100%; text-align:center;">
    <div id="main_forms" class="flex_centered">
        <form method="POST" class="width_25">
            <input id="food_name" name="food_name" type="text" placeholder="Nazwa potrawy" class="large_input"/><br>
            <textarea id="ingridients" name="ingridients" placeholder="Składniki przykład: składni1,składnik2,składnik3" class="large_textarea"></textarea><br>
            <input type="submit" value="Dodaj potrawę" class="large_input"/>
        </form>
        <form method="POST" style="width:25%;">
            <input id="food_name_edit" name="food_name_edit" type="text" placeholder="Nazwa potrawy" class="large_input"/><br>
            <textarea id="ingridients_edit" name="ingridients_edit" placeholder="Składniki przykład: składni1,składnik2,składnik3" class="large_textarea"></textarea><br>
            <input type="submit" value="Edytuj potrawę" class="large_input"/>
        </form>
    </div>
</div>