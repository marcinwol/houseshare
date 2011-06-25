Drogi <?php echo $username; ?>, 

<p>
Właśnie zostało zgłoszone zapytanie odnośnie twojej oferty:
<a href="<?php echo $advertUrl;?>">"<?php echo $advertTitle;?>"</a>
</p>
<p>
Treść zapytania jest następująca:
</p>

<p>
<i>        
<?php echo $message; ?>
</i>        
</p>

<p>
Podany email zwrotny:
<a href="mainto:<?php echo $fromMail;?>"><?php echo $fromMail;?></a>
</p>

<p>&nbsp;</p>

--
<p>
<?php echo SITE_NAME;?>
</p>


