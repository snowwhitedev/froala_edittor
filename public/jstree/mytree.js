$(document).ready(function(){
   // constructor of jstree 
  $("#jstree_demo").jstree({
    "core": {
      "check_callback": true,
      "data":  {
        'url':'dashboard/getProjects',
        'dataType':"json"
        }
    },
    "contextmenu" : {
      'items' : function(node) {
        var tmp = $.jstree.defaults.contextmenu.items();
        delete tmp.create.action;
        tmp.create.label = "New";
        tmp.create.submenu = {
          "create_folder" : {
            "separator_after"	: true,
            "label"				: "Folder",
            "action"			: function (data) {
              var inst = $.jstree.reference(data.reference),
                obj = inst.get_node(data.reference);
                inst.create_node(obj, { text:"New Folder", type : "default" }, "last", function (new_node) {
                setTimeout(function () { inst.edit(new_node); },0);
              });
            }
          },
          "create_file" : {
            "label"				: "File",
            "action"			: function (data) {
              var inst = $.jstree.reference(data.reference),
                obj = inst.get_node(data.reference);
                inst.create_node(obj, { text:"New File",type : "file" }, "last", function (new_node) {
                  setTimeout(function () { inst.edit(new_node); },0);
                });
            }
          }
        };
        if(this.get_type(node) === "file") {
          delete tmp.create;
        }
        return tmp;
      }
    }, 
    "types" : {
      "#" : {
        "valid_children" : ["default"]
      },
      "default" : {
            "valid_children" : ["default","file"]
      },
      "file" : {
          "icon" : "glyphicon glyphicon-file",
          "valid_children" : []
      }
    },
    "plugins" : ["contextmenu","dnd","search", "wholerow", "types"]

  }).on('create_node.jstree', function(e, data) {
    
    var node =data.node;
    pid = data.parent;
    $.ajax({
		type:"GET",
		url:'dashboard/addUserTree',
		data:{id:node.id,'pid':pid, 'text':node.text, 'type':node.type},
		dataType:'json',
		success:function(data){
        
      }
    });
	}).on('rename_node.jstree', function(e, data){
    var node = data.node;
    var text = data.text;
    
    $.ajax({
        type:"GET",
        url:'dashboard/reNameTree',
        data:{tid:node.id, 'text':text},
        dataType:'json',
        success:function(data){
          alert(data);
        }
    });
    
  });
  
  $('.vakata-context').css('z-index', 100);
  
  //add new project when clicking New Doc button
  $("#new_doc").on("click", function(){
    var text = "New Project";
    $('#jstree_demo').jstree().create_node('#', {"text": text,}, "last", function(){});
  });

  // when moving node to other parent
  $("#jstree_demo").on('move_node.jstree', function(e, data){
    tid = data.node.id;
    pid = data.parent;
    $.ajax({
				type:"GET",
				url:'dashboard/moveNode',
				data:{tid:tid, pid:pid},
				dataType:'json',
				success:function(data){
					alert(data);
				}
		});
  });
  
  //load data when changing the selected node
  var first = true;
  $('#jstree_demo').on('changed.jstree', function (e, data) {
    if(first){ first = false; }
    else if(!first){
      var ref = $('#jstree_demo').jstree(true);
      var sel = ref.get_selected();
      var tid = sel[0];
      $("#treeID").val(tid);
      $.ajax({
        type:"GET",
        url:"dashboard/getDoc",
        data:{tid:tid},
        dataType:"json",
        success:function(data){
          $("form#edit").froalaEditor('html.set', data[0]['html']);
        }
      });
    }
  }).jstree();
});