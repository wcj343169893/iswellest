<script type="text/javascript" src="/js/jquery-1.3.2.min.js"></script>
<script type="text/javascript" src="/js/area.js"></script>

<?php echo $form->create('Test');?>
<?php echo $form->select('province', $provinceList, null, array('empty'=>__('label.pleaseSelect', true)));?>
<?php echo $form->select('city', $cityList, null, array('empty'=>__('label.pleaseSelect', true)));?>
<?php echo $form->select('region', $regionList, null, array('empty'=>__('label.pleaseSelect', true)));?>
<?php echo $form->end();?>
<script>
$(function(){
    $("#TestProvince").change(function() {
      getCities("TestProvince", "TestCity", '');
    });
    $("#TestCity").change(function() {
      getRegions("TestCity", "TestRegion", '');
    });
});
</script>
