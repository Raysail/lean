<script type="text/javascript" src="design/js/jquery-1.8.1.min.js"></script>
<script type="text/javascript" src="design/tinymce/js/tinymce/tinymce.min.js"></script>
<script type="text/javascript">
tinymce.init({
		selector: "textarea",
		theme: "modern",
		height : 300,
		//file_browser_callback : 'myFileBrowser',
		plugins: [
			"advlist autolink lists link image charmap print preview hr anchor pagebreak",
			"searchreplace wordcount visualblocks visualchars code fullscreen",
			"insertdatetime media nonbreaking save table contextmenu directionality",
			"emoticons template paste textcolor moxiemanager",
			"insertdatetime media table contextmenu paste jbimages"
		],
		toolbar1: "insertfile undo redo | styleselect | bold italic | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | link image jbimages",
		toolbar2: "print preview media | forecolor backcolor emoticons",
		image_advtab: true,
		relative_urls: false,

		/*file_browser_callback: RoxyFileBrowser,
		templates: [
			{title: 'Test template 1', content: 'Test 1'},
			{title: 'Test template 2', content: 'Test 2'}
		]*/
	});
	
	/*function RoxyFileBrowser(field_name, url, type, win) {
  var roxyFileman = '<?php echo 'fileman/index.html' ?>';
  if (roxyFileman.indexOf("?") < 0) {     
    roxyFileman += "?type=" + type;   
  }
  else {
    roxyFileman += "&type=" + type;
  }
  roxyFileman += '&input=' + field_name + '&value=' + document.getElementById(field_name).value;
  if(tinyMCE.activeEditor.settings.language){
    roxyFileman += '&langCode=' + tinyMCE.activeEditor.settings.language;
  }
  tinyMCE.activeEditor.windowManager.open({
     file: roxyFileman,
     title: 'File Upload',
     width: 750, 
     height: 450,
     resizable: "yes",
     plugins: "media",
     inline: "yes",
     close_previous: "no"  
  }, {     window: win,     input: field_name    });
  return false; 
}*/
</script>

<?php echo $_SERVER['DOCUMENT_ROOT'];?>
 <textarea class="form-control custom-control" name="pub_reviewer" id="pub_reviewer"></textarea>