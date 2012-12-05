<script type="text/javascript" src="/js/jquery-1.7.1.min.js"></script>
<script>
var url = 'http://kenko.local/product/index/page:5/sort_key:price/sort_order:1/min_price:80/max_price:';
var reg = new RegExp('(/min_price\:.*|/max_price\:.*)', 'gi');
var newUrl = url.replace(reg, "");
newUrl += '/min_price:'+90+'/max_price:'+ 80;
alert(newUrl);
</script>
