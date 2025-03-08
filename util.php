<?php
//////////////////////////////////
//便利な関数
///////////////////////////////
/**
    * 画像ファイル名から画像のURLを生成する
    *
    * @param string $name 画像ファイル名
    * @param string $type user | tweet
    * @return string
    */
function buildImagePath(string $name = null, string $type)
{
    if ($type === 'user' && !isset($name)){
        return HOME_URL . 'Views/img/icon-default-user.svg';
    }
    return HOME_URL . 'Views/img_uploaded/' . $type . '/' . htmlspecialchars($name);
}
/**
    * 指定した日時からどれだけ経過したかを取得
    * 関数を作成する際は、パラムタグには引数の情報、リターンタグには戻り値の情報を書く
    * @param string $datetime 日時
    * @return string
    */
function convertToDayTimeAgo(string $datetime)
{
        $unix = strtotime($datetime);
        $now = time();
        $diff_sec = $now - $unix;
        // var_dump($diff_sec / 60 / 60 / 24);
        if ($diff_sec < 60){
            $time = $diff_sec;
            $unit = '秒前';
        } elseif($diff_sec < 3600){
            $time = ($diff_sec / 60);
            $unit = '分前';
        } elseif($diff_sec < 86400){
            $time = ($diff_sec / 3600);
            $unit = '時間前';
        }elseif($diff_sec < 2764800){
            $time = ($diff_sec / 86400);
            $unit = '日前';
        }else{
            if(date('Y') !== date('Y',$unix)){
                $time = date('Y年n月j日',$unix);
            }else{
                $time = date('n月j日',$unix);
            }
            return $time;
        }
        return (int)$time . $unit;
}

/**ユーザー情報を保存する関数を作成
 * @param array $user
 * @return void
 */
function saveUserSession(array $user){
    //セッションを開始していない場合
    if(session_status() === PHP_SESSION_NONE){
        //セッションを開始
        session_start();
    }
    $_SESSION['user'] = $user;
}

/**ユーザー情報をセッションから削除する関数を作成
 * @return void
 */
function deleteUserSession()
{
    //セッションを開始していない場合
    if(session_status() === PHP_SESSION_NONE){
        //セッションを開始
        session_start();
    } 

    //セッションのユーザー情報を削除
    unset($_SESSION['user']);
}

/**セッションのユーザー情報を取得
 * @return array/false
 */
function getUserSession() 
{
     //セッションを開始していない場合
    if(session_status() === PHP_SESSION_NONE){
        //セッションを開始
        session_start();
    }

    if(!isset($_SESSION['user'])){
        //セッションにユーザー情報がない
        return false;
    }
        //存在する場合は通常の処理を続ける
        //通常処理とは、ユーザー情報を取得し、変数に代入すること。
        $user = $_SESSION['user'];

        //画像のファイル名から画像のURLを取得
    if(!isset($user['image_name'])){
        $user['image_name'] = null;
    }
    $user['image_path'] = buildImagePath($user['image_name'], 'user');

    return $user;

}