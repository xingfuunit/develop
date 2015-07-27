define(function(require, exports, module) {

    var $url = 'http://pzfresh.com/wap';
    //返回上一页
	function returnback(){
		$('.titleBar span').click(function(){
			history.back();
		});
		$('.fa-search').on('click',function(){
			window.location.href = $url+'/simplesearch.html';
		});
		$('.fa-home').on('click',function(){
			window.location.href = $url;
		});
	};
    exports.returnback = returnback;

    //商品排序方法切换
    function tab() {
        $('.shop-nav > li').on('click', function() {
            $(this).addClass('active').siblings().removeClass('active');
        });
        $('.shop-nav > li').eq(1).toggle(function() {
            $(this).children('i').eq(0).addClass('active1').siblings().removeClass('active1');
            page = 1;
            $('#type').attr('value', 3);
            $('#click').attr('value', 'click');
            $('.product').children().remove('dl');
            addPage();
        }, function() {
            $(this).children('i').eq(1).addClass('active1').siblings().removeClass('active1');
            page = 1;
            $('#type').attr('value', 2);
            $('#click').attr('value', 'click');
            $('.product').children().remove('dl');
            addPage();
        });
        $('.active').bind('click', function() {
            page = 1;
            $('#type').attr('value', 1);
            $('#click').attr('value', 'click');
            $('.product').children().remove('dl');
            addPage();
        });
        $('.pj').bind('click', function() {
            page = 1;
            $('#type').attr('value', 4);
            $('#click').attr('value', 'click');
            $('.product').children().remove('dl');
            addPage();
        });
        $('.sj').bind('click', function() {
            page = 1;
            $('#type').attr('value', 5);
            $('#click').attr('value', 'click');
            $('.product').children().remove('dl');
            addPage();
        });
    };
    exports.tab = tab;

    //向下滑动，产生瀑布流效果 && 点击弹窗
    function swipedown() {
        $(window).scroll(function() {
            if (status == true) {
                $('#click').attr('value', '');
                addPage();
            }
        });
    };
    exports.swipedown = swipedown;

    var ajax = '';
    var page = 2;
    var num = $('#num').attr('value');
    var status = true;
    function addPage() {
        var scroll = $(window).scrollTop();
        var height = $(window).height();
        var height1 = $('.shop-menu').height();
        var num1 = $('.page-num > i:first-child').text();
        var num2 = $('.page-num > i:nth-child(2)').text();
        var length = $('.shop-menu > li:first-child').children('dl').length;
        var cat_id = $('#cat_id').attr('value');
        var type = $('#type').attr('value');
        var click = $('#click').attr('value');
        if (page <= num || click == 'click') {
            status = false;
            $.ajax({
                url: "http://localhost/yii2/pzfresh_weixin/web/index.php?r=site/product",
                type: "get",
                data: {'type': type, 'cat_id': cat_id, 'page': page},
                timeout: 1000,
                async:false,
                success: function(result) {
                    result = eval('(' + result + ')')
                    $.each(result, function(i, value) {
                        ajax = '<dl>' +
                                '<dt>' +
                                '<img src="http://pzfresh.com/public/images/a0/6a/99/6332cb1094516d4b562e919825e2577855e8d20d.jpg?1432019152#w"/>' +
                                '</dt>' +
                                '<dd>' +
                                '<ul>' +
                                '<li>' + value.product_name + '</li>' +
                                '<li>' + value.name + '</li>' +
                                '<li class="middle">省' + (parseInt(value.mktprice) - parseInt(value.price)) + '元</li>' +
                                '<li class="current-price">' + value.price + '</li>' +
                                '<li class="old-price">' +
                                '<del>' + value.mktprice + '</del>' +
                                '</li>'+
                                '<li class="cart">'+
                                    '<i class="fa fa-shopping-cart"></i>'+
                                '</li>'+
                                '</ul>' +
                                '</dd>' +
                                '</dl>';
                        $('.product').append(ajax);//用ajax获取到的数据替换！！！！！！！！！！
                    });
                    status = true;
                    if (click != 'click')
                    {
                        page++;
                        $('.page-num > i:first-child').text(page-1);
                    }else{
                        $('.page-num > i:first-child').text(1);
                        if(page<num)
                        page++;
                    }
                    
                }
            });
        }
        var res = scroll + height;
//        $('.total-page > i').text(num2 * length);//计算商品总数
        if (res > height1 && num1 < num2 || click == 'click') {
//            $('.product').append(ajax);//用ajax获取到的数据替换！！！！！！！！！！
            ++num1;
            if (click != 'click') {
                $('.page-num > i:first-child').text(num1);
            }
        }
        cart();
    }
    ;

    //加入购物车，弹层信息 
	function cart(){
		var retimenum = 3;
	    var timer=null;
		$('.cart i').on('click',function(){
			$('.cover').fadeIn();
			clearInterval( timer );
			timer = setInterval( function(){
				retimenum--;
				if( retimenum == 0 ){
					clearInterval( timer );
					$('.cover').fadeOut('fast');
					retimenum = 3;
					$('.cover i').text(3);
				} 
				else{
					$('.cover i').text( retimenum );
					$('.cover li:nth-of-type(2)').on('click',function(){
					 window.location.href=$url+'/cart.html';
					});
					$('.cover li:nth-of-type(3)').on('click',function(){
						clearInterval( timer );
						$('.cover').fadeOut('fast');
						retimenum = 3;
						$('.cover i').text(3);
					});
				}
			},1000 );
		});
	};
	exports.cart = cart;
     
    //底部导航
	function footer(){
		$('.footerBar li:nth-of-type(1)').on('click',function(){
			window.location.href = $url;
		});
		$('.footerBar li').eq(1).on('click',function(){
			window.location.href = 'tel:400-930-9303';
		});
		$('.footerBar li').eq(2).on('click',function(){
			window.location.href = $url+'/cart.html';
		});
		$('.footerBar li').eq(3).on('click',function(){
			window.location.href = $url+'/member.html';
		});
	};
	exports.footer = footer;
    
});