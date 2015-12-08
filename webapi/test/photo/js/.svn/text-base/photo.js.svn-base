document.write("<script type='text/javascript' src='"+_ROOT_URL_ + "libcode/js/serviceInterface.js'></script>");
$(function(){
    var album_idarray="";
    /**-------------------------------------------创建相册-----------------------------------------------------*/
    var create_photo_html='<form method="POST" action="./../index.php" enctype="multipart/form-data">'
    create_photo_html+=' <div class="create_photo">';
    create_photo_html+='<label class="album_name">相册名称：</label>';
    create_photo_html+='<input class="photoinput" placeholder="请输入相册名称" name="c_albumname" id="album_name" value = "" autocomplete="off" maxlength="8" />';
    create_photo_html+='<span id="userinput">0/8</span>';
    create_photo_html+=' <p class="create_button">';
    create_photo_html+='<input class="confirmbtn" id="confirm_create" type="button"  value="确认"/>';
    create_photo_html+='<input class="canelbtn" type="button" value="取消"/>';
    create_photo_html+='</p></div> </form>';
    /**-------------------------------------------创建相册   询问是否上传图片-----------------------------------------------------*/
    var is_uploading_img='<div class="create_photo txt_align">';
    is_uploading_img+='<p>相册创建成功、是否要上传照片？</p>';
    is_uploading_img+=' <p class="create_button" >';
    is_uploading_img+='<input class="confirmbtn" id="uploadingbtn" type="button"  value="上传图片"/>';
    is_uploading_img+='<input class="canelbtn" type="button" value="取消"/>';
    is_uploading_img+='</div>';
    //页面一开始需要加载所有的相册
    var PhotoAction={
        photoContainer:$("#container"),
        VIEWPHOTO:".view_photo", //查看相册
        CREATE_ALBUM:"#create_album",//创建相册
        CONFIRM_CREATE:"#confirm_create",//创建相册  确定按钮
        ALBUM_NAME :"#album_name",//相册名称输入
        BATCHREMOVE:"#batch_remove",//批量删除
        CONFIRM_DELETE:"#confirm_delete",//确认删除
        init:function(){
            CommonAction.init();
            CommonAction.onEvent();
            PhotoAction.onEvent();
        },
        RoadData:function(){ //加载数据
            /*模拟数据 start*/
            var array=new Array();
            array.push({
                'name':'xuejiao',
                'url':'./images/img_1.png',
                'id':'1'
            });
            array.push({
                'name':'dandan',
                'url':'./images/img_2.png',
                'id':'2'
            });
            /*模拟数据 end*/
            PhotoAction.init();
            /*调取拼接数据方法*/
            PhotoAction.photoContainer.append(CommonAction.SplicingData(array,0)) ; 
        },
       
        check_albumname:function(e){
            return PhotoAction.common_check_null(e)
        },
        common_check_null:function(e,value){
            var value = $(e).val();
            if(value==null||value==""){
                return false;
            }else{
                return true;
            }
        },
        onEvent:function(){
            /*查看相册*/
            $(PhotoAction.VIEWPHOTO).live({
                click:function(){
                    var id=$(this).attr("node");//获取的是相册id
                    console.log("相册id"+id);
                    window.location.href=_ROOT_URL_+"/test/photo/view_photo.html?photo_id="+id;
                }
            })
            /*创建相册*/
            $(PhotoAction.CREATE_ALBUM).on({
                click:function(){
                    $('#FaustCplus').dialog('option', 'title', "创建相册");
                    $('#FaustCplus').html(create_photo_html);
                    $('#FaustCplus').dialog('open');
                }
            })
            /*相册名称输入*/
            $(PhotoAction.ALBUM_NAME).live({
                keyup:function(){
                    $(this).next().html($(this).val().length+"/8");
                },
                
            })
           
            /*批量删除*/
            $(PhotoAction.BATCHREMOVE).on("click",function(){
                album_idarray=CommonAction.BacthDelete("albumlst_list",0);
            })
            /*确认删除*/
            $(PhotoAction.CONFIRM_DELETE).live("click",function(){
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
            /*创建相册点击确认*/
            $(PhotoAction.CONFIRM_CREATE).live("click",function(){
                var num=Math.ceil(Math.random()*100);//模拟数据、
                if(PhotoAction.check_albumname($("#album_name"))==false){
                    return;
                }
                var obj={
                    'name':$("#album_name").val(),
                    'url':'./images/defalut_album_face.png',
                    'id':num
                };
                //这里有异步请求、、当返回值是status为0的时候表示添加成功、  然后拼接数据 弹出是否上传图片的窗口
                PhotoAction.photoContainer.append(CommonAction.SplicingHtml(obj,0)); //1.拼接数据
                //拼接完毕数据、给弹出窗口换内容、
                $('#FaustCplus').dialog('option', 'title', "创建相册");
                $('#FaustCplus').html(is_uploading_img);
            })
            
        }
        
    }
    PhotoAction.RoadData();
   
})
function fun(e){
    var option_val=$(e).find("select").val();
    if(option_val==""||option_val==null){
        $(e).find("select").css("border","1px solid red");
        return false;
    }
    return true;
}
