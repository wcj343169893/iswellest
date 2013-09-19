<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <meta name="keywords" content="Blu Water, Seafood, Cooking Class" />
    <meta name="description" content="Blu Water, Seafood, Cooking Class" />
    <?php echo $this->Html->charset(); ?>
    <title>
        <?php echo $title_for_layout; ?>
    </title>
<?php echo $this->Html->css(array('bootstrap.css', 'css.css','style.css', 'bootstrap-responsive.css')); ?>
<link rel="stylesheet" type="text/css" href="http://ajax.googleapis.com/ajax/libs/jqueryui/1.9.1/themes/smoothness/jquery-ui.css" />
<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.8/jquery.min.js"></script>
<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jqueryui/1.9.1/jquery-ui.min.js"></script>
<?php echo $this->Html->script(array('bootstrap.js', 'js.js','jquery.slidertron-1.1.js')); ?>
<?php echo $this->App->js(); ?>
<?php echo $this->fetch('meta'); ?>
<?php echo $this->fetch('css'); ?>
<?php echo $this->fetch('script'); ?>
</head>
<body>
<div id="templatemo_wrapper">
    <div id="templatemo_header">
        <div id="site_title">
            <h1><a href="/"><strong>Blu-Waters</strong><span>High Quality Seafood</span></a></h1>
        </div> <!-- end of site_title -->
        <div id="templatemo_menu">
            <ul>
                <?php
                echo "<li class='important'>".$this->html->link('Home', '/')."</li>";
                echo "<li>".$this->html->link('About Us', '../pages/about')."</li>";
                echo "<li>".$this->html->link('Product', '../products/')."</li>";
                echo "<li>".$this->html->link('Cooking Class', '/cooking')."</li>";
                echo "<li>".$this->html->link('Contact Us', '../contacts')."</li>";
              /*  echo $form->create("Post",array('action' => 'search'));
                    echo $form->input("q", array('label' => 'Search for'));
                    echo $form->end("Search");
               */
                ?>

            </ul>
        </div> <!-- end of templatemo_menu -->
    </div>
    <div id="templatemo_middle">
        <div id='search-box'>
            <form action='<?php echo $webroot?>products' id='search-form' method='get' target='_top'>
                <input id='search-text' name='q' placeholder='Search...' type='text' value="<?php echo !empty($key)?$key:""?>"/>
                <button id='search-button' type='submit'><span>Search</span></button>
            </form>
        </div>
    </div>

    <div id="templatemo_content">
        <div id=".login_c">
        <h6><?php echo $this->Html->getCrumbs(' > ','Home');?></h6>
        </div>
        <div class="login_d">
            <?php if ($logged_in):    ?>
                <h6>Welcome  &nbsp <?php echo $this->Html->link(__($current_user['username']), array('controller'=>'users','action'=>null)); ?> &nbsp&nbsp
                    <?php echo $this->Html->link('Logout', array('controller'=>'users','action'=>'logout')); ?></h6>
            <?php else:  ?>
                <?php echo $this->Html->link('Login', array('controller'=>'users','action'=>'login')); ?>&nbsp&nbsp
                <?php echo $this->html->link('Register', '/users/add')."<br>"; ?>
            <?php endif;  ?>
        </div></br>
        <?php echo $this->Session->flash(); ?>
        <?php echo $this->fetch('content'); ?>
    </div>
    <div id="templatemo_footer">
        <p>© 2013 Untitled Inc. All rights reserved. <a href="../pages/home">Blu Water Seafood</a>. Design by Carp-e-Diem.</p>
    </div>
</div>
<div id="msg"></div>
</body>
</html>