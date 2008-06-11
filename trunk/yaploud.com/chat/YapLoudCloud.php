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
    	//$word = strtolower($word);
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
    	//print $this->max;
    	if (is_array($this->wordsArray))
    	{
    		$return = ($returnType == "html" ? "" : ($returnType == "array" ? array() : ""));
    		foreach ($this->wordsArray as $word => $popularity)
    		{
    			
    			$sizeRange = $this->getClassFromPercent(($popularity / $this->max) * 100);
    			print $sizeRange;
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
	$tagArray =array();
	$sql = "select distinct tag from chat_url_tag";
	$db = new DB();
	$result = $db->mysql_query($sql);
    while( ($row = mysql_fetch_assoc($result))) {
    	$word = $row['tag'];
     	//$tag = strtolower($word);
     	$tag_url = createLink($word);
     	$tagArray[] = array($tag_url=> 2);
    }
    //print_r ($tagArray);
    }
   
    function createLink($link = "") {
    	return '<a href="/search/find.php?searchby=tag&query=' .
                     $link . '">' . $link . '</a>';
    }
    $randomWords = getTagList();
    
    $cloud = new wordCloud($randomWords);
    
    $sql = "select tag from chat_url_tag";
	$db = new DB();
	$result = $db->mysql_query($sql);
	while( ($row = mysql_fetch_assoc($result))) {
    	$word = $row['tag'];
     	//$tag = strtolower($word);
     	$tag_url = createLink($word);
     	$cloud->addWord($tag_url, 1);
    }
   //print_r ($cloud->wordsArray);
    echo $cloud->showCloud();
    
   
    
    
    
    ?>
