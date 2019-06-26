<!--左侧列表-->
<div class="nav-list">
    @if(is_array($left))
        @foreach($left as $key=>$vo)
            <div class="level-1 level-product @if($loop->index == 0) init-active @endif">
                <p class="level-title-1 special"><i class="iconfont"></i>{{$vo['hc_name']}}</p>
                <i class="iconfont arrows1 active"></i>

                @foreach($vo['list'] as $k2=>$v2)
                    <div class="level-2">
                        <p><a data-id="{{$v2['id']}}" href="/help/{{$vo['hc_id']}}/{{$v2['id']}}">{{$v2['title']}}</a></p>
                    </div>
                @endforeach

            </div>
        @endforeach
    @endif
</div>
<input type="hidden" id="arc_id" value="{{$id}}">
<style>
    .level-1 .level-2 p a.active {
        color: #52a4fa;
    }
</style>
<script>
    $(function () {
        var arc_id=$('#arc_id').val()
        $('.nav-list a').each(function () {
            if($(this).data('id')==arc_id){
                $(this).parents('.level-1').addClass('init-active');
                $(this).parents('.level-1').siblings().removeClass('init-active');
                $(this).addClass('active');
            }
        })
    })
</script>