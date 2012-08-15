<?php
if(!defined('__XE__')) exit();

// file : indicategory.addon.php
// author : 인디스쿨웹팀 (webteam@indischool.com)
// license : 	GPL v2
// brief : 인디스쿨 학습자료실의 게시물을 분류합니다.


// 새 글을 작성해서 저장버튼을 누르고 act가 실행되고 난 직후
if(Context::get('act')=='procBoardInsertDocument' && $called_position == 'before_module_proc' && $this->toBool()) {


	// 확정변수 불러오기
	for($key=1;$key<=20;$key++)
	{

		$extra_vars = Context::get('extra_vars'.$key);

		// 확장변수가 더이상 존재하지 않으면 반복문 종료.
		// 게시판 확장변수를 설정할 때 반드시 필수항목으로 입력해야 함. 그렇지 않으면 중간에 확정변수 입력을 뛰어넘을 경우 이후의 확장변수가 태그에 반영이 안 됨.		
		if(!$extra_vars)
		{
			break;
		}

		// 확장변수가 있으면 분류코드에 추가. 단 $cfncode에 처음 입력할 때는 $exgra_vars 바로 입력. 그렇지 않으면 _(underbar)가 cfncode 앞에 붙음.
		else if(!$cfncode)
		{
			$cfncode = $extra_vars;
		}

		else
		{			
			$cfncode = $cfncode."_".$extra_vars;
		}
		//debugPrint("key : ".$key."\ncfncode : ".$cfncode);
	}
	
	// 미리 입력된 태그가 있으면 가져오기
	$tags = Context::get('tags');

	// 태그가 없으면 분류코드를 바로 입력, 입력된 태그가 있으면 생성된 분류코드를 추가로 입력
	if(!$tags)
	{
		Context::set('tags', $cfncode, 1);	
	} 
	else
	{
		$tags = $tags.",".$cfncode;
		Context::set('tags', $tags);
	}
	
}

?>