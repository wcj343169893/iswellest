<?php
Router::connect('/admin',array("plugin"=>"Admin","controller"=>"Dashboard","action"=>"display"));
Router::connect('/admin/*',array("plugin"=>"Admin"));