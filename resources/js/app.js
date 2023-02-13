require('./bootstrap');


jQuery(document).ready(function(){
    x= 0;
    y= 0;

    //Execute function for active first card in carousel:
    activeFirst();
    //Execute function for add selected value to input:
    addPositionInput();
    //Execute function for add Remaining Characteres to textareas:
    addRemainingCharacters();
    //Execute function for limit all Start date to today:
    limitStartDate();
    //Execute function for Initialize End Date:
    initializeEndDate()

    // launch or use event
    setTimeout(animPie, 500);

    jQuery('.modal').on('hidden.bs.modal',function(){
        
        if(jQuery(this).find('iframe').length){
            var iframe = jQuery(this).find('iframe');
            var link = iframe.attr("src");
            iframe.attr("src",link)
        }
    })

    jQuery(document).on('click','.readMoreButton',function(){
        var name = jQuery(this).data('target');
        jQuery(name).addClass('show');
    })

    jQuery(document).on('click','.closereadMore',function(){
        var name = jQuery(this).data('target');
        jQuery(name).removeClass('show');
            var iframe = jQuery(this).data('iframe');
            var link = jQuery(iframe).attr('src');          
            jQuery(iframe).attr('src',link.replace('&autoplay=1', ''));
            jQuery('#poster'+iframe.replace('#', '')).show('slow');
    })

    jQuery(document).on('click','.posterVideo',function(){
        jQuery(this).hide('slow');
        var iframe= jQuery(this).data('iframe')
        jQuery(iframe).attr('src',jQuery(iframe).attr('src')+"&autoplay=1");
    })

    jQuery(document).on('click','.close',function(){
        if(jQuery(this).data('iframe')){
            var iframe = jQuery(this).data('iframe');
            var link = jQuery(iframe).attr('src'); 
            jQuery(iframe).attr('src', link);
        }
    })

    //Execute selection in form position applicants:
    jQuery('.position-choose input[type=checkbox]').click(function(){
            jQuery('.position-choose input[type=checkbox]').prop('checked',false);
            jQuery(this).prop('checked',true);
            addPositionInput(this);
    })

    jQuery('#button-expand').click(function(){
        jQuery('#nav').toggleClass('little-navbar');
        jQuery('#main').toggleClass('max-content');
    })

    
    

    //Embed youtube video in form when change the field:
    jQuery('input[name="video"]').change(function(){
        var link = jQuery(this).val();
        if(jQuery('#video_iframe').length){
            jQuery('#video_iframe').attr('src',convertUrl(link));
        }else{
            jQuery(this).after('</br><iframe id="video_iframe" width="560" height="315" src="'+convertUrl(link)+'" frameborder="0" allowfullscreen></iframe></iframe>')
        }     
    });

    //Change application to dark mode (Not active): 
    /*jQuery('#darkmode_changer').click(function(){
        if(jQuery(this).is(':checked')){
            jQuery('body').addClass('dark-mode');
        }else{
            jQuery('body').removeClass('dark-mode');
        }
    });*/

    //Match Tooltip as popup:
    jQuery(document).on('click','[data-toggle="match-popup"]' ,function(){
        jQuery(jQuery(this).data('id')).fadeToggle();

    });

    //Add Skills fields in form: 
    jQuery('.add_skill').click(function(){
        if(x <= 8){
            x++;
            jQuery('.skills-group').append('<div class="d-flex align-items-center mb-1"><input type="text" class="form-control mr-1" name="skill[]" required><a class="remove_skill btn btn-danger" href="javascript:void(0)">Delete</a></div>');
        }else{  
            jQuery('.add_skill').prop('disabled', true);
            jQuery('.add_skill').removeClass('btn-primary');
            jQuery('.add_skill').addClass('btn-secondary');
        }
    });

    //Add Experiences fields in form: 
    jQuery('.add_experience').click(function(){
        if(y <= 3){
            y++;
            jQuery('.experience-group').append('<div class="mt-5"><div class="d-flex w-100"><div class="w-50"><label for="position">Position</label><input type="text" class="form-control" name="experience['+y+'][position]" required></div><div class="w-50 ml-1"><label for="company">Company</label><input type="text" class="form-control" name="experience['+y+'][company]"  required></div></div><div class="d-flex w-100 dates"><div class="w-50"><label for="start_date">Start date</label><input type="date" class="form-control start_date" name="experience['+y+'][start_date]" required></div><div class="w-50 ml-1"><label for="end_date">End date</label><input type="date" class="form-control end_date" name="experience['+y+'][end_date]" disabled required></div></div><div class="form-group mt-2"><label for="">Describe your tasks in this job</label><div class="textarea"><textarea class="form-control mt-1" maxlength="500" placeholder="Limited to 500 characters" name="experience['+y+'][description]" required></textarea></div></div><a href="javascript:void(0)" class="remove_experience btn btn-danger mt-2" style="float: right;">Remove Experience</a></div>');
        }else{
            jQuery('.add_experience').prop('disabled', true);
            jQuery('.add_experience').removeClass('btn-primary');
            jQuery('.add_experience').addClass('btn-secondary');
        }
    });

    //Add Education fields in form: 
    jQuery('.add_study').click(function(){
        if(y <= 3){
            y++;
            jQuery('.studies-group').append('<div class="mt-5"><div class="d-flex w-100"><div class="w-50"><label for="title">Title <b>*</b></label><input type="text" class="form-control" name="study['+y+'][title]" required></div><div class="w-50 ml-1"><label for="school">Institution <b>*</b></label><input type="text" class="form-control" name="study['+y+'][school]" required></div></div><div class="form-group mt-2"><label for="">State <b>*</b></label><select class="form-control mt-1" name="study['+y+'][graduated]" id="" required><option selected disabled value="">Choose an option</option><option value="course">In Course</option><option value="graduated">Graduated</option></select></div><a href="javascript:void(0)" class="remove_study btn btn-danger mt-2" style="float: right;">Remove Education</a></div>');
        }else{
            jQuery('.add_study').prop('disabled', true);
            jQuery('.add_study').removeClass('btn-primary');
            jQuery('.add_study').addClass('btn-secondary');
        }
    });

    //Remove Skills fields in form: 
    jQuery('.skills-group').on('click','.remove_skill',function(){
        jQuery(this).parent('div').remove();
        jQuery('.add_skill').addClass('btn-primary');
        jQuery('.add_skill').removeClass('btn-secondary');
        x--;
    });

    //Remove Education fields in form: 
    jQuery('.studies-group').on('click','.remove_study',function(){
        jQuery(this).parent('div').remove();
        jQuery('.add_study').addClass('btn-primary');
        jQuery('.add_study').removeClass('btn-secondary');
        y--;
    }); 
    
    //Remove Experiences fields in form: 
    jQuery('.experience-group').on('click','.remove_experience',function(){
        jQuery(this).parent('div').remove();
        jQuery('.add_experience').addClass('btn-primary');
        jQuery('.add_experience').removeClass('btn-secondary');
        y--;
    }); 

    //Executes avatarVisualization when change some field:
    jQuery('#avatar').change(function(){ 
        avatarVisualization(this, 'hard');
      }); 

    //Check a correct location in datalist:
    jQuery('#location').change(function(){
        var equal = 0;
        jQuery('datalist option').each(function(){
            if(jQuery(this).val() == jQuery('#location').val()){
                equal = 1;
            }
        });
        if(equal == 0){
            jQuery(this).val('');
        } 
    });
     //Check a correct user in datalist:
     jQuery('#receiver').change(function(){
        var equal = 0;
        var dato;
        jQuery('#Users option').each(function(){
            if(jQuery(this).val() == jQuery('#receiver').val()){
                equal = 1;   
            }
        });
        if(equal == 0){
            jQuery(this).val('');
        }  
        
    });

    //Manage Filtering selection:
    jQuery('input[type=checkbox]').change(function(){
        var recent_checked = jQuery(this).attr('class');
        jQuery(this).parents('.checkbox-group').find('input').each(function(){
           if(jQuery(this).attr('class') != recent_checked){
                jQuery(this).prop('checked',false);
            }else{
                jQuery(this).prop('checked',true);
            }
        })
    });
    
    //Executes ajaxFiltering when change some field:
    jQuery('.filter-form').on('change keyup', function(){       
        ajaxFiltering(jQuery(this).data('filter'))
    });
    

    //Executes for Limit the textareas when Keyup:
    jQuery(document).on('keyup', '.textarea textarea', function(){
        var len = this.value.length;
        var maxchar = jQuery(this).attr('maxlength');
        if(len > maxchar){
            return false;
        }else {
            if(jQuery(this).parent('.textarea').find('label').length){
                jQuery(this).parent('.textarea').find('label').html( "Remaining characters: " +( maxchar - len ));
            }else{
                jQuery(this).parent('.textarea').append( "<label>Remaining characters: " +( maxchar - len )+"</label>" );
            }
        }
      })

    //Executes for Limit Dates when choose:
    jQuery(document).on('change', '.dates .start_date', function(){
        var startfield = jQuery(this);
        var endfield = jQuery(this).parent().parent().find('.end_date');

        if (startfield.val() != null && startfield.val() != undefined && startfield != ''){

            endfield.removeAttr('disabled');
            endfield.attr('min',startfield.val());
            endfield.attr('max',todayforInputs());
            endfield.val(todayforInputs);
            
        }
        

      })

//FUNCTIONS:  

//1. activeFirst: This function active first card in carousel for appplicants. 
function activeFirst(){
    if(jQuery('.view__cards.dynamic-data .carousel-item').first().length){
        jQuery('.view__cards.dynamic-data .carousel-item').first().addClass('active');
    }
 
}
//End Function activeFirst.

//2. convertUrl: This function convert the youtube url videos for embed.
function convertUrl(url){
    var code;
    if(url.includes('youtu')){
        if(url.includes('youtu.be')){
            code = url.replace('https://youtu.be/','');
        }else if(url.includes('youtube')){
            code = url.replace('https://www.youtube.com/embed/','');
            code = url.replace('https://www.youtube.com/watch?v=','');
        }
        return 'https://www.youtube.com/embed/'+code;
    }else{
        return url;
    }
}
//End Function convertUrl.

//3. avatarVisualization: This function show the image that upload in a form.
function avatarVisualization(element, mode){
    jQuery('#img_avatar').remove();
    if(mode == 'easy'){
        jQuery('.avatar-visualization').css('background-image', 'url('+jQuery('#avatar-preassigned').val()+')');
    }else{
    const file = element.files[0];
    if (file){ 
      let reader = new FileReader(); 
      reader.onload = function(event){ 
        jQuery('.avatar-visualization').css('background-image', 'url('+event.target.result+')'); 
      } 
      reader.readAsDataURL(file); 
    }
    }
  }
//End Function avatarVisualization.

//4. ajaxFiltering: This function manage the ajax filter for applicants search applicants and do filters.
function ajaxFiltering(ttype){
    var state;
    var matches;
    var customer;
    if(jQuery('#'+ttype+'Filters .state-group').length > 0){
        state = jQuery('#'+ttype+'Filters .state-group').find('input:checked').attr('name');
    }else{
        state = 'active';
    }
    if(jQuery('#'+ttype+'Filters .matches-group').length > 0){
        matches = jQuery('#'+ttype+'Filters .matches-group').find('input:checked').attr('name');
        if(matches == undefined ){
            matches= 'nomatch';
        }
    }else{
            matches= 'nomatch';     
    }
    if(jQuery('#'+ttype+'Filters .customers-group').length > 0){
        customer = jQuery('#'+ttype+'Filters .customers-group').find('#customerFilter').val();
    }else{
            customer= '';   
    }
    var type = jQuery('#'+ttype+'Filters input[name=type]').val();
    var user = jQuery('#'+ttype+'Filters input[name=user]').val();
    var sort = jQuery('#'+ttype+'Filters .sort-group').find('input:checked').attr('name');
    var text = jQuery('#'+ttype+'Filters input[type=text]').val();
    var filter = jQuery('#'+ttype+'Filters [name=filter]').val();
    var pos = jQuery('#'+ttype+'Filters select[name=position]').val();
    var _token = jQuery('#'+ttype+'Filters input[name=_token]').val();

     jQuery.ajax({
        method: 'POST',
        url: jQuery('#'+ttype+'Filters').attr('action'),
        dataType: 'html',
        data: {
            _token: _token,
            text : text,
            state : state,
            matches: matches,
            sort: sort,
            user: user,
            type: type,
            filter: filter,
            customer: customer,
            pos: pos
        },
        success: function(res){
            jQuery('.dynamic-data').empty();
            jQuery('.dynamic-data').append(res);
            if(res == ''){
                jQuery('.dynamic-data').append('<p>Nothing for show.</p>')
            }
        },
        error: function (xhr, b, c) {
            console.log(xhr.responseText,b,c);
        }
      });
}
//End Function ajaxFiltering.

//5. addPositionInput: This function active first card in carousel for appplicants. 
function addPositionInput(elem){
    if(jQuery('.load-position-selected').length){
        if(jQuery(elem).length){
            jQuery('.load-position-selected').val(jQuery(elem).data('value'));
        }else{
            jQuery('.position-choose input[type=checkbox]').each(function(){
                if(jQuery(this).is(':checked')){
                    jQuery('.load-position-selected').val(jQuery(this).data('value'));
                }
            });
        }
}
}
//End Function addPositionInput.

function animPie(){
    if(jQuery('#pie').length){
        jQuery("#pie").removeClass("zero");
    }
    
  }
 
//Function add Remaining Characters:
function addRemainingCharacters(){
    jQuery( '.textarea textarea' ).each(function(){
        var len = this.value.length;
        var maxchar = jQuery(this).attr('maxlength');
        jQuery(this).parent('.textarea').append( "<label>Remaining characters: " +( maxchar - len )+"</label>" );
    })
}

//End Function add Remaining Characters

//Function Limits All Start Date:
function limitStartDate(){
    jQuery( '.dates .start_date' ).each(function(){
        jQuery(this).attr('max',todayforInputs());
    })
}

});

//Calculate Date Today for inputs:
function todayforInputs() {
    var d = new Date();
    var month, day;
        if((d.getMonth()+1) < 10){ month='0'+(d.getMonth()+1); } else{ month= (d.getMonth()+1);}
        if(d.getDate() < 10){ day='0'+d.getDate(); } else{ day= d.getDate();} 
    
    var strDate = d.getFullYear() + "-" + month + "-" + day;
    return strDate;
}

//function Initialize All End Date:
function initializeEndDate() {
    jQuery( '.dates' ).each(function(){
        jQuery(this).find('.end_date').attr('disabled',true);
        var choose_date = jQuery(this).find('.start_date').val(); 
        if(choose_date != null && choose_date != undefined && choose_date != ''){
            jQuery(this).find('.end_date').attr('disabled',false);
        }
    })
}

require('./login');