<?
class wordCloud
{
    var $wordsArray = array();

    function __construct($words = false)
    {
    	if ($words !== false && is_array($words))
    	{
    	foreach ($words as $key => $value)
    		{
    		$this->addWord($value);
    		}
    	}
    }

    /* this will support older versions of php without constructor */
    function wordCloud($words = false)
    {
    	$this->__construct($words);
    }

    function addWord($word, $value = 1)
    {
    	$word = strtolower($word);
    	if (array_key_exists($word, $this->wordsArray))
    		$this->wordsArray[$word] += $value;
    	else
    		$this->wordsArray[$word] = $value;
    	return $this->wordsArray[$word];
    }

    function shuffleCloud()
    {
    	$keys = array_keys($this->wordsArray);
    	shuffle($keys);

    	if (count($keys) && is_array($keys))
    	{
    		$tmpArray = $this->wordsArray;
    		$this->wordsArray = array();
    		foreach ($keys as $key => $value)
    		$this->wordsArray[$value] = $tmpArray[$value];
    	}
    }

    function getCloudSize()
    {
    	return array_sum($this->wordsArray);
    }

    function getClassFromPercent($percent)
    {
	    if ($percent >= 99)
    		$class = 1;
    	else if ($percent >= 70)
    		$class = 2;
    	else if ($percent >= 60)
    		$class = 3;
    	else if ($percent >= 50)
    		$class = 4;
    	else if ($percent >= 40)
    		$class = 5;
    	else if ($percent >= 30)
    		$class = 6;
    	else if ($percent >= 20)
    		$class = 7;
    	else if ($percent >= 10)
    		$class = 8;
    	else if ($percent >= 5)
    		$class = 9;
    	else
    		$class = 0;

    	return $class;
    }

    function showCloud($returnType = "html")
    {
    	$this->shuffleCloud();
    	$this->max = max($this->wordsArray);
    	if (is_array($this->wordsArray))
    	{
    		$return = ($returnType == "html" ? "" : ($returnType == "array" ? array() : ""));
    		foreach ($this->wordsArray as $word => $popularity)
    		{
    			$sizeRange = $this->getClassFromPercent(($popularity / $this->max) * 100);
    			if ($returnType == "array")
    			{
    			$return[$word]['word'] = $word;
   				$return[$word]['sizeRange'] = $sizeRange;
    			if ($currentColour)
    				$return[$word]['randomColour'] = $currentColour;
    			}
    			else if ($returnType == "html")
    			{
    				$return .= "<span class='word size{$sizeRange}'> {$word} </span>";
    			}
    		}
    	return $return;
    	}
    }
}
?>

    <style>
    <!--
    .word {
    font-family: Tahoma;
    padding: 4px 4px 4px 4px;
    letter-spacing: 3px;
    }
    span.size1 {
    color: #000;
    font-size: 2.4em;
    }
    span.size2 {
    color: #333;
    font-size:2.2em;
    }
    span.size3 {
    color: #666;
    font-size: 2.0em;
    }
    span.size4 {
    color: #999;
    font-size: 1.0em;
    }
    span.size5 {
    color: #aaa;
    font-size: 1.6em;
    }
    span.size6 {
    color: #bbb;
    font-size: 1.4em;
    }
    span.size7 {
    color: #ccc;
    font-size: 1.2em;
    }
    span.size8 {
    color: #ddd;
    font-size: .8em;
    }
    span.size0 {
    color: #ccc;
    font-size: .6em;
    }
    //-->
    </style>

    <?
    function getTagList() {
	$Array =array();
	$sql = "select distinct tag from chat_url_tag";
	$db = new DB();
	$result = $db->mysql_query($sql);
	//print $result;
    $count = 1;
    while( ($row = mysql_fetch_assoc($result)) && ($count < 30) ) {
     $word = $row['tag'];
     $tag = strtolower($word);
     $tag_url = createLink($tag);
     $Array[] = $tag_url;
     $count = $count + 1;
    //print $row['tag'];
    }
    return $Array;
    
    }
    function createLink($link = "") {
    	return '<a href="/search/find.php?searchby=tag&query=' .
                     $link . '">' . $link . '</a>';
    }
    $randomWords = getTagList();
    /*$randomWords = array(
    "webmasterworld", "Computer", "Skateboarding", "PC", "music", "music", "music", "music", "PHP", "C", "XHTML", "eminem", "programming", "forums", "webmasterworld",
    "Chill out", "email", "forums", "Computer", "GTA", "css", "mysql", "sql", "css", "mysql", "sql",
    "forums", "internet", "class", "object", "method", "music", "music", "music", "music", "gui", "encryption"
    );*/

    $cloud = new wordCloud($randomWords);
    
    $cloud->addWord(createLink("news"), 12);
    $cloud->addWord(createLink("cnn"), 8);
    $cloud->addWord(createLink("democrat"), 17);
    $cloud->addWord(createLink("blog"), 22);
    $cloud->addWord(createLink("events"), 32);
    echo $cloud->showCloud();
    
   
    
    
    
    ?>
