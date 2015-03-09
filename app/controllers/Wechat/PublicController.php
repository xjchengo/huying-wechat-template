<?php namespace Wechat;

use View;
use BaseController;
use Request;
use Response;
use Input;
use Session;
use MemberOpenid;
use Member;
use Redirect;

class PublicController extends BaseController {

    protected $member;
    protected $memberOpenid;

    public function __construct(Member $member, MemberOpenid $memberOpenid)
    {
        $this->member = $member;
        $this->memberOpenid = $memberOpenid;
        $this->beforeFilter('wechat.userinfo', ['only' => ['login']]);
    }

    public function login()
    {
        $openid = Session::get('openid');
        $memberOpenid = $this->memberOpenid->whereOpenid($openid)->first();
        if (!$memberOpenid) {
            $wechatUserinfo = Session::get('wechat_userinfo');
            $this->member->nickname = $wechatUserinfo['nickname'];
            $this->member->head_img_url = $wechatUserinfo['headimgurl'];
            $this->member->save();
            $this->memberOpenid->member_id = $this->member->id;
            $this->memberOpenid->openid = $openid;
            $this->memberOpenid->save();
            $memberOpenid = $this->memberOpenid;
        }
        Session::put('member_id', $memberOpenid->member_id);
        $redirectUrl = Session::pull('wechat-login-before-url', '/');
        return Redirect::to($redirectUrl);
    }

}
