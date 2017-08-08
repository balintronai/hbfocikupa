    
    <div id="login">
      <?php if (isset($probalkozas)): ?>
        <p class="error">Rossz felhasználónév vagy jelszó!</p>
      <?php endif; ?>
      <form name="login" method="POST" action="<?php echo $this->get_full_url(); ?>">
        <table>
          <tr>
            <td>Név:</td><td><input type="text" name="username" /></td>
          </tr>
          <tr>
            <td>Jelszó:</td><td><input type="password" name="password" /></td>
          </tr>
        </table>
        <input type="hidden" value="" name="hidden" />
        <p><input type="submit" name="ok" value="Bejelentkezés" id="loginbutton"/></p>
      </form>
      <script>
        document.login.username.select();
      </script>
    </div>
  </body>
</html>
