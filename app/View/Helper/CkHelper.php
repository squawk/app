<?php
App::uses('Helper', 'View');
class CkHelper extends Helper {
    public $helpers = array('Html', 'Form');

	/**
	* This function inserts CK Editor for a form input
	*
	* @param string $input The name of the field, can be field_name or Model.field_name
	* @param array $options Options include $options['label'] for a custom label - this can be expanded on if required
	*/
    function input($input, $options = array()) {
        echo $this->Html->script('//cdn.ckeditor.com/4.4.5.1/standard/ckeditor.js');

        $input = explode('.', $input);
        if (empty($input[1])) {
        	$field = $input[0];
        	$model = $this->Form->model();
        } else {
        	$model = $input[0];
        	$field = $input[1];
        }

        if (!empty($options['label'])) {
        	echo '<label>' . $options['label'] . '</label>';
        } else {
        	echo '<label>' . Inflector::humanize(Inflector::underscore($field)) . '</label>';
        }

        echo $this->Form->error($model . '.' . $field);
        echo $this->Form->input($model . '.' . $field, array('type' => 'textarea', 'label' => false, 'error' => false, 'required' => false));
		?>
			<script type="text/javascript">
				CKEDITOR.replace('<?php echo Inflector::camelize($model.'_'.$field); ?>', { customConfig: '<?php echo $this->Html->url('/coderity/pages/ckeditor'); ?>' });
			</script>

			<p>&nbsp;</p>
		<?php
    }
}