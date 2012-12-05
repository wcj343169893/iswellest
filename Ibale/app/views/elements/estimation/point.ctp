<?php for($i=0;$i<=4;$i++):?>
    <?php if ($point > $i && $point >= $i+1):?>
    <img src="/image/front/i_3.gif"/> 
    <?php elseif ($point > $i && $point < $i+1):?>
    <img src="/image/front/i_4.gif"/>
    <?php else:?> 
    <img src="/image/front/i_5.gif"/>
    <?php endif;?>
<?php endfor;?>