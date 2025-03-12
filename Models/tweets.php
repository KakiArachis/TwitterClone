<?php
///////////////////////////////////////
//ツイートデータを処理
///////////////////////////////////////
/**
    * ツイートを作成
    *
    * @param array $data
    * @return bool
    */
    function createTweet(array $data)
    {
        //DB接続
        $mysqli = new mysqli(DB_HOST,DB_USER,DB_PASSWORD,DB_NAME);

        //接続エラーがある場合に処理停止する
        if($mysqli->connect_errno){
            echo 'MySQLの接続に失敗しました。:' . $mysqli->connect_error . "\n";
            exit;
        }

    //新規登録するSQLクエリ（命令文）を作成（新しいユーザーを登録するSQL文
    $query = 'INSERT INTO tweets(user_id, body, image_name) VALUES (?, ?, ?)'; 

    //プリペアドステートメントに作成したクエリを登録
    $statement = $mysqli->prepare($query);

    //クエリのプレースホルダ（？の部分）にカラム値をひもづけ
    $statement->bind_param('iss', $data['user_id'], $data['body'], $data['image_name']);

    //クエリを実行
    $response = $statement->execute();

    //実行に失敗した場合→エラー表示
    if($response === false){
        echo 'エラーメッセージ：' . $mysqli->error . "\n";
    }

    //DB接続を解放
    $statement->close();
    $mysqli->close();

    return $response;
}  
