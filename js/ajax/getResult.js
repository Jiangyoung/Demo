/**
 * @brief 合并所有分页中的内容统一展示
 *
 * 1、修改参数或者代码。。 （①开始页②结束页(有的页面可能是start和offse具体按不用页面修改)③网址④取具体内容的js代码）
 * 2、在需要的页面打开控制台
 * 3、复制改好的代码然后回车。
 */
var start = 1; //①
var end = 5;   //②
var baseUrl = "http://qiancheng.me/page/";  //③     (随便找了个分页的测试网站。。)
//var result = [""];

//execute
getResult(baseUrl,start,end,[""]);

function getResult(url,start,end,res){
	if(start > end){	
		//test 输出
		document.body.innerHTML=res.join("<hr/>");
		return;
	}
	var xmlhttp=new XMLHttpRequest();
	xmlhttp.open("GET",url+start,true);
	xmlhttp.send();
	xmlhttp.onreadystatechange = function(){
		if (xmlhttp.readyState==4 && xmlhttp.status==200)
		{
			console.log("loading " + ((start/end) * 100) + "%");
			
			//转document
			var doc = (new DOMParser()).parseFromString(xmlhttp.responseText,"text/html");
			//console.log(doc.getElementsByClassName("container")[0].getElementsByClassName("home post-list")[0]);
			//④    (这里的内容按照页面具体格式自己研究。。 目的是取出实际内容)
			res[start++] = doc.getElementsByClassName("container")[0].getElementsByClassName("home post-list")[0].innerHTML;			
			getResult(url,start,end,res);
		}else {
			//console.log("loading...");
			//console.log("xmlhttp.readyState:" + xmlhttp.readyState + ",xmlhttp.status:" + xmlhttp.status);
			//console.log("start:" + start + ",end:" + end);
		}
	}
}






