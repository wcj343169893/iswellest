<div id="slider">
    <div class="viewer">
        <div class="reel">
            <div class="slide">

                <?php echo $this->Html->image('../img/images/img01.jpg', array('alt' => 'CakePHP','height' => 500, 'width' => 800));?> </div>
            <div class="slide">
                <?php echo $this->Html->image('../img/images/img02.jpg', array('alt' => 'CakePHP','height' => 500, 'width' => 800));?> </div>
            <div class="slide">
                <?php echo $this->Html->image('../img/images/img03.jpg', array('alt' => 'CakePHP','height' => 500, 'width' => 800));?> </div>
        </div>
    </div>
    <div class="indicator">
        <ul>
            <li class="active">1</li>
            <li>2</li>
            <li>3</li>
        </ul>
    </div>
</div>
<script type="text/javascript">
    $('#slider').slidertron({
        viewerSelector: '.viewer',
        reelSelector: '.viewer .reel',
        slidesSelector: '.viewer .reel .slide',
        advanceDelay: 3000,
        speed: 'slow',
        navPreviousSelector: '.previous-button',
        navNextSelector: '.next-button',
        indicatorSelector: '.indicator ul li',
        slideLinkSelector: '.link'
    });
</script>

        <div style="clear: both;">&nbsp;</div>
