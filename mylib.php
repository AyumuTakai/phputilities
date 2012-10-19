<?php

  // エスケープされた文字列を返す
  // $var   エスケープする値
  // 返り値 エスケープされた文字列
  function h($var) {
    return htmlentities($var,ENT_QUOTES,'UTF-8');
  }

  // POSTリクエストに値があればエスケープして出力する
  // $name  POSTリクエスト中のデータ名
  // 返り値 NULL
  function echo_post($name) {
    if(isset($_POST[$name])) { echo h($_POST[$name]); }
  }

  // GETリクエストに値があればエスケープして出力する
  // $name  GETリクエスト中のデータ名
  // 返り値 NULL
  function echo_get($name) {
    if(isset($_GET[$name])) { echo h($_GET[$name]); }
  }

  // POSTリクエストに指定したデータが全て含まれているかチェックする
  // 引数   可変長引数
  // 返り値 データが全て含まれていればtrue,一つでも含まれていなければfalse
  function check_post() {
    $num  = func_num_args();
    $args = func_get_args();
    for($i = 0;$i < $num;$i++) {
      if( ! isset($_POST[$args[$i]]) ) {
        return false;
      }  
    }
    return true;
  }
  
  // GETリクエストに指定したデータが全て含まれているかチェックする
  // 引数   可変長引数
  // 返り値 データが全て含まれていればtrue,一つでも含まれていなければfalse
  function check_get() {
    $num  = func_num_args();
    $args = func_get_args();
    for($i = 0;$i < $num;$i++) {
      if( ! isset($_GET[$args[$i]]) ) {
        return false;
      }  
    }
    return true;
  }

  // 指定URLにリダイレクトする
  // $url リダイレクト先のURL
  function redirect($url) {
    header('Location: '.$url);
    exit();
  }

  // $_POSTに指定されたname属性で指定された値がセットされていればcheckedを出力する
  // $name name属性
  // $value $_POST[$name]と比較する値
  function checked_post($name,$value) {
    if(isset($_POST[$name]) && ( $_POST[$name] === $value || ( is_array($_POST[$name]) && array_search($value,$_POST[$name]) !== false  ) )) {
      echo 'checked';
    }
  }

  // $_GETに指定されたname属性で指定された値がセットされていればcheckedを出力する
  // $name name属性
  // $value $_GET[$name]と比較する値
  function checked_get($name,$value) {
    if(isset($_GET[$name]) && ( $_GET[$name] === $value ||  ( is_array($_GET[$name]) && array_search($value,$_GET[$name]) !== false ) )) {
      echo 'checked';
    }
  }

  // $_POSTに指定されたname属性で指定された値がセットされていればselectedを出力する
  // $name name属性
  // $value $_POST[$name]と比較する値
  function selected_post($name,$value) {
    if(isset($_POST[$name]) && ( $_POST[$name] === $value || ( is_array($_POST[$name]) && array_search($value,$_POST[$name]) !== false  ) )) {
      echo 'selected';
    }
  }

  // $_GETに指定されたname属性で指定された値がセットされていればselectedを出力する
  // $name name属性
  // $value $_GET[$name]と比較する値
  function selected_get($name,$value) {
    if(isset($_GET[$name]) && ( $_GET[$name] === $value ||  ( is_array($_GET[$name]) && array_search($value,$_GET[$name]) !== false ) )) {
      echo 'selected';
    }
  }

  // メールアドレスのチェック
  // $email チェックするemailアドレス
  // 返り値 正しいメールアドレスならTRUE そうでなければFALSE
  function is_valid_mail_address($email) {
    // 正規表現によるメールアドレスチェック
    $pattern = '/^(?:(?:(?:(?:[a-zA-Z0-9_!#\$\%&\'*+\/=?\^`{}~|\-]+)(?:\.(?:[a-zA-Z0-9_!#\$\%&\'*+\/=?\^`{}~|\-]+))*)|(?:"(?:\\[^\r\n]|[^\\"])*")))\@(?:(?:(?:(?:[a-zA-Z0-9_!#\$\%&\'*+\/=?\^`{}~|\-]+)(?:\.(?:[a-zA-Z0-9_!#\$\%&\'*+\/=?\^`{}~|\-]+))*)|(?:\[(?:\\\S|[\x21-\x5a\x5e-\x7e])*\])))$/';
    if ( preg_match($pattern,$email) ){
        return true;
    }else{
        return false;
    }
  }



  //
  //  動作確認用関数
  //  

  // プログラムがどこまで実行されているかを確認するために使用する。
  // $marking というグローバル変数が存在し、かつ真の時に$strとHTMLの改行を出力する
  // $str マーカーとして表示する値 1,2,3や'a','b','c'など
  function m($str) {
    global $marking;
    if($marking) {
      echo $str,'<br />';
    }
  }

  // 変数の値の表示(HTML改行付き)
  // $value 出力する値
  // $msg   値を出力する前に出力する文字列(変数名など)
  function p($value,$msg=null) {
    if($msg) {
      echo $msg.' ';
    }
    echo gettype($value) . ' ' . var_export($value,true) . '<br />';
  }

  // ライブラリなどでファイルにPHPプログラム部分しか含まれていない場合は、
  // 閉じタグを記述しない(閉じタグ以降に文字があると不具合が発生するため)。
