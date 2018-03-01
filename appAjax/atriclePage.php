<?php 			
      $hedOp = '<span class="bg-warning col-sm-offset-2 col-md-offset-2 col-lg-offset-3" style="font-size:500%;">';
      $hedCls = '</span>';
      $imgMainFormOp = '<div class="row"><img class="img-responsive col-xs-12 col-sm-10 col-md-10 col-lg-8 col-sm-offset-1 col-md-offset-1 col-lg-offset-2" atl="Main Artical Img" scr="';
			$imgMainFormCls = '"></div>';
			$imgStdFormRtOp = '<img class="pull-right img-responsive col-md-8 col-lg-6" atl="Inline Article Img" scr="';
			$imgStdFormLtOp = '<img class="pull-left img-responsive col-md-8 col-lg-6" atl="Inline Article Img" scr="';
			$imgStdFormCls = '">';
			$parLdOp = '<p class="lead">';
			$parLdCls = '</p>';
			$parStdOp = '<p>';
			$parStdCls = '</p>';
			$lnkOP = '<a href="';
			$lnkMid = '">';
			$lnkCls = '</a>';
			
			$runOrd = array();
			$body = $mainPic = '';
			$i = 0;
      $mp = false;

    if(isset($_POST['headline'])){
      $ttl = $hedOp . $_POST['headline'] . $hedCls;
    }
      
			
			if(isset($_POST['runOrd'])){
				
				$runOrd = explode(",", $_POST['runOrd']);
				
				foreach ($runOrd as $str){
					  
					switch (substr($str, -3)){
							
						case 'Txt':
							$body = textCont($str, $i);
							break;
						case 'Lnk':
							$body = linkCont($str, $i, $body);
							break;
						case 'Img':
							if(substr($str, 3, 1) == 1){
								$mainPic = ttlPic($str);
                $mp = true;
								break;
							} else {
								$body = picCont($str, $i);
								break;
							}
					}
					$i++;
				}
        
        if ($mp){
        
          echo '{"title" : "' . $ttl , '"mainPic": " '. $mainPic . '", "body":"' . $body .'"}'; 
          
        } else {
          echo $body;
        }
				
			}
		
		
		function text($txt, $inx){
			if($inx >+ 1){
				if(substr($runOrd[$inx-1], -3) == 'Lnk' ){
					return $_POST[$txt] . $parStdCls;  //<-- this is for a text right after a link
				} else {
					if(substr($txt, 3, 1) == 1){
						return $parLdOp . $_POST[$txt] . $parLdCls; //<-- this is for first para thats not after a link
					} else {
						return $parStdOp . $_POST[$txt] . $parStdCls; //<-- this is for standard para thats not after a link
					}
				}
			} else {
				if(substr($txt, 3, 1) == 1){
					return $parLdOp . $_POST[$txt] . $parLdCls; //<-- if this is the first element
				} //else {
// 					return $parStdOp . $_POST[$txt] . $parStdCls;
// 				}
			}
		}
		
		function linkCont($txt, $inx, $bodyIn){
			
			if ($inx == 0){
				if (substr($runOrd[$inx+1], -3) == 'Txt' ){
					return '<p>' . $lnkOp . $_POST[$txt] . $lnkMid;//<-- used if the first element next is text
				} else {
					return $lnkOp . $_POST[$txt] . $lnkMid;//<-- used if the first element
				}
			} else {
				if(substr($txt, 4, 3) == 'Url'){
					if (substr($runOrd[$inx-1], -3) == 'Txt' ){
						return str_replace('</p>', $lnkOp . $_POST[$txt] . $lnkMid, $bodyIn);
					} else if (substr($runOrd[$inx+1], -3) == 'Txt'){
						return '<p>' . $lnkOp . $_POST[$txt] . $lnkMid;
					} else {
						return $lnkOp . $_POST[$txt] . $lnkMid;	
					}
				} else {
					if (substr($runOrd[$inx+1], -3) == 'Txt'){
						return $lnkCls;
					} else {
						if($inx >= 2){
							if(substr($runOrd[$inx-2], -3) == 'Txt'){
								return $lnkCls . '</p>';
							} 
						} else {
							return $lnkCls;
						}
					}
				}
			} 
		}
		
		function ttlPic($txt){
			return $imgMainFormOp . $txt . $imgMainFormCls;
		}
		
		function picCont($txt, $n){
			
			if ($n % 2 === 0){
				return $imgStdFormRtOp . $txt . $imgStdFormCls;
			} else {
				return $imgStdFormLtOp . $txt . $imgStdFormCls;
			}
			
		}

		?>