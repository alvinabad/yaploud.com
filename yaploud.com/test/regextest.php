<?php
require('../chat/bad_words.inc');
print $_REQUEST['test'];

?>


<?php
print preg_replace($bad_words, 'asdf', $_REQUEST['test']);
?>
