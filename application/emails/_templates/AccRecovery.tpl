Dear <?php echo $username; ?>, 


Someone requested a <?php echo SITE_NAME;?> account recovery for this email address.
If this was not you, please disregard this email. 



As a registered user, you have the following credentials 
associated with your <?php echo SITE_NAME;?> account: 


<?php if (true == $passwordLogin):?>

You have account directly in our system. You password was reset and
it is as follows:
<?php echo $newPassword;?>

<?php else:?>
You used <?php echo $provider_type;?> to login.

<?php 
if (!in_array($provider_type, array('facebook', 'twitter') )) {
   // echo "Your OpenID identyfier is \n" . $auth_key;
    
    //echo "\n\nCopy and paste this identifier to the field that will apppear
   //     when OpenID icon will be clicked on the login page.
   //     \n";
}
?>

<?php endif;?>



Log in using these credentials on the login page:
<?php echo $loginUrl; ?>



Kind regards
ShareHouse Team



