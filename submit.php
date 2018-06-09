 <?php
 

// 创建连接
  $titleErr = $writerErr = $contentErr = "";

  if ($_SERVER["REQUEST_METHOD"] == "POST")
  {
    if (empty($_POST["title"]))
    {
      $titleErr = "标题是必需的";
    }
    else
    {
      $title = test_input($_POST["title"]);
        // 检测标题是否只包含字母跟空格
      if (!preg_match("/^[a-zA-Z ]*$/",$title))
      {
        $titleErr = "只允许字母和空格"; 
      }
    }

    if (empty($_POST["writer"]))
    {
      $writerErr = "作者是必需的";
    }
    else
    {
      $writer = test_input($_POST["writer"]);
        // 检测作者填写格式是否合法
      if (!preg_match("/^[a-zA-Z ]*$/",$writer))
      {
        $writerErr = "非法作者填写格式"; 
      }
    }
    
    if (empty($_POST["content"]))
    {
      $contentErr = "正文不能为空";
    }
    else
    {
      $content = test_input($_POST["content"]);
        // 检测正文格式是否合法
      if (!preg_match("/^[a-zA-Z ]*$/",$content))
      {
        $contentErr = "非法的正文格式"; 
      }
    }
    
    
  }

  function test_input($data)
  {
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
  }

/*function _POST($str)
{
    $val = !empty($_POST[$str]) ? $_POST[$str] : null;
    return $val;
}

  
  
    $title = _POST("title");
    $writer = _POST("writer");
    $content = _POST("content");
  */
 
 
  //如果提交了表单  
        //数据库连接参数  
        $host = "localhost";  
        $user = "root";  
        $pass = "root";  
        $db = "home";  
          
        //取得表单中的值，检查表单中的值是否符合标准，并做适当转义，防止SQL注入  
        $title = empty($_POST['title'])? die("请输入标题"):  
        mysql_escape_string($_POST['title']);  
        $writer = empty($_POST['writer'])? die("请输入作者"):  
        mysql_escape_string($_POST['writer']);  
        $content = empty($_POST['content'])? die("请输入内容"):  
        mysql_escape_string($_POST['content']);  
          
        //打开数据库连接  
        $connection = mysql_connect($host, $user, $pass) or die("Unable to connect!");  
          
        //选择数据库  
        mysql_select_db($db) or die("Unable to select database!");  
          
        //构造一个SQL查询  
        $query = "INSERT INTO news(title, writer, content,time) VALUE('$title', '$writer', '$content','$time')";  
          
        //执行该查询  
        $result = mysql_query($query) or die("Error in query: $query. ".mysql_error());  
          
        //插入操作成功后，显示插入记录的记录号  
        echo "记录已经插入， mysql_insert_id() = ".mysql_insert_id();  
          
        //关闭当前数据库连接  
        mysql_close($connection);  
    


?>

<!doctype html>

<html>
<body>
<head>
  <style>
.error {color: #FF0000;}
</style>
</head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">

<table align="left">
 <caption><h2>网络技术会提交页面</h2></caption>
 <p><span class="error">* 必需字段。</span></p>
 <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" method="post">
  <tr >
   <th>标题：</th>
   <td ><input type="text" name="title" size="20" />
    <span class="error">* <?php echo $titleErr;?></span></td>
  </tr>
  <tr>
   <th>作者：</th>
   <td ><input type="text" name="writer" size="20"  />
    <span class="error">* <?php echo $writerErr;?></span></td>
  </tr>
  <tr>
   <th>内容：</th>
   <td><textarea name="content" rows="4" cols="40" ></textarea>
    <span class="error">* <?php echo $contentErr;?></span></td>
  </tr>
  <tr>	
   <td colspan="2" align="center">
    <input type="submit" name="submit" value="提交">

<form action="upload_file.php" method="post" enctype="multipart/form-data">
    <label for="file">文件上传：</label>
    <input type="file" name="file" id="file"><br>
    <input type="submit" name="submit" value="提交">
</form>

  </body>
  </html>