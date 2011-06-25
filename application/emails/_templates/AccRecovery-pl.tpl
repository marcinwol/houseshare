Drogi <?php echo $username; ?>, 

<p>
Ktoś zarządał informcje odnośnie konta na 
<?php echo SITE_NAME;?> związane z tym emailem.
Jeśli to nie ty, proszę zignorować ten email.
</p>


<?php if (true == $passwordLogin):?>

    <p>
        <i>
        Masz konto bezpośrednio w naszym systemie. 
        Twoje hasło może być zresetowane pod
        <a href="<?php echo $resetPasswordLink;?>">tym adresem</a>.    
        </i>
    </p>
    
    <p>
    Ważność tego adresu wygaśnie za <?php echo $resetExpire;?> godziny.
    </p>
    
<?php else:?>
    
    <p>
    <i>        
        Użyłeś konto <strong><?php echo $provider_type;?></strong> do zalogowania się do 
        naszego systemu.
    </i>
    </p>

<?php endif;?>


<p>
Link do strony z logowaniem: 
<a href="<?php echo $loginUrl; ?>"><?php echo $loginUrl; ?></a>
</p>

<p>&nbsp;</p>
--
<p>
<?php echo SITE_NAME;?>
</p>



