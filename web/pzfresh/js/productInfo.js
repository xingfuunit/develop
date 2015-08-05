define(function(require, exports, module) {
    var $ = require('jquery.sea');
    var touchSwipe = require('jquery.touchSwipe.sea');

    /***商品信息***/
    var scroll = function(interval, transition) {
        var container = $('#p-detail .show-scroll'),
            animate = 0,
            pics = container.find('li'),
            num = pics.length,
            switchTxt = '',
            time = transition / 1000 || 1,
            active = 1,
            WIDTH, HEIGHT, nextMove;

        pics.eq(0).clone().appendTo(container);
        pics.eq(-1).clone().prependTo(container);
        pics = container.find('li');

        //container.height(HEIGHT);
        var sizeInit = function() {
            WIDTH = $(window).width(), HEIGHT = WIDTH * 0.7;
            container.width((num + 2) * WIDTH);
            pics.css({
                width: WIDTH,
                height: HEIGHT
            });
            container.css({
                'transform': 'translateX(-' + active * WIDTH + 'px)'
            });
        }

        sizeInit();

        $(window).resize(sizeInit);

        for (var i = 0; i < num; i++) {
            switchTxt += '<span' + (i == 0 ? ' class="on"' : '') + '></span>';
        }
        $('#p-detail .show-switch').width(15 * num - 5).html(switchTxt);
        var switchs = $('#p-detail .show-switch span');

        //移动
        var tansform = function(index) {
            window.clearTimeout(nextMove);
            animate = 1;
            container.css({
                'transition': 'all ease ' + transition + 'ms',
                'transform': 'translateX(-' + index * WIDTH + 'px)'
            });
            var atborder = index == 0 || index == num + 1;
            if (atborder) {
                index != 0 ? (index = index % num) : (index = num);
            }
            switchs.eq(index - 1).addClass('on').siblings().removeClass('on');
            setTimeout(function() {
                if (atborder) {
                    borderChange(index);
                }
                active = index;
                animate = 0;
            }, transition);
            nextMove = setTimeout(next, interval);
        }

        //到达边界
        var borderChange = function(index) {
            container.css('transition', 'all ease 0s');
            container.css({
                'transform': 'translateX(-' + index * WIDTH + 'px)'
            });

        }
        var prev = function() {
            if (animate != 0) {
                return;
            }
            tansform(--active);
        };
        var next = function() {
            if (animate != 0) {
                return;
            }
            tansform(++active);
        };
        container.swipe({
            swipeLeft: function(event, direction, distance, duration, fingerCount) {
                next();
            },
            swipeRight: function(event, direction, distance, duration, fingerCount) {
                prev();
            },
        });
        nextMove = setTimeout(next, interval - transition);
    };

    exports.scroll = scroll;

    exports.infoInit = function() {
        $('#p-detail .show-favorite').click(function() {
            $(this).toggleClass('on');
        });
        $('#p-detail .expanse-all').click(function() {
            $(this).parents('section').toggleClass('ellipsis');
        });
        $('#p-detail .spe-list span').click(function() {
            $(this).addClass('on').siblings().removeClass('on');
        });
        $('#p-detail #cart .cart-count b').click(function() {
            var input = $('#p-detail #cart .cart-num'),
                num = parseInt(input.val()) || 0;
            if ($(this).hasClass('plus')) {
                input.val(num + 1);
            } else {
                input.val(Math.max(num - 1, 0));
            }
        });
    };

    /***评论***/
    exports.commentsInit = function() {
        var loading = false,
            loading_img = $('.decorate .loading'),
            container = $('.comm-list:first'),
            total_page = parseInt(container.attr('commpage')),
            page = 1;

        if (total_page > 1) {
            next_page_invoke();
            $(window).on('scroll',next_page_invoke);
        }

        function next_page_invoke() {
            var tt = $(window).scrollTop() + $(window).height();
            var hh = $(document).height() - 200;
            if (tt > hh) {
                //alert('scroll');
                get_next_page();
            };
        }

        function get_next_page() {
            if (loading || page >= total_page) {
                return;
            };
            loading = true;
            loading_img.show();
            var url = more_url;

            $.ajax({
                type: 'post',
                url: url,
                data: 'goods_id=18&page=' + (page + 1),
                cache: false,
                dataType: 'text',
                success: function(data) {
                    page++;
                    var res = eval("("+data+")");
                    var show_html = '';
                    for(var o in res){
                        show_html += '<li><div class="comm-avater"><img src="/pzfresh/img/avater.png"></div><div class="comm-text"><div class="par-comm"><p class="comm-title"><span class="comm-tel">'+res[o].author+'</span><span class="comm-data">'+res[o].time+'</span></p><p class="comm-content">'+res[o].comment+'</p></div>';
                        for(var i in res[o].items){
                            if (res[o].items[i].display == 'true' && res[o].items[i].disabled == 'false') {
                                show_html += '<div class="sub-comm"><p class="comm-title"><span class="comm-tel">品珍客服回复</span><span class="comm-data">'+res[o].items[i].time+'</span></p><p class="comm-content">'+res[o].items[i].comment+'</p></div>';
                            }
                        }
                        show_html += '</div></li>';
                    }
                    container.append(show_html);
                    loading_img.hide();
                    loading = false;
                    if (page == total_page) {
                        $('.p-comments .no-more-comm');
                    }
                },
                error: function(XMLHttpRequest, textStatus, errorThrown) {
                    //console.log('error='+errorThrown);
                    //alert('网络不通');
                    loading_img.hide();
                    loading = false;
                }
            });
        };
    }

    /***图文详情***/
    exports.viewScroll = function(interval, transition) {
        var container = $('#p-viewscroll .view-scroll'),
            animate = 0,
            pics = container.find('li'),
            num = pics.length,
            time = transition / 1000 || 1,
            active = 1,
            WIDTH, HEIGHT, nextMove;

        pics.eq(0).clone().appendTo(container);
        pics.eq(-1).clone().prependTo(container);
        pics = container.find('li');

        //container.height(HEIGHT);
        var sizeInit = function() {
            WIDTH = $(window).width();
            container.width((num + 2) * WIDTH);
            pics.css({
                width: WIDTH,
            });
            var h = $(window).height();
            pics.each(function() {
                //图片高度小于屏幕高度的时候调整
                var pic = $(this).find('img');
                if(pic.height()<h){
                    pic.css('top',(h-pic.height())/2);
                }else{
                    pic.css('top',0);
                }
            });
            container.css({
                'transform': 'translateX(-' + active * WIDTH + 'px)'
            });
        }

        sizeInit();

        $(window).resize(sizeInit);

        var switchs = $('#p-viewscroll .view-page');

        //移动
        var tansform = function(index) {
            window.clearTimeout(nextMove);
            animate = 1;
            container.css({
                'transition': 'all ease ' + transition + 'ms',
                'transform': 'translateX(-' + index * WIDTH + 'px)'
            });
            var atborder = index == 0 || index == num + 1;
            if (atborder) {
                index != 0 ? (index = index % num) : (index = num);
            }
            switchs.text(index + ' / ' + num);
            setTimeout(function() {
                if (atborder) {
                    borderChange(index);
                }
                active = index;
                animate = 0;
            }, transition);
        }

        //到达边界
        var borderChange = function(index) {
            container.css('transition', 'all ease 0s');
            container.css({
                'transform': 'translateX(-' + index * WIDTH + 'px)'
            });

        }
        var prev = function() {
            if (animate != 0) {
                return;
            }
            tansform(--active);
        };
        var next = function() {
            if (animate != 0) {
                return;
            }
            tansform(++active);
        };
        container.swipe({
            swipeLeft: function(event, direction, distance, duration, fingerCount) {
                next();
            },
            swipeRight: function(event, direction, distance, duration, fingerCount) {
                prev();
            },
        });
    };
});
