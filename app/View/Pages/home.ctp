<?php
/**
 *
 *
 * @link          http://cakephp.org CakePHP(tm) Project
 * @package       app.View.Pages
 * @since         CakePHP(tm) v 0.10.0.1076
 */

if (!Configure::read('debug')):
	throw new NotFoundException();
endif;

App::uses('Debugger', 'Utility');
?>
<h4><?php echo Configure::read('Labs.ProjectDescription'); ?></h4>
<?php
if (Configure::read('debug') > 0):
	Debugger::checkSecurityKeys();
endif;
?>
<p>
    <?php echo __('Thanks for checking out our new project. Please note that any unofficial labs projects are not guaranteed in any way'); ?>
</p>