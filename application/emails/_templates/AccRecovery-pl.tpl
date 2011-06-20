Drogi <?php echo $username; ?>, 


Ktoś zarządał informcje odnośnie konta na 
<?php echo SITE_NAME;?> związane z tym emailem.
Jeśli to nie ty, proszę zgnorować ten email.



<?php if (true == $passwordLogin):?>

Masz konto bezpośrednio w naszym systemie. 
Twoje hasło może byś zresetowane pod tym adresem:
<?php echo $newPassword;?>

<?php else:?>
Użyłeś konto <?php echo $provider_type;?> to zalogowania się do 
naszego systemu.

<?php 
if (!in_array($provider_type, array('facebook', 'twitter') )) {
   // echo "Your OpenID identyfier is \n" . $auth_key;
    
    //echo "\n\nCopy and paste this identifier to the field that will apppear
   //     when OpenID icon will be clicked on the login page.
   //     \n";
}
?>

<?php endif;?>



Link do strony z logowaniem portalu <?php echo SITE_NAME;?>:
<?php echo $loginUrl; ?>



Z poważaniem,
ShareHouse Team



