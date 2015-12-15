!function(){
    $(function () {
        var func = new MyFunction();
        func.init();
    });
}();

function MyFunction() {
    this.init= function () {
        this.add();
        this.cal();
        this.check();
        this.hrefopen();
        this.remove();
    },
    this.add= function () {
        var addEevent = $("#increment");
        addEevent.on("click", function () {
            var addNum = parseInt($("#changeNum").val())
            if($("#changeNum").attr("disabled")){
                $("#changeNum").removeAttr("disabled");
            };
            $("#changeNum").val(addNum+1)
        });
    },
    this.cal=function(){
       var decrement=$("#decrement"),changeNum=$("#changeNum");
       decrement.on("click", function () {
           var calNum = parseInt($("#changeNum").val());
           if(calNum==0){
               changeNum.attr("disabled","disabled");
              return false; 
           };
            changeNum.val(calNum-1);
           
        });
    },
    this.check=function(){
        $("#toggle-checkboxes_up,#toggle-checkboxes_down").on("click",function(){
            this.checked?$("input[type='checkbox']").each(function(){this.checked=true;}):$("input[type='checkbox']").each(function(){this.checked=false;});
        });
        $("input[name='checkItem']:checked").on("click",function(){
            alert(555)
            $("#toggle-checkboxes_up,#toggle-checkboxes_down").removeAttr("checked"); 
        });
       
    },
    this.hrefopen=function(){
        $(".submit-btn").on("click",function(){
            window.location.href= "getOrderInfo.html";
        });
       
    } ,
    this.remove=function(){
               $("#remove").on("click",function(){
                   $(this).parents("#product").remove();
               });
               $(".remove-batch").on("click",function(){
                   $("input[name='checkItem']:checked").each(function(){
                       $(this).parents("#product").remove();
                   })
               });
    }
}
