define(function(require, exports, module) {
    var $ = require('jquery.sea');

    //领取礼包class:get-gift
    //加入购物车class:add-to-cart

    exports.shopCart = function(){
        var mask = $('.mask'),//阴影背景
            alert_loading = $('#alert-loading'),//等待弹窗
            alert_msg = $('#alert-msg');//消息弹窗
            alert_cart = $('#alert-cart'),//购物弹窗
            cart_num = $('foot .cart-num'),//底部购物车
            keep_shopping = alert_cart.find('.keep');//购物弹窗继续购物

        //消除弹层通用接口
        $('.mask,#alert-msg .alert-but').click(function(){
            $('.modal-alert').fadeOut('fast');
            $('#index-page #sidebar').removeClass('active');//消除首页边导航
            mask.hide();
        });

        $('.get-gift').click(function(){
            var coupon = $(this).data('coupon');
            mask.show();
            alert_loading.show();
            //ajax
            //$.ajax
            setTimeout(function(){
                alert_loading.hide();
                alert_msg.show();
            },3000);
        });

        var shop_keep_time = 0;

        function shop_keep(){
            if(shop_keep_time==0){
                hide_cart_alert();
                return ;
            }
            --shop_keep_time;
            keep_shopping.text('继续购物('+shop_keep_time+')');
            setTimeout(shop_keep,1000);
        }

        //关闭购物车弹窗
        function hide_cart_alert(){
            alert_cart.hide();
            mask.hide();
        }

        //加入购物车
        $('.add-to-cart').click(function(){
            mask.show();
            alert_loading.show();

            //ajax
            //$.ajax

            setTimeout(function(){
                alert_loading.hide();
                alert_cart.show();

                if(cart_num.length>0){
                    cart_num.text(parseInt(cart_num.text())+1);
                }

                shop_keep_time = 4;
                //继续购物
                shop_keep();
            },3000);
        });

        //继续购物关闭
        keep_shopping.click(hide_cart_alert);
    }
});
