jQuery(document).on('click', 'a.display-property', function(){
    
    var property_id = jQuery(this).data('propertyid');

    jQuery.ajax({
        type:'POST',
        url:'view.php',
        data:{property_id: property_id},
        dataType:'html',    
        beforeSend: function () {
            jQuery('#render-dispaly-data').html('<div class="text-center"><i class="fa fa-spinner fa-pulse fa-5x fa-fw"></i></div>');
        },                      
        success: function (html) {
            jQuery('#render-dispaly-data').html(html);
			//jQuery('#display-property').modal('show');
                                 
        },
        error: function (xhr, ajaxOptions, thrownError) {
            alert("13");
            console.log(thrownError + "\r\n" + xhr.statusText + "\r\n" + xhr.responseText);
        }        
    });
});
jQuery(document).on('click', 'a.update-property-details', function(){
    var property_id = jQuery(this).data('propertyid');	
    jQuery.ajax({
        type:'POST',
        url:'edit.php',
        data:{property_id: property_id},
        dataType:'html',    
        beforeSend: function () {
            jQuery('#render-update-data').html('<div class="text-center"><i class="fa fa-spinner fa-pulse fa-5x fa-fw"></i></div>');
        },                      
        success: function (html) {			
            jQuery('#render-update-data').html(html);
			jQuery('#update-property').modal('show');
                                 
        },
        error: function (xhr, ajaxOptions, thrownError) {
            console.log(thrownError + "\r\n" + xhr.statusText + "\r\n" + xhr.responseText);
        }        
    });
});
jQuery(document).on('click', 'a.delete-property-details', function(){
    var property_id = jQuery(this).attr('data-propertyid');
	$('#delete-property').on('shown.bs.modal', function (event) {	 
	  jQuery('#property_id').val(property_id);
	});
});
jQuery(document).on('click', 'button#delete-property', function(){
    var property_id = jQuery('#property_id').val();
    jQuery.ajax({
        type:'POST',
        url:baseurl+'property/delete',
        data:{property_id: property_id},
        dataType:'html',  
        success: function (html) {
			jQuery('span#success-msg').html('');
            jQuery('span#success-msg').html('<div class="alert alert-success">Deleted property successfully.</div>');  
			jQuery('#propertyListing').DataTable().ajax.reload();		
			jQuery('#delete-property').modal('hide');			
        },
        error: function (xhr, ajaxOptions, thrownError) {
            console.log(thrownError + "\r\n" + xhr.statusText + "\r\n" + xhr.responseText);
        }        
    });
});
jQuery(document).on('click', 'button#add-property', function(){
    jQuery.ajax({
        type:'POST',
        url:baseurl+'property/save',
        data:jQuery("form#add-property-form").serialize(),
        dataType:'json',    
        beforeSend: function () {
            jQuery('button#add-property').button('loading');
        },
        complete: function () {
            jQuery('button#add-property').button('reset');
            setTimeout(function () {
                jQuery('span#success-msg').html('');
            }, 5000);
            
        },                
        success: function (json) {
            $('.text-danger').remove();
            if (json['error']) {             
                for (i in json['error']) {
                    var element = $('.input-property-' + i.replace('_', '-'));
                    if ($(element).parent().hasClass('input-group')) {                       
                        $(element).parent().after('<div class="text-danger" style="font-size: 14px;">' + json['error'][i] + '</div>');
                    } else {
                        $(element).after('<div class="text-danger" style="font-size: 14px;">' + json['error'][i] + '</div>');
                    }
                }
            } else {
                jQuery('span#success-msg').html('<div class="alert alert-success">Record added successfully.</div>');
                jQuery('#propertyListing').DataTable().ajax.reload();
                jQuery('form#add-property-form').find('textarea, input').each(function () {
                    jQuery(this).val('');
                });
                jQuery('#add-property').modal('hide');
                
            }

        },
        error: function (xhr, ajaxOptions, thrownError) {
            console.log(thrownError + "\r\n" + xhr.statusText + "\r\n" + xhr.responseText);
        }        
    });
});
jQuery(document).on('click', 'button#update-property', function(){
    jQuery.ajax({
        type:'POST',
        url:baseurl+'property/update',
        data:jQuery("form#update-property-form").serialize(),
        dataType:'json',    
        beforeSend: function () {
            jQuery('button#update-property').button('loading');
        },
        complete: function () {
            jQuery('button#update-property').button('reset');
            setTimeout(function () {
                jQuery('span#success-msg').html('');
            }, 5000);
            
        },                
        success: function (json) {
            $('.text-danger').remove();
            if (json['error']) {             
                for (i in json['error']) {
                  var element = $('.input-property-' + i.replace('_', '-'));
                  if ($(element).parent().hasClass('input-group')) {                       
                    $(element).parent().after('<div class="text-danger" style="font-size: 14px;">' + json['error'][i] + '</div>');
                  } else {
                    $(element).after('<div class="text-danger" style="font-size: 14px;">' + json['error'][i] + '</div>');
                  }
                }
            } else {
                jQuery('span#success-msg').html('<div class="alert alert-success">Record updated successfully.</div>');
                jQuery('#propertyListing').DataTable().ajax.reload();
                jQuery('form#update-property-form').find('textarea, input').each(function () {
                    jQuery(this).val('');
                });
                jQuery('#update-property').modal('hide');
            }                       
        },
        error: function (xhr, ajaxOptions, thrownError) {
            console.log(thrownError + "\r\n" + xhr.statusText + "\r\n" + xhr.responseText);
        }        
    });
});