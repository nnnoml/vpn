@section('alert')
    {{--登陆弹窗--}}
    <div  class="modal-login login footer_modal_login ">
        <!-- <div class="modal-main wx_code"> -->
        <div class="modal-main ">
            <span class="close">&#xe627;</span>
            <!-- <i class="cut_off_rule"></i> -->
            <!-- <div class="mlogin-wx">
              <h3><i class="iconfont">&#xe72a;</i>微信登录</h3>
              <img class="qr_image" src="" alt=""/>
              <p>请使用微信扫描二维码登录<br>“芝麻软件”</p>
            </div> -->
            <div class="mlogin-form">
                <h4>用户登录</h4>
                <form id="modal_footer_login_form">
                    <div class="form-pro">
                        <i class="iconfont">&#xe630;</i>密码错误，是否要<a class="forget_modal">找回密码</a>
                    </div>
                    <div class="form-line" style="margin-top: 10px"><i class="iconfont">&#xe619;</i><input placeholder="请输入用户名或手机号码" name="username" onkeydown="login_keydown()"></div>
                    <div class="form-line"><i class="iconfont">&#xe62a;</i><input type="password" placeholder="请输入密码" name="password" onkeydown="login_keydown()"></div>
                    {{--<div class="form-line with-code" style="display: block"><i class="iconfont">&#xe605;</i>--}}
                        {{--<input  placeholder="请输入图形验证码" name="verify" onkeydown="login_keydown()">--}}
                        {{--<img src="{{captcha_src('math')}}" style="cursor: pointer" onclick="this.src='{{captcha_src('math')}}'+Math.random()">--}}
                    {{--</div>--}}

                    <div class="fl-option">
                        <label><input type="checkbox" name="remember" id="remember" value="1" checked="checked"><span></span>自动登录</label>
                        <a class="forget_modal">忘记密码?</a>
                    </div>
                </form>
                <a class="submit modal_login_do">登录</a>
                <p class="tip">还没有账号? <a class="reg_modal">立即注册</a></p>
            </div>
        </div>
    </div>

    {{--忘记密码弹窗--}}
    <div  class="modal-login forget_password footer_modal_forget">
        <div class="modal-main">
            <span class="close">&#xe627;</span>
            <div class="mlogin-form">
                <h4>忘记密码</h4>
                <p>成功验证注册时的手机号即可找回密码</p>
                <!--<div class="form-line"><i class="iconfont">&#xe619;</i><input placeholder="用户名" name="username" onkeydown="forget_keydown()"></div>-->
                <div class="form-line"><i class="iconfont">&#xe6a9;</i><input placeholder="手机号" name="phone" onkeydown="forget_keydown()"></div>
                <div class="form-line with-code"><i class="iconfont">&#xe605;</i>
                    <input placeholder="图形验证码" name="verify" onkeydown="forget_keydown()">
                    <img src="{{captcha_src('flat')}}" style="cursor: pointer" onclick="this.src='{{captcha_src('flat')}}'+Math.random()">
                </div>
                <div class="form-line with-code"><i class="iconfont">&#xe69b;</i>
                    <input placeholder="请输入短信验证码" name="phone_verify" onkeydown="forget_keydown()"><a class="vacode get_vacode">获取验证码</a>
                </div>
                <div class="form-line"><i class="iconfont">&#xe692;</i><input type="password" name="password" placeholder="请输入密码" onkeydown="forget_keydown()"></div>
                <div class="form-line"><i class="iconfont">&#xe602;</i><input type="password" name="re_password" placeholder="请输入确认密码" onkeydown="forget_keydown()"></div>
                <a class="submit modal_forget_do">确认</a>
                <p class="tip">又想起来了? <a class="login_modal">立即登录</a></p>
            </div>
        </div>
    </div>
    {{--注册弹窗--}}
    <div  class="modal-login register footer_modal_reg">
        <div class="modal-main ">
            <span class="close">&#xe627;</span>
            <!-- <i class="cut_off_rule"></i>
            <div class="mlogin-wx">
              <h3><i class="iconfont">&#xe72a;</i>微信注册</h3>
              <img class="qr_image" src="" alt="扫描二维码即可注册"/>
              <p>请使用微信扫描二维码注册<br>“芝麻软件”</p>
            </div> -->
            <div class="mlogin-form">
                <h4>注册试用</h4>
                {{--<span class="st">注册后联系客服获取免费资格</span>--}}
                <form id="modal_footer_reg_form">
                    <div class="form-line"><i class="iconfont">&#xe686;</i><input  placeholder="请输入手机号" name="phone" onkeydown="reg_keydown()"></div>
                    <div class="form-line has-see-btn"><i class="iconfont">&#xe692;</i>
                        <input type="password" placeholder="请输入密码" name="password" onkeydown="reg_keydown()">
                        <span class="see-btn"><i class="iconfont on">&#xe671;</i><i class="iconfont off">&#xe664;</i></span>
                    </div>
                    <div id="show-trigger" class="form-line  with-code "><i class="iconfont">&#xe605;</i>
                        <input  placeholder="请输入图形验证码" name="verify" onkeydown="reg_keydown()">
                        <img src="{{captcha_src('flat')}}" style="cursor: pointer" onclick="this.src='{{captcha_src('flat')}}'+Math.random()">
                        {{--<img class="modal_verify_reg" onclick="this.src='http://webapi.apehorse.com/core/api/verify/verify_id/10000.html'+'?time='+Math.random();" src="http://webapi.apehorse.com/core/api/verify/verify_id/10000.html">--}}
                    </div>
                    <div class="form-line with-code "><i class="iconfont">&#xe69b;</i>
                        <input placeholder="请输入短信验证码" name="phone_verify" onkeydown="reg_keydown()"><a class="vacode get_vacode">获取验证码</a>
                    </div>
                    <input type="hidden" name="modal_verify_login_id" value="10000">
                </form>
                <!--<div class="fl-option">-->
                <!--<label><input type="checkbox"><span></span>自动登录</label>-->
                <!--<a>忘记密码?</a>-->
                <!--</div>-->


                <a class="submit modal_reg_do">注册</a>
                <div class="options new_opt">
                    <label for="st-conte1">
                        <input type="checkbox" name="is_agree" value="" id="st-conte1" checked="checked">
                        <i class="iconfont">&#xe639;</i>
                        <span class="agree">我同意</span>
                    </label>
                    <a class="agree_open" href="/aggrement.html" target="_blank">《芝麻软件用户注册协议》</a>
                </div>
                <p class="tip">已有账号? <a class="login_modal">立即登录</a></p>
            </div>
        </div>
    </div>
@endsection