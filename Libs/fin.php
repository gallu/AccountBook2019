<?php  // fin.php
/*
 * 終了処理
 */

// バッファリング終了(テンプレートのechoはバッファしない)
ob_end_flush();
//ob_end_clean();

// 
echo $twig->render($template_file_name, $template_data);

