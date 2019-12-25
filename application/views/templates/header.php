<!DOCTYPE html>
<html lang="en">
<head>
    <link rel="SHORTCUT ICON" href="<?php echo base_url();?>assets/icons/facebook.jpg"/>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title><?= $title;?></title>
    <link rel="stylesheet" href="<?php echo base_url();?>assets/css/bootstrap.css">
    <link rel="stylesheet" href="<?php echo base_url();?>assets/css/main.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
</head>
<body>
<?php 
global $site_title;
if($this->session->has_userdata('logged_in')){?>
    <nav class="navbar navbar-default">
        <div class="container-fluid"> 
            <div class="navbar-header">
                <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1"> <span class="sr-only">Toggle navigation</span> <span class="icon-bar"></span> <span class="icon-bar"></span> <span class="icon-bar"></span> </button>
                <a class="navbar-brand" href="<?php echo site_url('myaccount');?>"><img alt="140x140" class="display-icon" src="<?php echo base_url();?>assets/icons/facebook.jpg"></a><a class="navbar-brand" href="<?php echo site_url('myaccount');?>"><font color='black'><b><?= $site_title;?></b></font></a> 
            </div>
            <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
                <ul class="nav navbar-nav">
                    <li>
                        <a class="navbar-brand image-expand" href="#">
                            <img id="myImg" class="image-class" src="<?php echo base_url().$userdata['profile_pic'];?>" alt="<?php echo strtolower($userdata['fname']).".".strtolower($userdata['lname']);?>" title="Click to expand">
                        </a> 
                    </li>
                    <li>
                        <a href="<?php echo site_url('myprofile');?>" title="<?php echo strtolower($userdata['fname']).".".strtolower($userdata['lname']);?>">
                        <font color='black'><b><?php echo ucfirst($userdata['fname'])." ".ucfirst($userdata['lname']);?></b></font>
                        </a>
                    </li>
                </ul>
                <ul class="nav navbar-nav navbar-right">
                    <li class="dropdown"> 
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">
                            <i class="fa fa-comments" aria-hidden="true"></i> <span class="caret"></span>
                        </a>
                        <ul class="dropdown-menu" role="menu">
                            <li>
                                <a href='#'><i class="fa fa-comments" aria-hidden="true"></i> <span style="color:red;">(Coming Soon)</span></a> 
                            </li>
                        </ul>
                    </li>
                    <li class="dropdown">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">
                            <i class="fa fa-birthday-cake" aria-hidden="true"></i><span style="color:red;"><b><?php echo count($friendData);?></b></span><span class="caret"></span>
                        </a>
                        <ul class="dropdown-menu" role="menu">
                        <?php
                        $birthday_msg = "<li><a href='#'>None of your friends has Birthday today!!</a></li>";
                        if( count($friendData) > 0 ) {
                            $birthday_msg = '';
                            foreach($friendData as $fdata) {
                                $birthday_msg .= "<li><a href='#'><img src='".base_url().$fdata["profile_pic"]."' height='30px' width='30px' alt='/''> Today is <b>".ucfirst($fdata["fname"])." ".ucfirst($fdata["lname"])."'s</b> birthday..</a></li>";
                            }
                        }
                        echo $birthday_msg;
                        ?>
                        </ul>
                    </li>
                    <li class="dropdown">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">
                            <i class="fa fa-handshake-o" aria-hidden="true"></i><span style="color:red;"><b><?php echo count($friendRequest);?></b></span><span class="caret"></span>
                        </a>
                        <ul class="dropdown-menu" role="menu">
                        <?php
                        $request_msg = "<li><a href='#'>No Friend Requests !!</a></li>";
                        if( count($friendRequest) > 0 ) {
                            $request_msg = '';
                            foreach($friendRequest as $freq) {
                                $request_msg .= "<li><a href='#'><img src='".base_url().$freq["profile_pic"]."' height='30px' width='30px' alt='/''> <b>".ucfirst($freq["fname"])." ".ucfirst($freq["lname"])."</b> wants to be your friend.</a></li>";
                            }
                        }
                        echo $request_msg;
                        ?>
                        </ul>
                    </li>
                    <li class="dropdown"> 
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">
                            <i class="fa fa-globe" aria-hidden="true"></i><span style="color:red;"><b><?= count($friendResponse);?></b></span> <span class="caret"></span>
                        </a>
                        <?php
                        $response_msg = '';
                        if( count($friendResponse)>0 ){
                            $response_msg .= "<ul class='dropdown-menu' role='menu'>";
                            foreach ($friendResponse as $r) {
                                $response_msg .= "<li><a href='#'><img src='".base_url().$r["profile_pic"]."' height='30px' width='30px' alt='/'> <b>".ucfirst($r["fname"])." ".ucfirst($r["lname"])."</b> accepted your friend request.</a></li>";
                            }
                            $response_msg .= "</ul>";
                        }
                        echo $response_msg;
                        ?>
                    </li>
                    <li class="dropdown"> 
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">
                            <i class="fa fa-align-justify" aria-hidden="true"></i> <span class="caret"></span>
                        </a>
                        <ul class="dropdown-menu" role="menu">
                            <li>
                                <a href="<?php echo site_url('myaccount');?>"><i class="fa fa-home" aria-hidden="true"></i> Home
                                </a> 
                            </li>
                            <li>
                                <a href="<?php echo site_url('myprofile');?>"><i class="fa fa-user" aria-hidden="true"></i> Profile</a> 
                            </li>
                            <li>
                                <a href="#"><i class="fa fa-users" aria-hidden="true"></i> Friends</a> 
                            </li>
                            <li>
                                <a href="#"><i class="fa fa-bell" aria-hidden="true"></i> Notifications</a> 
                            </li>
                            <li>
                                <a href="#"><i class="fa fa-gear" aria-hidden="true"></i> Settings</a> 
                            </li>
                            <li class="divider"></li>
                            <li>
                                <a href="<?php echo site_url('logout');?>"><i class="fa fa-sign-out" aria-hidden="true"></i> LogOut</a> 
                            </li>
                        </ul>
                    </li>
                </ul>
                <div class="col-md-6 search-div-class">
                    <input type="text" class="form-control" name="search_friends" id="search_friends" placeholder="Search friends..." autocomplete="off">
                    <div class="loader-div">
                        <img class="loader-image" src="<?php echo base_url();?>assets/images/loader/loader1.gif">
                    </div>
                    <div class="col-md-12 friend_list"></div>
                </div>
            </div> 
        </div> 
    </nav>
<?php
}else{
    ?>
    <nav class="navbar navbar-default">
		<div class="container-fluid"> 
			<div class="navbar-header">
				<button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1"> <span class="sr-only">Toggle navigation</span> <span class="icon-bar"></span> <span class="icon-bar"></span> <span class="icon-bar"></span> </button>
				<a class="navbar-brand" href="<?php echo site_url('/');?>">
                    <img alt="140x140" class="display-icon" src="<?php echo base_url();?>assets/icons/facebook.jpg"></a><a class="navbar-brand" href="<?php echo site_url('/');?>"><font color='black'><b><?php echo $site_title;?></b></font>
                </a> 
			</div>
			<div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
				<form class="navbar-form navbar-right" role="search" method="post" action="<?php echo site_url('Authenticate');?>">
					<div class="form-group">
						<input type="email" class="form-control" name="login-email" placeholder="Email ID" required>
					</div>
					<div class="form-group">
						<input type="password" class="form-control" name="login-pwd" placeholder="Password" required>
					</div>
					<div class="form-group">
						<button type="submit" class="btn btn-primary" name="login-button">Login</button>
					</div>
					<?php echo $this->session->flashdata('login_failed');?>
				</form>

				<ul class="nav navbar-nav navbar-right">
					<li><a href="<?php echo site_url('forgot_password');?>">Forgotten Account?</a></li>
				</ul>
			</div>
		</div>
	</nav>
    <?php
}
?>