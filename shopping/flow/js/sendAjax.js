/*
 --------------------------------------------------------------------------------------------------------------------- 
 * ajax提交
  */
function apiSendAjax(url, vars, async, callback) {
    return $.ajax({
        type : "POST",
        url : url,
        data : vars,
        async : async,//异步为true，同步false
        dataType : "json",
        success : function(data){
            callback(data.status,data);
        },
        error : function(xhr, type, exception){  
            console.log(xhr.status +"\n"+xhr.responseText);                   
            callback('-404',"error");
        }
    });
}