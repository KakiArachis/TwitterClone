<!DOCTYPE html>
<html lang="ja">

<head>
    <?php include_once('../Views/common/head.php'); ?>
    <title>つぶやく画面/Twitterクローン</title>
    <meta name="description" content="つぶやく画面です">
</head>

<body class="home">
    <div class="container">
    <?php include_once('../Views/common/side.php'); ?>
        <div class="main"> <!-- メイン -->

        <!-- メインの中の、ヘッダー部分作成 -->
            <div class="main-header">
                <h1>つぶやく</h1>
            </div>

        <!-- メインの中の、つぶやき投稿エリア作成 -->
            <div class="tweet-post">
            <div class="my-icon">
                <img src="<?php echo htmlspecialchars($view_user['image_path']) ?>" alt="">
            </div>
                <div class="input-area">
                    <form action="post.php" method="post" enctype="multipart/form-data">
                    <textarea name="body" placeholder="いまどうしてる？" maxlength="140"></textarea>
                    <div class="bottom-area">
                        <div class="mb-0">
                            <input type="file" name="image" class="form-control form-control-sm">
                        </div>
                        <button class="btn" type="submit">つぶやく</button>
                    </div>
                    </form>
                </div>
            </div>
            
        <!-- メインの中の、仕切りエリア作成 -->
            <div class="ditch"></div>
        </div>
    </div>
    <?php include_once('../Views/common/foot.php'); ?>
</body>

</html>