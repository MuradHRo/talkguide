
function updateData(){
    $(".update_btn").on("click",function(e){
    e.preventDefault();
    $.ajax({
        url:"dashboard?page=about_us",
        data:$("form.updateAbout").serialize(),
        type:"POST",
        success:function(){
            location.reload();
        },
        error:function(){
            alert("failed");
        }
    })
    })
}
function del_user(){
$(".del_user").on("click",function(){
    var id = $(this).attr("id");
    bootbox.confirm("هل انت متأكد من إزالة هذا العضو؟",function(result){
        $.post("handlers/dashboard_ajax?tableName=users&id="+id,{result:result});
        if(result){
            location.reload();
        }
    });
})
}

function newUser(){
    $(".newUser").on("click",function(e){
        e.preventDefault();
        $.ajax({
            url:"handlers/dashboard_ajax",
            type:"POST",
            data: $("form.userForm").serialize()+"&tableName=users",
            cache:true,
            success:function(result){
                $(".error_box").html(result);
                if ($(".error_box").html() == ""){
                    location.reload();
                }
                
            }
        })
    })
}

function userInfo(){
    $("#users").on("change",function(){
        $.ajax({
            url:"handlers/dashboard_ajax",
            type:"POST",
            data: "username=" + $(this).val(),
            cache:true,
            success:function(result){
                $(".userResult").html(result);
            }
        })
    })

}
function del_message(){
    $(".del_message").on("click",function(){
        var id = $(this).attr("id");
        bootbox.confirm("هل انت متأكد؟",function(result){
            $.post("handlers/dashboard_ajax?tableName=complaints&id="+id,{result:result});
            if(result){
                location.reload();
            }
        });
    })
    
}
function preventForms(){
    $("#addNewWord").on("click",function(e){
        e.preventDefault();
        if($(".newWordForm select").val() != null){
            $.ajax({
                url:"handlers/words_handler",
                type:"POST",
                data:$(".newWordForm").serialize() +"&tableName=" + $(".newWordForm select").val() ,
                cache:true,
                success:function(){
                    bootbox.alert("تم الإضافة بنجاح");
                }
                
            })
    
        }else{
            bootbox.alert("برجاء اختيار القسم");
        }
    })
    $("#addNewVerb").on("click",function(e){
        e.preventDefault();
            $.ajax({
                url:"handlers/words_handler",
                type:"POST",
                data:$(".newVerbForm").serialize(),
                cache:true,
                success:function(){
                    bootbox.alert("تم الإضافة بنجاح");
                }
                
            })
    
    })
}

function del_wordToAdd(){
    $(".del_wordToAdd").on("click",function(){
        var id = $(this).attr("id");
        bootbox.confirm("هل انت متأكد؟",function(result){
            $.post("handlers/dashboard_ajax?tableName=words_to_add&id="+id,{result:result});
            if(result){
                location.reload();
            }
        });
    })

}


function updateHome(){
    $("input.update_home_btn").on("click",function(e){
        e.preventDefault();
        $.ajax({
            url:"handlers/dashboard_ajax",
            type:"POST",
            data: $("form.updateHome").serialize()+"&tableName=home",
            cache:true,
            success:function(result){
                    location.reload();
                
            }
        })
    })
}
