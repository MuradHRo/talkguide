// Variables
var searchbox = document.getElementsByClassName("searchBoxInput")[0];
var filter = document.getElementById("filterOption");
var filterForm = document.getElementById("filterForm");
var wallpaper =document.getElementById("wallpaper");
var tableName;
switch (location.pathname.split("/").slice(-1)[0]){
    case "ordlistet":
        tableName = "words"
        break;
    case "verblistet":
        tableName = "verb"
        break;
    default:
        tableName = "helse"
}
// Add Special Characters
function addLetter(letter){
    $(".searchBoxInput").val($(".searchBoxInput").val()+letter);
}

// Filter Limit
function limitChange(){
    localStorage.setItem("limit", $("select").val());
    filterForm.submit();
}
 

// Run Wow Library

new WOW().init(); 

//Print
function printDoc(){
window.print();
}



// Contact US



// Prevent resubmitting
$(".searchBox form").submit(function(e){
    e.preventDefault();
});

// Main search Ajax 

$(".mainSearch").on("change paste keyup",function(){
    $.ajax({
        url:"handlers/home_search_ajax",
        type:"POST",
        data:"pattern="+ $(".mainSearch").val(),
        cache:true,
        success:function(result){
            $("ul.result").empty();
            $("ul.result").html(result);
            if(result = "" || $(".mainSearch").val() == ""){
                $(".langChange").show();
                $("ul.result").hide();
            }else{
                $(".langChange").hide();
                $("ul.result").show();

            }
            
        }
    })
})


function getWord(id,name){
    $.ajax({
        url:"handlers/get_word_ajax",
        type:"POST",
        data:"id="+ id + "&tableName=" + name,
        cache:true,
        success:function(result){
            $("ul.result").empty();
            $("ul.result").html(result);
            if(result = "" || $(".mainSearch").val() == ""){
                $(".langChange").show();
                $("ul.result").hide();
            }else{
                $(".langChange").hide();
                $("ul.result").show();

            }
            
        }
    })}


// Search ajax

$("#searchBox").on("change paste keyup",function(){
    // Table Results update
    $.ajax({
        url:"handlers/search_ajax",
        type:"POST",
        data:"pattern=" + $("#searchBox").val() + "&tableName=" +tableName,
        cache:false,
        success:function(response){
            $("#results-body").empty;
            $("#results-body").html(response);
            del_word();
        },
        error:function(){
            alert("Ajax Error");
        }

    });
    // Page Pagination update
    $.ajax({
        url:"handlers/update_pagination_ajax",
        type:"POST",
        data:"search=" +$("#searchBox").val()+ "&pageNum=1" +"&tableName=" +tableName,
        cache:false,
        success:function(response){
            $(".pagination").empty();
            $(".pagination").html(response);
            del_word();
        },
        error:function(){
            alert("Ajax Error");
        }
    })


})




// Prevent search form submitting
$(".search-Form").submit(function(e){
    e.preventDefault();
});

function loadWords(pageNum){
    // Table Results update
    var limit;
    if($("select").val() != null){
        limit = "&limit=" + $("select").val();
    }else{
        limit = "";
    }
    $.ajax({
        url:"handlers/search_ajax",
        type:"POST",
        data:"pattern=" + $("#searchBox").val() + "&pageNum=" + pageNum +"&tableName=" +tableName + limit,
        cache:false,
        success:function(response){
            $("#results-body").empty();
            $("#results-body").html(response);
            del_word();

        },
        error:function(){
            alert("Ajax Error");
        }

    });
    $.ajax({
        url:"handlers/update_pagination_ajax",
        type:"POST",
        data:"search=" + $("#searchBox").val() + "&pageNum=" + pageNum +"&tableName=" +tableName +limit,
        cache:false,
        success:function(response){
            $(".pagination").empty();
            $(".pagination").html(response);
            del_word();
            
        },
        error:function(){
            alert("Ajax Error");
        }

    });
};
// 
$(".norwegianLayout a").on("click",function(){
        // Table Results update
        $.ajax({
            url:"handlers/search_ajax",
            type:"POST",
            data:"pattern=" + $("#searchBox").val()+"&tableName=" +tableName,
            cache:false,
            success:function(response){
                $("#results-body").empty;
                $("#results-body").html(response);
            },
            error:function(){
                alert("Ajax Error");
            }
    
        });
        // Page Pagination update
        $.ajax({
            url:"handlers/update_pagination_ajax",
            type:"POST",
            data:"search=" +$("#searchBox").val()+ "&pageNum=1"+"&tableName=" +tableName,
            cache:false,
            success:function(response){
                $(".pagination").empty();
                $(".pagination").html(response);
                del_word();
            },
            error:function(){
                alert("Ajax Error");
            }
        })
})

// Prevent Suggest New Words form submission

function sendWords(){
    $(".error_box_btn").on("click",function(e){

        e.preventDefault();
        $.ajax({
            url:"handlers/addwords_ajax",
            type:"POST",
            data:$("form.error_box").serialize() + "&tablName=" + tableName,
            cache:true,
            success:function(result){
                if(result == "" ){
                $(".notFoundDiv h1").html("تم إرسال رسالتك بنجاح وجارٍ المراجعة:)<br> شكرًا لمساهمتك");
                $(".notFoundDiv h1").removeClass("text-danger");
                $(".notFoundDiv h1").addClass("text-success");
                $(".notFoundDiv form").remove();
                $('.notFoundDiv').css('height','50vh');
                del_word();

                }else{
                    alert(result);
                }
            },
        })

    })
}

// Dep page
$(".fetcher").hide()

$(".departments div a").on("click",function(e){
    e.preventDefault();
    info = $(this).attr("href");
    info = info.split("?").slice(-1)[0];
    switch (info){
        case "medsin": 
            tableName = "helse";
            break;
        case "juss":
            tableName = "juss";
            break;
        case "nav":
            tableName = "nav_og_sosial";
            break;
        case "trafikk":
            tableName = "trafikk";
            break;
        case "pysk":
        tableName = "pysk";
        break;
        case "norsk_utrykk":
            tableName ="norsk_utrykk"
            break;

    }
    $.ajax({
        url: "fetcher",
        type:"GET",
        data:info,
        success:function(response){
            $(".departments div").removeClass();
            $(".departments div").addClass("mx-auto col-5 col-md-2");
            $(".search-Form,.langChange,.filterForm,.results,#filterForm").remove()
            $(".searchBox-verb").append(response);
            del_word();

        },
        error:function(){
            alert("ERROR");
        }

    })
})

del_word();
// Delete words
function del_word(){
$(".del_word").on("click",function(){
    word_id = $(this).attr("id").split(".").slice(-1);
    table = $(this).attr("id").split(".").slice(0,1);
    bootbox.confirm("هل أنت متأكد من إزالة هذه الكلمة؟",function(result){
        $.post("handlers/words_handler?tableName="+ table +"&word_id=" +word_id,{result:result})
        if (result){
            location.reload();
        }
    })
})
}