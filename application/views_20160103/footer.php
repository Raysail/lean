 <div class="main_news_letter">
      <div class="container">
        <div class="col-md-6">
          <div class="news_letter_left">
            <P>GET MORE RESEARCHES LIKE THIS IN YOUR INBOX!</P>
          </div>
        </div>
        <div class="col-md-6">
          <div class="news_letter_right">
			<form name="footer_research" method="post" id="footer_research">
			<input type="hidden" name="sub_for" value="2" />					
            <div class="input-group">
			 <input type="email" class="form-control bottom_ser" name="research_footer" placeholder="" require="required">
              <span class="input-group-btn">
              <button class="btn btn-default  bottom_but" id="footer_res_btn" type="button">Submit</button>
              </span> 
			  </div>
			  
				 <div id="footer_res_msg" style="display:none; color:#fff;padding: 2%;">				 	
				 </div>
				
			  </form>
          </div>
        </div>
      </div>
    </div>
    <div class="main_footer">
      <div class="container">
        <div class="row">
          <div class="footer">
            <div class="col-md-4">
              <div class="footer_one">
                <h3> CHANNELS</h3>
				<?php get_channel();?>
                 </div>
            </div>
            <div class="col-md-4">
              <div class="footer_one">
                <h3> MORE INFO</h3>					
				<?php get_more_info();?>
              </div>
            </div>
            <div class="col-md-4">
              <div class="footer_one">
                <h3>MAin Menu</h3>
                <ul>
                  <li><a href="<?php echo base_url();?>">Article ASAP </a></li>
                  <li><a href="<?php echo base_url().'archive-list';?>">Archive</a></li>
                  <li>
				  <?php 
				  $footer_link ='';
				  if($this->session->userdata('userid'))
				  {				  	
				 	 $footer_link = base_url().'user-dashboard';	
				  }
				  else
				  { 	
				 	 $footer_link = base_url().'login';				  
				  }
				  ?>
				  <a href="<?php echo $footer_link;?>">Submission & Review </a></li>
                  <li><a href="<?php echo base_url().'editorial-board';?>">Editorial Board</a></li>
                </ul>
				
				<?php get_social_link();?>
             
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
    <div class="main_copyright">
      <div class="container">
        <div class="copy_right">
          <p><?php get_footer_copyright();?></p>
        </div>
      </div>
    </div>
    
    <!-- /container --> 
    
  </div>
</div>

<!-- Bootstrap core JavaScript
    ================================================== --> 
<!-- Placed at the end of the document so the pages load faster --> 
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script> 
<script src="<?php echo base_url();?>design/front/js/bootstrap.min.js"></script> 

<!-- IE10 viewport hack for Surface/desktop Windows 8 bug --> 
<script src="../../assets/js/ie10-viewport-bug-workaround.js"></script>

<?php
if($this->uri->segment(1)=='sign-up' || $this->uri->segment(1)=='update-author-profile'  || $this->uri->segment(1)=='update-editor-profile'  || $this->uri->segment(1)=='update-reviewer-profile'  || $this->uri->segment(1)=='update-publisher-profile'  )
{
?>

<script src="http://thecodeplayer.com/uploads/js/jquery.easing.min.js" type="text/javascript"></script> 
<!--<script src="http://code.jquery.com/jquery-1.11.1.min.js"></script>
<script src="http://jqueryvalidation.org/files/dist/additional-methods.min.js"></script>-->
<script src="http://jqueryvalidation.org/files/dist/jquery.validate.min.js"></script>
<script>


//jQuery time
var current_fs, next_fs, previous_fs; //fieldsets
var left, opacity, scale; //fieldset properties which we will animate
var animating; //flag to prevent quick multi-click glitches

$(".next").click(function(event){

//alert('test');
var form = $( "#msform" );
form.validate();

 //alert( "Valid: " + form.valid() );
	if(form.valid()){
		if(animating) return false;
		animating = true;
		
		current_fs = $(this).parent();
		next_fs = $(this).parent().next();
		
		//activate next step on progressbar using the index of next_fs
		$("#progressbar li").eq($("fieldset").index(next_fs)).addClass("active");
		
		//show the next fieldset
		next_fs.show(); 
		//hide the current fieldset with style
		current_fs.animate({opacity: 0}, {
		step: function(now, mx) {
			//as the opacity of current_fs reduces to 0 - stored in "now"
			//1. scale current_fs down to 80%
			scale = 1 - (1 - now) * 0.2;
			//2. bring next_fs from the right(50%)
			left = (now * 50)+"%";
			//3. increase opacity of next_fs to 1 as it moves in
			opacity = 1 - now;
			current_fs.css({'transform': 'scale('+scale+')'});
			next_fs.css({'left': left, 'opacity': opacity});
		}, 
		duration: 800, 
		complete: function(){
			current_fs.hide();
			animating = false;
		}, 
		//this comes from the custom easing plugin
		easing: 'easeInOutBack'
	});
	}
	
	
});

$(".previous").click(function(){
	if(animating) return false;
	animating = true;
	
	current_fs = $(this).parent();
	previous_fs = $(this).parent().prev();
	
	//de-activate current step on progressbar
	$("#progressbar li").eq($("fieldset").index(current_fs)).removeClass("active");
	
	//show the previous fieldset
	previous_fs.show(); 
	//hide the current fieldset with style
	current_fs.animate({opacity: 0}, {
		step: function(now, mx) {
			//as the opacity of current_fs reduces to 0 - stored in "now"
			//1. scale previous_fs from 80% to 100%
			scale = 0.8 + (1 - now) * 0.2;
			//2. take current_fs to the right(50%) - from 0%
			left = ((1-now) * 50)+"%";
			//3. increase opacity of previous_fs to 1 as it moves in
			opacity = 1 - now;
			current_fs.css({'left': left});
			previous_fs.css({'transform': 'scale('+scale+')', 'opacity': opacity});
		}, 
		duration: 800, 
		complete: function(){
			current_fs.hide();
			animating = false;
		}, 
		//this comes from the custom easing plugin
		easing: 'easeInOutBack'
	});
});

$(".submit").click(function(){
	return true;
})


</script>

<?php
}
if($this->uri->segment(1)=='update-mainscript' || $this->uri->segment(1)=='post-manuscript'  || $this->uri->segment(1)=='revission-update-mainscript'  || $this->uri->segment(1)=='update-mainscript-edtrequest' )
{
?>

<script src="http://jqueryvalidation.org/files/dist/jquery.validate.min.js"></script>
<!--<script src="http://jqueryvalidation.org/files/dist/additional-methods.min.js"></script>-->

<script>
$(document).on('click', '.next_frm', function(event){
var pagt_url = '<?php echo $this->uri->segment(1)?>';
var this_li = $(this).attr('data-act-li');
var new_li = parseInt(this_li)+parseInt(1);
var frm_id = $(this).attr('data-id');
var new_tab = $(this).attr('data-act-tab');
var this_tab =$(this).attr('data-act-curt');
var form = $( "#"+frm_id );					
form.validate();

	if(this_li==1)
	{
		$('ul.resp-tabs-list  li a').attr("data-toggle","tab");		
	}
	

  if(form.valid()){
	
		var fdata1 = $('#'+frm_id).serialize();
		data = fdata1;
		url =  "<?php echo base_url()?>article/submit_article";
		$.ajax({
				   type: "POST",
				   url: url,
				   data: data,
				   dataType: 'html',
				   success: function(msg)
				   {
						$('#art_id').val(msg);
						$('.inset_artid').val(msg);
						
						$( "#"+this_tab ).removeClass( "active" );
						$( "#"+new_tab ).addClass( "active" );
						
						$( "#l"+this_li ).removeClass( "active" );
						$( "#l"+new_li ).addClass( "active" );
						
						
						if(frm_id=='step_1' && pagt_url =='post-manuscript')
						{
							var newurl = "<?php echo base_url()?>article/get_author";
							var formdata = 'oa_art_id='+msg;
							$.post( newurl, formdata, function( data ){
								$('.manage_author').html(data);
							});
						}
						
						
				   }
			});

  }

	

});

$(document).on('click', '#other_aut_btn', function(event){
var form = $( "#other_authorfrm");					
form.validate();
	 if(form.valid()){
	 
	 var fdata1 = $('#other_authorfrm').serialize();
		data = fdata1;
		url =  "<?php echo base_url()?>article/submit_other_author";
		$.ajax({
				   type: "POST",
				   url: url,
				   data: data,
				   dataType: 'html',
				   success: function(msg)
				   {
				   
				  // 	alert(msg);
						$('#oa_fname').val();
						$('#oa_lname').val();
						$('#oa_affiliation').val();
						$('#oa_email').val();
						
						
						if($('#oa_id').val()!='')
						{
							var od_id = $('#oa_id').val();
							$('#'+od_id).html(msg);
						}
						else
						{
							$('.manage_author').append(msg);
						}
				   }
			});
	 }
});

$(document).on('click', '.del_author', function(event){

	var r= confirm('Are you sure you want to delete?');
	if( r==true ){

 		var ou_id= $(this).attr('data-autid');	

 		var ou_artid= $(this).attr('data-artid');	
 
		 var fdata1 = 'oa_id='+ou_id+'&oa_art_id='+ou_artid ;
		data = fdata1;
		url =  "<?php echo base_url()?>article/delete_author";
		$.ajax({
				   type: "POST",
				   url: url,
				   data: data,
				   dataType: 'html',
				   success: function(msg)
				   {
							var newurl = "<?php echo base_url()?>article/get_author";
							var formdata = 'oa_art_id='+ou_artid;
							$.post( newurl, formdata, function( data ){
								$('.manage_author').html(data);
							});
				   }
			});
	}
});

$(document).on('click', '.edit_author', function(event){ 


 var ou_id= $(this).attr('data-autid');	
 var ou_fname= $(this).attr('data-fname');	
 var ou_lname= $(this).attr('data-lname');	
 var ou_affi = $(this).attr('data-affi');	
 var ou_email = $(this).attr('data-mail');	
 
 $('#oa_id').val(ou_id);
 $('#oa_fname').val(ou_fname);
 $('#oa_lname').val(ou_lname);
 $('#oa_affiliation').val(ou_affi);
 $('#oa_email').val(ou_email);
			
});

$(document).on('click', '.order_up', function(event){ 


var pagt_url = '<?php echo $this->uri->segment(1)?>';
 var ou_id= $(this).attr('data-autid');	
 var ou_artid= $(this).attr('data-artid');	
 var ou_order= $(this).attr('data-order');

var fdata1 = 'ou_id='+ou_id+'&ou_artid='+ou_artid+'&ou_order='+ou_order+'&order_type=up';
		data = fdata1;
		url =  "<?php echo base_url()?>article/update_ordertype";						
		 $.ajax({
				   type: "POST",
				   url: url,
				   data: data,
				   dataType: 'html',
				   success: function(msg)
				   {
				   	// alert(msg);
						if(pagt_url =='post-manuscript')
						{
							var newurl = "<?php echo base_url()?>article/get_author";
							var formdata = 'oa_art_id='+ou_artid;
							$.post( newurl, formdata, function( data ){
								$('.manage_author').html(data);
							});
						}
						else
						{
				  			//$('.manage_author').load(window.location.href + ' .manage_author');
							$('#oter_add_author').load(window.location.href + ' .manage_author');
						}	
				   }
			});
			


});

$(document).on('click', '.order_down', function(event){ 


var pagt_url = '<?php echo $this->uri->segment(1)?>';
 var ou_id= $(this).attr('data-autid');	
 var ou_artid= $(this).attr('data-artid');	
 var ou_order= $(this).attr('data-order');

var fdata1 = 'ou_id='+ou_id+'&ou_artid='+ou_artid+'&ou_order='+ou_order+'&order_type=down';
		data = fdata1;
		url =  "<?php echo base_url()?>article/update_ordertype";						
		 $.ajax({
				   type: "POST",
				   url: url,
				   data: data,
				   dataType: 'html',
				   success: function(msg)
				   {
				   	// alert(msg);
				  //	$('.manage_author').load(window.location.href + ' .manage_author');
				  		if(pagt_url =='post-manuscript')
						{
							var newurl = "<?php echo base_url()?>article/get_author";
							var formdata = 'oa_art_id='+ou_artid;
							$.post( newurl, formdata, function( data ){
								$('.manage_author').html(data);
							});
						}
						else
						{
				  			//$('.manage_author').load(window.location.href + ' .manage_author');
							$('#oter_add_author').load(window.location.href + ' .manage_author');
						}	
				   }
			});
			


});


	
$(document).on('change', '.crt_file_type', function(event){ 


    var name =$(this).val();
	

		var validExtensions = ['doc','docx','pptx','ppt']; //array of valid extensions
        var fileName = name;
        var fileNameExt = fileName.substr(fileName.lastIndexOf('.') + 1);
        if ($.inArray(fileNameExt, validExtensions) == -1){
           alert("Invalid file type");
            return false;
        }
	
});


$(document).on('click', '#submit_scheme_file', function(event){ 



var count = 0;

var frm_id = $(this).attr('data-id');

var form = $( ('#'+frm_id));					
form.validate();
 if(form.valid()){

	if($('#art_scheme').val()!='')
	{
		var name=$('#art_scheme').val();
		var validExtensions = ['gif','png','jpg','jpeg']; //array of valid extensions
        var fileName = name;
        var fileNameExt = fileName.substr(fileName.lastIndexOf('.') + 1);
        if ($.inArray(fileNameExt, validExtensions) == -1){		
			 count = 1;
			$('#art_scheme_error').show();
        }
	}	

	if(count==0)
	{
		$("#ajax_loddder").show();	
	
		var this_li = $(this).attr('data-act-li');
		var new_li = parseInt(this_li)+parseInt(1);
		var frm_id = $(this).attr('data-id');
		var new_tab = $(this).attr('data-act-tab');
		var this_tab =$(this).attr('data-act-curt');
		var fdata1 = $('#'+frm_id).serialize();
		var fdata1 =  new FormData($('#'+frm_id)[0]);
		data = fdata1;
		url =  "<?php echo base_url()?>article/submit_article";
		$.ajax({
				   type: "POST",
				   url: url,
				   data: data,
				   dataType: 'html',
				   success: function(msg)
				   {
				 	 $('#ajax_loddder').hide();
				   	
				  		$('#art_id').val(msg);
						$('.inset_artid').val(msg);
						
						$( "#"+this_tab ).removeClass( "active" );
						$( "#"+new_tab ).addClass( "active" );
						
						$( "#l"+this_li ).removeClass( "active" );
						$( "#l"+new_li ).addClass( "active" );
				   },
                    cache: false,
                    contentType: false,
                    processData: false
			});
		return false;
	   
	}
 }	

});
	
	
	

$(document).on('click', '#Submit_files', function(event){ 



var count = 0;
	if($('#art_cover').val()!='')
	{
		var name=$('#art_cover').val();
		var validExtensions = ['doc','docx']; //array of valid extensions
        var fileName = name;
        var fileNameExt = fileName.substr(fileName.lastIndexOf('.') + 1);
        if ($.inArray(fileNameExt, validExtensions) == -1){
			$('#art_cover_error').show();
			 count = 1;
        }
	}	
	if($('#art_menuscript').val()!='')
	{
		var name=$('#art_menuscript').val();
		var validExtensions = ['doc','docx']; //array of valid extensions
        var fileName = name;
        var fileNameExt = fileName.substr(fileName.lastIndexOf('.') + 1);
        if ($.inArray(fileNameExt, validExtensions) == -1){
			$('#art_menuscript_error').show();
			 count = 1;
        }
	}	
	if($('#art_figure').val()!='')
	{
		var name=$('#art_figure').val();
		var validExtensions = ['doc','docx']; //array of valid extensions
        var fileName = name;
        var fileNameExt = fileName.substr(fileName.lastIndexOf('.') + 1);
        if ($.inArray(fileNameExt, validExtensions) == -1){
			$('#art_figure_error').show();
			 count = 1;
        }
	}	
	if($('#art_slide').val()!='')
	{
		var name=$('#art_slide').val();
		var validExtensions = ['doc','docx','pptx','ppt']; //array of valid extensions
        var fileName = name;
        var fileNameExt = fileName.substr(fileName.lastIndexOf('.') + 1);
        if ($.inArray(fileNameExt, validExtensions) == -1){
			$('#art_slide_error').show();
			 count = 1;
        }
	}	
	if($('#art_supple').val()!='')
	{
		var name=$('#art_supple').val();
		var validExtensions = ['doc','docx']; //array of valid extensions
        var fileName = name;
        var fileNameExt = fileName.substr(fileName.lastIndexOf('.') + 1);
        if ($.inArray(fileNameExt, validExtensions) == -1){
			$('#art_supple_error').show();
			 count = 1;
        }
	}	
	if($('#art_response').val()!='')
	{
		var name=$('#art_response').val();
		var validExtensions = ['doc','docx']; //array of valid extensions
        var fileName = name;
        var fileNameExt = fileName.substr(fileName.lastIndexOf('.') + 1);
        if ($.inArray(fileNameExt, validExtensions) == -1){
			$('#art_response_error').show();
			 count = 1;
        }
	}	
		

	if(count==0)
	{
	 	$('#ajax_loddder').show();
		var this_li = $(this).attr('data-act-li');
		var new_li = parseInt(this_li)+parseInt(1);
		var frm_id = $(this).attr('data-id');
		var new_tab = $(this).attr('data-act-tab');
		var this_tab =$(this).attr('data-act-curt');
		var fdata1 = $('#'+frm_id).serialize();
		var fdata1 =  new FormData($('#'+frm_id)[0]);
		data = fdata1;
		url =  "<?php echo base_url()?>article/submit_article";
		$.ajax({
				   type: "POST",
				   url: url,
				   data: data,
				   dataType: 'html',
				   success: function(msg)
				   {
				   	 $('#ajax_loddder').hide();
				  		$('#art_id').val(msg);
						$('.inset_artid').val(msg);
						
						$( "#"+this_tab ).removeClass( "active" );
						$( "#"+new_tab ).addClass( "active" );
						
						$( "#l"+this_li ).removeClass( "active" );
						$( "#l"+new_li ).addClass( "active" );
				   },
                    cache: false,
                    contentType: false,
                    processData: false
			});
		return false;
	   
	}

});
	
	

$(document).on('click', '#Submit_Submission', function(event){ 

var count = 0;

	if(count==0)
	{
		$('#ajax_loddder').show();
		var fdata = $('#step_7').serialize();
		
		var fdata1 = $('#step_1').serialize();
		var fdata2 = $('#step_2').serialize();
		var fdata3 = $('#step_3').serialize();
		var fdata4 = $('#step_4').serialize();
		var fdata5 = $('#step_5').serialize();
		var fdata7 = $('#step_7').serialize();
		
		
		data = fdata7+'&'+fdata5+'&'+fdata4+'&'+fdata3+'&'+fdata2+'&'+fdata1;
		url =  "<?php echo base_url()?>article/article_invite_frnds";
		$.ajax({
				   type: "POST",
				   url: url,
				   data: fdata,
				   dataType: 'html',
				   success: function(msg)
				   {
				 
				  	 data = fdata;//+'&'+fdata5+'&'+fdata4+'&'+fdata3+'&'+fdata2+'&'+fdata1;
					url =  "<?php echo base_url()?>article/final_submission";
					$.ajax({
								url: url,
								type: 'POST',
								data: data,
								async: false,
							   success: function(msg)
							   {
							   $('#ajax_loddder').hide();
								
									window.location.href = "<?php echo base_url();?>/user-dashboard";
									
							   }
						});
						
				   }
			});
			

	
	   
	}

});
	
</script>	
<?php
}
if($this->uri->segment(1)=='assign-reviewer' || $this->uri->segment(1)=='again-assign-reviewer')
{
?>
 <link rel="stylesheet" href="//code.jquery.com/ui/1.11.4/themes/smoothness/jquery-ui.css">
  <script src="//code.jquery.com/jquery-1.10.2.js"></script>
  <script src="//code.jquery.com/ui/1.11.4/jquery-ui.js"></script>
  <link rel="stylesheet" href="/resources/demos/style.css">
  <script>
  $(function() {
    $( "#due_date" ).datepicker();
  });
  </script>


<script src="http://thecodeplayer.com/uploads/js/jquery.easing.min.js" type="text/javascript"></script>
<script src="http://jqueryvalidation.org/files/dist/jquery.validate.min.js"></script>
<script>
$(document).on('click', '.chose_reviewer', function(event){



var frm_id = $(this).attr('data-fid');
	var form = $( "#"+frm_id );		
	$( "#"+frm_id ).removeAttr("novalidate");
form.validate();
		var fdata1 = $('#'+frm_id).serialize();
		data = fdata1;
		var count =0;
		$('input:checkbox').each(function () {
					if ($(this).is(':checked')) {
						count=1;
					}
		  });
		
		
		
		if((count==1)&& (form.valid()) )
		{
		
			$('#'+frm_id).submit();
		
			/*var fdata1 = $('#'+frm_id).serialize();
			data = fdata1;
			url =  "<?php echo base_url()?>editor/chose_reviewer";
			$.ajax({
				   type: "POST",
				   url: url,
				   data: data,
				   dataType: 'html',
				   success: function(msg)
				   {
				   		alert(msg);
					 // window.location.href = "<?php echo base_url();?>/user-dashboard";
				   }
			});*/

			
		}
		else
		{
			alert("Please Select reviwer name for that article");
		}
});

</script>	
<?php }
if($this->uri->segment(1)=='submit-review')
{
?>
<script src="<?php echo base_url();?>design/front/js/bootstrap-checkbox.js"></script>
<script>
$(function() {
$('input[type="checkbox"]').checkboxpicker();
});
</script>

<?php
}
if($this->uri->segment(1)=='publish-mainscript' || $this->uri->segment(1)=='publish-continue')
{
?>

<script src="http://jqueryvalidation.org/files/dist/jquery.validate.min.js"></script>
<!--<script src="http://jqueryvalidation.org/files/dist/additional-methods.min.js"></script>-->

<script>
$(document).on('click', '.next_pub', function(event){
var this_li = $(this).attr('data-act-li');
var new_li = parseInt(this_li)+parseInt(1);
var frm_id = $(this).attr('data-id');


var this_tab =$(this).attr('data-act-curt');



if( (this_li==1) && ($('#pub_paper').val()=='Review_article_or_Correspondence')){
	var new_tab = $(this).attr('data-act-tab-new');
}
else
{
	var new_tab = $(this).attr('data-act-tab');	
}


if(this_tab=='j')
{
var this_li ='2';
var frm_id = frm_id+'j';
}


//alert( frm_id);
//alert($('#'+frm_id).serialize());

var form = $( "#"+frm_id );					
form.validate();

	if(this_li==1)
	{
		$('ul.full_html_tab  li a').attr("data-toggle","tab");		
	}
	
tinyMCE.triggerSave();
  if(form.valid()){
	
		var fdata1 = $('#'+frm_id).serialize();
		data = fdata1;
		url =  "<?php echo base_url()?>publisher/submit_publisher";
		$.ajax({
				   type: "POST",
				   url: url,
				   data: data,
				   dataType: 'html',
				   success: function(msg)
				   {
				   		//alert(msg);
						//$('#art_id').val(msg);
												
						$('.inset_artid').val(msg);
						
						$( "#"+this_tab ).removeClass( "active" );
						$( "#"+new_tab ).addClass( "active" );
						
						$( "#l"+this_li ).removeClass( "active" );
						$( "#l"+new_li ).addClass( "active" );
						
						if(new_tab=='attach_file')
						{
							$('ul.resp-tabs-list  li a').attr("data-toggle","tab");
							$( "#full_html" ).removeClass( "active" );
							$( "#full" ).removeClass( "active" );
							$( "#attach" ).addClass( "active" );
							
						}
				   }
			});

  }

	

});


$(document).on('click', '.next_full_html', function(event){

var paper_type = $('#pub_paper').val();
if(paper_type=='Review_article_or_Correspondence')
{
		$('.pagestyle').hide();
		$('.pagestyle2').show();
}
else if(paper_type=='Article_or_Communication')
{	
		$('.pagestyle').show();
		$('.pagestyle2').hide();
}
var form = $( "#step_basic" );					
form.validate();
if(form.valid()){
	
		var fdata1 = $('#step_basic').serialize();
		data = fdata1;
		url =  "<?php echo base_url()?>publisher/submit_publisher";
		$.ajax({  
				type: "POST",
			    url: url,
			    data: data,
			    dataType: 'html',
			    success: function(msg)
			    {
					
					//alert(msg);
					//$('#art_id').val(msg);
					$('.inset_artid').val(msg);

					$( "#basic_inforamtion" ).removeClass( "active" );
					$( "#basic_info" ).removeClass( "active" );
					$( "#full_html" ).addClass( "active" );
					$( "#full" ).addClass( "active" );
				 }
			});

		}		
	
});


$(document).on('click', '#full', function(event){

var paper_type = $('#pub_paper').val();
if(paper_type=='Review_article_or_Correspondence')
{
		$('.pagestyle').hide();
		$('.pagestyle2').show();
}
else if(paper_type=='Article_or_Communication')
{	
		$('.pagestyle').show();
		$('.pagestyle2').hide();
}
	
});




$(document).on('click', '.next_research', function(event){

				$( "#attach" ).removeClass( "active" );
				$( "#attach_file" ).removeClass( "active" );
				$( "#rese" ).addClass( "active" );
				$( "#research" ).addClass( "active" );
	
});



$(document).on('click', '.next_like_article', function(event){

				$( "#rese" ).removeClass( "active" );
				$( "#research" ).removeClass( "active" );
				$( "#like_art" ).addClass( "active" );				
				$( "#like_article" ).addClass( "active" );
	
});


$(document).on('click', '#Submit_proof_files', function(event){ 



var count = 0;
	/*if($('#art_cover').val()!='')
	{
		var name=$('#art_cover').val();
		var validExtensions = ['doc','docx']; //array of valid extensions
        var fileName = name;
        var fileNameExt = fileName.substr(fileName.lastIndexOf('.') + 1);
        if ($.inArray(fileNameExt, validExtensions) == -1){
			$('#art_cover_error').show();
			 count = 1;
        }
	}	
	if($('#art_menuscript').val()!='')
	{
		var name=$('#art_menuscript').val();
		var validExtensions = ['doc','docx']; //array of valid extensions
        var fileName = name;
        var fileNameExt = fileName.substr(fileName.lastIndexOf('.') + 1);
        if ($.inArray(fileNameExt, validExtensions) == -1){
			$('#art_menuscript_error').show();
			 count = 1;
        }
	}	
	if($('#art_figure').val()!='')
	{
		var name=$('#art_figure').val();
		var validExtensions = ['doc','docx']; //array of valid extensions
        var fileName = name;
        var fileNameExt = fileName.substr(fileName.lastIndexOf('.') + 1);
        if ($.inArray(fileNameExt, validExtensions) == -1){
			$('#art_figure_error').show();
			 count = 1;
        }
	}	
	if($('#art_slide').val()!='')
	{
		var name=$('#art_slide').val();
		var validExtensions = ['doc','docx']; //array of valid extensions
        var fileName = name;
        var fileNameExt = fileName.substr(fileName.lastIndexOf('.') + 1);
        if ($.inArray(fileNameExt, validExtensions) == -1){
			$('#art_slide_error').show();
			 count = 1;
        }
	}	
	if($('#art_supple').val()!='')
	{
		var name=$('#art_supple').val();
		var validExtensions = ['doc','docx']; //array of valid extensions
        var fileName = name;
        var fileNameExt = fileName.substr(fileName.lastIndexOf('.') + 1);
        if ($.inArray(fileNameExt, validExtensions) == -1){
			$('#art_supple_error').show();
			 count = 1;
        }
	}	
	if($('#art_response').val()!='')
	{
		var name=$('#art_response').val();
		var validExtensions = ['doc','docx']; //array of valid extensions
        var fileName = name;
        var fileNameExt = fileName.substr(fileName.lastIndexOf('.') + 1);
        if ($.inArray(fileNameExt, validExtensions) == -1){
			$('#art_response_error').show();
			 count = 1;
        }
	}	*/
		

	if(count==0)
	{
	 $('#ajax_loddder').show();
	
		var new_tab = $(this).attr('data-act-tab');
		var this_tab =$(this).attr('data-act-curt');
		var fdata1 = $('#step_10').serialize();
		var fdata1 =  new FormData($('#step_10')[0]);
		data = fdata1;
		url =  "<?php echo base_url()?>publisher/submit_files";
		$.ajax({
				   type: "POST",
				   url: url,
				   data: data,
				   dataType: 'html',
				   success: function(msg)
				   {
				    $('#ajax_loddder').hide();
				  		$( "#attach" ).removeClass( "active" );
						$( "#attach_file" ).removeClass( "active" );
						$( "#rese" ).addClass( "active" );
						$( "#research" ).addClass( "active" );
				   },
                    cache: false,
                    contentType: false,
                    processData: false
			});
		return false;
	   
	}
	
	

});


$(document).on('click', '.submit_see_complete', function(event){

	($('.art_must_see').length);
	
 var checked_art = $('.art_must_see:checkbox:checked').length; 

	if(checked_art>0)
	{
		var data=  $('#must_see').serialize();
	  url =  "<?php echo base_url()?>publisher/submit_publisher";
		  $.post( url, data, function( result ) {
		  //	alert(result);
			
				$( "#rese" ).removeClass( "active" );
				$( "#research" ).removeClass( "active" );
				$( "#like_art" ).addClass( "active" );				
				$( "#like_article" ).addClass( "active" );
		});
	}
	else
	{
		alert('Please checked atleast one check box');
	}

});



$(document).on('click', '#add_res_art', function(event){	

var frm_id  = $(this).attr('data-fid');
var art_id  = $(this).attr('data-artid');


var html_body = '';
var i_val = (frm_id-1);
var form = $( "#res_art"+i_val );					
form.validate();

	
	
  if(form.valid()){
  
		html_body ='<div class="main_public_se_cont"><form name="res_art'+frm_id+'" id="res_art'+frm_id+'" method="post"  enctype="multipart/form-data"><input type="hidden" name="research_id" id="research_id'+frm_id+'" value=""><input type="hidden" name="research_artid" id="research_artid" value="'+art_id+'"><div class="col-md-2"><div class="main_public_se_head_two"><input type="text" name="research_title" id="research_title'+frm_id+'" value="" required="required"></div></div><div class="col-md-2"> <div class="main_public_se_head_two"><input type="text" name="research_journal" id="research_journal'+frm_id+'" value="" required="required"></div></div> <div class="col-md-2"><div class="main_public_se_head_two"><input type="file" name="research_file" id="research_file'+frm_id+'" class="next action-button"/></div></div><div class="col-md-4"><div class="main_public_se_head_two"> <input type="text" name="research_url" id="research_url'+frm_id+'" value=""required="required"></div></div><div class="col-md-4"><div class="main_public_se_head_two"> <a href="#" class="next action-button submit_res_asrt" data-sno="'+frm_id+'">Submit</a> </div></div></form></div>';
	
var attvalue =	(parseInt(frm_id)+parseInt(1));
								
								$('#add_res_art').attr('data-fid',attvalue);
								
								$( "#all_data" ).append( html_body );
	}								
	
});	

$(document).on('click', '.submit_res_asrt', function(event){


var frm_id = $(this).attr('data-sno');
var form = $( "#res_art"+frm_id );					
form.validate();

	
	
  if(form.valid()){
  $('#ajax_loddder').show();
	var fdata1 = $('#res_art'+frm_id).serialize();
		var fdata1 =  new FormData($('#res_art'+frm_id)[0]);
		data = fdata1;
		url =  "<?php echo base_url()?>publisher/res_art_submit";
		$.ajax({
				   type: "POST",
				   url: url,
				   data: data,
				   dataType: 'html',
				   success: function(msg)
				   {			
				   		$('#ajax_loddder').hide();			
						$('#research_id'+frm_id).val(msg);					
				   },
                    cache: false,
                    contentType: false,
                    processData: false
			});
		return false;
  }
});



$(document).on('click', '.preview_article', function(event){



var art_id = $(this).attr('data-artid');

window.location.href = "<?php echo base_url();?>/article_preview/"+art_id;

});

	
</script>	
<?php
}
if($this->uri->segment(1)=='login')
{
?>

<script src="http://jqueryvalidation.org/files/dist/jquery.validate.min.js"></script>
<script>
$(document).on('change', '#user_type', function(event){
var form = $( "#login_frm" );					
form.validate();
form.valid();
	if(form.valid())
	{
		$( "#login_frm" ).submit();
	}
});
</script>
<?php
}
if(($this->uri->segment(1)=='article_fulltext') ||($this->uri->segment(1)=='detail-fulltext') || ($this->uri->segment(1)=='user-dashboard'))
{
?>
<script src=" <?php echo  base_url();?>design/front/js/easyResponsiveTabs.js"></script> 
<!-- IE10 viewport hack for Surface/desktop Windows 8 bug --> 

<script type="text/javascript">
    $(document).ready(function() {
        //Horizontal Tab
        $('#parentHorizontalTab').easyResponsiveTabs({
            type: 'default', //Types: default, vertical, accordion
            width: 'auto', //auto or any width like 600px
            fit: true, // 100% fit in a container
            tabidentify: 'hor_1', // The tab groups identifier
            activate: function(event) { // Callback function if tab is switched
                var $tab = $(this);
                var $info = $('#nested-tabInfo');
                var $name = $('span', $info);
                $name.text($tab.text());
                $info.show();
            }
        });

        // Child Tab
        $('#ChildVerticalTab_1').easyResponsiveTabs({
            type: 'vertical',
            width: 'auto',
            fit: true,
            tabidentify: 'ver_1', // The tab groups identifier
            activetab_bg: '#fff', // background color for active tabs in this group
            inactive_bg: '#F5F5F5', // background color for inactive tabs in this group
            active_border_color: '#c1c1c1', // border color for active tabs heads in this group
            active_content_border_color: '#5AB1D0' // border color for active tabs contect in this group so that it matches the tab head border
        });

        //Vertical Tab
        $('#parentVerticalTab').easyResponsiveTabs({
            type: 'vertical', //Types: default, vertical, accordion
            width: 'auto', //auto or any width like 600px
            fit: true, // 100% fit in a container
            closed: 'accordion', // Start closed if in accordion view
            tabidentify: 'hor_1', // The tab groups identifier
            activate: function(event) { // Callback function if tab is switched
                var $tab = $(this);
                var $info = $('#nested-tabInfo2');
                var $name = $('span', $info);
                $name.text($tab.text());
                $info.show();
            }
        });
    });
</script>
<?php 
}

if($this->uri->segment(1)=='revision-mainscript')/* || $this->uri->segment(1)=='post-manuscript'*/
{
?>

<script src="http://jqueryvalidation.org/files/dist/jquery.validate.min.js"></script>
<!--<script src="http://jqueryvalidation.org/files/dist/additional-methods.min.js"></script>-->

<script>
$(document).on('click', '.next_frm', function(event){

var this_li = $(this).attr('data-act-li');
var new_li = parseInt(this_li)+parseInt(1);
var frm_id = $(this).attr('data-id');
var new_tab = $(this).attr('data-act-tab');
var this_tab =$(this).attr('data-act-curt');
var form = $( "#"+frm_id );					
form.validate();

	if(this_li==1)
	{
		$('ul.resp-tabs-list  li a').attr("data-toggle","tab");		
	}
	

  if(form.valid()){
	
		var fdata1 = $('#'+frm_id).serialize();
		data = fdata1;
		url =  "<?php echo base_url()?>article/revision_action";
		$.ajax({
				   type: "POST",
				   url: url,
				   data: data,
				   dataType: 'html',
				   success: function(msg)
				   {
				   		alert(msg);
						$('#art_id').val(msg);
						$('.inset_artid').val(msg);
						
						$( "#"+this_tab ).removeClass( "active" );
						$( "#"+new_tab ).addClass( "active" );
						
						$( "#l"+this_li ).removeClass( "active" );
						$( "#l"+new_li ).addClass( "active" );
				   }
			});

  }

	

});







$(document).on('click', '#add_keyword_revission', function(event){ 

var form = $( "#step_4");					
	form.validate();
	 if(form.valid()){	 
	 var art_keywork='';
	 art_keywork = $('#art_keyword').val();
	 
	 if(art_keywork=='')
	 {
	 	art_keywork = $('#art_keyword_tep').val();
	 }
	 else
	 {	 	
	 	art_keywork = art_keywork+','+$('#art_keyword_tep').val();
	 }
	  $('#art_keyword').val(art_keywork);
	  
	 
	 var fdata1 = $('#step_4').serialize();
		data = fdata1;
		url =  "<?php echo base_url()?>article/keyword_sudmission";
		$.ajax({
				   type: "POST",
				   url: url,
				   data: data,
				   dataType: 'html',
				   success: function(msg)
				   {
				   		$('#keyword_list').append(msg);
				   }
			});
	 }
});


	
$(document).on('click', '.del_key', function(event){ 

	var r= confirm('Are you sure you want to delete?');
	if( r==true ){
		
		var this_name = $(this).attr('data-name');
		var art_id = $(this).attr('data-artid');	
		
		data = 'art_id='+art_id+'&key_name='+this_name;
		url =  "<?php echo base_url()?>article/update_key_sudmission";
		$.ajax({
				   type: "POST",
				   url: url,
				   data: data,
				   dataType: 'html',
				   success: function(msg)
				   {
				   		var key_list ='';
						$('#art_keyword').val(msg);
						if(msg!='')
						{ 
						   var key_val = msg.split(',');
						   $.each(key_val, function( index, value ) {
							 // alert( index + ": " + value );
							key_list = key_list+'<span class="tab_fiv">'+value+'<a href="#" class="del_key" data-name="'+value+'" data-artid="'+art_id+'">X</a></span><br>';
							});
							
						}						
						$('#keyword_list').html(key_list);
				   }
			});
			
			
	
	}

});

	
$(document).on('change', '.crt_file_type', function(event){ 


    var name =$(this).val();
	

		var validExtensions = ['doc','docx','pptx','ppt']; //array of valid extensions
        var fileName = name;
        var fileNameExt = fileName.substr(fileName.lastIndexOf('.') + 1);
        if ($.inArray(fileNameExt, validExtensions) == -1){
           alert("Invalid file type");
            return false;
        }
	
});


$(document).on('click', '#Submit_files_revision', function(event){ 



var count = 0;
	if($('#art_cover').val()!='')
	{
		var name=$('#art_cover').val();
		var validExtensions = ['doc','docx']; //array of valid extensions
        var fileName = name;
        var fileNameExt = fileName.substr(fileName.lastIndexOf('.') + 1);
        if ($.inArray(fileNameExt, validExtensions) == -1){
			$('#art_cover_error').show();
			 count = 1;
        }
	}	
	if($('#art_menuscript').val()!='')
	{
		var name=$('#art_menuscript').val();
		var validExtensions = ['doc','docx']; //array of valid extensions
        var fileName = name;
        var fileNameExt = fileName.substr(fileName.lastIndexOf('.') + 1);
        if ($.inArray(fileNameExt, validExtensions) == -1){
			$('#art_menuscript_error').show();
			 count = 1;
        }
	}	
	if($('#art_figure').val()!='')
	{
		var name=$('#art_figure').val();
		var validExtensions = ['doc','docx']; //array of valid extensions
        var fileName = name;
        var fileNameExt = fileName.substr(fileName.lastIndexOf('.') + 1);
        if ($.inArray(fileNameExt, validExtensions) == -1){
			$('#art_figure_error').show();
			 count = 1;
        }
	}	
	if($('#art_slide').val()!='')
	{
		var name=$('#art_slide').val();
		var validExtensions = ['doc','docx','pptx','ppt']; //array of valid extensions
        var fileName = name;
        var fileNameExt = fileName.substr(fileName.lastIndexOf('.') + 1);
        if ($.inArray(fileNameExt, validExtensions) == -1){
			$('#art_slide_error').show();
			 count = 1;
        }
	}	
	if($('#art_supple').val()!='')
	{
		var name=$('#art_supple').val();
		var validExtensions = ['doc','docx']; //array of valid extensions
        var fileName = name;
        var fileNameExt = fileName.substr(fileName.lastIndexOf('.') + 1);
        if ($.inArray(fileNameExt, validExtensions) == -1){
			$('#art_supple_error').show();
			 count = 1;
        }
	}	
	if($('#art_response').val()!='')
	{
		var name=$('#art_response').val();
		var validExtensions = ['doc','docx']; //array of valid extensions
        var fileName = name;
        var fileNameExt = fileName.substr(fileName.lastIndexOf('.') + 1);
        if ($.inArray(fileNameExt, validExtensions) == -1){
			$('#art_response_error').show();
			 count = 1;
        }
	}	
		

	if(count==0)
	{
		 $('#ajax_loddder').show();
		var this_li = $(this).attr('data-act-li');
		var new_li = parseInt(this_li)+parseInt(1);
		var frm_id = $(this).attr('data-id');
		var new_tab = $(this).attr('data-act-tab');
		var this_tab =$(this).attr('data-act-curt');
		var fdata1 = $('#'+frm_id).serialize();
		var fdata1 =  new FormData($('#'+frm_id)[0]);
		data = fdata1;
		url =  "<?php echo base_url()?>article/revision_action";
		$.ajax({
				   type: "POST",
				   url: url,
				   data: data,
				   dataType: 'html',
				   success: function(msg)
				   {
				   	 $('#ajax_loddder').hide();
				   		alert('Files uploaded successfuly');
				  		/*$('#art_id').val(msg);
						$('.inset_artid').val(msg);
						
						$( "#"+this_tab ).removeClass( "active" );
						$( "#"+new_tab ).addClass( "active" );
						
						$( "#l"+this_li ).removeClass( "active" );
						$( "#l"+new_li ).addClass( "active" );*/
					
						
				   },
                    cache: false,
                    contentType: false,
                    processData: false
			});
		return false;
	   
	}

});
	
	

$(document).on('click', '#Submit_revison_Submission', function(event){ 

var count = 0;

	if(count==0)
	{
		var fdata = $('#step_1').serialize();
		var fdata2 = $('#step_2').serialize();
		var fdata3 = $('#step_3').serialize();
		var fdata4 = $('#step_4').serialize();
		var fdata5 = $('#step_5').serialize();
		
	
				 
				  	 data = fdata;
					url =  "<?php echo base_url()?>article/final_revission_submission";
					$.ajax({
								url: url,
								type: 'POST',
								data: data,
								async: false,
							   success: function(msg)
							   {
								
									window.location.href = "<?php echo base_url();?>/user-dashboard";
									
							   }
						});
	}

});
	
</script>	
<?php
}
if($this->uri->segment(1)=='complete-paper')
{
?>
<script>
	
$(document).on('click', '.final_publish', function(event){ 

	var r= confirm('Are you sure you want final publish this article?');
	if( r==true ){
		
		var art_id = $(this).attr('data-artid');	
		
		data = 'art_id='+art_id;
		url =  "<?php echo base_url()?>publisher/publish_final_article";
		$.ajax({
				   type: "POST",
				   url: url,
				   data: data,
				   dataType: 'html',
				   success: function(msg)
				   {
					  window.location.href = "<?php echo base_url();?>/user-dashboard";
				   }
			});
			
			
	
	}

});
</script>	
<?php
}
if($this->uri->segment(1)=='archive-list')
{
?>
	<script type="text/javascript" src="<?php echo base_url();?>design/front/js/smk-accordion.js"></script>
	<script type="text/javascript">
		jQuery(document).ready(function($){

			$(".accordion_example1").smk_Accordion();

			$(".accordion_example2").smk_Accordion({
				closeAble: true, //boolean
			});

			$(".accordion_example3").smk_Accordion({
				showIcon: false, //boolean
			});

			$(".accordion_example4").smk_Accordion({
				closeAble: true, //boolean
				closeOther: false, //boolean
			});

			$(".accordion_example5").smk_Accordion({closeAble: true});

			$(".accordion_example6").smk_Accordion();
			
			$(".accordion_example7").smk_Accordion({
				activeIndex: 2 //second section open
			});
			$(".accordion_example8, .accordion_example9").smk_Accordion();


	
			
		});
	</script>
<?php 	
}
?>
	
<script src="http://jqueryvalidation.org/files/dist/jquery.validate.min.js"></script>
<script>	
$(document).on('click', '#header_res_btn', function(event){
var form = $( "#header_res_frm" );					
form.validate();

	  if(form.valid()){
	  	var fdata1 = $('#header_res_frm').serialize();
		data = fdata1;
		url =  "<?php echo base_url()?>home/submit_subscriber";
		$.ajax({
				   type: "POST",
				   url: url,
				   data: data,
				   dataType: 'html',
				   success: function(msg)
				   {
						$('#header_res_msg').html(msg);
						$('#header_res_msg').show();
				   }
			});

	  }
});
   
$(document).on('click', '#footer_res_btn', function(event){
var form = $( "#footer_research" );					
form.validate();

	  if(form.valid()){
	  	var fdata1 = $('#footer_research').serialize();
		data = fdata1;
		url =  "<?php echo base_url()?>home/submit_subscriber";
		$.ajax({
				   type: "POST",
				   url: url,
				   data: data,
				   dataType: 'html',
				   success: function(msg)
				   {
						$('#footer_res_msg').html(msg);
						$('#footer_res_msg').show();
				   }
			});

	  }
});

</script>	

<script src="<?php echo base_url();?>design/front/js/jquery.ba-throttle-debounce.min.js"></script>
<script src="<?php echo base_url();?>design/front/js/jquery.stickyheader.js"></script>




</body>
</html>
