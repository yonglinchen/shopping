
$(function(){
    var album_idarray="";//用于接收批量删除操作id以逗号分割的字符串 例如：1,2
    var album_id=""; //获取相册的id
    /**-------------------------------------------上传图片到指定相册-----------------------------------------------------*/
    var uploading_to_album='<form method="POST" action="../../index.php" enctype="multipart/form-data" onsubmit="return fun(this)">';
    uploading_to_album+='<div class="create_photo">';
    var service = JSON.stringify({
        "inter_num":"0030",
        "servicecode":"9005"
    });
    uploading_to_album+='<input type="hidden" name="service" value=\''+service+'\'/>';
    uploading_to_album+=' <label>上传到：</label>';
    uploading_to_album+='<input class="form-control photoinput" name="albumname" id="galname" value="" disabled="true" type="text">';
    uploading_to_album+='<p class="create_button">';
    uploading_to_album+='<input type="button" class="confirmbtn" value="选择照片"/><input id="file_upload" name="file_upload" class="file_upload" type="file" name="uploadfile[]" multiple="true">';
    uploading_to_album+='<input type="submit" class="confirmbtn" value="提交"/>';
    uploading_to_album+='</p></div></form>';
    var ViewPhotoAction={
        PicContainer:$("#container"), //照片结果集所放的容器
        AlbumInfo:$("#photoinfo"),//相册信息
        BATCH_OPERATION:"#batch_operation",//点击批量操作按钮、、按钮隐藏、全选和删除按钮显示出来
        BATCHREMOVE:"#batch_remove",//批量删除
        CONFIRM_DELETE:"#confirm_delete",//确认删除
        UPLOADINGBTN_TO_ALBUM:"#uploadingbtn_to_album",//上传图片到相册
        /*读取url路径中的参数*/
        GetUrlParameter: function (name){
            var reg = new RegExp("(^|&)"+ name +"=([^&]*)(&|$)");
            var r = window.location.search.substr(1).match(reg);
            if(r!=null)return  unescape(r[2]);
            return null;
        },
        init:function(){
            CommonAction.init();
            CommonAction.onEvent();
            ViewPhotoAction.onEvent();
             fancybox();
        },
        LoadData:function(){
            album_id=ViewPhotoAction.GetUrlParameter("photo_id");
            console.log("从photo页面传入的id值："+ViewPhotoAction.GetUrlParameter("photo_id"));
            /*然后根据id值查询、当前相册里面所包含的照片、里面涉及到图片的分页*/
            /*模拟相册信息   start*/
            ViewPhotoAction.AlbumInfo.find("div.left img").attr("src","./images/img_1.png");//相册封面取得是第一张图片的url
            ViewPhotoAction.AlbumInfo.find("div.right label.name").html("galname");//相册封面取得是第一张图片的url
            ViewPhotoAction.AlbumInfo.find("div.right label.amount").html(666);//相册中图片的总数
            /*模拟相册信息   end*/
            /*模拟数据照片数据 start*/
            var array=new Array();
            array.push({
                'name':'照片一',
                'url':'./images/img_1.png',
                'id':'11'
            });
            array.push({
                'name':'照片二',
                'url':'./images/img_2.png',
                'id':'22'
            });
            /*模拟数据照片数据 end*/
            ViewPhotoAction.init();
            /*调取拼接数据方法*/
            ViewPhotoAction.PicContainer.append(CommonAction.SplicingData(array,1)) ; 
            
        /*模拟数据  end*/
        },
        onEvent:function(){
            /*点击批量*/
            $(ViewPhotoAction.BATCH_OPERATION).on("click",function(){
                if(document.getElementById("showhiden").hidden==true){
                    $(".butn input:last").addClass("batchremove");
                    document.getElementById("showhiden").hidden=false;
                }else{
                    document.getElementById("showhiden").hidden=true;
                               
                }
            })
            /*批量删除*/
            $(ViewPhotoAction.BATCHREMOVE).on("click",function(){
                album_idarray=CommonAction.BacthDelete("albumlst_list");
            })
            /*确认删除*/
            $(ViewPhotoAction.CONFIRM_DELETE).live("click",function(){
                // 为要删除的id 用逗号分割成为字符串  例如：1,2
                console.log("删除相册id字符串："+album_idarray);
                //异步请求
                //删除页面数据
                var del_arr= album_idarray.split(","); //拆分
                del_arr.forEach(function(del){
                    $(".box[node='"+del+"']").remove();//删除
                })
                $("#FaustCplus").dialog("close"); 
            })
            /*在相册中点击上传图片*/
            $(ViewPhotoAction.UPLOADINGBTN_TO_ALBUM).on("click",function(){
                /*获取当前相册的名称*/
                var album_name=ViewPhotoAction.AlbumInfo.find("div.right label.name").html();
                
                /*获取当前相册的id   */
                console.log("当前相册id:"+album_id);
                $('#FaustCplus').dialog('option', 'title', "上传照片");
                $('#FaustCplus').html(uploading_to_album);
                //给当前的相册名称复制
                $("#galname").val(album_name);
                $('#FaustCplus').dialog('open');
            })
            
        }
    }
    ViewPhotoAction.LoadData();
})

function fancybox(){
    $('.fancybox').fancybox();

    /*
			 *  Different effects
			 */

}