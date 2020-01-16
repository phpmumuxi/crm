<?php
//000000000001s:3048:" <div class="pagination"><div class="span2">共114 条记录 1/23 页</div><div class="span4"><div><ul><li><span>首页</span></li><li><span>&laquo; 上一页</span></li><li><span class='current'>1</span><a href='/index.php?m=dynamic&a=index&p=2'>2</a><a href='/index.php?m=dynamic&a=index&p=3'>3</a><a href='/index.php?m=dynamic&a=index&p=4'>4</a><a href='/index.php?m=dynamic&a=index&p=5'>5</a></li><li><a href='/index.php?m=dynamic&a=index&p=2'>下一页 &raquo;</a></li><li><a href='/index.php?m=dynamic&a=index&p=23' >末页</a></li></ul></div></div><div class="span2">跳转至第<select style="width:auto;display:inline-block;" name="p" onchange="go_pagep(this.value)"><option value ="/index.php?m=dynamic&a=index&p=1" selected="selected">1</option><option value ="/index.php?m=dynamic&a=index&p=2" >2</option><option value ="/index.php?m=dynamic&a=index&p=3" >3</option><option value ="/index.php?m=dynamic&a=index&p=4" >4</option><option value ="/index.php?m=dynamic&a=index&p=5" >5</option><option value ="/index.php?m=dynamic&a=index&p=6" >6</option><option value ="/index.php?m=dynamic&a=index&p=7" >7</option><option value ="/index.php?m=dynamic&a=index&p=8" >8</option><option value ="/index.php?m=dynamic&a=index&p=9" >9</option><option value ="/index.php?m=dynamic&a=index&p=10" >10</option><option value ="/index.php?m=dynamic&a=index&p=11" >11</option><option value ="/index.php?m=dynamic&a=index&p=12" >12</option><option value ="/index.php?m=dynamic&a=index&p=13" >13</option><option value ="/index.php?m=dynamic&a=index&p=14" >14</option><option value ="/index.php?m=dynamic&a=index&p=15" >15</option><option value ="/index.php?m=dynamic&a=index&p=16" >16</option><option value ="/index.php?m=dynamic&a=index&p=17" >17</option><option value ="/index.php?m=dynamic&a=index&p=18" >18</option><option value ="/index.php?m=dynamic&a=index&p=19" >19</option><option value ="/index.php?m=dynamic&a=index&p=20" >20</option><option value ="/index.php?m=dynamic&a=index&p=21" >21</option><option value ="/index.php?m=dynamic&a=index&p=22" >22</option><option value ="/index.php?m=dynamic&a=index&p=23" >23</option></select><script type="text/javascript">
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