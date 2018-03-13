


var names = ["华米科技","趣店","爱奇艺","点牛金融","格林豪泰","尚德教育","虎牙","平安好医生(平安健康)","天立教育","博骏教育","春来教育","小米","哔哩哔哩","精锐教育","挖财","云米","掌麦科技","智融集团/用钱宝","小牛资本-小牛在线","爱钱进","途家网","脉脉","拉勾网","量化派","秒拍","优信二手车","易果生鲜网","新东方在线","蔚来汽车","微贷网","闪银奇异","海蓝教育","快手","微医集团(挂号网)","点融网","51信用卡","融金所","景域文化-驴妈妈","陆金所","同程旅游","找钢网","第七大道","中粮我买网","借贷宝","腾讯音乐","文思海辉","猫眼","斗鱼","映客","万达体育","猎聘网","复宏汉霖","纳恩博","美团","滴滴","VIPKID","瓜子二手车","今日头条","商汤科技SenseTime","蚂蚁金服","华领医药","微芯生物"];


var targetUrls = {};
var result = {};
var targetId = "invest-portfolio";
var targetUrls2 = {};


function getTargetUrl(name){
    var searchUrl = "https://www.itjuzi.com/search?word=" + name;
	var xmlhttp=new XMLHttpRequest();
	xmlhttp.open("GET", searchUrl, true);
	xmlhttp.send();
	xmlhttp.onreadystatechange = function(){
		if (xmlhttp.readyState==4 && xmlhttp.status==200)
		{
		    var targetUrl;
		    try {
				//转document
				var doc = (new DOMParser()).parseFromString(xmlhttp.responseText,"text/html");
				targetUrl = doc.getElementById("the_search_list").getElementsByTagName("li")[0].getElementsByTagName("a")[0].href;
			} catch (err) {
		        console.log(err);
		    }
			if (undefined === targetUrl || null === targetUrl) {
				targetUrl = "搜索失败";
			}
			console.log(name + " : " + targetUrl);
			targetUrls[name] = targetUrl;
			console.log("getTargetUrl " + (Object.keys(targetUrls).length / names.length * 100) + "%");
			if (Object.keys(targetUrls).length === names.length) {
				console.log("url获取完毕，开始获取具体url2。。。");
				getTargetUrl2s();
			}
		}else {
			console.log("getTargetUrl loading...");
			//console.log("xmlhttp.readyState:" + xmlhttp.readyState + ",xmlhttp.status:" + xmlhttp.status);
		}
		
	}
}

function getTargetUrl2(targetUrl, targetName, targetId){
    console.log(targetName);
    if (targetUrl.search("http") < 0) {
		targetUrls2[targetName] = "查询失败";
	}
	var data = null;
	var xhr = new XMLHttpRequest();
	xhr.withCredentials = true;
	xhr.addEventListener("readystatechange", function () {
	    if (this.readyState === 4) {
		    var targetContent;
			var currentName;
			var targetUrl2;
		    try {
				//转document
				var doc = (new DOMParser()).parseFromString(this.responseText, "text/html");
				targetContent = doc.getElementById(targetId);
				currentName = doc.getElementsByClassName("seo-important-title")[0].getAttribute("data-name");
				var tmpurls = targetContent.getElementsByTagName("a");
				for(var j=0;j<tmpurls.length;j++) {
				    if ("详情" == tmpurls[j].innerText) {
					    targetUrl2 = tmpurls[j].href;
						console.log(targetName + " : " + targetUrl2);
						break;
					}
				}
				//console.log(targetContent);
			} catch (err) {
			    console.log(err);
				if (undefined === currentName) {
				    currentName = targetUrl + " 查询失败";
				}
				if (undefined === targetUrl2 || null === targetUrl2) {
				    targetUrl2 = "查询失败";
				}
				if (undefined === targetContent || null === targetContent) {
				    targetContent = document.createElement("h4");
					targetContent.innerText = "内容获取失败";
				}
			}
			targetName += ' (' + currentName + ')';
			targetUrls2[targetName] = targetUrl2;
			console.log("getTargetUrl2 " + (Object.keys(targetUrls2).length / names.length * 100) + "%");
			if (Object.keys(targetUrls2).length === names.length) {
			    console.log("url获取完毕，开始获取具体内容。。。");
				getContents();
			}
		}else {
			console.log("getTargetUrl2 loading...");
			//console.log("this.readyState:" + this.readyState + ",this.status:" + this.status);
		}
	});
	xhr.open("GET", targetUrl);
	xhr.setRequestHeader("cache-control", "no-cache");
	xhr.send(data);
}


function getTargetContent(targetUrl, targetName){
    console.log(targetName);
	console.log(targetUrl);

    if (targetUrl.search("http") < 0) {
	    var tmpdoc = document.createElement("h3");
		tmpdoc.innerText = "查询失败";
	    result[targetUrl] = tmpdoc;
	}
	var data = null;
	var xhr = new XMLHttpRequest();
	xhr.withCredentials = true;
	xhr.addEventListener("readystatechange", function () {
	    if (this.readyState === 4) {
		    var targetContent;
			var currentName;
		    try {
				//转document
				var doc = (new DOMParser()).parseFromString(this.responseText, "text/html");
				var tmpcontents = doc.getElementsByClassName("main-left-container")[0].children;
				console.log(tmpcontents);
				for(var j=0;j<tmpcontents.length;j++) {
					var title = "";
					try {
						title = tmpcontents[j].getElementsByTagName("h2")[0].innerText;
					} catch (err) {
					}
				    if ("完整融资记录" == title) {
					    targetContent = tmpcontents[j];
						console.log(targetContent);
						break;
					}
				}
				targetContent = tmpcontents[4];
				currentName = doc.getElementsByClassName("investfirm-info")[0].children[1].innerText;
				//console.log(targetContent);
			} catch (err) {
			    console.log(err);
				if (undefined === targetContent || null === targetContent) {
				    targetContent = document.createElement("h4");
					targetContent.innerText = targetUrl + " 内容获取失败";
				}
				if (undefined === currentName || null === currentName) {
					currentName = "--获取失败--";
				}
			}
			targetName += ' (' + currentName + ')';
			result[targetName] = targetContent;
			console.log("getTargetContent " + (Object.keys(result).length / names.length * 100) + "%");
			if (Object.keys(result).length === names.length) {
			    //console.log(result);
				outputResult();
			}
		}else {
			console.log("getTargetContent loading...");
			//console.log("this.readyState:" + this.readyState + ",this.status:" + this.status);
		}
	});
	xhr.open("GET", targetUrl);
	xhr.setRequestHeader("cache-control", "no-cache");
	xhr.send(data);
}


function getTargetUrl2s() {
	for(key in targetUrls){
		getTargetUrl2(targetUrls[key], key, targetId);
	}
}

function getContents() {
	for(key in targetUrls2) {
		getTargetContent(targetUrls2[key], key);
	}
}

function outputResult() {
    var resultHtml = "";
    for (key in result) {
	    console.log("组装页面：" + key);
	    resultHtml += '<div class="on-edit-hide"><div class="rowhead feedback-btn-parent"><div class="picinfo"><div class="line-title"><span class="title"><h1 class="seo-important-title" data-name="'
		+key
		+'" data-fullname="">'
		+key
		+'</h1></span></div></div></div></div>';
		resultHtml += result[key].innerHTML;
		resultHtml += "<br/><br/>"
	}
    //document.getElementsByClassName("thewrap")[0].innerHTML = resultHtml;
	document.write(resultHtml);

}


for(var i=0; i<names.length;i++){
	getTargetUrl(names[i]);
}

