//alert(lightweb.ajaxurl);
//alert('adsf');


 function ajax_load_post(post_ids, wrapper_id){

       jQuery.ajax({
          type : "post",
  
          url : lightwebAJAX.ajaxurl,
           data: { action: "load_post", post_ids: post_ids },
           success: function (data, textStatus, XMLHttpRequest) {
              // alert(data);
                  	
            jQuery( "#"+wrapper_id ).html(data);
           },
           error: function (XMLHttpRequest, textStatus, errorThrown) {
               alert(errorThrown);
               
        }
       });
    }
