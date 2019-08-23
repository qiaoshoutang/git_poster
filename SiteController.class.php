<?php
namespace Home\Controller;
use Common\Controller\BaseController;
/**
*  @author shanmao
 * http://shanmao.me
 * 前台公共类
 */
class SiteController extends BaseController {

	
    public function __construct()
    {
        parent::__construct();
        $this->initialize();
    }

    /**
     * 控制器初始化
     */
    protected function initialize(){
        //设置手机版参数
        if(MOBILE){
            C('TPL_NAME' , C('MOBILE_TPL'));
        }
        
        $cook = cookie('checklogina');

        $ucookie = json_decode ( stripslashes ( $cook ), true );
        $userinfo = S ( 'uinfo' . $ucookie ['checka'] );
        if ($userinfo) {
            if (md5 ( $userinfo ['openid'] . $userinfo ['id'] ) == $ucookie ['checka']) {

                $uinfo = $userinfo;
                $this->uinfo=$uinfo;
            }
            
        }
        
    }
    /*
     * 判断是否微信打开
     */
    protected function shownotinwx(){
        if(strpos($_SERVER['HTTP_USER_AGENT'], 'MicroMessenger') === false){
//             header("Location: https://ss3.bdstatic.com/lPoZeXSm1A5BphGlnYG/skin/442.jpg");
            exit('请在微信内打开');
        }
    }
    
    public function makePosterEtp($mould,$path,$word1,$word2){ // by tjx
        
        
        if(!$mould||!$path||!$word1) return array('status'=>-1,'msg'=>'参数错误');
        
        $img =  new \Think\Image(1);
        

        $nameFont = './Public/font/sy.otf';
        
        $img->open($mould)
            ->text($word1,$nameFont,'90','#000000', 5,array(0,100))
            ->text($word1,$nameFont,'90','#000000', 5,array(1,100))
            ->text($word2,$nameFont,'30','#000000', 5,array(0,220))
            ->save($path);
            
        return $path;
        
    }
    
    /**
     *
     * @param  $mould 红包模板
     * @param  $word 海报上的文字
     * @param  $money  海报上的金额
     * @return  返回生成海报图片地址
     */
    
    public function makePosterFz($mould,$path,$word1,$word2,$word3,$word4,$language='zh'){ // by jnooo.cn
        
        
        if(!$mould||!$path||!$word1) return array('status'=>-1,'msg'=>'参数错误');
        
        $img =  new \Think\Image(1);

        if($language == 'zh'){
            $nameFont = './Public/font/pf.ttf';
            
            if(empty($word3) && empty($word4)){
                $img->open($mould)
                ->text($word1,$nameFont,'45','#ffffff', 5,array(0,180))
                ->text($word1,$nameFont,'45','#ffffff', 5,array(1,180))
                ->text($word2,'./Public/font/pf.ttf','20','#ffffff', 5,array(0,240))
                ->save($path);
                
            }elseif(empty($word3)){
                $img->open($mould)
                ->text($word1,$nameFont,'45','#ffffff', 5,array(0,160))
                ->text($word1,$nameFont,'45','#ffffff', 5,array(1,160))
                ->text($word2,'./Public/font/pf.ttf','20','#ffffff', 5,array(0,220))
                ->text($word4,'./Public/font/pf.ttf','20','#ffffff', 5,array(0,255))
                ->save($path);
            }elseif(empty($word4)){
                $img->open($mould)
                ->text($word1,$nameFont,'45','#ffffff', 5,array(0,160))
                ->text($word1,$nameFont,'45','#ffffff', 5,array(1,160))
                ->text($word2,'./Public/font/pf.ttf','20','#ffffff', 5,array(0,220))
                ->text($word3,'./Public/font/pf.ttf','20','#ffffff', 5,array(0,255))
                ->save($path);
            }else{
                $img->open($mould)
                ->text($word1,$nameFont,'45','#ffffff', 5,array(0,140))
                ->text($word1,$nameFont,'45','#ffffff', 5,array(1,140))
                ->text($word2,'./Public/font/pf.ttf','20','#ffffff', 5,array(0,200))
                ->text($word3,'./Public/font/pf.ttf','20','#ffffff', 5,array(0,235))
                ->text($word4,'./Public/font/pf.ttf','20','#ffffff', 5,array(0,270))
                ->save($path);
            }
        }
        if($language == 'en'){
            $nameFont = './Public/font/gb.ttf';
            $y = -320;
            
            if(empty($word3) && empty($word4)){
                $img->open($mould)
                ->text($word1,$nameFont,'38','#ffffff', 9,array(-70,$y-30))
                ->text($word1,$nameFont,'38','#ffffff', 9,array(-71,$y-30))
                ->text($word2,'./Public/font/pf.ttf','18','#ffffff', 9,array(-70,$y))
                ->save($path);
                
            }elseif(empty($word3)){
                $img->open($mould)
                ->text($word1,$nameFont,'38','#ffffff', 9,array(-70,$y-60))
                ->text($word1,$nameFont,'38','#ffffff', 9,array(-71,$y-60))
                ->text($word2,'./Public/font/pf.ttf','18','#ffffff', 9,array(-70,$y-30))
                ->text($word4,'./Public/font/pf.ttf','18','#ffffff', 9,array(-70,$y))
                ->save($path);
            }elseif(empty($word4)){
                $img->open($mould)
                ->text($word1,$nameFont,'38','#ffffff', 9,array(-70,$y-60))
                ->text($word1,$nameFont,'38','#ffffff', 9,array(-71,$y-60))
                ->text($word2,'./Public/font/pf.ttf','18','#ffffff', 9,array(-70,$y-30))
                ->text($word3,'./Public/font/pf.ttf','18','#ffffff', 9,array(-70,$y))
                ->save($path);
            }else{
                $img->open($mould)
                ->text($word1,$nameFont,'38','#ffffff', 9,array(-70,$y-90))
                ->text($word1,$nameFont,'38','#ffffff', 9,array(-71,$y-90))
                ->text($word2,'./Public/font/pf.ttf','18','#ffffff', 9,array(-70,$y-60))
                ->text($word3,'./Public/font/pf.ttf','18','#ffffff', 9,array(-70,$y-30))
                ->text($word4,'./Public/font/pf.ttf','18','#ffffff', 9,array(-70,$y))
                ->save($path);
            }
        }



        
        return $path;
        
    }
    
    /**
     *  线下抽奖活动海报生成
     * @param  $mould 海报模板地址
     * @param  $ewm_img  海报上的二维码图片地址
     * @param  $path  海报的地址
     * @param  $position array() 水印的位置,距离左上角
     * @return  返回生成海报图片地址
     */
    
    public function makePosterLsz($mould,$water_img,$path,$position){
        
        $image=new \Think\Image(1);
        
        $image->open($mould)
        
        ->water($water_img,$position,100)
        ->save($path);
        
        return $path;
        
    }
    
    public function imgThumb($imgUrl,$width,$thumbUrl){
        
        $image=new \Think\Image(1);
        
        $image->open($imgUrl)
        ->thumb($width,$width)
        ->save($thumbUrl);
    }
    
    
    
    protected function dologin($re) {
  
        $username = $re['openid'];
        
        $logincheck = md5($username . $re['id']);
        
        // 用户名+ md5密码 +sala
        $cookie['checka'] = $logincheck;
        $cookie['username'] = $username;
        cookie('checklogina', json_encode($cookie), 86400 * 365);

        S('uinfo' . $logincheck, $re);
        
    }
    

    /**
     * 前台模板显示 调用内置的模板引擎显示方法
     * @access protected
     * @param string $name 模板名
     * @param bool $type 模板输出
     * @return void
     */
    protected function siteDisplay($name='',$type = true,$tpl='') {
        C('TAGLIB_PRE_LOAD','Dux');
        C('TAGLIB_BEGIN','<!--{');
        C('TAGLIB_END','}-->');
        C('VIEW_PATH','./themes/');
        if(empty($tpl)){
            $tpl = C('TPL_NAME');
        }
        $data = $this->view->fetch($tpl.'/'.$name);
        //模板包含
        if(preg_match_all('/<!--#include\s*file=[\"|\'](.*)[\"|\']-->/', $data, $matches)){
            foreach ($matches[1] as $k => $v) {
                $ext=explode('.', $v);
                $ext=end($ext);
                $file=substr($v, 0, -(strlen($ext)+1));
                $phpText = $this->view->fetch($tpl.'/'.$file);
                $data = str_replace($matches[0][$k], $phpText, $data);
            }
        }
        //替换资源路径
        $tplReplace=array(
            //普通转义
            'search' => array(
                //转义路径
                "/<(.*?)(src=|href=|value=|background=)[\"|\'](images\/|img\/|css\/|js\/|style\/)(.*?)[\"|\'](.*?)>/",
            ),
            'replace' => array(
               
                "<$1$2\"".C('cdn').__ROOT__."/themes/".$tpl."/"."$3$4\"$5>",
            ),      
        );
        $data = preg_replace(  $tplReplace['search'] , $tplReplace['replace'] , $data);
        if($type){
            echo $data;
        }else{
            return $data;
        }
        
    }
	
	 protected function sitemDisplay($name='',$type = true) {
        C('TAGLIB_PRE_LOAD','Admin');
       // C('TAGLIB_BEGIN','<!--{');
       // C('TAGLIB_END','}-->');
        C('VIEW_PATH','./themes/');
        $data = $this->view->fetch(C('TPL_NAME').'/'.$name);
        //模板包含
        if(preg_match_all('/<!--#include\s*file=[\"|\'](.*)[\"|\']-->/', $data, $matches)){
            foreach ($matches[1] as $k => $v) {
                $ext=explode('.', $v);
                $ext=end($ext);
                $file=substr($v, 0, -(strlen($ext)+1));
                $phpText = $this->view->fetch(C('TPL_NAME').'/'.$file);
                $data = str_replace($matches[0][$k], $phpText, $data);
            }
        }
        //替换资源路径
        $tplReplace=array(
            //普通转义
            'search' => array(
                //转义路径
                "/<(.*?)(src=|href=|value=|background=)[\"|\'](images\/|img\/|css\/|js\/|style\/)(.*?)[\"|\'](.*?)>/",
            ),
            'replace' => array(
                "<$1$2\"".__ROOT__."/themes/".C('TPL_NAME')."/"."$3$4\"$5>",
            ),      
        );
        $data = preg_replace(  $tplReplace['search'] , $tplReplace['replace'] , $data);
        if($type){
            echo $data;
        }else{
            return $data;
        }
        
    }

    /**
     * 页面Meda信息组合
     * @return array 页面信息
     */
    protected function getMedia($title='',$keywords='',$description='',$mod='',$css='')
    {
    	$title2 = $title;
        if(empty($title)){
            $title=C('SITE_TITLE').' - '.C('SITE_SUBTITLE');
        }else{
            $title=$title.' - '.C('SITE_TITLE').' - '.C('SITE_SUBTITLE');
        }
        if(empty($keywords)){
            $keywords=C('SITE_KEYWORDS');
        }
        if(empty($description)){
            $description=C('SITE_DESCRIPTION');
        }
        
        
        return array(
            'title'=>$title,
            'keywords'=>$keywords,
            'description'=>$description,
        	'mod'=>$mod,
        	'title2'=>$title2,
        	 $css =>'menu-hover',	
        );
    }
	
    /**
     * 生成验证码
     */
    public function verifyCode(){
    	$Verify =     new \Think\Verify();
    	$Verify->fontSize = 100;
    	$Verify->length   = 4;
    	$Verify->useNoise = false;
    	$Verify->entry();
    }
    // 检测输入的验证码是否正确，$code为用户输入的验证码字符串
    protected function check_verify($code, $id = ''){
    	$verify = new \Think\Verify();
    	return $verify->check($code, $id);
    }
    



protected function send_mobcode($mob,$code){
		if(S('check'.$mob)==1) return '两次发送间隔需1分钟。';
	$url = 'http://106.dxton.com/webservice/sms.asmx/Submit?account=sss112&password=shanmao123789&mobile='.$mob.'&content='."您的验证码是：【".$code."】。请不要把验证码泄露给其他人。如非本人操作，可不用理会！";
			
			$res  = file_get_contents($url);
			//var_dump($res);
			$ref = json_decode(json_encode((array) simplexml_load_string($res)), true);
			if($ref['result']==100){
				S('check'.$mob,1,60);
				S($mob,$code,600);
				return true;
			}else{
				return  $ref['message'];
			}
}
    
    /**
     * 邮件验证
     *
     * @return true,false;
     * @since 2014-4-5
     */
    protected function isEmail($email) {
    	if (ereg ( "^([a-zA-Z0-9_-])+@([a-zA-Z0-9_-])+(\.[a-zA-Z0-9_-])+", $email )) {
    		return true;
    	} else {
    		return FALSE;
    	}
    }
    
    /**
     * 验证身份证号
     *
     * @param
     *        	$vStr
     * @return bool
     */
    protected function isCreditNo($vStr) {
    	$vCity = array (
    			'11',
    			'12',
    			'13',
    			'14',
    			'15',
    			'21',
    			'22',
    			'23',
    			'31',
    			'32',
    			'33',
    			'34',
    			'35',
    			'36',
    			'37',
    			'41',
    			'42',
    			'43',
    			'44',
    			'45',
    			'46',
    			'50',
    			'51',
    			'52',
    			'53',
    			'54',
    			'61',
    			'62',
    			'63',
    			'64',
    			'65',
    			'71',
    			'81',
    			'82',
    			'91'
    	);
    
    	if (! preg_match ( '/^([\d]{17}[xX\d]|[\d]{15})$/', $vStr ))
    		return false;
    
    	if (! in_array ( substr ( $vStr, 0, 2 ), $vCity ))
    		return false;
    
    	$vStr = preg_replace ( '/[xX]$/i', 'a', $vStr );
    	$vLength = strlen ( $vStr );
    
    	if ($vLength == 18) {
    		$vBirthday = substr ( $vStr, 6, 4 ) . '-' . substr ( $vStr, 10, 2 ) . '-' . substr ( $vStr, 12, 2 );
    	} else {
    		$vBirthday = '19' . substr ( $vStr, 6, 2 ) . '-' . substr ( $vStr, 8, 2 ) . '-' . substr ( $vStr, 10, 2 );
    	}
    
    	if (date ( 'Y-m-d', strtotime ( $vBirthday ) ) != $vBirthday)
    		return false;
    	if ($vLength == 18) {
    		$vSum = 0;
    			
    		for($i = 17; $i >= 0; $i --) {
    			$vSubStr = substr ( $vStr, 17 - $i, 1 );
    			$vSum += (pow ( 2, $i ) % 11) * (($vSubStr == 'a') ? 10 : intval ( $vSubStr, 11 ));
    		}
    			
    		if ($vSum % 11 != 1)
    			return false;
    	}
    
    	return true;
    }
    
    /**
     * 验证手机号码
     *
     * @param string $email
     * @return boolean
     */
    protected function isTel($mobilePhone) {
    	if (preg_match ( "/1[34587]{1}\d{9}$/", $mobilePhone )) {
    		return true;
    	} else {
    		return false;
    	}
    }
    
    


  
  
  
	
protected function get_token($appid=0,$appsecret=0,$new=0){

	$appid = $appid?$appid:C('APPID');
	$appsecret = $appsecret?$appsecret:C('SCRETID');
	if(S('access_tokens'.$appid) && $new==0) return S('access_tokens'.$appid);
	
	$url = "https://api.weixin.qq.com/cgi-bin/token?grant_type=client_credential&appid=$appid&secret=$appsecret";
        $ret_json = $this->curl_get_contents($url);
        $ret = json_decode($ret_json);
       // dump($ret);
        if($ret -> access_token){  	
        	
			S('access_tokens'.$appid,$ret -> access_token,7000);
			return $ret -> access_token;
			}
}	

protected function get_card_ticket($asstonek){
	if(S('card_ticket')) return S('card_ticket');
	if(!$asstonek) return 'assess token error';
	$ticket = $this->curl_get_contents("https://api.weixin.qq.com/cgi-bin/ticket/getticket?access_token=".$asstonek."&type=wx_card");
	 $ret = json_decode($ticket);
        if($ret -> ticket){
			S('card_ticket',$ret -> ticket,3600);
			return $ret -> ticket;
			}
}
	
	
protected function is_weixin(){
if (strpos($_SERVER['HTTP_USER_AGENT'], 'MicroMessenger') !== false ) {
return true;
}
return false;
}

protected function getRandStr($length){
	$str = 'abcdefghijklmnopqrstuvwxyz0123456789ABCDEFGHIJKLMNOPQRSTUVWXYZ';
	$randString = '';
	$len = strlen($str)-1;
	for($i = 0;$i < $length;$i ++){
		$num = mt_rand(0, $len);
		$randString .= $str[$num];
	}
	return $randString;
}

protected function getRandNum($length){
    $str = '0123456789';
    $randString = '';
    $len = strlen($str)-1;
    for($i = 0;$i < $length;$i ++){
        $num = mt_rand(0, $len);
        $randString .= $str[$num];
    }
    return $randString;
}




protected function get_url() {
$sys_protocal = isset($_SERVER['SERVER_PORT']) && $_SERVER['SERVER_PORT'] == '443' ? 'https://' : 'http://';
$php_self = $_SERVER['PHP_SELF'] ? $_SERVER['PHP_SELF'] : $_SERVER['SCRIPT_NAME'];

$path_info = isset($_SERVER['PATH_INFO']) ? $_SERVER['PATH_INFO'] : '';
$relate_url = isset($_SERVER['REQUEST_URI']) ? $_SERVER['REQUEST_URI'] : $php_self.(isset($_SERVER['QUERY_STRING']) ? '?'.$_SERVER['QUERY_STRING'] : $path_info);
return $sys_protocal.(isset($_SERVER['HTTP_HOST']) ? $_SERVER['HTTP_HOST'] : '').$relate_url;
}

public function curl_get_contents($url){
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, $url);
    curl_setopt($ch, CURLOPT_TIMEOUT, 1);
    curl_setopt($ch, CURLOPT_MAXREDIRS, 200);
    curl_setopt($ch, CURLOPT_USERAGENT, _USERAGENT_);
    curl_setopt($ch, CURLOPT_REFERER, _REFERER_);
    @curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, FALSE);
    curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, false);
    $r = curl_exec($ch);
    curl_close($ch);
    return $r;
}

protected function curlp($post_url,$xjson){//php post
	$ch = curl_init($post_url);
	curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST");
	curl_setopt($ch, CURLOPT_POSTFIELDS,$xjson);
	curl_setopt($ch, CURLOPT_RETURNTRANSFER,true);
	 curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, FALSE);
    curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, false);
	curl_setopt($ch, CURLOPT_HTTPHEADER, array(
	'Content-Type: application/json',
	'Content-Length: ' . strlen($xjson))
	);
	$respose_data = curl_exec($ch);
	return $respose_data;
	}

/**
* 
* @param undefined $jifen
* @param undefined $type 改变方式   关注送积分 =1  邀请获得 =2
* @note = 0 不发送通知
* 
* @return  积分变动结果
*/
public function changejifen($jifen,$type='1',$desc='',$uid='',$note=0){
	if(!$jifen) return false;	
	$data['uid']=$uid?$uid:$this->uinfo['id'];
	if(!$data['uid']) return FALSE;
	$data['jifen']=$jifen;	
	$data['time']=time();	
	$data['type']=$type;	
	$data['desc']=$desc;
	$res = M("account_log")->add($data);	
	if($res){
		M("Users")->where("id=".$data['uid'])->setInc('jifen',$jifen);
		$re = M("Users")->find($data['uid']);		
		if($note>0) {			
			A('Weixin')->sendmb_jifen($re['weixin'],'您好，您有新的积分变动',$jifen,$re['jifen'],$desc,$re["user_nicename"]);
			}
		return $re['jifen'];
	}
}
 
 /**
 * 
 * @param undefined $fee
 * @param undefined $type  发送失败 转移到 余额 3
 * @param undefined $desc
 * @param undefined $uid
 * @param undefined $note
 * 
 * @return
 */
public function changemoney($fee,$type='3',$desc='',$uid='',$note=0){
	if(!$fee) return false;	
	$data['uid']=$uid?$uid:$this->uinfo['id'];
	if(!$data['uid']) return FALSE;
	$data['money']=$fee;	
	$data['time']=time();	
	$data['type']=$type;	
	$data['desc']=$desc;
	$res = M("account_log")->add($data);	
	if($res){
		M("Users")->where("id=".$data['uid'])->setInc('money',$fee);
		$re = M("Users")->find($data['uid']);		
		if($note>0) {
			A('Weixin')->sendmb_money($re['weixin'],'您好，您有新的余额变动',$fee,$re['money'],$desc." 余额可提现和兑换积分。",$re["user_nicename"]);
			}
		return $re['money'];
	}
} 
 
 
 
 
public function openidrepid($openid){//openid 得到上级pid
 	return M("Users")->where("weixin='{$openid}'")->getField('parent_id');
}


  
	
	
}