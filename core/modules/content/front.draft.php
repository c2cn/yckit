<?php
if(!defined('ROOT'))exit('Access denied!');
if($this->do=='draft'){
	if(empty($_SESSION['user_id']))http_404();
	if($this->config['content_draft_status']==0)http_404();
	$this->template->in('category_option',$content->category_option(0,0,true));
	$this->template->in('header',$this->get_header());
	$this->template->in('footer',$this->get_footer());
	$this->template->out('content.draft.php');
}
if($this->do=='draft_insert'){
	check_request();
	if(empty($_SESSION['user_id']))http_404();
	if($this->config['content_draft_status']==0)http_404();
	$draft_title=empty($_POST['draft_title'])?'':trim(addslashes($_POST['draft_title']));
	$draft_content=empty($_POST['draft_content'])?'':trim(addslashes($_POST['draft_content']));
	$draft_author=empty($_POST['draft_author'])?'':trim(addslashes($_POST['draft_author']));
	$category_id=empty($_POST['category_id'])?'':intval($_POST['category_id']);
	/*
	$code=empty($_POST['code'])?'':trim(addslashes($_POST['code']));
	if($code!=$_SESSION['code']){
		alert('验证码错误');
	}
	*/
	if($draft_title=='')alert('标题不能为空');
	if($draft_content=='')alert('内容不能为空');
	if($draft_author=='')alert('作者不能为空');
	$array=array();
	$array['draft_title']=$draft_title;
	$array['draft_content']=$draft_content;
	$array['draft_author']=$draft_author;
	$array['category_id']=$category_id;
	$array['draft_time']=$_SERVER['REQUEST_TIME'];
	$this->db->insert(DB_PREFIX."content_draft",$array);
	alert('感谢您的投递！我们会在第一时间审核！',PATH);
}