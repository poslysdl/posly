var Index = function () {

    return {

        

        initIntro: function () {

            // display marketing alert only once
            if (!$.cookie('intro_show')) {
                setTimeout(function () {
					 $.extend($.gritter.options, {
                        position: 'bottom-left'
                    });
                    var unique_id = $.gritter.add({
						position: 'bottom-left',
                        // (string | mandatory) the heading of the notification
                        title: '<a href="#" target="_self">You have new notification</a>',
                        // (string | mandatory) the text inside the notification
                        text: 'Lorem ipsum dolor sit amet, consectetuer adipiscing elit, sed diam nonummy nibh euismod tincidunt ut laoreet dolore magna aliquam erat volutpat.',
                        // (string | optional) the image to display on the left
                        image: 'assets/img/avatar1_small.jpg',
                        // (bool | optional) if you want it to fade out on its own or just sit there
                        sticky: true,
                        // (int | optional) the time you want it to be alive for before fading out
                        time: '',
                        // (string | optional) the class name you want to apply to that specific message
                        class_name: 'my-sticky-class'
                    });

                    // You can have it return a unique id, this can be used to manually remove it later using
                    setTimeout(function () {
                        $.gritter.remove(unique_id, {
                            fade: true,
                            speed: 'slow'
                        });
                    }, 12000);
                }, 2000);

                setTimeout(function () {
                    var unique_id = $.gritter.add({
						position: 'bottom-left',
                        // (string | mandatory) the heading of the notification
                        title: '<a href="#"">Love is Blind</a>',
                        // (string | mandatory) the text inside the notification
                        text: '1 lô măng cụt trực tiếp từ nhà vườn Chợ Lách - bao ngon - khoảng 100kg - giá 20k/ký - bao cân đủ - thứ 6 ngày 4/7 có hàng. Comment đặt hàng nhanh',
                        // (string | optional) the image to display on the left
                        image: 'assets/img/avatar1_small.jpg',
                        // (bool | optional) if you want it to fade out on its own or just sit there
                        sticky: true,
                        // (int | optional) the time you want it to be alive for before fading out
                        time: '',
                        // (string | optional) the class name you want to apply to that specific message
                        class_name: 'my-sticky-class'
                    });

                    // You can have it return a unique id, this can be used to manually remove it later using
                    setTimeout(function () {
                        $.gritter.remove(unique_id, {
                            fade: true,
                            speed: 'slow'
                        });
                    }, 13000);
                }, 8000);

                setTimeout(function () {

                   
                    $.extend($.gritter.options, {
                        position: 'bottom-left'
                    });

                    var unique_id = $.gritter.add({
                        position: 'bottom-left',
                        // (string | mandatory) the heading of the notification
                        title: '<a href="#" >Customize Notification</a>',
                        // (string | mandatory) the text inside the notification
                        text: 'Nha hoàn Chức Tâm vào phủ khi tròn tám tuổi, là nha hoàn đi theo hầu Đại bối lặc Ung Tuấn trong Ba vương phủ. (Ba là tên một nước thời Chu, nay thuộc phía Đông tỉnh Tứ Xuyên)',
                        // (string | optional) the image to display on the left
                        image1: './assets/img/avatar1_small.jpg',
                        // (bool | optional) if you want it to fade out on its own or just sit there
                        sticky: true,
                        // (int | optional) the time you want it to be alive for before fading out
                        time: '',
                        // (string | optional) the class name you want to apply to that specific message
                        class_name: 'my-sticky-class'
                    });

                    $.extend($.gritter.options, {
                        position: 'bottom-left'
                    });

                    // You can have it return a unique id, this can be used to manually remove it later using
                    setTimeout(function () {
                        $.gritter.remove(unique_id, {
                            fade: true,
                            speed: 'slow'
                        });
                    }, 10000);

                }, 23000);

                $.cookie('intro_show', 1);
            }
        }

    };

}();