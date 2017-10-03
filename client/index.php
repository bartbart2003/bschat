<html>
<head>
<title>BSChat</title>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<script src="jquery.js"></script>
<style>
@import url('https://fonts.googleapis.com/css?family=Lato');
body {
	font-family: 'Lato', sans-serif;
	background-color: white;
}

/* === Start tabs === */
div.tab {
    overflow: hidden;
    border: 1px solid #ccc;
    background-color: gray;
}

/* buttons inside the tab */
div.tab button {
    background-color: inherit;
    float: left;
    border: none;
    outline: none;
    cursor: pointer;
    padding: 14px 20px;
    transition: 0.3s;
}

/* buttons background color on hover */
div.tab button:hover {
    background-color: gainsboro;
}

/* active/current tablink */
div.tab button.active {
    background-color: lightgray;
}

/* tab content */
.tabcontent {
    display: none;
    padding: 6px 12px;
    border: 1px solid #ccc;
    border-top: none;
} 
/* === End tabs === */

.textInput {
	background-color: lightgray;
	border: solid;
	border-radius: 8px;
}
.sendButton {
	background-color: gainsboro;
	border-radius: 10px;
	border: 1px solid gray;
	width: 80px;
	height: 40px;
}
.emoticonBox {
	border-left: 1px solid black;
	display: inline-block;
}
</style>
</head>
<body>
<center>
<div style="font-size: 25px;">BSChat (v0.3)</div>
</center>
<div id="messages" style="height: 66vh; overflow: auto; border-top: 1px solid black; border-bottom: 1px solid black;">
</div>
<center>
	
<!-- Translations -->
<?php
$lang = $_SERVER['HTTP_ACCEPT_LANGUAGE'];
switch(substr($lang, 0, 2))
{
	case "pl":
		putenv("LANG=pl_PL.UTF-8");
		setlocale(LC_ALL, "pl_PL.UTF-8");
		break;
	default:
		break;
	
}
bindtextdomain("translation", "locale");
textdomain("translation");
?>

<!-- Tabs -->
<?php echo gettext("Name:") ?> <input type="text" id="name" style="width: 20vw" class="textInput" value="<?php echo $_GET['name']; ?>">
 <div class="tab">
  <button class="tablinks" onclick="openFormTab(event, 'Text')" id="textButton"><?php echo gettext("Text") ?></button>
  <button class="tablinks" onclick="openFormTab(event, 'Image')"><?php echo gettext("Image") ?></button>
  <button class="tablinks" onclick="openFormTab(event, 'Emoticon')"><?php echo gettext("Emoticon") ?></button>
</div>

<!-- Tab: Message -->
<div id="Text" class="tabcontent">
<form action="../server/insert.php" method="get" style="margin-left: 1px; margin-right: 1px;" id="textForm">
 <?php echo gettext("Formatting:") ?><br>
  <input type="radio" name="formatting" value="normal" checked>Normal 
  <input type="radio" name="formatting" value="italic"><span style="font-style: italic">Italic </span>
  <input type="radio" name="formatting" value="strike"><span style="text-decoration: line-through">Strike</span>
  <br>
 <?php echo gettext("Message:") ?><br>
  <input type="text" name="content" style="width: 90vw" class="textInput"><br>
  <input type="submit" value="<?php echo gettext('Send') ?>" onclick="document.getElementById('textForm').getElementsByClassName('textFormNameHiddenInput')[0].value = document.getElementById('name').value" class="sendButton">
  <input type="hidden" name="name" value="" class="textFormNameHiddenInput" />
  <input type="hidden" name="type" value="text" />
  <input type="hidden" name="redir" value="true" />
  <input type="hidden" name="returnname" value="true" />
</form>
</div>

<!-- Tab: Image -->
<div id="Image" class="tabcontent">
<form action="../server/insert.php" method="get" style="margin-left: 1px; margin-right: 1px;" id="imageForm">
 URL:<br>
  <input type="text" name="content" style="width: 90vw" class="textInput"><br>
  <input type="submit" value="<?php echo gettext('Send') ?>" onclick="document.getElementById('imageForm').getElementsByClassName('imageFormNameHiddenInput')[0].value = document.getElementById('name').value" class="sendButton">
  <input type="hidden" name="name" value="" class="imageFormNameHiddenInput" />
  <input type="hidden" name="type" value="img" />
  <input type="hidden" name="redir" value="true" />
  <input type="hidden" name="returnname" value="true" />
</form>
</div>

<!-- Tab: Emoticon -->
<div id="Emoticon" class="tabcontent">
 <form action="../server/insert.php" method="get" style="margin-left: 1px; margin-right: 1px;" id="emoticonForm">
  <span class="emoticonBox" style="border-left: none;"><input type="radio" name="content" value="smile.png" checked><img src="../emoticons/smile.png" width="50px" height="50px"></img></span>
  <span class="emoticonBox"><input type="radio" name="content" value="sad.png"><img src="../emoticons/sad.png" width="50px" height="50px"></img></span>
  <span class="emoticonBox"><input type="radio" name="content" value="unknown-smiley.png"><img src="../emoticons/unknown-smiley.png" width="50px" height="50px"></img></span>
  <span class="emoticonBox"><input type="radio" name="content" value="cry-smiley.png"><img src="../emoticons/cry-smiley.png" width="50px" height="50px"></img></span>
  <span class="emoticonBox"><input type="radio" name="content" value="heart.png"><img src="../emoticons/heart.png" width="50px" height="50px"></img></span><br>
  <input type="submit" value="<?php echo gettext('Send') ?>" onclick="document.getElementById('emoticonForm').getElementsByClassName('emoticonFormNameHiddenInput')[0].value = document.getElementById('name').value" class="sendButton">
  <input type="hidden" name="name" value="" class="emoticonFormNameHiddenInput" />
  <input type="hidden" name="type" value="emoticon" />
  <input type="hidden" name="redir" value="true" />
  <input type="hidden" name="returnname" value="true" />
 </form>
</div>

</center>

<!-- Bottom text -->
<div style="text-align: right; font-size: 10px;"><?php echo gettext("by bartbart2003") ?></div>
<script>
// Tabs
function openFormTab(evt, tabName) {
    var i;
    var tabcontent;
    var tablinks;
    
    tabcontent = document.getElementsByClassName("tabcontent");
    for (i = 0; i < tabcontent.length; i++)
    {
        tabcontent[i].style.display = "none";
    }
    
    tablinks = document.getElementsByClassName("tablinks");
    for (i = 0; i < tablinks.length; i++)
    {
        tablinks[i].className = tablinks[i].className.replace(" active", "");
    }
    
    document.getElementById(tabName).style.display = "block";
    evt.currentTarget.className += " active";
} 

document.getElementById("textButton").click();

// Messages refreshing
var messagesAmount;
$.get("../server/messagescount.php", function(data)
{
  messagesAmount = data;
});

function loadLink()
{
    $('#messages').load('../server/messages.php',function () {
	$(this).unwrap();
    });
}

loadLink();
var newMessagesAmount;

setInterval(function()
{
	$.get("../server/messagescount.php", function(data)
	{
	  newMessagesAmount = data;
	  if (messagesAmount != newMessagesAmount)
		  {
			  loadLink();
			  messagesAmount = newMessagesAmount;
		  }
	});
}, 1000);
</script>
</body>
</html>
