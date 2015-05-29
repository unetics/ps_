<?php
	
function add_dashboard_widget()
{
    add_meta_box( 'todo', 'You have work TODO', 'TODO_dashboard_widget', 'dashboard', 'side', 'high' );
}

function TODO_dashboard_widget()
{
	
	global $theme_options;
	
	$todos = array();
	
// 	check fav icon
if ($theme_options['fav-icon']['url'] == 'http://assets.webcreationcentre.com.au/favicon.ico'){	
	$todos[] = 'Add Custom favicon <a href="/wp-admin/themes.php?page=_options">HERE</a>';
}elseif ($theme_options['fav-icon']['url'] == ''){
	$todos[] = 'Add a favicon <a href="/wp-admin/themes.php?page=_options">HERE</a>';
}
	
// 	check analitics
if ($theme_options['analitics'] == ''){	
	$todos[] = 'You Need to add your analitcis code <a href="/wp-admin/themes.php?page=_options">HERE</a>';
}	

// 	check webmaster tools
if ($theme_options['GoogleWT'] == ''){	
	$todos[] = 'You Need to add your webmaster tools code <a href="/wp-admin/themes.php?page=_options">HERE</a>';
}	

// 	check footer text
if ($theme_options['copyright'] == '&copy; [current-year] VR Enviro Services'){	
	$todos[] = 'You should customise your footer text <a href="/wp-admin/themes.php?page=_options">HERE</a>';
}elseif ($theme_options['copyright'] == ''){
	$todos[] = 'You should add some footer text <a href="/wp-admin/themes.php?page=_options">HERE</a>';
}

// 	check for custom user
$users = count_users();
// log_me($users);
if ($users['total_users']  < 3){	
	$todos[] = 'You should create a custom user account for the client <a href="/wp-admin/user-new.php">HERE</a>';
}


$things_to_do = count($todos);
if ($things_to_do != 0){?>

<ul class="todo_items">
	<li class="todo"> you have <span><?= $things_to_do?></span> things left TODO</li>
	<?php 
		foreach ($todos as $todo) {
		 echo('<li>');
		 echo($todo);
		 echo('</li>');
		}
		?>
</ul>
<style type="text/css" media="screen">
	#todo{
		  background-color: white;
  border: 1px solid #d8dbe1;
  border-radius: 4px;
  box-shadow: 0px 1px 1px 0px rgba(128,138,158,0.33);
	}
	#todo .hndle{
		display: none
	}
	.todo_items li{
		border: 1px solid #d8dbe1;
		background: #eee;
		padding: 10px;
		margin: 0;
	}
	.todo_items li:hover{
		background: #e3e3e3;
	}
	li.todo{
		background:white;
	}
	li.todo span{
		background: red;
		color: white ;
		padding: 2px 4px;
		border-radius: 4px;
	}
</style>

<?php 
	}else{
		echo('<li class="todo"> you have <span>0</span> things left TODO well done</li>');
	}
}

add_action("wp_dashboard_setup", "add_dashboard_widget");


