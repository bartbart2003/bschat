<html>
<head>
<title>BSChat</title>
<meta charset='utf-8'>
<meta name='viewport' content='width=device-width, initial-scale=1.0"'>
<script src='jquery.js'></script>
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
.sendButton:hover {
	transition-duration: 0.3s;
	background-color: gray;
	cursor: pointer;
}
.elementBox {
	border-radius: 10px;
	background-color: lightgray;
	display: inline-block;
}
</style>
</head>
<body>
<!-- Translations -->
<?php
$lang = $_SERVER['HTTP_ACCEPT_LANGUAGE'];
switch(substr($lang, 0, 2))
{
	case 'pl':
		putenv('LANG=pl_PL.UTF-8');
		setlocale(LC_ALL, 'pl_PL.UTF-8');
		break;
	default:
		break;
	
}
bindtextdomain('translation', 'locale');
textdomain('translation');
?>
<center>
<div style='font-size: 25px; font-weight: bold;' id='servertitle'>An BSChat server</div><div style='font-size: 15px;'><?php echo gettext('Powered by BSChat v0.4') ?></div>
</center>
<div id='messages' style='height: 66vh; overflow: auto; border-top: 1px solid black; border-bottom: 1px solid black;'>
</div>
<center>

<!-- Name -->
<?php echo gettext('Name:') ?> <input type="text" id="name" style="width: 20vw" class="textInput" value='<?php if (isset($_GET['name'])) { echo $_GET['name']; } ?>'>

<!-- Tabs -->
 <div class="tab">
  <button class='tablinks' onclick="openFormTab(event, 'Text')" id='textButton'><?php echo gettext('Text') ?></button>
  <button class='tablinks' onclick="openFormTab(event, 'Image')"><?php echo gettext('Image') ?></button>
  <button class='tablinks' onclick="openFormTab(event, 'Emoji')"><?php echo gettext('Emoji') ?></button>
</div>

<!-- Tab: Message -->
<div id='Text' class='tabcontent'>
<form action='../server/insert.php' method='get' style='margin-left: 1px; margin-right: 1px;' id='textForm'>
 <?php echo gettext('Formatting:') ?><br>
  <span class='elementBox'><input type="radio" name="formatting" value='normal' checked><?php echo gettext('Normal') ?> 
  <input type="radio" name="formatting" value='italic'><span style='font-style: italic'><?php echo gettext('Italic') ?> </span>
  <input type="radio" name="formatting" value='strike'><span style='text-decoration: line-through'><?php echo gettext('Strike') ?></span>
  <input type="radio" name="formatting" value='underline'><span style='text-decoration: underline'><?php echo gettext('Underline') ?></span></span>
  <br>
 <?php echo gettext('Message:') ?><br>
  <input type='text' name='content' style='width: 90vw' class='textInput'><br>
  <input type='submit' value="<?php echo gettext('Send') ?>" onclick="document.getElementById('textForm').getElementsByClassName('textFormNameHiddenInput')[0].value = document.getElementById('name').value" class="sendButton">
  <input type='hidden' name='name' value='' class='textFormNameHiddenInput' />
  <input type='hidden' name='type' value='text' />
  <input type='hidden' name='redir' value='true' />
  <input type='hidden' name='returnname' value='true' />
</form>
</div>

<!-- Tab: Image -->
<div id='Image' class='tabcontent'>
<form action='../server/insert.php' method='get' style='margin-left: 1px; margin-right: 1px;' id='imageForm'>
 URL:<br>
  <input type='text' name='content' style='width: 90vw' class='textInput'><br>
  <input type='submit' value="<?php echo gettext('Send') ?>" onclick="document.getElementById('imageForm').getElementsByClassName('imageFormNameHiddenInput')[0].value = document.getElementById('name').value" class="sendButton">
  <input type='hidden' name='name' value='' class='imageFormNameHiddenInput' />
  <input type='hidden' name='type' value='img' />
  <input type='hidden' name='redir' value='true' />
  <input type='hidden' name='returnname' value='true' />
</form>
</div>

<!-- Tab: Emoji -->
<div id='Emoji' class='tabcontent'>
 <form action='../server/insert.php' method='get' style='margin-left: 1px; margin-right: 1px;' id='emojiForm'>
  <span class='elementBox'><input type='radio' name='content' value='smile.png' checked><img src='../emojis/smile.png' width='50px' height='50px'></img></span>
  <span class='elementBox'><input type='radio' name='content' value='sad.png'><img src='../emojis/sad.png' width='50px' height='50px'></img></span>
  <span class='elementBox'><input type='radio' name='content' value='simple-emoticon-4.png'><img src='../emojis/simple-emoticon-4.png' width='50px' height='50px'></img></span>
  <span class='elementBox'><input type='radio' name='content' value='question-face.png'><img src='../emojis/question-face.png' width='50px' height='50px'></img></span>
  <span class='elementBox'><input type='radio' name='content' value='unknown-smiley.png'><img src='../emojis/unknown-smiley.png' width='50px' height='50px'></img></span>
  <span class='elementBox'><input type='radio' name='content' value='cry-smiley.png'><img src='../emojis/cry-smiley.png' width='50px' height='50px'></img></span>
  <span class='elementBox'><input type='radio' name='content' value='heart.png'><img src='../emojis/heart.png' width='50px' height='50px'></img></span><br>
  <input type='submit' value="<?php echo gettext('Send') ?>" onclick="document.getElementById('emojiForm').getElementsByClassName('emojiFormNameHiddenInput')[0].value = document.getElementById('name').value" class='sendButton'>
  <input type='hidden' name='name' value='' class='emojiFormNameHiddenInput' />
  <input type='hidden' name='type' value='emoji' />
  <input type='hidden' name='redir' value='true' />
  <input type='hidden' name='returnname' value='true' />
 </form>
</div>

</center>

<!-- Bottom text -->
<div style='text-align: right; font-size: 10px;'><a href='about.html' style='color: black;'><?php echo gettext('BSChat (by bartbart2003) - About') ?></a> | <a href='rules.html' style='color: black;'><?php echo gettext('Chat rules') ?></a></div>

<script>
// Server title
$.get('../server/servertitle.php', function(data)
{
  document.getElementById('servertitle').innerHTML = data;
   document.title = data + ' - BSChat';
});

// Tabs
function openFormTab(evt, tabName) {
    var i;
    var tabcontent;
    var tablinks;
    
    tabcontent = document.getElementsByClassName('tabcontent');
    for (i = 0; i < tabcontent.length; i++)
    {
        tabcontent[i].style.display = 'none';
    }
    
    tablinks = document.getElementsByClassName('tablinks');
    for (i = 0; i < tablinks.length; i++)
    {
        tablinks[i].className = tablinks[i].className.replace(' active', '');
    }
    
    document.getElementById(tabName).style.display = 'block';
    evt.currentTarget.className += ' active';
} 

document.getElementById('textButton').click();

// Messages refreshing
var messagesAmount;
$.get('../server/messagescount.php', function(data)
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
	$.get('../server/messagescount.php', function(data)
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
