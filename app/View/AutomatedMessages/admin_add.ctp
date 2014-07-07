<script language="JavaScript">
    jQuery(document).ready(function() {
       jQuery("#AutomatedMessageEventType").change(function() {
           itm = jQuery(this);
           if(itm.val() == '2') {
               jQuery("#message-contains").slideDown();
           } else {
               jQuery("#message-contains").slideUp();
           }
       });
       
       jQuery("#AutomatedMessageEventType").trigger('change');
        
    });
</script>


<div class="automatedMessages form">

	<div class="row">
		<div class="col-md-12">
			<div class="page-header">
				<h1><?php echo __('Add Automated Message'); ?></h1>
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

																<li><?php echo $this->Html->link(__('<span class="glyphicon glyphicon-list"></span>&nbsp;&nbsp;List Automated Messages'), array('action' => 'index'), array('escape' => false)); ?></li>
									<li><?php echo $this->Html->link(__('<span class="glyphicon glyphicon-list"></span>&nbsp;&nbsp;List Applications'), array('controller' => 'applications', 'action' => 'index'), array('escape' => false)); ?> </li>
		<li><?php echo $this->Html->link(__('<span class="glyphicon glyphicon-plus"></span>&nbsp;&nbsp;New Application'), array('controller' => 'applications', 'action' => 'add'), array('escape' => false)); ?> </li>
							</ul>
						</div>
					</div>
				</div>			
		</div><!-- end col md 3 -->
		<div class="col-md-9">
			<?php echo $this->Form->create('AutomatedMessage', array('role' => 'form')); ?>

				<div class="form-group">
					<?php echo $this->Form->input('application_id', array('class' => 'form-control', 'placeholder' => 'Application Id'));?>
				</div>
				<div class="form-group">
					<?php echo $this->Form->input('subject', array('class' => 'form-control', 'placeholder' => 'Subject'));?>
				</div>
				<div class="form-group">
					<?php echo $this->Form->input('message', array('class' => 'form-control', 'placeholder' => 'Message'));?>
				</div>
				<div class="form-group">
					<?php echo $this->Form->input('event_type', array('class' => 'form-control', 'placeholder' => 'Event Type', 'options' => Configure::read('Labs.EventTypes')));?>
				</div>
				<div id="message-contains">
				<div class="form-group">
					<?php echo $this->Form->input('message_contains', array('class' => 'form-control', 'placeholder' => 'Message Contains Text (leave blank for any)'));?>
				</div>					
				</div>
            <div class="form-group">
					<?php echo $this->Form->input('delay_by_seconds', array('class' => 'form-control', 'placeholder' => 'Delay by seconds (before sending this message)'));?>
				</div>
				<div class="form-group">
					<?php echo $this->Form->submit(__('Submit'), array('class' => 'btn btn-default')); ?>
				</div>

			<?php echo $this->Form->end() ?>

		</div><!-- end col md 12 -->
	</div><!-- end row -->
</div>
