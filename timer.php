
<head>
<style>

h1{
  color: #396;
  font-weight: 100;
  font-size: 40px;
  margin: 40px 0px 20px;
}
 #clockdiv{
    font-family: sans-serif;
    color: #fff;
    display: inline-block;
    font-weight: 100;
    text-align: center;
    font-size: 30px;
}
#clockdiv > div{
    padding: 10px;
    border-radius: 3px;
    background: #00BF96;
    display: inline-block;
}
#clockdiv div > span{
    padding: 15px;
    border-radius: 3px;
    background: #00816A;
    display: inline-block;
}
smalltext{
    padding-top: 5px;
    font-size: 16px;
}
</style>
</head>
<body>
  <div id="tim_er">
  <input type="number" min="0" max="23" id="hs" name="hours" placeholder="Hours" autofocus required>
  <input type="number" min="0" max="59" id="mins" name="mins" placeholder="Minutes" required>
  <input type="number" min="0" max="59" id="secs" name="secs" placeholder="Seconds" required><br><br>
  <input type="submit" class = "submit-button" value="Count" onclick="count()"></div>
  <button class = "submit-button" onclick="reset()">Reset</button>

<h1>Countdown Clock</h1>
<div id="clockdiv">
  <div>
    <span class="hours" id="hour"></span>
    <div class="smalltext">Hours</div>
  </div>
  <div>
    <span class="minutes" id="minute"></span>
    <div class="smalltext">Minutes</div>
  </div>
  <div>
    <span class="seconds" id="second"></span>
    <div class="smalltext">Seconds</div>
  </div>
</div>

<p id="demo"></p>

<script>
var text ='';
var x;
function reset() {
   clearInterval(x);
   document.getElementById("demo").innerHTML = "CLEARED";
   document.getElementById("hour").innerHTML ='0';
   document.getElementById("minute").innerHTML ='0' ;
   document.getElementById("second").innerHTML = '0';
   document.getElementById("tim_er").style.display = 'block';
}

function count() {
var h = document.getElementById('hs').value;
var m = document.getElementById('mins').value;
var s = document.getElementById('secs').value;

text = 'feb 10, 2020 '+h+':'+m+':'+s;


var deadline = new Date(text).getTime();
document.getElementById("tim_er").style.display = 'none';
x = setInterval(function() {

var now = new Date().getTime();
var t = deadline - now;

var hours = Math.floor((t%(1000 * 60 * 60 * 24))/(1000 * 60 * 60));
var minutes = Math.floor((t % (1000 * 60 * 60)) / (1000 * 60));
var seconds = Math.floor((t % (1000 * 60)) / 1000);
document.getElementById("hour").innerHTML =hours;
document.getElementById("minute").innerHTML = minutes;
document.getElementById("second").innerHTML =seconds;
if (t < 0) {
        clearInterval(x);
        document.getElementById("demo").innerHTML = "TIME UP";
        document.getElementById("hour").innerHTML ='0';
        document.getElementById("minute").innerHTML ='0' ;
        document.getElementById("second").innerHTML = '0';
        document.getElementById("tim_er").style.display = 'block';
        $.ajax({
            type:'POST',
            url:'sms/sms.php',
            data:'help='+help+'&userUid='+<?php echo $_SESSION['lat']; ?>+'&latitude='+<?php echo $_SESSION['lat']; ?>+'&longitude='+<?php echo $_SESSION['long']; ?>,
        });
      }
}, 1000);

}
</script>
