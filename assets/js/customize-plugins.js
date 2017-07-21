$(function() {


    var uiElements = function(){
        // Start Smart Wizard
        var uiSmartWizard = function(){
            
            if($(".wizard").length > 0){
                
                //Check count of steps in each wizard
                $(".wizard > ul").each(function(){
                    $(this).addClass("steps_"+$(this).children("li").length);
                });//end
                
                // This par of code used for example
                if($("#wizard-validation").length > 0){
                    
                    var validator = $("#wizard-validation").validate({
                            rules: {
		                        username: {
		                                required: true,
		                                minlength: 3
		                        },
		                        password: {
		                                required: true,
		                                minlength: 5,
		                                maxlength: 15
		                        },
		                        're-password': {
		                                required: true,
		                                minlength: 5,
		                                maxlength: 15,
		                                equalTo: "#password1"
		                        },
		                        email: {
		                                required: true,
		                                email: true
		                        },
		                        phone: {
		                                required: true,
		                                minlength: 5,
		                                maxlength: 7
		                        },
		                        mobile: {
		                                required: true,
		                                minlength: 10,
		                                maxlength: 12
		                        }
                            }
                        });
                        
                }// End of example
                
                $(".wizard").smartWizard({                        
                    // This part of code can be removed FROM
                    onLeaveStep: function(obj){
                        var wizard = obj.parents(".wizard");

                        if(wizard.hasClass("wizard-validation")){
                            
                            var valid = true;
                            
                            $('input,textarea',$(obj.attr("href"))).each(function(i,v){
                                valid = validator.element(v) && valid;
                            });
                                                        
                            if(!valid){
                                wizard.find(".stepContainer").removeAttr("style");
                                validator.focusInvalid();                                
                                return false;
                            }         
                            
                        }    
                        
                        return true;
                    },// <-- TO
                    
                    //This is important part of wizard init
                    onShowStep: function(obj){                        
                        var wizard = obj.parents(".wizard");

                        if(wizard.hasClass("show-submit")){
                        
                            var step_num = obj.attr('rel');
                            var step_max = obj.parents(".anchor").find("li").length;

                            if(step_num == step_max){                             
                                obj.parents(".wizard").find(".actionBar .btn-primary").css("display","block");
                            }                         
                        }
                        return true;                         
                    }//End
                });
            }            
            
        }// End Smart Wizard
        
        return {
            init: function(){
                uiSmartWizard();
            }
        }
        
    }();
});
$(".search").on('blur', function(){
            $(".search-form").removeClass("active");
        }).on('focus', function(){
            $(".search-form").addClass("active");
        });