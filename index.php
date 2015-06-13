<?php
	include_once('ClassCreator.php');
	
	if(isset($_POST['sbmt'])){
		$hostname = mysql_real_escape_string($_POST['hostname']);
		$user = mysql_real_escape_string($_POST['user']);
		$pwd = mysql_real_escape_string($_POST['pwd']);
		$db = mysql_real_escape_string($_POST['db']);
		//exit($hostname);
		$create = new ClassCreator();
		$create->startConnection($hostname,$user,$pwd,$db);
		$create->createClases();
		header('location: ./');
	}else{
		$hostname = 'localhost';
		$user = 'root';
		$pwd = '';
		$db = '';
	}
	
?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
    <title>Malaba Model Builder 0.1</title>

    <!-- Bootstrap -->
    <link href="css/bootstrap.min.css" rel="stylesheet">

    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
      <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
  </head>
<body role="document">

    <!-- Fixed navbar -->
    <nav class="navbar navbar-inverse navbar-fixed-top">
      <div class="container">
        <div class="navbar-header">
          <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
            <span class="sr-only">Toggle navigation</span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
          </button>
          <a class="navbar-brand" href="#">Malaba Model Builder 0.1</a>
        </div>
        <div id="navbar" class="navbar-collapse collapse">
          <ul class="nav navbar-nav">
            <li class="active"><a href="#">Home</a></li>
            <li><a href="#about">About</a></li>
            <li><a href="#contact">Contact</a></li>
            
          </ul>
        </div><!--/.nav-collapse -->
      </div>
    </nav>

    <div class="container theme-showcase" role="main">

      <!-- Main jumbotron for a primary marketing message or call to action -->
      <div class="jumbotron">
        <h2>Malaba Model Builder 0.1 For Codeigniter</h2>
        <p>An easier way to build large scale models.</p>
      </div>

	<?php
	$dir = scandir('./ClassCreator');	
	?>
      <div class="page-header">
        <h3><?php echo "The foolowing(".(sizeof($dir)-2).") models are in The ClassCreator Folder"; ?></h3>
		<?php
			if(sizeof($dir)-2){
				?>
				<input type="button" id="submit" value="CLEAR" class="btn btn-info" onclick="go()">
				<?php
			}
		?>
      </div>
      <div class="row">
		<div class="col-md-7">
          <table class="table table-striped">
            <thead>
              <tr>
                <th>#</th>
                <th>File Name</th>
                <th>Size</th>
                <th>Status</th>
              </tr>
            </thead>
            <tbody>
			<?php
				$i=0;
				foreach($dir as $file){
					$i++;
			?>
              <tr>
                <td><?php echo $i;?></td>
                <td><?php echo $file; ?></td>
                <td>Kb</td>
                <td>T</td>
              </tr>
              
            <?php
			}
			?>
            </tbody>
          </table>
        </div>
		
		<form role="form" method='POST' action=''>
            <div class="col-lg-5">
                <div class="well well-sm"></span><h4>Database Details</h4></strong></div>
                <div class="form-group">
                    <label for="hostname">Database Host</label>
                    <div class="input-group">
                        <input type="text" class="form-control" name='hostname' id='hostname' value='<?php echo $hostname; ?>' placeholder="Enter Database Host" required="">
                        <span class="input-group-addon"><span class="glyphicon glyphicon-asterisk"></span></span>
                    </div>
                </div>
                <div class="form-group">
                    <label for="user">Database User Name</label>
                    <div class="input-group">
                        <input type="text" class="form-control" name='user' id='user' value='<?php echo $user; ?>' placeholder="Enter Database User Name" required="">
                        <span class="input-group-addon"><span class="glyphicon glyphicon-asterisk"></span></span>
                    </div>
                </div>
                <div class="form-group">
                    <label for="pwd">Database Password</label>
                    <div class="input-group">
                        <input type="password" class="form-control" name='pwd' id='pwd' value='<?php echo $pwd; ?>' placeholder="Enter Database Password">
                        <span class="input-group-addon"><span class="glyphicon glyphicon-asterisk"></span></span>
                    </div>
                </div>
                <div class="form-group">
                    <label for="pwd">Database Name</label>
                    <div class="input-group">
                        <input type="text" class="form-control"name='db' id='db' value='<?php echo $db; ?>' placeholder="Enter Database Name" required="">
                        <span class="input-group-addon"><span class="glyphicon glyphicon-asterisk"></span></span>
                    </div>
                </div>
				<input type='hidden' name='sbmt' value='true'/>
                <input type="submit" name="submit" id="submit" value="CREATE" class="btn btn-info pull-right">
            </div>
        </form>
        
      </div>

      <div class="page-header">
        <h1>NB:</h1>
      </div>
      <div class="well">
        <p>The above models are found in the 'ClassCreator'
				folder in The Application Directory. 
				Make sure you copy the file 'my_model.php' found in the 'core'
				folder to your 'application\core' folder. Dont forget to clear files in the 'ClassCreator' folder for mantaining neatness.</p>
      </div>

    </div> <!-- /container -->
	<script>
		function go(){ document.location = './delete.php'; }
	</script>
	</body>
 </html>