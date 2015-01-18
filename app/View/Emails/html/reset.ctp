<p><?php echo __('Hi %s,', $user['User']['first_name']);?></p>

<p><?php echo __('Your password has been reset at %s.', $siteName);?></p>

<p><?php echo __('Your login details are:');?><br />
<?php echo __('Username');?>: <?php echo $user['User']['username'];?><br />
<?php echo __('Password');?>: <?php echo $user['User']['password'];?>
</p>

<?php echo __('We recommend you change your password when you login.');?>

<p><?php echo __('Thank You');?><br/>
<?php echo $siteName;?></p>
