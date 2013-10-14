<?php $this->Html->addCrumb('Contact Us', '/Contacts/index');?>
<div class="col_w620_w2col">
    <div class="col_w620_content">

        <h3>Contact Information</h3>

    </div>

    <div class="col_w300">

        <h6>LOCATION</h6><br />
        Shop 11, <br />
        20/2 Koornang Rd,<br />
        Carnegie VIC 3163<br /><br />

        Tel: 061-9572-2117<br /><br />

        Email: Blu-Waters@iinet.net.au<br />
    </div>

    <div class="col_w300 col_last">
        <h6>MAP LOCATION</h6>
        <iframe width="400" height="325" frameborder="0" scrolling="no" marginheight="0" marginwidth="0" src="https://maps.google.com.au/maps?q=shop+11,+2%2F20+koornang+road&amp;ie=UTF8&amp;hq=&amp;hnear=20%2F2+Koornang+Rd,+Carnegie+Victoria+3163&amp;gl=au&amp;ll=-37.88446,145.058679&amp;spn=0.002947,0.005681&amp;t=m&amp;z=14&amp;output=embed"></iframe><br /><small><a href="https://maps.google.com.au/maps?q=shop+11,+2%2F20+koornang+road&amp;ie=UTF8&amp;hq=&amp;hnear=20%2F2+Koornang+Rd,+Carnegie+Victoria+3163&amp;gl=au&amp;ll=-37.88446,145.058679&amp;spn=0.002947,0.005681&amp;t=m&amp;z=14&amp;source=embed" style="color:#0000FF;text-align:left">View Larger Map</a></small>
    </div>

    <div class="cleaner_h40"></div>

    <div id="contact_form">

        <h4> Contact Form</h4>
            <div class="col_w300">
                <?php
                echo $this->Form->create('Contact');
                echo $this->Form->input('name', array('label'=>"Name","required"));
                echo $this->Form->input('email', array('label'=>"Email","type"=>"email","required"));
                echo $this->Form->input('seccode', array('label'=>"Seccode","type"=>"text","required",'maxlength'=>4,'class'=>'contact_seccode',"after"=>'<img alt="" src="'.$webroot.'image/seccode" width="100px">'));
                ?>
                
            </div>
            <div class="col_w300 col_last">
                <?php
                echo $this->Form->input('message', array('label'=>"Message", 'type'=>"textarea","required"));
                echo $this->Form->submit();
                echo $this->Form->end();?>
                <div class="cleaner_h10"></div>
            </div>
    </div>
</div>



<div class="cleaner"></div>
