define(function(require, exports, module) {
    var $ = require('jquery.sea');
    var touchSwipe = require('jquery.touchSwipe.sea');

    var scroll = function(interval, transition) {
        var container = $('#banner .banner-scroll'),
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
            WIDTH = $(window).width(), HEIGHT = WIDTH * 0.625;
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
        $('#banner .banner-switch').width(20 * num - 12).html(switchTxt);
        var switchs = $('#banner .banner-switch span');

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

    exports.indexScroll = scroll;

    exports.init = function() {
        var volume_icon = $('#index-page .promotion .volume i');
        setInterval(function(){
            var animateClass = volume_icon.hasClass('fa-volume-up')?'fa-volume-down':'fa-volume-up';
            volume_icon.attr('class','fa '+animateClass);
        },500);


        var mask = $('.mask'),//阴影背景
            sidebar = $('#index-page #sidebar');//导航

        //导航展开
        $('#sidebar-open').click(function(){
            sidebar.addClass('active');
            mask.show();
        });
    };
});