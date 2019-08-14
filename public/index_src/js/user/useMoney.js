layui.use(['laydate','laypage'], function(){
          var laydate = layui.laydate;
          var laypage = layui.laypage;

          //余额记录查询data
          laydate.render({
            elem: '#usemoney_input' //指定元素

            ,theme: '#0e4f94'
            ,type: 'date'
            ,range: true
          });
//          //余额记录分页
          laypage.render({
            elem: 'usemoney_page' //注意，这里的 test1 是 ID，不用加 # 号
            ,limit:20
            ,count: use_money_list_count //数据总数，从服务端得到
            ,jump: function(obj, first){
                if(!first){
                  getUseMoneyList(obj.curr,obj.limit)
                }
            }
          });

//        getUseMoneyList(1,20)

        $(".act_search").click(function(){
            getUseMoneyList(1,20);
        })

        function getUseMoneyList(page,limit){
            var getData = {};
            getData.page=page;
            getData.limit=limit;
            getData.date=$("#usemoney_input").val();
            var html = '';
            ajaxDo('/user/useMoneyList','get',getData,function(data){
                if(data.code == 1){

                    data.info.list.forEach(function(vo){

                        html += '<div class="tr">';
                        html+='<span class="td td-6">'+vo.iptype_format+' ';
                        if(vo.log_ty==1)
                            html+='按次余额</span>'
                        else
                            html+='按次扣次</span>'

                        html+='<span class="td td-6">'+vo.money/100+'</span>'
                        html+='<span class="td td-6">'+vo.create_time+'</span>'
                        html += '</div>'
                    })
                    $("#useMoneyList").html(html);

                    $("#usemoney_input").val(data.info.date)

                    //ajax余额记录分页
                    //如果总页数不一样才刷新
                    if(use_money_list_count != data.info.count){
                        use_money_list_count = data.info.count
                        laypage.render({
                            elem: 'usemoney_page' //注意，这里的 test1 是 ID，不用加 # 号
                            ,limit:20
                            ,count: use_money_list_count //数据总数，从服务端得到
                            ,jump: function(obj, first){
                                if(!first){
                                  getUseMoneyList(obj.curr,obj.limit)
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

