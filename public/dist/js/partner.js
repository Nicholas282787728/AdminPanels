$(document).ready( function() {
    
    $(".option-content-partner").on("click", function(){
        $(".content-partner.active").addClass("inactive");
        $(".content-partner.active").removeClass("active");
        var id_option=$(this).attr("id");
        $("#contentPartner"+id_option).removeClass("inactive");
        $("#contentPartner"+id_option).addClass("active");
        
        $(".content-"+id_option).removeClass("active");
        $(".content-"+id_option).addClass("inactive");
        $(".content-"+id_option+":first").removeClass("inactive");
        $(".content-"+id_option+":first").addClass("active");
        
        $(".option-content-partner.option-active").addClass("option-inactive");
        $(".option-content-partner.option-active").removeClass("option-active");
        $(this).addClass("option-active");
        $(this).removeClass("option-inactive");
        
        $(".opcion-content-"+id_option).removeClass("sub-option-active");
        $(".opcion-content-"+id_option).addClass("sub-option-inactive");
        $(".opcion-content-"+id_option+":first").removeClass("sub-option-inactive");
        $(".opcion-content-"+id_option+":first").addClass("sub-option-active");
    });
    
    $(".opcion-content-Market").on("click", function(){
        $(".content-Market.active").addClass("inactive");
        $(".content-Market.active").removeClass("active");
        var id_option=$(this).attr("id");
        $("#contentMarket"+id_option).removeClass("inactive");
        $("#contentMarket"+id_option).addClass("active");
        
        $(".opcion-content-Market.sub-option-active").addClass("sub-option-inactive");
        $(".opcion-content-Market.sub-option-active").removeClass("sub-option-active");
        $(this).addClass("sub-option-active");
        $(this).removeClass("sub-option-inactive");
    });
    
    $(".opcion-content-Requirements").on("click", function(){
        $(".content-Requirements.active").addClass("inactive");
        $(".content-Requirements.active").removeClass("active");
        var id_option=$(this).attr("id");
        $("#contentRequirements"+id_option).removeClass("inactive");
        $("#contentRequirements"+id_option).addClass("active");
        
        $(".opcion-content-Requirements.sub-option-active").addClass("sub-option-inactive");
        $(".opcion-content-Requirements.sub-option-active").removeClass("sub-option-active");
        $(this).addClass("sub-option-active");
        $(this).removeClass("sub-option-inactive");
    });
    
    $(".opcion-content-Application").on("click", function(){
        $(".content-Application.active").addClass("inactive");
        $(".content-Application.active").removeClass("active");
        var id_option=$(this).attr("id");
        $("#contentApplication"+id_option).removeClass("inactive");
        $("#contentApplication"+id_option).addClass("active");
        
        $(".opcion-content-Application.sub-option-active").addClass("sub-option-inactive");
        $(".opcion-content-Application.sub-option-active").removeClass("sub-option-active");
        $(this).addClass("sub-option-active");
        $(this).removeClass("sub-option-inactive");
    });
    
    $("#mStatus").on("change", function(){
        var status=$(this).val();
        if(status=="Other"){
            $("#otherMStatus").removeClass("inactive");
            $("#otherMStatus").addClass("active");
        }
        else{
            $("#otherMStatus").removeClass("active");
            $("#otherMStatus").addClass("inactive");
        }
    });
});