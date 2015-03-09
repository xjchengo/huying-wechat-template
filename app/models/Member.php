<?php

use Xjchen\BasicAdmin\Externals\Ardent;
use Xjchen\BasicAdmin\Traits\LimitedWechatAccountTrait;
use Xjchen\LimitedTrait\LimitedTrait;

class Member extends Ardent {

    use LimitedTrait, LimitedWechatAccountTrait;
    protected $limitedColumns = ['wechat_account_id'];

    protected $table = 'members';

    protected $guarded = array('id');

    public $forceEntityHydrationFromInput = true;

    protected $perPage = 6;

    public static $rules = array(
    );

    public static $customAttributes = [
        'nickname' => '昵称',
        'head_img_url' => '头像链接'
    ];

    protected $appends = [];

    public function openids()
    {
        return $this->hasMany('MemberOpenid', 'member_id');
    }

    public function getNicknameAttribute($value)
    {
        return json_decode($value);
    }

    public function setNicknameAttribute($value)
    {
        $this->attributes['nickname'] = json_encode($value);
    }

}
