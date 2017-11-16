ThinkCMF 5.0 API 1.0.0 增强版
===============
## 添加了导航 API和widget API
###  导航
/api/home/navs/1
navs后面的值是cmf_nav的id值，这样就可以通过导航id来取得json
###  widget
http://localhost/thinkc/public/api/widget?ids=107
这里的ids用法与官方用法一致
ids
field
limit
page
order
relation
其实后面的基本都用不上，需要注意的是，我这里写死了field的字段就是‘more’，因为只需要widget的json而已，其他的并未取得。




