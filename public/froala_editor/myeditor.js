$.ajaxSetup({
  headers: { 'X-CSRF-Token' : $('meta[name="csrf-token"]').attr('content') } 
});
$(document).ready(function(){ 
    var nHeight = screen.height * 0.6;
   
   
    var curImage;
    $('#edit').froalaEditor({
        fullPage: true,
        heightMin:nHeight - 100,
        heightMax:nHeight,

        imageUpload:true,
        imageUploadMethod: 'GET',
        imageMaxSize: 5 * 1024 * 1024,
        imageAllowedTypes: ['jpeg', 'jpg', 'png'],
        // Set the image upload URL.
        imageUploadURL: 'dashboard/uploadImage',
        
        imageEditButtons: ['imageDisplay', 'imageAlign', 'imageInfo', 'imageRemove']
    })
    .on('froalaEditor.image.uploaded', function(e, editor, response){
        //alert(response);
    
    }).on('froalaEditor.image.error', function (e, editor, error, response) {
        console.log(error);
        console.log(response);
    });;
   
    $("#save_btn").on('click', function(){
        var ref = $('#jstree_demo').jstree(true);
        var sel = ref.get_selected();
        var html = $("form#edit").froalaEditor('html.get');
        var tid = sel[0];
            $.ajax({
                type:"GET",
                url:"dashboard/saveDoc",
                data:{tid:tid, html:html},
                success:function(data){
                alert(data);
                }
            });
    });
});