<?php
//000000000001s:1383:" <div class="pagination"><div class="span2">共1 条记录 1/1 页</div><div class="span4"><div><ul><li><span>首页</span></li><li><span>&laquo; 上一页</span></li><li></li><li><span>下一页 &raquo;</span></li><li><span>末页</span></li></ul></div></div><div class="span2">跳转至第<select style="width:auto;display:inline-block;" name="p" onchange="go_pagep(this.value)"><option value ="/index.php?m=dynamic&a=index&p=1" selected="selected">1</option></select><script type="text/javascript">
		   function changeURLArg(url,arg,arg_val){ 
				var pattern=arg+"=([^&]*)"; 
				var replaceText=arg+"="+arg_val; 
				if(url.match(pattern)){ 
				var tmp="/("+ arg+"=)([^&]*)/gi"; 
				        tmp=url.replace(eval(tmp),replaceText); 
				return tmp; 
				    }else{ 
				if(url.match("[\?]")){ 
				return url+"&"+replaceText; 
				        }else{ 
				return url+"?"+replaceText; 
				        } 
				    } 
				return url+"\n"+arg+"\n"+arg_val; 
			} 
		   function go_pagep(page){
				var listrows = $("#listrows option:selected").val();
				if(page.indexOf("listrows") <= 0){
					if(listrows > 0){
						window.location = page+"&listrows="+listrows;
					}else{
						window.location = page;
					}
				}else{
					window.location = changeURLArg(page,"listrows",listrows);
				}
			}
        </script>页</div></div> ";
?>