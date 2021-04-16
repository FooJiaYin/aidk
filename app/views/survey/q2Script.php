<script src='/static/js/fa.js'></script>

<script src="https://static.codepen.io/assets/common/stopExecutionOnTimeout-157cd5b220a5c80d4ff8e0e70ac069bffd87a61252088146915e8726e5d9f147.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/gsap/1.18.4/TweenMax.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/gsap/1.18.4/utils/Draggable.min.js"></script>

<script>
    window.onpageshow = function(event) {
        if (event.persisted) {
            console.log('Reloading');
            window.location.reload();
        }
    };
    $(function() {

        //出入允许拖拽节点的父容器，一般是ul外层的容器
        drag.init('container');

        $(".btnJL").click(function() {

            var ids = [];
            $(".sortList").find(".actselected").each((index, item) => {
                ids.push($(item).attr("data-id"));
            })
            if ($(".sortList >li").length == ids.length) {
                //window.location.href = $(this).data("href");
                $('#val').val(JSON.stringify(ids));
                $("#question").submit();
            } else {
                console.log("fail");
                alert("請確定是否都填寫完成");
            }

            console.log(ids)


        })

    });


    //拖拽
    var drag = {

        class_name: null, //允许放置的容器
        permitDrag: false, //是否允许移动标识

        _x: 0, //节点x坐标
        _y: 0, //节点y坐标
        _left: 0, //光标与节点坐标的距离
        _top: 0, //光标与节点坐标的距离

        old_elm: null, //拖拽原节点
        tmp_elm: null, //跟随光标移动的临时节点
        new_elm: null, //拖拽完成后添加的新节点

        //初始化
        init: function(className) {

            //允许拖拽节点的父容器的classname(可按照需要，修改为id或其他)
            drag.class_name = className;

            //监听鼠标按下事件，动态绑定要拖拽的节点（因为节点可能是动态添加的）
            $('.' + drag.class_name).on('mousedown', 'ul li.move,.target', function(event) {

                //console.log("nnnll")

                if ($(this).hasClass("target")) {
                    if (!$(this).hasClass("actselected")) {
                        return false
                    }

                } else if ($(this).hasClass("disable")) {

                    return false;
                }
                //当在允许拖拽的节点上监听到点击事件，将标识设置为可以拖拽
                drag.permitDrag = true;
                //获取到拖拽的原节点对象
                drag.old_elm = $(this);
                //执行开始拖拽的操作
                drag.mousedown(event);
                return false;
            });

            $('.' + drag.class_name).on('touchstart', 'ul li.move,.target', function(event) {
                $(drag.tmp_elm).remove();
                //console.log("nnnll")

                if ($(this).hasClass("target")) {
                    if (!$(this).hasClass("actselected")) {
                        return false
                    }

                } else if ($(this).hasClass("disable")) {

                    return false;
                }
                //当在允许拖拽的节点上监听到点击事件，将标识设置为可以拖拽
                drag.permitDrag = true;
                //获取到拖拽的原节点对象
                drag.old_elm = $(this);
                //执行开始拖拽的操作
                drag.mousedown(event);
                return false;
            });



            //监听鼠标移动
            $(document).mousemove(function(event) {
                //判断拖拽标识是否为允许，否则不进行操作
                if (!drag.permitDrag) return false;
                //执行移动的操作
                drag.mousemove(event);
                return false;
            });


            document.addEventListener('touchmove', function(event) {

                if (!drag.permitDrag) return false;
                //执行移动的操作
                drag.mousemove(event);
                return false;
            }, false)


            //兼容手机

            document.addEventListener('touchend', function(event) {
                //判断拖拽标识是否为允许，否则不进行操作
                if (!drag.permitDrag) return false;
                //拖拽结束后恢复标识到初始状态
                drag.permitDrag = false;
                //执行拖拽结束后的操作
                drag.mouseup(event);
                return false;
            }, false)

            //监听鼠标放开
            $(document).mouseup(function(event) {
                //判断拖拽标识是否为允许，否则不进行操作
                if (!drag.permitDrag) return false;
                //拖拽结束后恢复标识到初始状态
                drag.permitDrag = false;
                //执行拖拽结束后的操作
                drag.mouseup(event);
                return false;
            });

        },

        //按下鼠标 执行的操作
        mousedown: function(event) {

            //console.log('我被mousedown了');
            //console.log($(drag.old_elm).hasClass("move"));


            var pwidth = $(drag.old_elm).width();
            if ($(drag.old_elm).hasClass("move")) {
                pwidth = pwidth + 20;
            }
            //1.克隆临时节点，跟随鼠标进行移动
            drag.tmp_elm = $(drag.old_elm).clone();

            //2.计算 节点 和 光标 的坐标
            drag._x = $(drag.old_elm).offset().left;
            drag._y = $(drag.old_elm).offset().top;

            var e = event || window.event;

            //   e.originalEvent.targetTouches[0]

            if (e.originalEvent.targetTouches) {
                e = e.originalEvent.targetTouches[0]
            }

            drag._left = e.pageX - drag._x;
            drag._top = e.pageY - drag._y;
            // console.log(drag._left)
            // drag._x= drag._x-20;
            //3.修改克隆节点的坐标，实现跟随鼠标进行移动的效果
            $(drag.tmp_elm).css({
                'position': 'absolute',
                'background-color': '#FFFFFF',
                'box-shadow': 'rgba(0,0,0,0.2) 0 16px 5px 0 ',
                'left': drag._x,
                'top': drag._y,
                'width': pwidth,
                'opacity': 0.5
            });

            //4.添加临时节点
            tmp = $(drag.old_elm).parent().append(drag.tmp_elm);
            drag.tmp_elm = $(tmp).find(drag.tmp_elm);
            $(drag.tmp_elm).css('cursor', 'move');

        },

        //移动鼠标 执行的操作
        mousemove: function(event) {

            //console.log('我被mousemove了');
            //console.log(event)

            //2.计算坐标
            var e = event || window.event;
            //	console.log( e.originalEvent.targetTouches[0])

            if (e.touches) {
                e = e.touches[0]
            }
            var x = e.pageX - drag._left;
            var y = e.pageY - drag._top;
            var maxL = $(document).width() - $(drag.old_elm).outerWidth();
            var maxT = $(document).height() - $(drag.old_elm).outerHeight();
            //不允许超出浏览器范围
            x = x < 0 ? 0 : x;
            x = x > maxL ? maxL : x;
            y = y < 0 ? 0 : y;
            y = y > maxT ? maxT : y;

            //3.修改克隆节点的坐标
            $(drag.tmp_elm).css({
                'left': x,
                'top': y,
            });

            //判断当前容器是否允许放置节点
            $.each($('.' + drag.class_name + ' .region'), function(index, value) {

                //获取容器的坐标范围 (区域)
                var box_x = $(value).offset().left; //容器左上角x坐标
                var box_y = $(value).offset().top; //容器左上角y坐标
                var box_width = $(value).outerWidth(); //容器宽
                var box_height = $(value).outerHeight(); //容器高

                //给可以放置的容器加背景色
                if (e.pageX > box_x && e.pageX < box_x - 0 + box_width && e.pageY > box_y && e.pageY < box_y - 0 + box_height) {

                    //判断是否不在原来的容器下（使用坐标进行判断：x、y任意一个坐标不等于原坐标，则表示不是原来的容器）
                    if ($(value).offset().left !== drag.old_elm.parent().offset().left ||
                        $(value).offset().top !== drag.old_elm.parent().offset().top) {

                        $(value).css('background-color', 'rgba(0,0,0,0.1)');
                        // $(value).css('box-shadow', 'rgba(0,0,0,0.2) 0 16px 5px 0 ');

                    }
                } else {
                    //恢复容器原背景色
                    $(value).css('background-color', '#ffffff');
                    // $(value).css('box-shadow', 'rgba(0,0,0,0.2) 0 0 0 0 ');

                }

            });

        },

        //放开鼠标 执行的操作
        mouseup: function(event) {

            //console.log('我被mouseup了');
            //移除临时节点
            $(drag.tmp_elm).remove();

            //判断所在区域是否允许放置节点
            var e = event || window.event;

            if (e.touches) {
                e = e.changedTouches[0]
            }
            $.each($('.' + drag.class_name + ' .region'), function(index, value) {
                //获取容器的坐标范围 (区域)
                var box_x = $(value).offset().left; //容器左上角x坐标
                var box_y = $(value).offset().top; //容器左上角y坐标
                var box_width = $(value).outerWidth(); //容器宽
                var box_height = $(value).outerHeight(); //容器高

                //判断放开鼠标位置是否想允许放置的容器范围内
                if (e.pageX > box_x && e.pageX < box_x - 0 + box_width && e.pageY > box_y && e.pageY < box_y - 0 + box_height) {

                    //判断是否不在原来的容器下（使用坐标进行判断：x、y任意一个坐标不等于原坐标，则表示不是原来的容器）
                    if ($(value).offset().left !== drag.old_elm.parent().offset().left ||
                        $(value).offset().top !== drag.old_elm.parent().offset().top) {
                        if ($(value).hasClass("target")) {
                            if ($(value).hasClass("actselected") && $(drag.old_elm).hasClass("move")) {
                                $(".sortList-item").find("[data-id='" + $(value).attr("data-id") + "']").removeClass("disable")
                            }
                            var isswap = false;
                            var swapmodel = {};
                            //有值的时候触发交换
                            if ($(value).hasClass("actselected")) {
                                isswap = true
                                swapmodel["title"] = $(value).text()
                                swapmodel["id"] = $(value).attr("data-id")
                            }

                            $oldid = $(value).attr("data-id")

                            $(value).attr("data-id", $(drag.old_elm).attr("data-id"))
                            $(value).addClass("actselected")

                            /*已选项目之间排序*/
                            if ($(drag.old_elm).hasClass("target")) {

                                $odltitle = $(value).text()

                                $(value).html($(drag.old_elm).text())

                                if (isswap) {
                                    $(drag.old_elm).attr("data-id", swapmodel["id"])
                                    $(drag.old_elm).text(swapmodel["title"])
                                } else {
                                    $(drag.old_elm).removeClass("actselected")
                                    $(drag.old_elm).text("排序項目")
                                }

                            } else {
                                $(value).html($(drag.old_elm).attr("data-title"))
                                $(drag.old_elm).addClass("disable")
                            }
                        } else {

                            $(".sortList-item").find("[data-id='" + $(drag.old_elm).attr("data-id") + "']").removeClass("disable")
                            $(drag.old_elm).removeClass("actselected")
                            $(drag.old_elm).text("排序項目")
                        }
                    }
                }
                //恢复容器原背景色
                $(value).css('background-color', '#ffffff');
            });
        },
    };
    $(window).unload(function() {});
</script>