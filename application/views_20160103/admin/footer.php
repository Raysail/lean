</div><!-- ./wrapper -->

        <!-- add new calendar event modal -->


        <!-- jQuery 2.0.2 -->
        <script src="http://ajax.googleapis.com/ajax/libs/jquery/2.0.2/jquery.min.js"></script>
        <!-- jQuery UI 1.10.3 -->
        <script src="<?php echo base_url();?>design/admin/js/jquery-ui-1.10.3.min.js" type="text/javascript"></script>
        <!-- Bootstrap -->
        <script src="<?php echo base_url();?>design/admin/js/bootstrap.min.js" type="text/javascript"></script> 
		      
        <!-- DATA TABES SCRIPT -->
        <script src="<?php echo base_url(); ?>design/admin/js/plugins/datatables/jquery.dataTables.js" type="text/javascript"></script>
        <script src="<?php echo base_url(); ?>design/admin/js/plugins/datatables/dataTables.bootstrap.js" type="text/javascript"></script>
		
		
        <!-- daterangepicker -->
        <script src="<?php echo base_url();?>design/admin/js/plugins/daterangepicker/daterangepicker.js" type="text/javascript"></script>
        <!-- Bootstrap WYSIHTML5 -->
        <script src="<?php echo base_url();?>design/admin/js/plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.all.min.js" type="text/javascript"></script>
        <!-- Admin App -->
        <script src="<?php echo base_url();?>design/admin/js/Admin/app.js" type="text/javascript"></script>
        
        <!-- Admin dashboard demo (This is only for demo purposes) -->
        <script src="<?php echo base_url();?>design/admin/js/Admin/dashboard.js" type="text/javascript"></script>   
		<script type="text/javascript">
            $(function() {
                $("#example1").dataTable();
                $('#example2').dataTable({
                    "bPaginate": true,
                    "bLengthChange": false,
                    "bFilter": false,
                    "bSort": true,
                    "bInfo": true,
                    "bAutoWidth": false
                });
            });
        </script>     
<script>

function delete_wal()
{
	var conf=confirm("Are You sure to delete this record!.");
	if(conf)
	{
		return true;
	}
	else
	{
		return false;
	}
}

function status_wal()
{
	var conf=confirm("Are You sure to change status this record!.");
	if(conf)
	{
		return true;
	}
	else
	{
		return false;
	}
}

function status_wal_upgrade()
{
	var conf=confirm("Are You sure this ad payment is transfer in your account!.");
	if(conf)
	{
		return true;
	}
	else
	{
		return false;
	}
}

function status_wal_paid()
{
	var conf=confirm("Are You sure this member is paid the fetaured amount!.");
	if(conf)
	{
		return true;
	}
	else
	{
		return false;
	}
}

</script>
    </body>
</html>