<?php if (isset($_SESSION['admin_error']) && $_SESSION['admin_error'] != null) { ?>
    <div style="background-color: #F8D7DA; color: #721c24;  padding: 10px 15px; text-align: center;"><?php echo $_SESSION['admin_error']; ?></div>
    <?php $_SESSION['admin_error'] = null; ?>
<?php } ?>

<?php if (isset($_SESSION['admin_message']) && $_SESSION['admin_message'] != null) { ?>
    <div style="background-color: #d4edda; color: #155724;  padding: 10px 15px; text-align: center;"><?php echo $_SESSION['admin_message']; ?></div>
    <?php $_SESSION['admin_message'] = null; ?>
<?php } ?>
