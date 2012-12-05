<link rel="stylesheet" type="text/css" href="/css/admin/autocomplete.css" />
<?php echo $this->element('/common/brand_list');?>
<script type="text/javascript" src="/js/autoComplete.js"></script>
<input type="text" name="auto" value="" size="15" style="width:120px;height:15px;" id="brand_name" onkeyup="suggest.display('brand_name', 'brand',1,event,'hiddenObj');" onClick="suggest.display('brand_name', 'brand',1,event,'hiddenObj');"/>
<input type="text" name="hidden" value="" id="hiddenObj">