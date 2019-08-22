layui.use('laypage', function(){
          var laypage = layui.laypage;

          laypage.render({
            elem: 'order_list_page' //注意，这里的 test1 是 ID，不用加 # 号
            ,limit:20
            ,count: order_list_count //数据总数，从服务端得到
            ,jump: function(obj, first){
                if(!first){
                  getOrderList(obj.curr,obj.limit)
                }
            }
          });

//        getUseMoneyList(1,20)

        $(".record-sel>ul>li").click(function(){
            $(".record-sel").data('tab',$(this).data('tab'))
            getOrderList(1,20);
        })

        function getOrderList(page,limit){
            var getData = {};
            getData.page=page;
            getData.limit=limit;
            getData.pay_status=$(".record-sel").data('tab');
            var html = '';
            ajaxDo('/user/orderList','get',getData,function(data){
                if(data.code == 1){

                    data.info.list.forEach(function(vo){

//                                    <span class="td td-6"
//                                        @if($vo['p_type']==1 && $vo['vpn_deadline'])
//                                          onmouseenter="layer.tips('本订单vpn到期时间：<br /> {{$vo['vpn_deadline']}}', this)"
//                                        @endif
//                                    >{{$vo['created_at']}}</span>


                        html += '<div class="tr">';
                        html+='<span class="td td-1" style="text-align: left;">'+vo.order_title+'</span>';
                        html+='<span class="td td-2">'+vo.order_no+'</span>';
                        html+='<span class="td td-3">'+vo.pay_money/100+'</span>';
                        if(vo.pay_type==1)
                            html+='<span class="td td-4">微信</span>'
                        else if(vo.pay_type==2)
                            html+='<span class="td td-4">支付宝</span>'
                        else
                            html+='<span class="td td-4">--</span>'

                        if(vo.pay_status==0)
                            html+='<span class="td td-5">未支付</span>'
                        else if(vo.pay_status==1)
                            html+='<span class="td td-5">已支付</span>'
                        else if(vo.pay_status==2)
                            html+='<span class="td td-5">已取消</span>'
                        else
                            html+='<span class="td td-5">--</span>'

                        html+='<span class="td td-6" ';
                        if(vo.p_type==1 && vo.vpn_deadline)
                            html += 'onmouseenter="layer.tips(\'本订单vpn到期时间：<br /> '+vo.vpn_deadline+'\', this)" >'+vo.created_at+'</span>'
                        else
                            html += '>'+vo.created_at+'</span>';
                        html += '</div>'
                    })
                    $("#orderList").html(html);

                    //ajax余额记录分页
                    //如果总页数不一样才刷新
                    if(order_list_count != data.info.count){
                        order_list_count = data.info.count
                        laypage.render({
                            elem: 'order_list_page' //注意，这里的 test1 是 ID，不用加 # 号
                            ,limit:20
                            ,count: order_list_count //数据总数，从服务端得到
                            ,jump: function(obj, first){
                                if(!first){
                                  getOrderList(obj.curr,obj.limit)
                                }
                            }
                          });
                    }
                }
                else{
                    alert('暂无数据')
                }
            },true)
        }
});

