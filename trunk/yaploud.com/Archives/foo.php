<script type=text/javascript>
function cl(e){
   for(i in e){
      document.write(i + ' ' + e[i] + '<br/>');
   }
   e.returnValue = 'sure you want to leave yaploud?';
}
window.onbeforeunload = cl;
</script>
