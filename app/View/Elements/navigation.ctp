    <div class="navbar navbar-inverse navbar-fixed-top">
      
      <div class="container">
          
        <div class="navbar-header">
          
          <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
          </button>
          
          <?php echo $this->Html->link(Configure::read('Labs.ProjectName'), array('controller' => 'pages', 'action' => 'home', 'admin' => false), array('class' => 'navbar-brand')); ?></a>
        </div>
        <div class="collapse navbar-collapse">
          <ul class="nav navbar-nav">
            <li><?php echo $this->Html->link(__('Accounts'), array('controller' => 'accounts', 'action' => 'index', 'admin' => true)); ?></li>
            <li><?php echo $this->Html->link(__('Applications'), array('controller' => 'applications', 'action' => 'index', 'admin' => true)); ?></li>
            <li><?php echo $this->Html->link(__('Messages'), array('controller' => 'automated_messages', 'action' => 'index', 'admin' => true)); ?></li>
            <li><?php echo $this->Html->link(__('Devices'), array('controller' => 'devices', 'action' => 'index', 'admin' => true)); ?></li>
          </ul>
            <?php echo $this->Html->image('panacea-icon-50px.png'); ?>
        </div><!--/.nav-collapse -->
      </div>
    </div>