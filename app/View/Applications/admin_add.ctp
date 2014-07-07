<script language="JavaScript">
    jQuery(document).ready(function() {
       jQuery("#ApplicationType").change(function() {
           itm = jQuery(this);
           if(itm.val() == '1') {
               jQuery("#private-details").slideDown();
               jQuery("#public-details").slideUp();
           } else {
               jQuery("#private-details").slideUp();
               jQuery("#public-details").slideDown();
           }
       });
       
       jQuery("#ApplicationType").trigger('change');
        
    });
</script>

<div class="applications form">

	<div class="row">
		<div class="col-md-12">
			<div class="page-header">
				<h1><?php echo __('Admin Add Application'); ?></h1>
			</div>
		</div>
	</div>



	<div class="row">
		<div class="col-md-3">
			<div class="actions">
				<div class="panel panel-default">
					<div class="panel-heading">Actions</div>
						<div class="panel-body">
							<ul class="nav nav-pills nav-stacked">

																<li><?php echo $this->Html->link(__('<span class="glyphicon glyphicon-list"></span>&nbsp;&nbsp;List Applications'), array('action' => 'index'), array('escape' => false)); ?></li>
									<li><?php echo $this->Html->link(__('<span class="glyphicon glyphicon-list"></span>&nbsp;&nbsp;List Accounts'), array('controller' => 'accounts', 'action' => 'index'), array('escape' => false)); ?> </li>
		<li><?php echo $this->Html->link(__('<span class="glyphicon glyphicon-plus"></span>&nbsp;&nbsp;New Account'), array('controller' => 'accounts', 'action' => 'add'), array('escape' => false)); ?> </li>
		<li><?php echo $this->Html->link(__('<span class="glyphicon glyphicon-list"></span>&nbsp;&nbsp;List Automated Messages'), array('controller' => 'automated_messages', 'action' => 'index'), array('escape' => false)); ?> </li>
		<li><?php echo $this->Html->link(__('<span class="glyphicon glyphicon-plus"></span>&nbsp;&nbsp;New Automated Message'), array('controller' => 'automated_messages', 'action' => 'add'), array('escape' => false)); ?> </li>
							</ul>
						</div>
					</div>
				</div>			
		</div><!-- end col md 3 -->
		<div class="col-md-9">
			<?php echo $this->Form->create('Application', array('role' => 'form')); ?>

				<div class="form-group">
					<?php echo $this->Form->input('description', array('class' => 'form-control', 'placeholder' => 'Description'));?>
				</div>
				<div class="form-group">
					<?php echo $this->Form->input('type', array('class' => 'form-control', 'placeholder' => 'Type', 'options' => Configure::read('Labs.AppTypes')));?>
				</div>
            <div id="private-details">
				<div class="form-group">
					<?php echo $this->Form->input('application_key', array('class' => 'form-control', 'placeholder' => 'Application Key'));?>
				</div>
				<div class="form-group">
					<?php echo $this->Form->input('account_id', array('class' => 'form-control', 'placeholder' => 'Account Id'));?>
				</div>
            </div>
            <div id="public-details">
                <div class="form-group">
					<?php echo $this->Form->input('api_key', array('class' => 'form-control', 'placeholder' => 'Api Key'));?>
				</div>
                <div class="form-group">
					<?php echo $this->Form->input('application_identifier', array('class' => 'form-control', 'placeholder' => 'Public Application Identifier'));?>
				</div>
            </div>
				<div class="form-group">
					<?php echo $this->Form->submit(__('Submit'), array('class' => 'btn btn-default')); ?>
				</div>

			<?php echo $this->Form->end() ?>

		</div><!-- end col md 12 -->
	</div><!-- end row -->
</div>
