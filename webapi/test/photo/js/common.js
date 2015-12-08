/**-------------------------------------------上传图片-----------------------------------------------------*/
var uploading='<form method="POST" action="../../index.php" enctype="multipart/form-data" onsubmit="return fun(this)">';
uploading+='<div class="create_photo">';
var service = JSON.stringify({
    "inter_num":"0030",
    "servicecode":"9005"
});
uploading+='<input type="hidden" name="service" value=\''+service+'\'/>';
uploading+=' <label>上传到：</label>';
uploading+='<select  name="albumname" id="albumname" class="photoinput" >';
uploading+='<option value="">请选择您的相册</option>';
uploading+='</select>';
uploading+='<p class="create_button">';
uploading+='<input type="button" class="confirmbtn" value="选择照片"/><input id="file_upload" name="file_upload" class="file_upload" type="file" name="uploadfile[]" multiple="true">';
uploading+='<input type="submit" class="confirmbtn" value="提交"/>';
uploading+='</p></div></form>';

/**-------------------------------------------确认删除相册弹出窗口-----------------------------------------------------*/
var confirm_delete='<div  class="create_photo txt_align" >';
confirm_delete+='<p>你确定要删除这<span class="delete_num">1</span>个相册？</p>';
confirm_delete+='<p>如果确认，则相册中所含的照片将全部删除!!</p>';
confirm_delete+='<p class="create_button">';
confirm_delete+='<input class="confirmbtn" id="confirm_delete" type="button"  value="删除"/>';
confirm_delete+='<input class="canelbtn" type="button" value="取消"/>';
confirm_delete+='</p>';
confirm_delete+='</div>';
/**-------------------------------------------确认删除照片弹出窗口-----------------------------------------------------*/
var confirm_pic_delete='<div  class="create_photo txt_align" >';
confirm_pic_delete+='<p>你确定要删除这<span class="delete_num">1</span>张照片吗？</p>';
confirm_pic_delete+='<p class="create_button">';
confirm_pic_delete+='<input class="confirmbtn" id="confirm_delete" type="button"  value="删除"/>';
confirm_pic_delete+='<input class="canelbtn" type="button" value="取消"/>';
confirm_pic_delete+='</p>';
confirm_pic_delete+='</div>';
/**-------------------------------------------删除没有选择数据-----------------------------------------------------*/
var delete_no_data='<div  class="create_photo">请选择要操作的数据！！！</div>';
var CommonAction={
    FILEUPLOADBTN:"#uploadingbtn",//上传
    CANELBTN :".canelbtn",//取消按钮
    ALBUMNAME:"#albumname", //选择相册的select  
    SELECT_ALL:"#select_all_check",//全选
   
    init:function(){
        $('#FaustCplus').dialog({
            autoOpen: false, //如果设置为true，则默认页面加载完毕后，就自动弹出对话框；相反则处理hidden状态。
            bgiframe: true, //解决ie6中遮罩层盖不住select的问题 
            width:  500 ,
            diaggable:false,
            resizable:false,
            modal: true, //这个就是遮罩效果  
        });   
    },
    SplicingData:function(records,id){//拼接数据
        var html_content="";
        records.forEach(function(record){
            
            html_content+= CommonAction.SplicingHtml(record,id);
        })
        return  html_content;
    },
    
    SplicingHtml:function(record,id){
        var class_name=id==0?"view_photo":"view_pic photolst_photo fancybox";
        var str_fancybox_pro=id==1?'data-fancybox-group="gallery"':"";
        var str_html='<div class="box albumlst" node="'+record.id+'">';
        str_html+='<div class="pal">';
        str_html+='<a href="'+(id==1?record.url:'javascript:void(0)')+'" class="'+class_name+'" node="'+record.id+'" '+str_fancybox_pro+'>';
        str_html+='<img src="'+record.url+'" />';
        str_html+='</a></div>';
        str_html+=' <div class="albumlst_r">';
        str_html+='<p class="pd05">';
        str_html+='<a href="javascript:void(0)" class="'+class_name+'" node="'+record.id+'">'+record.name+'</a>';
        str_html+='<input type="checkbox" name="albumlst_list"  node="'+record.id+'" id=""/>';
        str_html+='</p>';
        str_html+='</div></div>';
        return str_html;
    },
    /*
     *label_name为标签名称  例如：<input type="checkbox" name="albumlst_list" id=""/> 中的name
     **/  
    SelectAll:function(e,label_name){
        var obj = $("input[name='"+label_name+"']");
        for (var i=0;i<obj.length;i++){
            obj[i].checked=e[0].checked ;
        }
    },
    /*
         *  id_property_name   id属性名称
         *  type 删除的类型  如果为0表示的是相册、为1表示的是照片
         */
    BacthDelete:function(id_property_name,type){
        var album_idarray="";  //将删除的id都拼接成一个字符串
        var count =0; //用于记录勾选数据的个数
        var num=$("input[name='"+id_property_name+"']:checked");//获取当前所选中的
        
        for(var i=0;i<num.length;i++){
            if(i==num.length-1){
                album_idarray+=$(num[i]).attr("node");
            }else{
                album_idarray+=$(num[i]).attr("node")+",";
            }
            count=count+1;
        }
        if(count>0){
            
            $('#FaustCplus').dialog('option', 'title', "提示");
            $('#FaustCplus').html(type==0?confirm_delete:confirm_pic_delete);
            $("span.delete_num").html(count);
            $('#FaustCplus').dialog('open');
        }
        else{   
            $('#FaustCplus').dialog('option', 'title', "提示");
            $('#FaustCplus').html(delete_no_data);
            $('#FaustCplus').dialog('open');
        }
        return album_idarray;
    },
    onEvent:function(){
        /*点击上传图片*/
        $(CommonAction.FILEUPLOADBTN).live("click",function(){
            //弹出框
            $('#FaustCplus').dialog('option', 'title', "上传图片");
            $('#FaustCplus').html(uploading);
            //获取当前所有的相册 albumname
            var option_str="";
            for(var i=0;i<2;i++){
                option_str+="<option value="+i+">相册"+(i+1)+"</option>";
            }
            $("#albumname").append(option_str);
            $("#FaustCplus").dialog("open"); 
        });
        /*点击取消*/
        $(CommonAction.CANELBTN).live("click",function(){
            $(this).parents("div.dialogDiv").dialog("close");
        })
        $(CommonAction.ALBUMNAME).live("change",function(){
            var val= $(this).val();
            if(val!=""){
                $(this).removeAttr("style");
            }
        })
        /*全选*/
        $(CommonAction.SELECT_ALL).on("click",function(){
            //传一个参数
            CommonAction.SelectAll($(this),"albumlst_list");
        });
      
    }
}

