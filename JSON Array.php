<!DOCTYPE html>
<html>
<body>

<h2> Array from JSON</h2>
<p id="Trial"></p>

<script>
const myJSON = '["Car", "Bike", "Train"]';
const myArray = JSON.parse(myJSON);
document.getElementById("Trial").innerHTML = myArray;
</script>

</body>
</html>
