<html>
<body>
This is a test! <br />
<a href="javascript:test()">Test</a> <br />
<div id="testDiv"></div>
<script type="text/javascript">
function test() {
  document.getElementById("testDiv").innerHTML = "WHOA!";
}
</script>
</html>