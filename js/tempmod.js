//模板页_tempPage对象
var _TempPage = _TempPage || {};
_TempPage = {
	editing:false, //是否已经修改，每次保存重置为false
	sectionID:0,	 //横切累加ID
	blockID:0,		 //栏目块累加ID
	sdata:_tmpldata.section,	//横切模板数据
	bdata:_tmpldata.block,	//栏目块模板数据
	sections:[],
	blocks:[],
	textarea:"",
	create:function(){},
	del:function(){},
	check:function(){
			
	},	
	save:function(){
		var tmplBox = $("#tmplcontainer"), tmplForm = $("#"+_TempPage.textarea),
			tmplHtml = "";
		if(confirm("格式化后将无法再对当前内容进行编辑，是否确认？")){
			tmplBox.find(".btnblock, .sectionTool, .blockTool, br")
			.each(function(){
				$(this).remove()
			});
			tmplHtml = tmplBox.html();
			tmplForm.html(tmplHtml);
			alert("保存成功")
		}else{
			return	
		}
		_TempPage.editing = false	
	},
	init:function(tid){
		_TempPage.textarea = tid;
		$("#tmpl_section").bind("click",_TempPage.Section.list);
		$("#tmpl_save").bind("click",_TempPage.save);
		_TempPage.NoResize();
		window.onbeforeunload = function(){
			if(_TempPage.editing){
				return "您刚才的操作还没有保存，直接关闭浏览器将导致刚才的修改失效！";
			}
		}
	}
};

//横切Section操作
_TempPage.Section = {
	data:[],
	list:function(){
		var sectionLi=[], sectionlist = _TempPage.sdata, objli;
			i=0,l=sectionlist.length;
		if(l>0){
			l = sectionlist.length;
			for(;i<l;i++){
				sectionLi[i] = '<li class="'+sectionlist[i].type+'"><a href="javascript://" title="'+sectionlist[i].title+'"></a></li>'
			}
			$("#SectionList").find("ul").html(sectionLi.join(""))
			.find("li").each(function(index,element){
                $(element).bind("click",function(e){
					_TempPage.Section.add(index);
					secDialog.close();
					_TempPage.preventDefault(e)
				})
            });
			var secDialog = art.dialog({id:"secDialog",lock:true,fixed:false,resize:false,padding:'0 0',content:document.getElementById('NewSection')});
		}
	},
	add:function(index){
		var newSectionId = "sec_"+_TempPage.sectionID;
		var reg = /\{\$blocktail\}/g;
		var addblock = '<div class="btnblock"><input type="button" name="addBlock" class="addBlock" value="添加模块" /></div>';
		//栏目块工具条
		var toolSection = '<div class="sectionTool"><span class="icon_del" title="删除">删除</span></div>';
		
		_TempPage.sectionID++;
		_TempPage.Section.data.push(newSectionId);
		
		var newsection = _TempPage.sdata[index].html.replace(reg,addblock);
		var domSection = $(newsection).attr("id", newSectionId);
		var domTool = $(toolSection);
		
		domSection.find(".addBlock").each(function(index,element){
			$(element).bind("click",function(){
				_TempPage.Block.list(newSectionId,index,this)
			})
		});
		
		domTool.find(".icon_del").bind("click",function(){ //删除横切
			_TempPage.Section.del(newSectionId);
			$(this).blur()
		});
		domSection.append(domTool).bind("mouseover",function(){
			$(this).addClass("activited");
			domSection.find(".sectionTool").show()
		}).bind("mouseout",function(){
			$(this).removeClass("activited");
			domSection.find(".sectionTool").hide()
		});
		$("#tmplcontainer").append(domSection);
		_TempPage.editing = true
	},
	del:function(SectionId){
		if("string" !== typeof SectionId || "" == SectionId)return;
		domTool = $("#"+SectionId).find(".sectionTool");
		if(!confirm("确定要删除此横切吗？")){
			//删除ckeditor附加标记
			_TempPage.delDirty(domTool);
			return;
		}
		$("#"+SectionId).remove();
		_TempPage.editing = true
	}
	
};

//栏目块Block操作
_TempPage.Block = {
	data:[],
	list:function(secid,col,btnObj){
		var blockLi=[], blockDialog = null, blocklist = _TempPage.bdata;
			i=0,l=blocklist.length;
		var that = this;
		if(l>0){
			l = blocklist.length;
			for(;i<l;i++){
				blockLi[i] = '<li class="'+blocklist[i].type+'"><h3>'+blocklist[i].title+'</h3><p><a href="javascript://" class="addBlock" title="'+blocklist[i].title+'"><img src="'+blocklist[i].imgTmpl+'" alt="'+blocklist[i].title+'" /></a></p></li>'
			}
			
			$("#NewBlockList").find("ul").html(blockLi.join("")).find("li")
			.each(function(index, element) {
				var addBlock = $(element).find("a.addBlock");
               	addBlock.bind("click",function(e){
					_TempPage.Block.add(secid,index,col,btnObj);
					blockDialog.close();
					_TempPage.preventDefault(e)
				});
            });
			blockDialog = art.dialog({id:"blockDialog",lock:true,fixed:false,resize:false,padding:'0 0',content:document.getElementById('NewBlock')});
		}
	},
	add:function(secid,index,col,btnObj){	//创建新栏目块
		var newBlockId = "block_"+_TempPage.blockID,  //栏目块ID
			newBlock = _TempPage.bdata[index].html,   //读取栏目块模板
			colNum = col+1,						  		//计算所在横切列序
			colTotal = $("#"+secid).children().length-1;  //计算所在横切总列数
		_TempPage.blockID++;
		_TempPage.Block.data.push(newBlockId);	
		
		//栏目块工具条
		var toolBlock = '<div class="blockTool"><span class="icon_del" title="删除">删除</span><span class="icon_up" title="上移">上移</span><span class="icon_down" title="下移">下移</span><span class="icon_add" title="增加">增加</span></div>';
		
		var domBlock = $(newBlock).attr("id", newBlockId),
			domCol = $("#"+secid).find("div.c_"+colNum),
			colChilds = domCol.children(".c_wrap"),
			domTool = $(toolBlock);
		if(colChilds.length>0)domBlock.addClass("mt10");
		
		domTool.find(".icon_del").bind("click",function(){ //删除栏目块
			_TempPage.Block.del(newBlockId)
		});		
		domTool.find(".icon_add").bind("click",function(){ //复制栏目块
			_TempPage.Block.add(secid,index,col,btnObj)
		});		
		domTool.find(".icon_up").bind("click",function(){ //上移栏目块
			_TempPage.Block.up(newBlockId,colTotal,colNum)
		});		
		domTool.find(".icon_down").bind("click",function(){ //下移栏目块
			_TempPage.Block.down(newBlockId,colTotal,colNum)
		});
		
		domBlock.append(domTool).bind("mouseover",function(){
			$(this).addClass("activited");
			domTool.show();
			if(colNum == colTotal)domTool.addClass("left").css({"left":-25});
			//console.log(colNum+", "+colTotal+", "+$("#"+secid).children().length)
		}).bind("mouseout",function(){
			$(this).removeClass("activited");
			domTool.hide()
		});
		
		$(btnObj).parent().before(domBlock);
		_TempPage.editing = true
	},
	del:function(BlockId){	//删除栏目块
		if("string" !== typeof BlockId || "" == BlockId)return;
		var orignblock = $("#"+BlockId),
			prevObj = orignblock.prev(".c_wrap"),
			nextObj = orignblock.next(".c_wrap");
		if(!confirm("确定要删除此栏目块吗？")){
			orignblock.mouseout();
			return
		};
		$("#"+BlockId).remove();
		_TempPage.Block.setspace(prevObj,nextObj)
		_TempPage.editing = true;
	},
	up:function(BlockId,colTotal,colNum){ //上移栏目块
		if("string" !== typeof BlockId || "" == BlockId)return;
		var orignblock = $("#"+BlockId),
			cloneblock = orignblock.clone(true),
			prevObj = orignblock.prev(".c_wrap"),
			orignTool = orignblock.find(".blockTool"),
			cloneTool = cloneblock.find(".blockTool");
		if(prevObj.length){
			prevObj.before(cloneblock);
			orignblock.remove();
			cloneTool.hide();
			_TempPage.Block.setspace(cloneblock,prevObj)
		}else{
			alert("已经移动到第一位！");
			orignTool.hide();
			_TempPage.delDirty(orignTool)
		}
		
		//修复jquery clone BUG 为栏目块工具条重新绑定事件
		cloneblock.bind("mouseover",function(){
			$(this).addClass("activited");
			cloneTool.show();
			if(colNum == colTotal)cloneTool.css({"left":-25});
		}).bind("mouseout",function(){
			$(this).removeClass("activited");
			cloneTool.hide()
		});
		
		//删除ckeditor附加标记
		_TempPage.delDirty(cloneTool);
		_TempPage.editing = true
	},
	down:function(BlockId,colTotal,colNum){ //下移栏目块
		if("string" !== typeof BlockId || "" == BlockId)return;
		var orignblock = $("#"+BlockId), 
			cloneblock = orignblock.clone(true),
			nextObj = orignblock.next(".c_wrap"),
			orignTool = orignblock.find(".blockTool"),
			cloneTool = cloneblock.find(".blockTool");
		if(nextObj.length){
			nextObj.after(cloneblock);
			orignblock.remove();
			cloneTool.hide();
			_TempPage.Block.setspace(nextObj,cloneblock)
			
		}else{
			alert("已经移动到最后一位！");
			orignTool.hide();
			_TempPage.delDirty(orignTool)
		}
		
		//修复jquery clone BUG 为栏目块工具条重新绑定事件
		cloneblock.bind("mouseover",function(){
			$(this).addClass("activited");
			cloneTool.show();
			if(colNum == colTotal)cloneTool.css({"left":-25});
		}).bind("mouseout",function(){
			$(this).removeClass("activited");
			cloneTool.hide()
		});
		//删除ckeditor附加标记
		_TempPage.delDirty(cloneTool);
		_TempPage.editing = true
		
	},
	setspace:function(prev,next){	//重置同一横切中栏目块上下间距
		var pp = prev.prev(), nn = next.next();
		if(prev.length==0 && next.length==0)return;
		if(prev.length>0 && next.length==0){
			prev.removeClass("mt10")
		}else if(prev.length==0 && next.length>0){
			next.removeClass("mt10")
		}else if(prev.length>0 && next.length>0){
			if(pp.length==0){
				prev.removeClass("mt10")
				next.addClass("mt10")
			}
		}
		_TempPage.editing = true;
	}
}
_TempPage.delDirty = function(obj){
	obj.removeAttr("_moz_resizing");
	obj.removeAttr("_moz_abspos")
}
_TempPage.preventDefault = function(b) {
	var b = b || window.event;
    if(b.preventDefault){
        b.preventDefault()
    }else{
        b.returnValue = false
    }
}
_TempPage.NoResize = function(){
	if(_TempPage.browser()=='FF'){
	  document.execCommand('enableObjectResizing', false, 'false');
	}
}
_TempPage.browser = function(){
	var userAgent = navigator.userAgent; //取得浏览器的userAgent字符串
	var isOpera = userAgent.indexOf("Opera") > -1;
	
	if (isOpera){return "Opera"}; //判断是否Opera浏览器
	if (userAgent.indexOf("Firefox") > -1){return "FF";} //判断是否Firefox浏览器
	if (userAgent.indexOf("Safari") > -1){return "Safari";} //判断是否Safari浏览器
	if (userAgent.indexOf("compatible") > -1 && userAgent.indexOf("MSIE") > -1 && !isOpera){return "IE";} //判断是否IE浏览器
}