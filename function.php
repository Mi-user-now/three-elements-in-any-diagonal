<?php
function arrayCheck (array $arr) : array {
    $result = array();
    // Получаем по очереди матрици с массива $arr
    foreach ($arr as $key=>$value){
        $matrixSize = sizeof($arr[$key]); //4 для примера
        //Проверяем, является матрица размером 4*4 и более
        if ($matrixSize < 4)  array_push($result,null);
         array_push($result, boolval(vertical($arr[$key], $matrixSize) + horizontal($arr[$key], $matrixSize) + mainDiagonal($arr[$key], $matrixSize) + SecondaryDiagonal($arr[$key], $matrixSize)));
    }
    return $result;
}

function vertical (array $arr, int $matrixSize) : bool{
    //Главный цикл по столбцам, основное перемещение по рядкам
    for ($j = 0; $j < $matrixSize; $j++){
        for ($i = 0; $i < $matrixSize; $i++){
            $prev = $arr[$i][$j];               //[0][0]
            $curr = $arr[$i+1][$j];             //[1][0]
            $next = $arr[$i+2][$j];             //[2][0]
            if ($i+2 < $matrixSize){
                if ($prev === $curr && $prev == $next) return true;
            }
        }
    }
    //Если не нашлось совпадений во всех столбцах матрицы, то фу-я вернет фолс
    return false;
}

function horizontal (array $arr, int $matrixSize) : bool{
    //Главный цикл по рядкам, основное перемещение по столбцам
    for ($i = 0; $i < $matrixSize; $i++){
        for ($j = 0; $j < $matrixSize; $j++){
            $prev = $arr[$i][$j];               //[0][0]
            $curr = $arr[$i][$j+1];             //[1][0]
            $next = $arr[$i][$j+2];             //[2][0]
            if ($j+2 < $matrixSize){
                if ($prev == $curr && $prev == $next) return true;
            }
        }
    }
    //Если не нашлось совпадений во всех столбцах матрицы, то фу-я вернет фолс
    return false;
}

function mainDiagonal (array $arr, int $matrixSize) : bool{
    //Main diagonal and bottom
    $start_i = 0; $start_j = 0;
    $i = $start_i; $j = $start_j;

    while ($start_i <= $matrixSize - 3){
        $prev = $arr[$i][$j];               //[0][0]
        $curr = $arr[$i+1][$j+1];           //[1][1]
        $next = $arr[$i+2][$j+2];           //[2][2]

        if ($prev === $curr && $prev === $next){
            return true;
        }else{
            $i++; $j++;
        }

        if ($i === $matrixSize){
            $start_i++;
            $i = $start_i;
            $j = $start_j;
        }
    }

    //Under main diagonal
    $start_i = 2; $start_j = $matrixSize - 1; $i = $start_i; $j = $start_j;

    while ($start_i <= $matrixSize-2){
        $prev = $arr[$i][$j];               //[0][0]
        $curr = $arr[$i-1][$j-1];           //[1][1]
        $next = $arr[$i-2][$j-2];           //[2][2]

        if ($prev === $curr && $prev === $next){
            return true;
        }else{
            $i--; $j--;
        }
        if ($i - 2 <= 0){
            $start_i++;
            $i = $start_i;
            $j = $start_j;
        }
    }
    return false;
}

function SecondaryDiagonal (array $arr, int $matrixSize) : bool {
    //secondary diagonal and bottom
    $start_i = $matrixSize - 1; $start_j = 0;
    $i = $start_i; $j = $start_j;

    while ($start_j < $matrixSize-2){
        $prev = $arr[$i][$j];           //[3][0]
        $curr = $arr[$i-1][$j+1];       //[2][1]
        $next = $arr[$i-2][$j+2];       //[1][2]

        if ($prev == $curr && $prev == $next){
            return true;
        }else{
            $i--; $j++;
        }
        if ($j + 2 > $matrixSize - 1){
            $start_j++;
            $i = $start_i;
            $j = $start_j;
        }
    }

    //Check top
        $start_i = $matrixSize - 2; $start_j = 0; //[3][0]
        $i = $start_i; $j = $start_j;

        while ($start_i > 1){
            $prev = $arr[$i][$j];           //[3][0]
            $curr = $arr[$i-1][$j+1];       //[2][1]
            $next = $arr[$i-2][$j+2];       //[1][2]

            if ($prev == $curr && $prev == $next){
                return true;
            }else{
                $i--; $j++;
            }
            if ($i - 2 <= 0){
                $start_i--;
                $i = $start_i;
                $j = $start_j;
            }
        }
    return false;
}