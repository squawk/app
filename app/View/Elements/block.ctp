<?php
	if (!empty($key) || !empty($slug)) {
		if (!empty($slug)) {
			$key = $slug;
		}

		$content = $this->requestAction(array('controller' => 'blocks', 'action' => 'get', $key));

		if ($content) {
			echo $content;
		}
	}
?>