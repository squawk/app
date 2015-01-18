<?php echo __('Hi %s,', $siteName);?>


<?php echo __('The %s form has been submitted at %s.', $lead['Lead']['type'], $siteName);?>


<?php echo __('The details are:');?>


<?php echo __('Name: %s', $lead['Lead']['name']); ?>


<?php echo __('Email Address: %s', $lead['Lead']['email']); ?>


<?php if (!empty($lead['Lead']['phone'])) : ?>
<?php echo __('Phone Number: %s', $lead['Lead']['phone']); ?>


<?php endif; ?>
<?php echo __('Message:'); ?>

<?php echo $lead['Lead']['message']; ?>