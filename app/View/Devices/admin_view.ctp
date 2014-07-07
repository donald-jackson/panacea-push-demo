<div class="devices view">
	<div class="row">
		<div class="col-md-12">
			<div class="page-header">
				<h1><?php echo __('Device'); ?></h1>
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
		<li><?php echo $this->Form->postLink(__('<span class="glyphicon glyphicon-remove"></span>&nbsp;&nbsp;Delete Device'), array('action' => 'delete', $device['Device']['id']), array('escape' => false), __('Are you sure you want to delete # %s?', $device['Device']['id'])); ?> </li>
		<li><?php echo $this->Html->link(__('<span class="glyphicon glyphicon-list"></span>&nbsp&nbsp;List Devices'), array('action' => 'index'), array('escape' => false)); ?> </li>
							</ul>
						</div><!-- end body -->
				</div><!-- end panel -->
			</div><!-- end actions -->
		</div><!-- end col md 3 -->

		<div class="col-md-9">			
			<table cellpadding="0" cellspacing="0" class="table table-striped">
				<tbody>
				<tr>
		<th><?php echo __('Id'); ?></th>
		<td>
			<?php echo h($device['Device']['id']); ?>
			&nbsp;
		</td>
</tr>
<tr>
		<th><?php echo __('Created'); ?></th>
		<td>
			<?php echo h($device['Device']['created']); ?>
			&nbsp;
		</td>
</tr>
<tr>
		<th><?php echo __('Modified'); ?></th>
		<td>
			<?php echo h($device['Device']['modified']); ?>
			&nbsp;
		</td>
</tr>
<tr>
		<th><?php echo __('Device Id'); ?></th>
		<td>
			<?php echo h($device['Device']['device_id']); ?>
			&nbsp;
		</td>
</tr>
<tr>
		<th><?php echo __('Device Name'); ?></th>
		<td>
			<?php echo h($device['Device']['device_name']); ?>
			&nbsp;
		</td>
</tr>
				</tbody>
			</table>

		</div><!-- end col md 9 -->
		<div class="col-md-3">
		</div>
		<div class="col-md-9">
			<h2><?php echo __('Send Message'); ?></h2>
			<?php echo $this->Form->create('Message', array('role' => 'form')); ?>
				<div class="form-group">
					<?php echo $this->Form->input('subject', array('class' => 'form-control', 'placeholder' => 'Subject'));?>
				</div>
				<div class="form-group">
					<?php echo $this->Form->input('message', array('class' => 'form-control', 'placeholder' => 'Message'));?>
				</div>
				<div class="form-group">
					<?php echo $this->Form->input('thread', array('class' => 'form-control', 'placeholder' => 'Thread'));?>
				</div>

				<div class="form-group">
					<?php echo $this->Form->submit(__('Submit'), array('class' => 'btn btn-default')); ?>
				</div>

			<?php echo $this->Form->end() ?>

		</div>

	</div>
</div>

