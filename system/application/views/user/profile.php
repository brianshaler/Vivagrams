<div class="wrapper wrappercontent">
<div class="content">

<?php if(($this->db_session->flashdata('success'))): ?>
<div class="flash"><?=$this->db_session->flashdata('success')?></div>
<?php endif ?>

<h2 class="CronosProBold">My Account</h2>

<?=form_open('/profile', array('class' => 'account'))?>
<?=form_fieldset('User Info')?>
<p>
    <? if ($user_name == digitsonly($user_name)) { ?>
    <?=form_label('Phone', 'phone')?>
    <?=form_input('phone', $user_name)?>
    <?
      $show_confirm = false;
      if ($confirmed) {
        echo " Confirmed!";
      } else { 
        $show_confirm = true;
        echo "<a href=\"#\" id=\"confirm_link\">Confirm your number!</a>";
      }
    } ?>
</p>
<p>
    <?=form_label('Password', 'password')?>
    <?=form_password('password')?>
</p>
<?=form_fieldset_close()?>

<?=form_fieldset('Notifications')?>
<p>
    <?=form_label('Enable Notifications', 'notifications')?>
    <?=form_checkbox('notifications', '1', $notifications)?>
</p>
<?=form_fieldset_close()?>

<?=form_submit('save', 'Save')?>
</form>

<?
if ($show_confirm)
{
  echo $this->load->view('widgets/confirm_number_popup', null, true);
  echo "<script>$(\"#confirm_link\").click(OpenConfirmPopup);</script>";
  
}
?>

<div style="height: 160px;"><!-- --></div>

</div>
</div>
