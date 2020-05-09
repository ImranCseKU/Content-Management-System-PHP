$(document).ready( function(){
    
    //Add GK text editor
    if($('#content').length ){
        ClassicEditor
        .create( document.querySelector( '#content' ) )
        .catch( error => {
            console.error( error );
        } );
    }
    //select all checkbox
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
    
});