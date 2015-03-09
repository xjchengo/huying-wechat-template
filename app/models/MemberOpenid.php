<?php

use Xjchen\BasicAdmin\Externals\Ardent;
use Xjchen\BasicAdmin\Traits\LimitedWechatAccountTrait;
use Xjchen\LimitedTrait\LimitedTrait;

class MemberOpenid extends Ardent {

    use LimitedTrait, LimitedWechatAccountTrait;
    protected $limitedColumns = ['wechat_account_id'];

    protected $table = 'member_openids';

    protected $guarded = array('id');

    public $forceEntityHydrationFromInput = true;

    protected $perPage = 6;

    public static $rules = array(
    );

    public static $customAttributes = [
    ];

    protected $appends = [];

    public function member()
    {
        return $this->belongsTo('Member', 'member_id');
    }

}
