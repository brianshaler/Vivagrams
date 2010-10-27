<div class="wrapper wrappercontent">
<div class="content">
<h2 class="CronosProBold">My Account</h2>

<?=form_open('/profile', array('class' => 'account'))?>
<?=form_fieldset('User Info')?>
<p>
    <?=form_label('Phone', 'phone')?>
    <?=form_input('phone', $user_name)?>
</p>
<p>
    <?=form_label('Password', 'password')?>
    <?=form_password('password')?>
</p>
<?=form_fieldset_close()?>

<?=form_fieldset('Notifications')?>
<p>
    <?=form_label('Enable Notifications', 'notifications')?>
    <?=form_checkbox('notifications')?>
</p>
<?=form_fieldset_close()?>

<?=form_submit('save', 'Save')?>
</form>

<div style="height: 160px;"><!-- --></div>

</div>
</div>
