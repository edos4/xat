<!DOCTYPE html>
<?php
	include('dbConnect.php');
?>
<html>
<head>
    <meta charset="utf-8" />
    <title><?php echo title;?></title>
    <script src="js/jquery1.11.js"></script>
    <script src="js/jqueryui.js"></script>
    <script src="js/jquery.mousewheel-min.js"></script>
    <script src="js/jquery.terminal-min.js"></script>
	<script src="js/passwordPrompt.js"></script>
    <link href="css/jquery.terminal.css" rel="stylesheet" />
	<link href="css/theme.css" rel="stylesheet" />
	<link rel="icon" type="image/ico" href="favicon.ico"/>
</head>

<body>
    <div id="terminalWindow" class="ui-widget-content">
        <div id="panel">
            <div id="title"><?php echo title;?></div>
        </div>
        <br>
        <div id="termDiv"></div>
    </div>
    <script>
        jQuery(document).ready(function($) {
		    var id = 1;
			$("#terminalWindow").draggable();
            var terminal = $('#termDiv').terminal(function(command, term) {
                var q = command.split(" ");
				if(q[0]=='login'){
					if(q[1]){
						password_prompt("Please enter your password:", "Submit", function(password) {
							$.ajax({
								type: "POST",
								url: 'login.php',
								data: {
									username: q[1],
									password: password
								},
								success: function(data){
									if (data === 'true') {
										term.echo("Welcome, "+q[1]);
										term.set_prompt(q[1]+":# ");
									}
									else {
										term.error("Incorrect username or password.");
									}
								}
							});
						});
					}
					else{
						term.error("Syntax: login <username>");
					}
				}
				else if(q[0]=='reg'){
					if(q[1] && q[2] && q[3]){
						password_prompt("Please enter your password:", "Submit", function(password) {
							$.ajax({
								type: "POST",
								url: 'reg.php',
								data: {
									name: q[1],
									email: q[2],
									username: q[3],
									password: password
								},
								success: function(data){
									if (data === 'true') {
										term.echo("Successfully registered "+q[1]);
									}
									else {
										term.error(data);
									}
								}
							});
						});
					}
					else{
						term.error("Syntax: reg <name> <email> <username>");
					}
				}
                else if (q[0] == 'help') {
                    term.echo("Available commands are: reg, login");
                }else {
                    term.error("Unknown command " + command + ". Enter <help> for command list.");
                }
            }, {
                scroll: 1,
                name: '<?php echo title;?>',
                greetings: "Enter <help> for command list.",
                prompt: '<?php echo title;?>:~$ '
            });
        });
    </script>
	<div id="footer">
		<a href="https://github.com/edos4/xat">Code</a> | <a href="https://trello.com/b/WpXaAi9x/xat">Docu</a>
	</div>
</body>

</html>