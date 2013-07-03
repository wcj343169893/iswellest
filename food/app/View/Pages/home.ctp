<div id="slider">
    <div class="viewer">
        <div class="reel">
            <div class="slide">
                <h2>First Picture.</h2>
                <p>Description 1.</p>
                <?php echo $this->Html->image('../img/images/img01.jpg', array('alt' => 'CakePHP','height' => 500, 'width' => 800));?> </div>
            <div class="slide">
                <h2>Second Picture</h2>
                <p>Description 2</p>
                <?php echo $this->Html->image('../img/images/img02.jpg', array('alt' => 'CakePHP','height' => 500, 'width' => 800));?> </div>
            <div class="slide">
                <h2>Third Picture</h2>
                <p>Description 3</p>
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
