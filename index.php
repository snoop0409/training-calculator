<?php
$disp_num=$_POST['disp_num'];//表示
$pre_num=$_POST['pre_num'];//最新の記号を押す前までの計算値
$input_num=$_POST['input_num'];//追加入力していく値
$ope=$_POST['ope'];//記号
$pre_button=$_POST['pre_button'];//１つ前のボタン
$button=$_POST['button'];//ボタン

if(isNumBtn($button)||empty($button)){
    if(isOpeBtn($pre_button)){//記号の場合
        $pre_num=$disp_num;//表示された値がプレナンバーに代入される
        $disp_num=$button;//押したボタンが表示される
    }else{//記号以外＝数字の場合
        $disp_num=$disp_num.$button;//連続した数字。「.」は数字の結合　例「２２１」
        }
    $input_num=$disp_num;

}else{
    switch($button){
        case'c'://クリア
            $disp_num='';
            $pre_num='';
            $input_num='';
            break;
        default://クリアをしなかった場合、下に進む
        //イコールを押した場合
        if(!empty($pre_num)&&(preg_match('/=/',$button)||(isOpeBtn($button)&&isNumBtn($pre_button)))){
            //値が存在する時または記号と１つ前までの計算値が入力されている時
            switch($ope){
                case'+';
                    $disp_num=$pre_num+$disp_num;
                break;
                case'-';
                    $disp_num=$pre_num-$disp_num;
                break;
                case'*';
                    $disp_num=$pre_num*$disp_num;
                break;
                case'/';
                $disp_num=$pre_num/$disp_num;
                break;
                default://いずれの場合でもなかった場合下に進む
                break;
            }
        }
        if ($button != '＝'){//「=」を押さなかったとしたら、$buttonが
            $ope = $button;
        }
        break;
    }
}

$pre_button = $button;

//記号か判定する関数
function isOpeBtn($btn){
    if($btn=='+'||$btn=='-'||$btn=='*'||$btn=='/'){
        return true;//正
    }else{
        return false;//誤
    }
}
//数字か判定する関数
function isNumBtn($btn){
    if($btn=='1'||$btn=='2'||$btn=='3'||$btn=='4'||$btn=='5'||$btn=='6'||$btn=='7'||$btn=='8'||$btn=='9'){
        return true;//正
    }else{
        return false;//誤
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Calculator</title>
</head>
<body>
    <h2>Calculator</h2>
    <p><?php echo $disp_num; ?></p>
    <form action="?" method="post">
        <input type="hidden" name="disp_num" value="<?php echo $disp_num; ?>" /><!--hiddenを使うことで表示させずに計算値を保持させておく。（１+１）＝のイコールの前の値など。これがないと計算できない-->
        <input type="hidden" name="pre_num" value="<?php echo $pre_num; ?>" />
        <input type="hidden" name="input_num" value="<?php echo $input_num; ?>" />
        <input type="hidden" name="pre_button" value="<?php echo $pre_button; ?>" />
        <input type="hidden" name="ope" value="<?php echo $ope; ?>" />
        <table>
            <tr align="center">
                <td><button type="submit" name="button" value="7">7</button></td>
                <td><button type="submit" name="button" value="8">8</button></td>
                <td><button type="submit" name="button" value="9">9</button></td>
                <td><button type="submit" name="button" value="*">*</button></td>
            </tr>
            <tr align="center">
                <td><button type="submit" name="button" value="4">4</button></td>
                <td><button type="submit" name="button" value="5">5</button></td>
                <td><button type="submit" name="button" value="6">6</button></td>
                <td><button type="submit" name="button" value="-">-</button></td>
            </tr>
            <tr align="center">
                <td><button type="submit" name="button" value="1">1</button></td>
                <td><button type="submit" name="button" value="2">2</button></td>
                <td><button type="submit" name="button" value="3">3</button></td>
                <td><button type="submit" name="button" value="+">+</button></td>
            </tr>
            <tr align="center">
                <td><button type="submit" name="button" value="0">0</button></td>
                <td><button type="submit" name="button" value="c">c</button></td>
                <td><button type="submit" name="button" value="=">=</button></td>
                <td><button type="submit" name="button" value="/">/</button></td>
            </tr>
        </table>
    </form>
</body>
</html>
