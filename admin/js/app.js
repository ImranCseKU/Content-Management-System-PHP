$(document).ready( function(){
    
    //Add GK text editor
    if($('#content').length ){
        ClassicEditor
        .create( document.querySelector( '#content' ) )
        .catch( error => {
            console.error( error );
        } );
    }
    //select all bulkOption checkbox
    $('#bulkOptionId').change( function(event){
        if(this.checked){
            
            // iterate each class item
            $('.bulkOptionClass').each( function(){
                this.checked = true;
            });
        }
        else{
            // iterate each class item
            $('.bulkOptionClass').each( function(){
                this.checked = false;
            });
        }
        
    });

    var loader = "<div id='load-screen'> <div id='loading'></div> </div>";

    $("body").prepend(loader);

    $('#load-screen').delay(700).fadeOut(600, function(){
        $(this).remove();
    })


    
});