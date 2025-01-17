<?php
if ($_SERVER["REQUEST_METHOD"] === "POST") {
    // 入力内容を取得
    $name = htmlspecialchars($_POST['name'], ENT_QUOTES, 'UTF-8');
    $email = htmlspecialchars($_POST['email'], ENT_QUOTES, 'UTF-8');
    $message = htmlspecialchars($_POST['message'], ENT_QUOTES, 'UTF-8');

    // CSVファイル名の設定
    $csvFile = 'contacts.csv';

    // ファイルに書き込む準備
    $fileExists = file_exists($csvFile);
    $file = fopen($csvFile, 'a');

    // ファイルが新規の場合、ヘッダーを追加
    if (!$fileExists) {
        fputcsv($file, ['お名前', 'メールアドレス', 'メッセージ', '送信日時']);
    }

    // 現在日時を取得
    $currentDate = date("Y-m-d H:i:s");

    // データをCSVに書き込み
    fputcsv($file, [$name, $email, $message, $currentDate]);
    fclose($file);

    // 完了メッセージを表示
    echo '<p>お問い合わせありがとうございました！内容を受け付けました。</p>';
    echo '<p><a href="index.html">ホームページに戻る</a></p>';
} else {
    echo '<p>不正なアクセスです。</p>';
}
?>
