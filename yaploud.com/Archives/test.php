<?php
   header("Last-Modified: " . gmdate("D, d M Y H:i:s") . " GMT");

   function hostname($strURL){
      preg_match("/\:\/\/([^\/]+)/",$strURL,$arrResult);
      return $arrResult[1];
   }

   function ExamineURL($strURL){
   	echo "Trying to get Get contents for : <a href=\"$strURL\">" . $strURL."</a>";
      $strPage = @file_get_contents($strURL) or ($Error = 1);
      if(!$strPage){
         if(preg_match_all("/(?i)\<title\s*\>([^<]+)\<\/title\s*\>|\<meta\s+name=\"description\"\s*content=\"([^\"]+)\"\s*\/?\>/", $strPage, $arrResult)){
            $arrReturn['URL'] = $strURL;
            $arrReturn['URL'] = hostname($strURL);

            echo "Examined URL: <a href=\"$strURL\">" . $strURL."</a><br>";
            foreach ($arrResult as $patternOrder => $arrMatches){
               foreach($arrMatches as $strMatch){
                  if ($patternOrder == 1 && strlen($strMatch)){
                     $arrReturn['title'] = $strMatch;
                     echo "Examined title: <b>" . $strMatch ."</b><br>" ;
                  }
                  if ($patternOrder == 2 && strlen($strMatch)){
                     $arrReturn['descr'] = $strMatch;
                     echo "Examined description: <b>" . $strMatch ."</b><br>" ;
                  }
               }
            }
            return $arrReturn;
         }
      }else{
         echo "Error! Could not open: <a href=\"$strURL\">" . $strURL."</a>";
      }
      echo "</p>";
   }


   ?>
   <form action="<?php echo basename($_SERVER['PHP_SELF'])?>" method="POST">
      <input type="text" name="strURL" value="<?php echo strlen($_POST['strURL']) ? $_POST['strURL'] : "http://"?>">
      <input type="submit" name="submit" value="Test URL"><br>
   </form>
   <?php
   if (isset($_POST['strURL'])){
      print_r(ExamineURL($_POST['strURL']));
   }

$content=file_get_contents("http://www.google.com",FALSE,NULL,0,20);
echo $content;

?>